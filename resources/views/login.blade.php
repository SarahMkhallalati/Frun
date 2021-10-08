@extends('main')


@section('body')

@include('navBar')
<div id="Sign">
<div id="card" style="background-color: #3498DB; height:50px;text-align: center;">
<h2>Login</h2>
</div>
<div id="main-cont" style="margin-left:600px; margin-top:20px;">
<pre><b>please fill this form to login to your account.</b></pre>
<form id="form" method="POST" action="/login">
    @csrf
  <div class="mb-2">
    <label for="exampleInputEmail1" class="form-label">Username</label>
    <input type="text" class="form-control" name="username" id="exampleInputEmail1" aria-describedby="emailHelp" style="width:300px; box-shadow:1px 1px grey;">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" name="password" id="exampleInputPassword1" style="width:300px; box-shadow:1px 1px grey;">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  <button type="button" class="btn btn-secondary">Reset</button>
</form>
<pre style="padding-top:5px;">Dont have account?<a href="{{route('register')}}" id="log"style="text-decoration: none; padding:5px;" >register here. </a>
</pre>
</div>
</div>
@include("footer")
@endsection
