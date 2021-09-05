@extends('layouts.app')

@section('title')
search
@endsection

@section('content')

<div class="col-sm-4">
    <div class="trending-wr apper">
        <h4>result for search</h4>
        
        @foreach($products as $item)
        <div class ="searched-item">
            <a href="detail/{{$item['id']}}">
            <img class="trending-image" src="{{$item['gallery']}}">
            <div class="">
                <h3>{{$item['name']}}</h3>
            </a>
        </div>

@endforeach
     </div>
</div>
@endsection