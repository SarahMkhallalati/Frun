@extends('main')
@section('body')

@include('navBar')
<h2> Cheapest </h2>
<hr>

    <div class="card-group">

        <div class="row">
            @foreach ($cheps as $cheps)
            <div class="col-lg-4">
                <div class="card">
                  <img src="{{asset($cheps->image)}}" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">{{$cheps->furn_name}}</h5>
                    <p class="card-text">width:'{{$cheps->width}}
                        height:{{$cheps['height']}}  depth : {{$cheps->depth}} <br>
                      price:{{$cheps->price}}
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
