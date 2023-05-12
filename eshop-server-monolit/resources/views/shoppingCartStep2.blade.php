@extends('layouts.app')

@section('content')
    <div class="container sumarization my-5 px-5 pt-2 pb-4">
        <div class="row d-flex justify-content-center">
            @isset($products)
            <div class="progress-holder col-10 mt-5">
                <div class="progress">
                    <div id="progress-bar-2" class="progress-bar" role="progressbar" aria-valuenow="50"
                         aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <button type="button" class="top-0 start-0 translate-middle btn btn-sm btn-primary rounded-pill">1
                </button>
                <button type="button" class="top-0 start-50 translate-middle btn btn-sm btn-primary rounded-pill">2
                </button>
                <button type="button" class="top-0 start-100 translate-middle btn btn-sm btn-secondary rounded-pill">3
                </button>
            </div>

            <div class="d-flex justify-content-between mt-2">
                <div>
                    <input type="text" readonly class="form-control-plaintext text-center" value="Sumarizácia položiek">
                </div>
                <div>
                    <input type="text" readonly class="form-control-plaintext text-center fw-bold"
                           value="Doprava a platba">
                </div>
                <div>
                    <input type="text" readonly class="form-control-plaintext text-center" value="Dodacie údaje">
                </div>
            </div>

            <form class="row" method="GET" action="{{ route('getShoppingCart3') }}">
                <div class="table-wrap col-12 col-lg-6">
                    <table class="table-small table table-responsive table-borderless">
                        <h5>Spôsob dopravy</h5>
                        <tbody>
                        @foreach($transports as $transport)
                            <tr class="align-middle alert border-bottom">
                                <td>
                                    @if ($loop->first)
                                        <input type="checkbox" id="personal-collect" class="transport-check" value="{{$transport->name}}" name="transport" checked>
                                    @else
                                        <input type="checkbox" id="delivery" class="transport-check" value="{{$transport->name}}" name="transport">
                                    @endif
                                </td>
                                <td class="text-center"><i class="{{$transport->icon}}"></i></td>

                                <td>
                                    <div>
                                        <p class="m-0 fw-bold">{{$transport->name}}</p>
                                    </div>
                                </td>
                                @if($transport->price > 0)
                                    <td>{{$transport->price}}&nbsp;€</td>
                                @else
                                    <td>Zadarmo</td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <table class="table-small table table-responsive table-borderless">
                        <h5>Spôsob platby</h5>
                        <tbody>
                        @foreach($payments as $payment)
                            <tr class="align-middle alert border-bottom">
                                <td>
                                    @if ($loop->first)
                                        <input type="checkbox" id="card" value="{{$payment->name}}" name="payment_method" checked>
                                    @else
                                        <input type="checkbox" id="cash-on-delivery" value="{{$payment->name}}" name="payment_method">
                                    @endif
                                </td>
                                <td class="text-center"><i class="{{$payment->icon}}"></i></td>

                                <td>
                                    <div>
                                        <p class="m-0 fw-bold">{{$payment->name}}</p>
                                    </div>
                                </td>
                                @if($payment->price > 0)
                                    <td>{{$payment->price}}&nbsp;€</td>
                                @else
                                    <td>Zadarmo</td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="table-wrap col-12 col-lg-6">
                    <table class="table-small table table-responsive table-borderless">
                        <h5>Sumár objednávky</h5>
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
                            </td>
                            <td>
                                <div>
                                    <p class="m-0 fw-bold">{{ $product['item']['name'] }}</p>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <p class="m-0 fw-bold">{{ $product['quantity'] }} KS</p>
                                </div>
                            <td>{{ $product['price'] }} €</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between">
                        <div class="next-step">
                            <ul>
                                <li><a href="{{route('getShoppingCart1')}}" class="btn btn-dark btn"><- späť do košíka</a></li>
                            </ul>
                        </div>

                        <div class="next-step mt-2">
                            <ul class="text-left">
                                <li><p>Spôsob doručenia:<span id="transport-type"></span></p></li>
                                <li><p>Spôsob platby:<span id="payment-method"></span></p></li>
                                <li><p>Cena celkom:<span id="price-total">{{ $totalPrice }} €</span></p></li>
                                <li><button type="submit" class="conditional-btn btn btn-dark btn">Pokračovať v objednávke</button></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </form>
            @else
                <div class="d-flex justify-content-center mt-auto">
                    <h3>Nemáte žiadne produkty v košíku.</h3>
                </div>
            @endisset
        </div>
    </div>

    <script>
        $('input[type="checkbox"]').on('change', function() {
            $('input[name="' + this.name + '"]').not(this).prop('checked', false);
            let type = $(this).attr('id');
            var url = "{{ route('transportType', ":type")  }}";
            url = url.replace(':type', type);
            if(this.checked){
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(data) {
                        console.log('Data retrieved succesfully');
                        if (type==='delivery' || type==='personal-collect'){
                            $('#transport-type').html(data + '€');
                        }
                        else if (type==='card' || type==='cash-on-delivery'){
                            $('#payment-method').html(data + '€');
                        }
                        // let total_now = document.getElementById("price-total").innerText;
                        // $('#price-total').html(parseFloat(total_now) + parseFloat(data));
                    },
                    error: function() {
                        console.log('Something went wrong');
                    }
                });

            }
        });
    </script>
@endsection
