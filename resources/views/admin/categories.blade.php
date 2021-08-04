@extends('layouts.appadmin')

@section('title')
  Categories
@endsection
@section('content')

{{Form::hidden('',$increment=1)}}
<div class="card">
            <div class="card-body">
              <h4 class="card-title">Categories</h4>
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
                            <th>Category Name</th>
                            <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                     @foreach($categories as $category)
                        <tr>
                            <td>{{$increment}}</td>
                            <td>{{$category->category_name}}</td>
                            <td>
                              <button class="btn btn-outline-primary" onclick="window.location = '{{url('/edit_category/'.$category->id)}}'">Edit</button>

                              <a class="btn btn-outline-danger" id="delete" 
                              href="/delete/{{$category->id}}">Delete</a>
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