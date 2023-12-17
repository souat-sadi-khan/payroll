<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <title>{{ isset($title) ? $title .' | '. config('app.name', 'Satt ') :  config('app.institue_name', config('app.name', 'Satt'))}}</title>
  <link rel="icon" type="image/png" sizes="16x16" href="{{asset(get_option('favicon')?'storage/logo/'.get_option('favicon'):'favicon.ico')}}">
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="{{ asset('login_assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('login_assets/css/font-awesome.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('login_assets/css/icon-font.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('login_assets/css/animate.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('login_assets/css/hamburgers.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('login_assets/css/animsition.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('login_assets/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('login_assets/css/main.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/css/toastr.min.css') }}">
</head>
  <body style="background-color: #666666;">
    <section class="login-content">
      @section('auth')
      @show
    </section>
    <script src="{{ asset('login_assets/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('login_assets/js/animsition.min.js') }}"></script>
    <script src="{{ asset('login_assets/js/popper.js')}}"></script>
    <script src="{{ asset('login_assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('login_assets/js/main.js') }}"></script>  
    <script src="{{asset('backend/js/toastr.min.js')}}"></script>
    <script type="text/javascript">
    $.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    </script>
    @stack('scripts')
  </body>
</html>