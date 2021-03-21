@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card">
                    <div class="card-header">Editar Producto</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form action="{{ route('products.update', $product) }}"
                                method="POST"
                                enctype="multipart/form-data"
                        >
                            <div class="form-group">
                                <label for="selection">Companies *:</label>
                                <select name="selection" id="selection" class="form-control form-select-lg mb-3">
                                    @foreach ($companies as $company )
                                        <option value="{{$company->id}}">{{$company->name}}</option>
                                    @endforeach
                                </select>
                                <label for="name" class="font-weight-bold">Name *:</label>
                                <input type="text" value="{{ old('name', $product->name) }}" name="name" id="name" class="form-control" placeholder="name" required>
                            </div>

                            <div class="form-group text-center">
                                @csrf
                                @method('PUT')
                                <input type="submit" value="Actualizar" class="btn btn-lg btn-outline-success">
                            </div>
                        </form>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
