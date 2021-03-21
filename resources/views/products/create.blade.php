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
                    @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form
                        action="{{ route('products.store') }}"
                        method="POST"
                    >
                        <div class="form-group">
                            <label for="selection">Companies *:</label>
                            <select name="selection" id="selection" class="form-control form-select-lg mb-3">
                                @foreach ($companies as $company )
                                    <option value="{{$company->id}}">{{$company->name}}</option>
                                @endforeach
                                {{-- <option value="1">option</option>
                                <option value="2">option2</option>
                                <option value="3">option3</option>
                                <option value="4">option4</option> --}}
                            </select>
                            <label for="name" class="font-weight-bold">Name *:</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="name" required>
                        </div>
                        <div class="form-group text-center">
                            @csrf
                            <input type="submit" value="Send" class="btn btn-outline-primary col-2 btn-lg">
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection






