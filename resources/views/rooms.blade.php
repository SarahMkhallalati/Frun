@extends('main')
@section('body')
@include('navBar')

	<hr>
	<h2  class="bestselling"> {{$roomName}} </h2>
    <div class="card-group">

        <div class="row">
            @foreach ($rooms as $room)
            <div class="col-lg-4">
                <div class="card">
                  <img src="{{asset($room->image)}}" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">{{$room->furn_name}}</h5>
                    <p class="card-text">width:'{{$room->width}}
                        height:{{$room['height']}}  depth : {{$room->depth}} <br>
                      price:{{$room->price}}
                    </p>
                    <button class="btn btn-primary" type="button">
                      <strong class="btn-text">Add to favorite <i class="far fa-heart"></i></i></strong>
                    </button>
                  </div>
                </div>
              </div>
            @endforeach
        </div>
    </div>

<hr>
@include("footer");
@endsection

