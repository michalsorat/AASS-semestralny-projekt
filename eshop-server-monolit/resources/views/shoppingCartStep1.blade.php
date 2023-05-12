@extends('layouts.app')

@section('content')
    <div class="container sumarization my-5 px-5 pt-2 pb-4">
        <div class="row d-flex justify-content-center">
            @isset($products)
            <div class="progress-holder col-10 mt-5">
                <div class="progress">
                    <div id="progress-bar-1" class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <button type="button" class="top-0 start-0 translate-middle btn btn-sm btn-primary rounded-pill">1</button>
                <button type="button" class="top-0 start-50 translate-middle btn btn-sm btn-secondary rounded-pill">2</button>
                <button type="button" class="top-0 start-100 translate-middle btn btn-sm btn-secondary rounded-pill">3</button>
            </div>

            <div class="d-flex justify-content-between mt-2">
                <div>
                    <input type="text" readonly class="form-control-plaintext text-center fw-bold"  value="Sumarizácia položiek">
                </div>
                <div>
                    <input type="text" readonly class="form-control-plaintext text-center"  value="Doprava a platba">
                </div>
                <div>
                    <input type="text" readonly class="form-control-plaintext text-center"  value="Dodacie údaje">
                </div>
            </div>

            <div class="table-wrap">
                <table class="table table-responsive table-borderless">
                    <thead>
                    <th>&nbsp;</th>
                    <th>Produkt</th>
                    <th>Počet kusov</th>
                    <th>Cena</th>
                    <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr class="align-middle alert border-bottom">
                                <td class="text-center">
                                    @foreach($product['item']['productImages'] as $image)
                                        @if($image->main_img == true)
                                            <img src="{{ asset($image->image_src) }}" class="pic" alt="...">
                                            @break
                                        @endif
                                    @endforeach
                                <td>
                                    <div>
                                        <p class="m-0 fw-bold">{{ $product['item']['name'] }}</p>
                                    </div>
                                </td>
                                <td> <input class="input" type="text" value={{ $product['quantity'] }} readonly>
                                    <div class="d-inline">
                                        <a class="btn" href="{{ route('addOneItemToCart', $product['item']['id']) }}">
                                            <i class="fas fa-plus-square"></i>
                                        </a>
                                        <a class="btn" href="{{ route('removeOneItemToCart', $product['item']['id']) }}">
                                            <i class="fas fa-minus-square"></i>
                                        </a>
                                    </div>
                                </td>
                                <td>{{ $product['price'] }} €</td>
                                <td>
                                    <a href="{{ route('removeItemFromCart', $product['item']['id']) }}" class="btn">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="next-step">
                <ul class="float-end text-center">
                    <li><p>Cena celkom:<span>{{ $totalPrice }} €</span></p></li>
                    <li><a href="{{route('getShoppingCart2')}}" class="btn btn-dark btn">Pokračovať v objednávke</a></li>
                </ul>
            </div>
            @else
                <div class="d-flex justify-content-center mt-auto">
                    <h3>Nemáte žiadne produkty v košíku.</h3>
                </div>
            @endisset
        </div>
    </div>

@endsection
