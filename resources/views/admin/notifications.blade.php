@extends('layouts.appadmin')

@section('title')
    Notifications
@endsection
@section('content')

    {{ Form::hidden('', $increment = 1) }}

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Notifications</h4>
            @if (Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                                <tr>
                                    <!-- <th>Id #</th> -->
                                    <th>User name</th>
                                    <th>Order id</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($notifications as $notification)
                                <tr class="@if($notification->id == \Session::get('id')) alert alert-danger @endif">
                                    <!-- <td>{{$increment}}</td> -->
                                    <td>{{$notification->data['name']}}</td>
                                    <td>{{$notification->data['id']}}</td>
                                </tr>
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
    <script src="{{ asset('backend/js/data-table.js') }}"></script>
@endsection
