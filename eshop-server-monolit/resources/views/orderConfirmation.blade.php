@extends('layouts.app')

@section('content')
    <div id="order-final-holder" class="container">
        <div class="card text-center mx-3 my-2 my-xxl-3">
            <div class="card-body">
                <p id="order-final-text" class="card-text">Vaša objednávka č. {{ $orderId }} v hodnote {{ $totalPrice }}€ bola úspešne zaznamenaná</p>
                <a class="btn btn-dark" href="{{ route('homepage') }}">Späť na domovskú stránku</a>
            </div>
        </div>
    </div>
@endsection
