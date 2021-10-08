@extends('main')


@section('body')

@include('navBar')
<div id="Sign">
<div id="card" style="background-color: #3498DB; height:50px;text-align: center;">
<h2>SignUp </h2>
</div>
<div id="main-cont" style="margin-left:600px; margin-top:20px;">
<pre><b>please fill this form to create an account.</b></pre>
<form id="form" method="POST" action="/register">
    @csrf
  <div class="mb-2">
    <label for="exampleInputEmail1" class="form-label">Username</label>
    <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" style="width:300px; box-shadow:1px 1px grey;" max="20" required>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" name="password" class="form-label">Password</label>
    <input type="password" class="form-control" name="passowrd" id="exampleInputPassword1" style="width:300px; box-shadow:1px 1px grey;" required>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" name="confirm_password" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" style="width:300px; box-shadow:1px 1px grey;">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  <button type="button" class="btn btn-secondary">Reset</button>
</form>
<pre style="padding-top:5px;">Already have an account?<a href="{{route('login')}}" id="log"style="text-decoration: none; padding:5px;" >Login here. </a>
</pre>
</div>
</div>
@include("footer")
@endsection
