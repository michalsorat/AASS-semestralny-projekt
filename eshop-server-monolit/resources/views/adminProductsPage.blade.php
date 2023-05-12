@extends('layouts.app')

@section('content')
        <div class="card text-center mx-5 my-3">
            <div class="card-body">
                <h4 class="card-title">Zoznam všetkých produktov</h4>
            </div>
        </div>

    <div class="container-fluid mt-4">
        <div class="row">
                <div class="col-sm-3 col-md-2 col-xl-1 col-12">
                </div>
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
                                                <form method="POST" action="{{ route('admin.destroy', $product->id) }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button class="btn" type="submit">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
