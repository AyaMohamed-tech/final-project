@extends('layouts.appadmin')

@section('title')
  Clients
@endsection
@section('content')

{{Form::hidden('',$increment=1)}}

<div class="card">
            <div class="card-body">
              <h4 class="card-title">Clients</h4>
                  @if(Session::has('status'))
                      <div class="alert alert-success">
                            {{Session::get('status')}}
                      </div>
                  @endif
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Client Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($clients as $client)
                        <tr>
                            <td>{{$increment}}</td>
                            <td>{{$client->name}}</td>
                            <td>{{$client->email}}</td>
                            <td>
                            <a href="/delete_client/{{$client->id}}" class="btn btn-outline-danger" id="delete">Delete</a>
                            </td>
                        </tr> 
                        {{Form::hidden('',$increment=$increment+1)}}

                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

@endsection

@section('scripts')
<script src="{{asset('backend/js/data-table.js')}}"></script>
@endsection