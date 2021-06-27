@extends('main')

@section('body')

@include('navBar')

<div id="main_cont">
  <div style="display: inline-block;">

 </div>
  <h2 id="Welcome"> Welcome To EAST SR</h2>
</div>

<hr>
<h2  class="bestselling"> Cheapest </h2>
<button style="margin-left: 1200px;" type="button" class="btn btn-primary">VIEW ALL</button>
<div class="card-group">

    <div class="row">
        @foreach ($furnitures as $furniture)
        <div class="col-lg-4">
            <div class="card">
              <img src="{{asset($furniture->image)}}" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">{{$furniture->furn_name}}</h5>
                <p class="card-text">width: {{$furniture->width}} height: {{$furniture['height']}}  depth: {{$furniture->depth}} <br>
                  price:{{$furniture->price}}
                </p>
                <button id="AddToFavBT" class="btn btn-primary" type="button" onclick="AddToFav({{$furniture->ID}});" >
                  <strong class="btn-text">Add to favorite <i class="far fa-heart"></i></i></strong>
                </button>
              </div>
            </div>
          </div>
        @endforeach
    </div>
</div>

@include('footer')
@endsection

@section('scripts')
<script>
var AddFav = document.getElementById("AddToFavBT");
    function AddToFav($id)
    {

        $.ajax({
            method: 'GET',
            url: 'AddToFav',
            dataType: 'json',
            data: {
                ID:$id
            },

        }).done((json) =>{
            alert("Added to favorite");
        }).fail((json)=>{alert("Already exisit");});
    }
</script>
@endsection





