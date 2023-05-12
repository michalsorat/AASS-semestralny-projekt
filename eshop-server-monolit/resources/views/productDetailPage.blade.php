@extends('layouts.app')

@section('content')
    <div class="container mt-4 mt-lg-5">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="container">
                    <div id="product-images-slider" class="carousel carousel-dark slide w-100 ms-auto"
                         data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#product-images-slider" data-bs-slide-to="0"
                                    class="active" aria-current="true">
                            </button>
                            <button type="button" data-bs-target="#product-images-slider" data-bs-slide-to="1"></button>
                            <button type="button" data-bs-target="#product-images-slider" data-bs-slide-to="2"></button>
                        </div>
                        <div class="carousel-inner">
                            @foreach($product->productImages as $image)
                                @if($image->main_img == true)
                                <div class="carousel-item active">
                                    <img
                                        src="{{ asset($image->image_src) }}"
                                        class="d-block w-100" alt="">
                                </div>
                                @else
                                <div class="carousel-item">
                                    <img
                                        src="{{ asset($image->image_src) }}"
                                        class="d-block w-100" alt="">
                                </div>
                                @endif
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#product-images-slider"
                                data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#product-images-slider"
                                data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="row mx-lg-1 mx-xxl-4">
                    <div class="card border-0 mt-lg-0 mt-xxl-4 ">
                        <div class="product card-body">
                            <h2 class="product card-title">{{ $product->name }}</h2>
                            <p class="product card-text my-sm-3">
                                {{ $product->short_description }}
                                <a href="#">zobraziť celý popis</a>
                            </p>
                        </div>
                    </div>
                    <div class="card border-0 col-6 col-lg-4 mx-lg-4 my-sm-2 my-lg-3 px-3 px-sm-4 px-md-3 px-lg-0">
                        <div class="product prop card-body">
                            <h3 class="product prop card-title">Dostupnosť</h3>
                            <p class="product prop card-text">
                                {{ $availability }}
                            </p>
                        </div>
                    </div>
                    <div class="card border-0 col-6 col-lg-4 mx-lg-4 my-sm-2 my-lg-3 px-3 px-sm-4 px-md-3 px-lg-0">
                        <div class="product prop card-body">
                            <h3 class="product prop card-title">Záruka</h3>
                            <p class="product prop card-text">
                                2 roky
                            </p>
                        </div>
                    </div>
                    <div class="card border-0 col-6 col-lg-4 mx-lg-4 my-2 my-lg-3 px-3">
                        <div class="product price card-body">
                            <h3 class="product price card-title">{{ $product->price }} €</h3>
                        </div>
                    </div>
{{--                    <form method="GET" action="{{ route('addItemToCart', $product->id) }}">--}}
{{--                        <button class="btn" type="submit">--}}
{{--                            <i class="fas fa-cart-plus"></i>--}}
{{--                        </button>--}}
{{--                    </form>--}}
                    <form class="align-self-center col-5 col-lg-4 mx-lg-4 my-3 my-lg-4 ms-3 ms-sm-4 ms-md-3 px-lg-0" method="GET" action="{{ route('addItemToCart', $product->id) }}">
                        <button class="product btn btn-primary " type="submit">
                            <i class="fas fa-cart-plus"></i>
                            Pridať do košíka
                        </button>
                        <input id="cart-count" name="cart_count" type="text" placeholder="ks">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="product-specification-placeholder container my-4 my-lg-5">
        <div class="row specifications">
            <h2 class="specifications-title text-center mt-4 my-lg-4">
                Kompletné špecifikácie
            </h2>
            <div class="container col-10 col-lg-7 mb-5">
                @foreach($product->specifications as $specification)
                    <div class="row mt-4">
                        <h4 class="text-center my-3">{{ $specification->name }}</h4>
                        <p>{{ $specification->description }}</p>
                        <img src="{{ asset($specification->image_src) }}" alt="">
                    </div>
                @endforeach
            </div>

            <div class="tech-parameters-placeholder container col-9 col-lg-4 mt-3 mb-5 pb-4">
                <h3 class="params-title text-center my-4">Technické parametre</h3>
                <div
                    class="params-category d-flex justify-content-between border-bottom border-1 border-primary mx-2 my-2 mt-2">
                    <span>Displej</span>
                </div>
                <div
                    class="params-value d-flex justify-content-between border-bottom border-1 border-primary mx-2 my-2">
                    <span>Uhlopriečka displeja:</span>
                    <span>{{ $product->parameters->screen_size }}"</span>
                </div>
                <div
                    class="params-value d-flex justify-content-between border-bottom border-1 border-primary mx-2 my-2">
                    <span>Rozlíšenie displeja:</span>
                    <span>{{ $product->parameters->screen_resolution }}</span>
                </div>
                <div
                    class="params-value d-flex justify-content-between border-bottom border-1 border-primary mx-2 my-2">
                    <span>Typ displeja</span>
                    <span>{{ $product->parameters->screen_type }}</span>
                </div>

                <div
                    class="params-category d-flex justify-content-between border-bottom border-1 border-primary mx-2 my-2 mt-5">
                    <span>Výkon a výdrž</span>
                </div>
                <div
                    class="params-value d-flex justify-content-between border-bottom border-1 border-primary mx-2 my-2">
                    <span>Počet jadier procesora:</span>
                    <span>{{ $product->parameters->cpu_cores }}</span>
                </div>
                <div
                    class="params-value d-flex justify-content-between border-bottom border-1 border-primary mx-2 my-2">
                    <span>Frekvencia procesora:</span>
                    <span>{{ $product->parameters->cpu_frequency }} GHz</span>
                </div>
                <div
                    class="params-value d-flex justify-content-between border-bottom border-1 border-primary mx-2 my-2">
                    <span>Operačná pamäť:</span>
                    <span>{{ $product->parameters->ram }} GB</span>
                </div>
                <div
                    class="params-value d-flex justify-content-between border-bottom border-1 border-primary mx-2 my-2">
                    <span>Veľkosť úložiska:</span>
                    <span>{{ $product->parameters->internal_storage }} GB</span>
                </div>
                <div
                    class="params-value d-flex justify-content-between border-bottom border-1 border-primary mx-2 my-2">
                    <span>Kapacita batérie:</span>
                    <span>{{ $product->parameters->battery_capacity }} mAh</span>
                </div>

                <div
                    class="params-category d-flex justify-content-between border-bottom border-1 border-primary mx-2 my-2 mt-5">
                    <span>Fotoaparát</span>
                </div>
                <div
                    class="params-value d-flex justify-content-between border-bottom border-1 border-primary mx-2 my-2">
                    <span>Rozlíšenie zadného fotoaparátu:</span>
                    <span>{{ $product->parameters->back_camera_resolution }}</span>
                </div>
                <div
                    class="params-value d-flex justify-content-between border-bottom border-1 border-primary mx-2 my-2">
                    <span>Rozlíšenie predného fotoaparátu:</span>
                    <span>{{ $product->parameters->front_camera_resolution }}</span>
                </div>
                <div
                    class="params-value d-flex justify-content-between border-bottom border-1 border-primary mx-2 my-2">
                    <span>Maximálne rozlíšenie videa:</span>
                    <span>{{ $product->parameters->max_video_resolution }}</span>
                </div>

                <div
                    class="params-category d-flex justify-content-between border-bottom border-1 border-primary mx-2 my-2 mt-5">
                    <span>Softvér a pripojenie</span>
                </div>
                <div
                    class="params-value d-flex justify-content-between border-bottom border-1 border-primary mx-2 my-2">
                    <span>Operačný systém:</span>
                    <span>{{ $product->parameters->operating_system }}</span>
                </div>
                <div
                    class="params-value d-flex justify-content-between border-bottom border-1 border-primary mx-2 my-2">
                    <span>Konektor:</span>
                    <span>{{ $product->parameters->connector }}</span>
                </div>
                <div
                    class="params-value d-flex justify-content-between border-bottom border-1 border-primary mx-2 my-2">
                    <span>Sieťové pripojenie:</span>
                    <span>{{ $product->parameters->network_connection }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
