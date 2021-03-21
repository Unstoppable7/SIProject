@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Companies
                    <a href="{{ route('companies.create') }}" class="btn btn-sm btn-primary float-right">Create</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                  <table class="table">
                      <thead>
                          <tr>
                              <th>ID</th>
                              <th>TITULO</th>
                              <th colspan="2"> &nbsp; </th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($companies as $company)
                              <tr>
                                  <td>{{$company->id}}</td>
                                  <td>{{$company->name}}</td>
                                  <td>
                                      <a href="{{ route('companies.edit', $company) }}" class="btn btn-sm btn-primary">Edit</a>
                                  </td>
                                  <td>
                                      <form action="{{ route('companies.destroy',$company) }}" method="POST">
                                          @csrf
                                          @method("DELETE")
                                          <input
                                              type="submit"
                                              value="Delete"
                                              class="btn btn-danger"
                                              onclick="return confirm('Do you want to delete the article?')"
                                          >
                                      </form>
                                  </td>
                              </tr>
                          @endforeach

                      </tbody>

                  </table>
              </div>
   </div>
</div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
