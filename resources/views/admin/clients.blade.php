@extends('layouts.appadmin')

@section('title')
  users
@endsection
@section('content')

{{Form::hidden('',$increment=1)}}

<div class="card">
            <div class="card-body">
              <h4 class="card-title">users</h4>
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
                            <th>user Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$increment}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            @if ($user->status == 1)
                            <td>
                              <label class="badge badge-success">Activated</label>
                            </td>

                           @else

                             <td>
                               <label class="badge badge-danger">Unactivated</label>
                             </td>

                           @endif
                           <td>
                           @if ($user->status == 1)
                                                <a href="/admin/unactivate_client/{{ $user->id }}"
                                                    class="btn btn-outline-warning">Unactivate</a>
                                            @else
                                                <a href="/admin/activate_client/{{ $user->id }}"
                                                    class="btn btn-outline-success">activate</a>
                                            @endif
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