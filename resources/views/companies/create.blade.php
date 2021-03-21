@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create new company</div>

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
                        action="{{ route('companies.store') }}"
                        method="POST" enctype="multipart/form-data"
                    >
                        <div class="form-group">
                            <label for="name" class="font-weight-bold">Name *:</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="name" required>
                        </div>

                        <div class="form-group">
                            <label for="registry_number" class="font-weight-bold">Registry Number:</label>
                            <input type="text" name="registry_number" id="registry_number" class="form-control" placeholder="registry number">
                        </div>

                        <div class="form-group">
                            <label for="address" class="font-weight-bold">Address:</label>
                            <input type="text" name="address" id="address" class="form-control" placeholder="address">
                        </div>

                        <div class="form-group">
                            <label for="latitud_number" class="font-weight-bold">Latitud Number:</label>
                            <input type="number" step="0.01" min="-90" max="90" name="latitud_number" id="latitud_number" class="form-control" placeholder="latitud number">
                        </div>

                        <div class="form-group">
                            <label for="longitude_number" class="font-weight-bold">Longitude Number:</label>
                            <input type="number" step="0.01" min="-180" max="180" name="longitude_number" id="longitude_number" class="form-control" placeholder="longitude number">
                        </div>

                        <div class="form-group">
                            <label for="mobile_number" class="font-weight-bold">Mobile Number:</label>
                            <input type="text" name="mobile_number" id="mobile_number" class="form-control" placeholder="mobile number">
                        </div>

                        <div class="form-group">
                            <label for="phone_number" class="font-weight-bold">Phone Number:</label>
                            <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="phone number">
                        </div>

                        <div class="form-group">
                            <label for="email" class="font-weight-bold">Email:</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="email">
                        </div>

                        <div class="form-group">
                            <label for="country_code" class="font-weight-bold">Country Code:</label>
                            <input type="number" name="country_code" id="country_code" class="form-control" placeholder="country code">
                        </div>

                        <div class="form-group text-center">
                            @csrf
                            <input type="submit" value="Enviar" class="btn btn-outline-primary col-2 btn-lg">
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection






