<!doctype html>
<html lang="en-US">
	<head>
		@include('frontend.layouts.headcss')
		@stack('styles')
	</head>
    <body>
		<!-- Preloader Start -->
		<div class="preloader">
			<div class="loading-container">
				<div class="loading"></div>
				<div id="loading-icon">
					<img src="{{asset('fronted/assets/ask-img/fav.png')}}" alt="loader">
				</div>
			</div>
		</div>
		<!-- Preloader End -->		
		@include('frontend.layouts.header-menu')
		@yield('main-content')
		@include('frontend.layouts.footer')
		@include('frontend.layouts.modal')
		@include('frontend.layouts.footerjs')
		@stack('scripts')
	</body>
</html>