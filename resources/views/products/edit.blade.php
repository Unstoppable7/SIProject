@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">Editar Producto</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                           <form action="{{ route('products.update', $product) }}"
                                 method="POST"
                                 enctype="multipart/form-data"
                            >
                                    <div class="form-group">
                                        <label >Titulo *</label>                                            //<!--aparece lo que ya estaba escrito -->
                                        <input type="text" name="title" class="form-control" required value="{{ old('title', $product->name) }}  ">
                                    </div>

                                    <div class="form-group">
                                        <label >Imagen</label>
                                        <input type="file" name="file">
                                    </div>


                                    <div class="form-group">
                                        <label >Contenido *</label>                                            //<!--aparece lo que ya estaba escrito -->
                                        <textarea name="body" rows="6" class="form-control" required>{{ old('body', $product->name) }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label >Contenido embebido</label>                                            //<!--aparece lo que ya estaba escrito -->
                                        <textarea name="iframe" class="form-control" required>{{ old('iframe', $product->name) }}</textarea>
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
    </div>
</div>
@endsection
