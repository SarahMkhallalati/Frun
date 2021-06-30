@extends('main')


@section('body')

@include('navBar')
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div style="width:1550px; height: 500px; margin: auto; padding-top: 0PX;" class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{ asset('images/2.jpg') }}" class="d-block w-100" alt="">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('images/4.jpg') }}" class="d-block w-100" alt="">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('images/3.jpg') }}" class="d-block w-100" alt="">
    </div>
  </div>
</div>
</div>
<div class="who-we" >
  <h4 class="who-we-heading" style="margin-left:700px; font-family:Dancing Script;font-weight:bold;font-size:30px;"> Who We Are </h4>
                          <pre  style="margin-left:500px;">EAST SR is one of the world's largest online destinations for the home.</pre>
</div>
<div class="our-promis">
  <h4 class="our-promis-heading" style="margin-left:700px; font-family:Dancing Script;font-weight:bold;font-size:30px;"> Our Promis</h4>
<pre style="margin-left:300px;">
           EAST SR believes everyone should live in a home they love. Through technology and innovation,
EAST SR makes it possible for shoppers to quickly and easily find exactly what they want from a selection of more than 22 million items
across home furnishings, décor, home improvement, housewares and more. Committed to delighting its customers every step of the way,
         EAST SR  is reinventing the way people shop for their homes - from product discovery to final delivery.
</pre>
</div>
<div class="our-culture">
<h4 class="our-culture-heading" style="margin-left:700px; font-family:Dancing Script;font-weight:bold;font-size:30px;"> Our Culture</h4>
<pre id="lastpre" style="margin-left:300px;" >
              EAST SR  is a rapidly growing company with a variety of career opportunities.
       We offer employees exciting work in a fun, dynamic environment that encourages learning and growth.
We are accepting résumés on a rolling basis from motivated individuals who are interested in working in the e−commerce industry.
</pre>
<hr>
@include("footer");
@endsection
