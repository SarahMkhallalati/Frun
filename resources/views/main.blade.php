
	<!DOCTYPE html>
	<html>

	<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>East SR</title>
		<link rel="shortcut icon" type="image/x-icon" href="{{asset('public/images/logo.jpg')}}"/>
		<link href="{{asset('fontawesome-free-5.12.0-web/css/all.min.css')}}" rel="stylesheet"/>
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Dancing Script"/>
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Cabin"/>
	    <link rel="stylesheet" type="text/css" href="{{asset('css/css/bootstrap.min.css')}}"/>
        <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
        @yield('links')


    <script type="text/javascript" src="{{asset('JS/jquery-3.4.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('JS/popper.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('JS/js/bootstrap.min.js')}}"></script>




    <style>
        #main_cont{
      			width: 100%;
      			height:620px;
      			background-image: url(images/cover.jpg);
      			background-size: cover;
      			background-repeat: no-repeat;
      		    background-position: center;
                 }

		</style>

	</head>

 <body>

    @yield('body')

   <footer class="footer">

    @yield('footer')

   </footer>

 </body>

</html>

@yield('scripts')
