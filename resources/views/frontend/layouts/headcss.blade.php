<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="Ask Foundation">
<meta name="description" content="@yield('description')">
<meta name="keywords" content="@yield('keywords')">
<meta name="csrf-token" content="{{ csrf_token() }}">
@yield('meta')
<title>ASK Foundation</title>
 <link rel="canonical" href="{{ url()->current() }}" />
<link rel="shortcut icon" type="image/x-icon" href="{{asset('fronted/assets/ask-img/fav.png')}}">
<link rel="preconnect" href="https://fonts.googleapis.com/">
<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
<link
href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&amp;family=Onest:wght@100..900&amp;display=swap"
rel="stylesheet">
<link href="{{asset('fronted/assets/css/bootstrap.min.css')}}" rel="stylesheet" media="screen">
<link href="{{asset('fronted/assets/css/slicknav.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('fronted/assets/css/swiper-bundle.min.css')}}">
<link href="{{asset('fronted/assets/css/all.min.css')}}" rel="stylesheet" media="screen">
<link href="{{asset('fronted/assets/css/animate.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('fronted/assets/css/magnific-popup.css')}}">
<link rel="stylesheet" href="{{asset('fronted/assets/css/mousecursor.css')}}">
<link href="{{asset('fronted/assets/css/custom.css')}}" rel="stylesheet" media="screen">