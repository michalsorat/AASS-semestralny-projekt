<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;

class ProductController extends Controller
{
    public function home()
    {
        $top_products = Product::with('productImages')->where('top_product', 1)->get();
        $best_prices = Product::with('productImages')->where('best_price', 1)->get();
        $discounts = Product::with('productImages')->where('discount', 1)->get();

        return view('homePage')
            ->with('top_products', $top_products)
            ->with('best_prices', $best_prices)
            ->with('discounts', $discounts);
    }

    public function index(Request $request)
    {
        $category = Route::currentRouteName();
        $products = Product::with('productImages')
            ->where('category', $category)
            ->where(function($query) use ($request) {
                if (!empty($request->minPrice)) {
                    $query->where('price', '>=', $request->minPrice);
                }
                if (!empty($request->maxPrice)) {
                    $query->where('price', '<=', $request->maxPrice);
                }
                if (!empty($request->inStock)) {
                    if (count($request->inStock) == 1) {
                        if ($request->inStock[0] == 'true') {
                            $query->where('available_amount', '>', 0);
                        }
                        else {
                            $query->where('available_amount', 0);
                        }
                    }
                }
            })
            ->whereHas('parameters', function ($query) use ($request) {
                if (!empty($request->screenSize)) {
                    $query->where('screen_size', 'LIKE', "{$request->screenSize[0]}%");
                    foreach ($request->screenSize as $screenSize) {
                        $query->orWhere('screen_size', 'LIKE', "{$screenSize}%");
                    }
                }
                if (!empty($request->ram)) {
                    $query->whereIn('ram', $request->ram);
                }
                if (!empty($request->internalStorage)) {
                    $query->whereIn('internal_storage', $request->internalStorage);
                }
            })
            ->when($request, function($query) use ($request) {
                if (!empty($request->orderBy)) {
                    if ($request->orderBy == 'new') {
                        $query->orderByDesc('created_at');
                    }
                    else if ($request->orderBy == 'priceAsc') {
                        $query->orderBy('price');
                    }
                    else if ($request->orderBy == 'priceDesc') {
                        $query->orderByDesc('price');
                    }
                }
                else {
                    $query->orderByDesc('created_at');
                }
            })
            ->paginate(16);

        return view('productsPage')
            ->with('products', $products)
            ->with('category', $category);
    }

    public function show($id)
    {
        $product = Product::with('productImages', 'specifications', 'parameters')->where('id', $id)->first();

        if ($product->available_amount > 0) {
            $availability = 'Skladom';
        }
        else {
            $availability = 'Na objednávku';
        }

        return view('productDetailPage')
            ->with('product', $product)
            ->with('availability', $availability);
    }

    public function showProductByName(Request $request){
        $product = Product::with('productImages', 'specifications', 'parameters')->where('name', $request->search_input)->first();
        $products = Product::with('productImages', 'specifications', 'parameters')
                            ->where('category', 'LIKE', "%{$request->search_input}%")
                            ->orWhere('name', 'LIKE', "%{$request->search_input}%")
                            ->orWhere('price', 'LIKE', "%{$request->search_input}%")
                            ->paginate(16);

        if ($product != null) {
            if ($product->available_amount > 0) {
                $availability = 'Skladom';
            }
            else {
                $availability = 'Na objednávku';
            }

            return view('productDetailPage')
                ->with('product', $product)
                ->with('availability', $availability);
        }
        else if ($products != null) {
            return view('productsPage')
                ->with('products', $products)
                ->with('category', null);
        }
        else return redirect('/');
    }

    public function autocomplete(Request $request)
    {
        $data = Product::select("name")
            ->where("name", "LIKE", "%{$request->get('query')}%")
            ->get();
        $product_names = array();
        foreach ($data as $obj) {
            array_push($product_names, (json_decode($obj)->name));
        }
        return response()->json($product_names);
    }

    public function synchronizeDatabase($shoppingCart) {
        $order = Order::firstWhere([['email', Auth::user()->email], ['status', 'pending']]);
        //uz existuje objednavka pending treba pridat produkt do nej
        if ($order) {
            $order->products()->detach();
        }
        //neexistuje pending treba vytvorit
        else {
            if (Auth::user()) {
                $id = Auth::user()->id;
            }
            else  {
                $id = 0;
            }
            $order_arr = array_merge(['user_id' => $id], Auth::user()->toArray(), ['status' => 'pending']);
            $cartProducts =  Order::create($order_arr);
        }
        foreach ($shoppingCart->items as $item) {
            $order->products()->attach($item['item']['id'], ['product_quantity' => $item['quantity']]);
        }
    }

    public function addItemToCart(Request $request, $id)
    {
        $oldShoppingCart = null;
        $times = 1;
        if ($request->session()->has('shoppingCart')) {
            $oldShoppingCart = $request->session()->get('shoppingCart');
        }

        $shoppingCart = new ShoppingCart($oldShoppingCart);
        $product = Product::with('productImages', 'specifications', 'parameters')->find($id);
        if ($request->cart_count != null) {
            $times = $request->cart_count;
        }

        $shoppingCart->add($product, $product->id, $times);
        $request->session()->put('shoppingCart', $shoppingCart);

        if (auth()->check()) {
            $this->synchronizeDatabase($shoppingCart);
        }

        return redirect()->back();
    }

    public function removeItemFromCart(Request $request, $id) {
        $oldShoppingCart = $request->session()->get('shoppingCart');
        $shoppingCart = new ShoppingCart($oldShoppingCart);
        $shoppingCart->remove($id);
        $request->session()->put('shoppingCart', $shoppingCart);

        if (auth()->check()) {
            $this->synchronizeDatabase($shoppingCart);
        }

        return redirect()->back();
    }

    public function addOneItemToCart(Request $request, $id) {
        $oldShoppingCart = $request->session()->get('shoppingCart');
        $shoppingCart = new ShoppingCart($oldShoppingCart);
        $shoppingCart->addOne($id);
        $request->session()->put('shoppingCart', $shoppingCart);

        if (auth()->check()) {
            $this->synchronizeDatabase($shoppingCart);
        }

        return redirect()->back();
    }

    public function removeOneItemToCart(Request $request, $id) {
        $oldShoppingCart = $request->session()->get('shoppingCart');
        $shoppingCart = new ShoppingCart($oldShoppingCart);
        $shoppingCart->removeOne($id);
        $request->session()->put('shoppingCart', $shoppingCart);

        if (auth()->check()) {
            $this->synchronizeDatabase($shoppingCart);
        }

        return redirect()->back();
    }

    public function getShoppingCart1(Request $request) {
        if (!$request->session()->has('shoppingCart')) {
            return view('shoppingCartStep1');
        }
        $oldShoppingCart = $request->session()->get('shoppingCart');
        $shoppingCart = new ShoppingCart($oldShoppingCart);

        return view('shoppingCartStep1')
            ->with('products', $shoppingCart->items)
            ->with('totalPrice', $shoppingCart->totalPrice);
    }

    public function getShoppingCart2(Request $request) {
        if (!$request->session()->has('shoppingCart')) {
            return view('shoppingCartStep2');
        }
        $oldShoppingCart = $request->session()->get('shoppingCart');
        $shoppingCart = new ShoppingCart($oldShoppingCart);
        $client = new Client(['base_uri' => 'http://localhost:3000']);
        $response = $client->get('/transports');
        $body = $response->getBody();
        $transports = json_decode($body);

        $response = $client->get('/payments');
        $body = $response->getBody();
        $payments = json_decode($body);

        return view('shoppingCartStep2')
            ->with('transports', $transports)
            ->with('payments', $payments)
            ->with('products', $shoppingCart->items)
            ->with('totalPrice', $shoppingCart->totalPrice);
    }

    public function getShoppingCart3(Request $request) {
        if (!$request->session()->has('shoppingCart')) {
            return view('shoppingCartStep3');
        }
        $oldShoppingCart = $request->session()->get('shoppingCart');
        $shoppingCart = new ShoppingCart($oldShoppingCart);
        $user = Auth::user();

        return view('shoppingCartStep3')
            ->with('products', $shoppingCart->items)
            ->with('totalPrice', $shoppingCart->totalPrice)
            ->with('user', $user)
            ->with('transport', $request->transport)
            ->with('payment', $request->payment_method);
    }

    public function getTransportType(Request $request, $type) {
        $price = 0;
        if ($type == 'delivery') {
            $price = 3.99;
        }
        else if ($type == 'cash-on-delivery') {
            $price = 2.99;
        }
        $oldShoppingCart = Session::get('shoppingCart');
        $shoppingCart = new ShoppingCart($oldShoppingCart);
        $shoppingCart->addPrice($price);
        Session::put('shoppingCart', $shoppingCart);

        return response()->json($price);
    }

    public function getOrderConfirmation(Request $request) {
        $userId = null;
        if (auth()->check()) {
            $userId = Auth::user()->id;
        }
        $order_arr = array_merge(['user_id' => $userId], $request->except('_token'), ['status' => 'created']);

//        Kafka
        Http::post('http://localhost:3000/trigger-kafka-process', $order_arr);

//        Camunda
//        $variablesJson = array();
//        foreach ($order_arr as $key => $value) {
//            $jsonItem = array_merge(["value" => $value]);
//            $variablesJson = array_merge($variablesJson, [$key => $jsonItem]);
//        }
//        $variablesJson = array_merge(["variables" => $variablesJson]);
//        Http::post('http://localhost:8080/engine-rest/process-definition/key/place-order/start', (array)json_encode($variablesJson));

        $shoppingCart = $request->session()->get('shoppingCart');

        //ak je prihlaseny
        //update pending->created
//        if (auth()->check()) {
//            $order = Order::firstWhere([['email', Auth::user()->email], ['status', 'pending']]);
//            $order->update(['status' => 'created']);
//        }
//        //ak nieje prihlaseny
//        else {
//            $order_arr = array_merge(['user_id' => '0'], $request->all(), ['status' => 'created']);
//            $order =  Order::create($order_arr);
//            foreach ($shoppingCart->items as $item) {
//                $order->products()->attach($item['item']['id'], ['product_quantity' => $item['quantity']]);
//            }
//        }
        $totalPrice = $shoppingCart->totalPrice;
        $request->session()->forget('shoppingCart');
        return view('orderConfirmation')
            ->with('totalPrice', $totalPrice)
            ->with('orderId', 1);
    }
}
