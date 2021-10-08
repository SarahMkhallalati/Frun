@extends('main')

@section('body')

@include('navBar')

<div id="main_cont">

  <h2 id="Welcome"> Welcome To EAST SR</h2>
</div>

<hr>
<aside>
    <div style="inline; padding-bottom:10px; padding-left:30px;" >
       <b style="font-size:20px;">Filtered With:</b>
       <b style="margin-left:20px;">Material:</b>
       <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="material_id" id="inlineRadio1" value="7">
          <label class="form-check-label" for="inlineRadio1">Wood</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="material_id" id="inlineRadio2" value="3">
            <label class="form-check-label" for="inlineRadio2">Fabric</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="material_id" id="inlineRadio1" value="5">
            <label class="form-check-label" for="inlineRadio1">Leather</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="material_id" id="inlineRadio2" value="1">
            <label class="form-check-label" for="inlineRadio2">Bambo</label>
        </div>
        <b style="margin-left:40px;">Price:</b>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="price_group" id="inlineRadio2" value="1">
            <label class="form-check-label" for="inlineRadio2">80$-200$</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="price_group" id="inlineRadio2" value="2">
            <label class="form-check-label" for="inlineRadio2">205$-300$</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="price_group" id="inlineRadio2" value="3">
            <label class="form-check-label" for="inlineRadio2">More than 300$</label>
        </div>
        <button type="button" class="btn btn-success">Find</button>


    </div>
    </aside>
<h2  class="bestselling"> Cheapest </h2>
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
                @if ($favorite->contains($furniture->ID))
                <button id="InFav_{{$furniture->ID}}" style="margin-left:120px;"  class="btn btn-success" type="button" onclick="alterFav({{$furniture->ID}});" >
                    <strong class="btn-text">Already in favorite </strong>
                  </button>
                @else
                <button id="AddToFavBT_{{$furniture->ID}}" style="margin-left:120px;"  class="btn btn-primary" type="button" onclick="AddToFav({{$furniture->ID}});" >
                  <strong class="btn-text">Add to favorite <i class="far fa-heart"></i></i></strong>
                </button>
                @endif
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


function alterFav($id)
{
    $("#InFav_"+$id).append(`<i class="fa fa-spinner fa-spin"></i>`)
    $.ajax({
            method: 'GET',
            url: 'DelFav',
            dataType: 'json',
            data: {
                ID:$id
            },
        }).done((json) =>{
            $("#InFav_"+$id).replaceWith
                    (`<button id="AddToFavBT_${$id}" style="margin-left:120px;"  class="btn btn-primary" type="button" onclick="AddToFav(${$id});" >
                    <strong class="btn-text">Add to favorite <i class="far fa-heart"></i></i></strong>
                  </button>`);
        })
}

    function AddToFav($id)
    {
        $("#AddToFavBT_"+$id).append(`<i class="fa fa-spinner fa-spin"></i>`)
        $.ajax({
            method: 'GET',
            url: 'AddToFav',
            dataType: 'json',
            data: {
                ID:$id
            },
        }).done((json) => {
            $("#AddToFavBT_"+$id).replaceWith(
                    `<button id="InFav_${$id}" style="margin-left:120px;"  class="btn btn-success" type="button" onclick="alterFav(${$id});" >
                    <strong class="btn-text">Already in favorite </strong>
                  </button>`);
        }).fail((response) => {
            if(response.status == 401)
            alert('you must login first')
            window.location.href = '/login';
        })
    }

    function filter()
    {
       materialId = document.querySelector('input[name="material_id"]:checked')?.value ?? 0;
       price = document.querySelector('input[name="price_group"]:checked')?.value ?? 0;
       if(!materialId && !price)
       alert('choose some filters first')
      else  window.location.href = "/furniture/public/filter?material_id="+materialId+"&price="+price;
    }



</script>
@endsection





