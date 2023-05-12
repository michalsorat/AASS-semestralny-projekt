<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ShoppingCart;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use function PHPUnit\Framework\isEmpty;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//    protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo() {
        if (Auth::user()->role == 'admin') {
            return RouteServiceProvider::ADMIN;
        }
        else {
            return RouteServiceProvider::HOME;
        }
    }

    protected function authenticated(Request $request, $user)
    {
        $cartProducts = Order::firstWhere([['email', Auth::user()->email], ['status', 'pending']]);

        if ($cartProducts && !empty($cartProducts->products()->get()->toArray())) {
            $cartProducts = $cartProducts->products()->get();
            $shoppingCart = new ShoppingCart(null);
            foreach ($cartProducts as $cartProduct) {
                $shoppingCart->add($cartProduct, $cartProduct->id, $cartProduct->pivot->product_quantity);
            }
            Session::put('shoppingCart', $shoppingCart);
        }
        else if (Session::has('shoppingCart')) {
            $shoppingCart = Session::get('shoppingCart');
            if (!$cartProducts) {
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
                $cartProducts->products()->attach($item['item']['id'], ['product_quantity' => $item['quantity']]);
            }
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
