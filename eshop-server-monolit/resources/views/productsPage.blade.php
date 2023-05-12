@extends('layouts.app')

@section('content')
    @if($category != null)
    <div class="card text-center mx-5 my-3">
        <div class="card-body">
            <h4 class="card-title"><span class="category">{{ $category }}</span> smartfóny</h4>
            <p class="card-text text-responsive">V našej ponuke nájdete výrobky renomovaného predajcu mobilných
                telefónov a smartfónov {{ $category }}. Ponúkame to najlepšie na našom trhu za
                bekonkurenčné ceny. Naším hlavným cieľom je dosiahnuť najvyššiu možnú mieru spokojnosti zákazníkov a
                sprostredkovať prívetivé nákupné prostredie.
            </p>
        </div>
    </div>
    @else
        <div class="card text-center mx-5 my-3">
            <div class="card-body">
                <h4 class="card-title">Nájdené produkty</h4>
            </div>
        </div>
    @endif

    <div class="container-fluid mt-4">
        <div class="row">
            @if($category != null)
            <div class="col-sm-4 col-md-3 col-xl-2 col-12">
                <form >
                    <div class="container border-bottom mt-4">
                        <div class="text-uppercase d-flex align-items-center">Zoradiť podľa
                            <button class="btn ms-auto" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#order-choices"
                                    aria-expanded="false" aria-controls="order-choices">
                        <span
                            class="fas fa-plus">
                        </span>
                            </button>
                        </div>
                        <div id="order-choices" class="collapse">
                            <div class="form-check my-1">
                                <input class="form-check-input only-one" type="checkbox" name="orderBy" value="new" id="new-products">
                                <label class="form-check-label" for="new-products">
                                    Novinky
                                </label>
                            </div>
                            <div class="form-check my-1">
                                <input class="form-check-input only-one" type="checkbox" name="orderBy" value="priceAsc" id="ascending">
                                <label class="form-check-label" for="ascending">
                                    Najlacnejšie
                                </label>
                            </div>
                            <div class="form-check my-1">
                                <input class="form-check-input only-one" type="checkbox" name="orderBy" value="priceDesc" id="descending">
                                <label class="form-check-label" for="descending">
                                    Najdrahšie
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="container border-bottom mt-4">
                        <div class="text-uppercase d-flex align-items-center">Cena
                            <button class="btn ms-auto" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#price-range"
                                    aria-expanded="false" aria-controls="price-range">
                        <span
                            class="fas fa-plus">
                        </span>
                            </button>
                        </div>
                        <div id="price-range" class="collapse">
                            <div class="row mt-3 mb-4">
                                <div class="col-6 pe-1 ps-0">
                                    <div class="form-floating">
                                        <input id="min-price" class="form-control" name="minPrice" readonly>
                                        <label for="min-price">Od:</label>
                                    </div>
                                </div>
                                <div class="col-6 ps-1 pe-0">
                                    <div class="form-floating">
                                        <input id="max-price" class="form-control" name="maxPrice" readonly>
                                        <label for="max-price">Do:</label>
                                    </div>
                                </div>
                                <div class="col-12 mt-4">
                                    <div id="slider-range"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container border-bottom mt-4">
                        <div class="text-uppercase d-flex align-items-center">Dostupnosť
                            <button class="btn ms-auto" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#avail-choices"
                                    aria-expanded="false" aria-controls="avail-choices">
                        <span
                            class="fas fa-plus">
                        </span>
                            </button>
                        </div>
                        <div id="avail-choices" class="collapse">
                            <div class="form-check my-1">
                                <input class="form-check-input" type="checkbox" name="inStock[]" value="true" id="inStock">
                                <label class="form-check-label" for="inStock">
                                    Skladom
                                </label>
                            </div>
                            <div class="form-check my-1">
                                <input class="form-check-input" type="checkbox" name="inStock[]" value="false" id="onOrder">
                                <label class="form-check-label" for="onOrder">
                                    Na objednávku
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="container border-bottom mt-4">
                        <div class="text-uppercase d-flex align-items-center">Uhlopriečka
                            <button class="btn ms-auto" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#screen-size-choices"
                                    aria-expanded="false" aria-controls="screen-size-choices">
                        <span
                            class="fas fa-plus">
                        </span>
                            </button>
                        </div>
                        <div id="screen-size-choices" class="collapse">
                            <div class="form-check my-1">
                                <input class="form-check-input" type="checkbox" name="screenSize[]" value="4" id="screen-size-1">
                                <label class="form-check-label" for="screen-size-1">
                                    4" až 4,9"
                                </label>
                            </div>
                            <div class="form-check my-1">
                                <input class="form-check-input" type="checkbox" name="screenSize[]" value="5" id="screen-size-2">
                                <label class="form-check-label" for="screen-size-2">
                                    5" až 5,9"
                                </label>
                            </div>
                            <div class="form-check my-1">
                                <input class="form-check-input" type="checkbox" name="screenSize[]" value="6" id="screen-size-3">
                                <label class="form-check-label" for="screen-size-3">
                                    6" až 6,9"
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="container border-bottom mt-4">
                        <div class="text-uppercase d-flex align-items-center">Operačná pamäť
                            <button class="btn ms-auto" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#ram-choices"
                                    aria-expanded="false" aria-controls="ram-choices">
                        <span
                            class="fas fa-plus">
                        </span>
                            </button>
                        </div>
                        <div id="ram-choices" class="collapse">
                            <div class="form-check my-1">
                                <input class="form-check-input" type="checkbox" name="ram[]" value="12" id="ram-1">
                                <label class="form-check-label" for="ram-1">
                                    12 GB
                                </label>
                            </div>
                            <div class="form-check my-1">
                                <input class="form-check-input" type="checkbox" name="ram[]" value="8" id="ram-2">
                                <label class="form-check-label" for="ram-2">
                                    8 GB
                                </label>
                            </div>
                            <div class="form-check my-1">
                                <input class="form-check-input" type="checkbox" name="ram[]" value="4" id="ram-3">
                                <label class="form-check-label" for="ram-3">
                                    4 GB
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="container border-bottom mt-4">
                        <div class="text-uppercase d-flex align-items-center">Interná pamäť
                            <button class="btn ms-auto" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#hdd-choices"
                                    aria-expanded="false" aria-controls="hdd-choices">
                        <span
                            class="fas fa-plus">
                        </span>
                            </button>
                        </div>
                        <div id="hdd-choices" class="collapse">
                            <div class="form-check my-1">
                                <input class="form-check-input" type="checkbox" name="internalStorage[]" value="512" id="hdd-1">
                                <label class="form-check-label" for="hdd-1">
                                    512 GB
                                </label>
                            </div>
                            <div class="form-check my-1">
                                <input class="form-check-input" type="checkbox" name="internalStorage[]" value="256" id="hdd-2">
                                <label class="form-check-label" for="hdd-2">
                                    256 GB
                                </label>
                            </div>
                            <div class="form-check my-1">
                                <input class="form-check-input" type="checkbox" name="internalStorage[]" value="128" id="hdd-3">
                                <label class="form-check-label" for="hdd-3">
                                    128 GB
                                </label>
                            </div>
                            <div class="form-check my-1">
                                <input class="form-check-input" type="checkbox" name="internalStorage[]" value="64" id="hdd-4">
                                <label class="form-check-label" for="hdd-4">
                                    64 GB
                                </label>
                            </div>
                            <div class="form-check my-1">
                                <input class="form-check-input" type="checkbox" name="internalStorage[]" value="32" id="hdd-5">
                                <label class="form-check-label" for="hdd-5">
                                    32 GB
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        <button class="btn btn-dark w-75" type="submit">Použiť</button>
                    </div>
                </form>
            </div>
            @else
                <div class="col-sm-3 col-md-2 col-xl-1 col-12">
                </div>
            @endif
            <div class="product-list col-sm-8 col-md-9 col-xl-10 col-12 pe-5">
                <div class="bg-transparent list-items">
                    <div class="row">
                        @foreach($products as $product)
                            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                                <a class="list-item card" href="{{ route('product.show', $product->id) }}">
                                    @foreach($product->productImages as $image)
                                        @if($image->main_img == true)
                                            <img src="{{ asset($image->image_src) }}" class="card-img-top" alt="...">
                                            @break
                                        @endif
                                    @endforeach

                                    <div class="card-body pt-0">
                                        <h5 class="card-title text-center mb-4">{{ $product->name }}</h5>
                                        <div class="d-flex justify-content-between mx-4">
                                            <div class="price">
                                                <span>{{ $product->price }} €</span>
                                            </div>
                                            <div class="shopping-cart">
                                                <form method="GET" action="{{ route('addItemToCart', $product->id) }}">
                                                    <button class="btn" type="submit">
                                                        <i class="fas fa-cart-plus"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                        <div class="d-flex justify-content-end">
                            {{  $products->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $("#slider-range").slider({
                range: true,
                min: 0,
                max: 1500,
                values: [0, 1500],
                slide: function (event, ui) {
                    $("#min-price").val(ui.values[0]);
                    $("#max-price").val(ui.values[1]);
                }
            });
        });
        $('.only-one').click(function() {
            $('.only-one').not(this).prop('checked', false);
        });
    </script>
@endsection
