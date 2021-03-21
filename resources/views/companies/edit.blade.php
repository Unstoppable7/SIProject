@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Companies</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('companies.update', $company) }}"
                                method="POST"
                                enctype="multipart/form-data"
                        >

                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">Name *:</label>
                                    <input type="text" value="{{ old('name', $company->name) }}" name="name" id="name" class="form-control" placeholder="name" required>
                                </div>

                                <div class="form-group">
                                    <label for="registry_number" class="font-weight-bold">Registry Number:</label>
                                    <input type="text" value="{{ old('registry_number', $company->registry_number) }}" name="registry_number" id="registry_number" class="form-control" placeholder="registry number">
                                </div>

                                <div class="form-group">
                                    <label for="address" class="font-weight-bold">Address:</label>
                                    <input type="text" value="{{ old('registry_number', $company->address) }}" name="address" id="address" class="form-control" placeholder="address">
                                </div>

                                <div class="form-group">
                                    <label for="latitud_number" class="font-weight-bold">Latitud Number:</label>
                                    <input type="number" value="{{ old('registry_number', $company->latitud_number) }}" step="0.01" min="-90" max="90" name="latitud_number" id="latitud_number" class="form-control" placeholder="latitud number">
                                </div>

                                <div class="form-group">
                                    <label for="longitude_number" class="font-weight-bold">Longitude Number:</label>
                                    <input type="number" value="{{ old('registry_number', $company->longitude_number) }}" step="0.01" min="-180" max="180" name="longitude_number" id="longitude_number" class="form-control" placeholder="longitude number">
                                </div>

                                <div class="form-group">
                                    <label for="mobile_number" class="font-weight-bold">Mobile Number:</label>
                                    <input type="text" value="{{ old('registry_number', $company->mobile_number) }}" name="mobile_number" id="mobile_number" class="form-control" placeholder="mobile number">
                                </div>

                                <div class="form-group">
                                    <label for="phone_number" class="font-weight-bold">Phone Number:</label>
                                    <input type="text" value="{{ old('registry_number', $company->phone_number) }}" name="phone_number" id="phone_number" class="form-control" placeholder="phone number">
                                </div>

                                <div class="form-group">
                                    <label for="email" class="font-weight-bold">Email:</label>
                                    <input type="text" value="{{ old('registry_number', $company->email) }}" name="email" id="email" class="form-control" placeholder="email">
                                </div>

                                <div class="form-group">
                                    <label for="country_code" class="font-weight-bold">Country Code:</label>
                                    <input type="number" value="{{ old('registry_number', $company->country_code) }}" name="country_code" id="country_code" class="form-control" placeholder="country code">
                                </div>

                                <div class="form-group text-center">
                                    @csrf
                                    @method('PUT')
                                    <input type="submit" value="Update" class="btn btn-lg btn-outline-success">
                                </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
