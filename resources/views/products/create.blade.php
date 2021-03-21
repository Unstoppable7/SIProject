@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create new product</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form
                        action="{{ route('products.store') }}"
                        method="POST" enctype="multipart/form-data"
                    >
                        <div class="form-group">
                            <label for="name" class="font-weight-bold">Name *:</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
                        </div>

                        <div class="form-group custom-file">
                            <input type="file" class="custom-file-input" name="image" id="image">
                            <label class="custom-file-label" for="image" data-browse="Elige una imagen"><i class="far fa-file-image"></i> Elige una imagen</label>
                        </div>

                        <div class="form-group">
                            <label for="body" class="font-weight-bold">Contenido *:</label>
                            <textarea class="form-control" name="body" id="body" rows="5" required></textarea>
                        </div>

                         <div class="form-group">
                            <label for="iframe" class="font-weight-bold">Contenido embebido:</label>
                            <textarea class="form-control" name="iframe" id="iframe"></textarea>
                        </div>

                        <div class="form-group text-center">
                            @csrf
                            <input type="submit" value="Enviar" class="btn btn-outline-primary col-2 btn-lg">
                        </div>

                    </form>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection






