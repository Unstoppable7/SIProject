@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($products as $product)
                <div class="card mb-4">
                    <div class="card-header">Producto</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">
                            {{ $product->get_excerpt }}
                            <a href="{{ route('product', $product) }}">Mas información</a>
                        </p>

                        <p class="text-muted mb-0">
                            <em>
                                &ndash;
                                @foreach ( $product->companies as $company )
                                    $company->name <br>
                                @endforeach
                            </em>
                        </p>
                    </div>
                </div>
            @endforeach
            {{$products->links()}}
        </div>
    </div>
</div>
@endsection
