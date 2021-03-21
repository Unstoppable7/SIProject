@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">Producto</div>
                <div class="card-body">
                    <h2 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">
                        @if ($product->status)
                            Producto Activo
                        @else
                            Producto Inactivo
                        @endif

                    </p>
                    <p class="text-muted mb-0">
                        <em>
                            &ndash;
                            @foreach ( $product->companies as $company )
                                {{$company->name}} <br>
                            @endforeach
                        </em>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

