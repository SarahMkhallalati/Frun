@extends('main')

@section('body')

@include('navBar')

<div id="main_cont">

  <h2 id="Welcome"> Welcome To EAST SR</h2>
</div>

<hr>
<aside>
    <div style="inline-block; padding-bottom:10px;" >
       <b style="font-size:20px;">Filtered With:</b>
       <b style="margin-left:20px;">Material:</b>
       <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
          <label class="form-check-label" for="inlineRadio1">Wood</label>
        </div>
   <div class="form-check form-check-inline">
     <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
     <label class="form-check-label" for="inlineRadio2">Fabric</label>
   </div>
   <div class="form-check form-check-inline">
     <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option3">
     <label class="form-check-label" for="inlineRadio1">Leather</label>
   </div>
   <div class="form-check form-check-inline">
     <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option4">
     <label class="form-check-label" for="inlineRadio2">Bambo</label>
   </div>
        <b style="margin-left:40px;">Price:</b>
        <div class="form-check form-check-inline">
     <input class="form-check-input" type="radio" name="group2" id="inlineRadio2" value="opt1">
     <label class="form-check-label" for="inlineRadio2">80$-200$</label>
   </div>
   <div class="form-check form-check-inline">
     <input class="form-check-input" type="radio" name="group2" id="inlineRadio2" value="opt2">
     <label class="form-check-label" for="inlineRadio2">205$-300$</label>
   </div>
   <div class="form-check form-check-inline">
     <input class="form-check-input" type="radio" name="group2" id="inlineRadio2" value="opt3">
     <label class="form-check-label" for="inlineRadio2">More than 300$</label>
   </div>

     </div>
    </aside>
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
                <button id="AddToFavBT" style="margin-left:120px;"  class="btn btn-primary" type="button" onclick="AddToFav({{$furniture->ID}});" >
                  <strong class="btn-text">Add to favorite <i class="far fa-heart"></i></i></strong>
                </button>
              </div>
            </div>
          </div>
        @endforeach
    </div>

</div>
<button id="test" type="button" > test </button>

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

    test.onclick = function() {
        x = geneticalgorithm.populationsixe;
        console.log(x);
        console.log("x");
    }
</script>
@endsection





