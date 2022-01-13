<!DOCTYPE html>
<html lang="{{str_replace('_', '-', app()->getLocale())}}" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" value="{{csrf_token()}}">
	<title>{{ env('APP_NAME') }} - login</title>
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css'>
	<link href="{{ asset('css/loginStyle.css') }}" rel="stylesheet">

    {{-- css resources notifications--}}
    <link href="{{ asset('notifications/css/ns-default.css') }}" rel="stylesheet">
    <link href="{{ asset('notifications/css/ns-style-growl.css') }}" rel="stylesheet">
    <script src="{{ asset('notifications/js/modernizr.custom.js') }}"></script>

</head>
<body>

	{{-- auth --}}
    @if (Auth::check())
        @php
        $user_auth_data = [
            'isLoggedin' => true,
            'user' =>  Auth::user()
        ];
        @endphp
    @else
        @php
        $user_auth_data = [
            'isLoggedin' => false
        ];
        @endphp
    @endif
    <script> window.Laravel = JSON.parse(atob('{{ base64_encode(json_encode($user_auth_data)) }}')); </script>
    

    {{-- app --}}
	<div id="app"></div>
	<script src="{{ asset('js/app.js') }}"></script>

   {{-- js resources notifications--}}
    <script src="{{ asset('notifications/js/classie.js') }}"></script>
    <script src="{{ asset('notifications/js/notificationFx.js') }}"></script>
</body>
</html>