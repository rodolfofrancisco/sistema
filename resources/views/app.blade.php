<!DOCTYPE html>
<html lang="en" ng-app="app">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sistema</title>
	@if(Config::get('app.debug'))
		<link href="{{ asset('build/css/app.css') }}" rel="stylesheet" />
		<link href="{{ asset('build/css/components.css') }}" rel="stylesheet" />
		<link href="{{ asset('build/css/flaticon.css') }}" rel="stylesheet" />
		<link href="{{ asset('build/css/font-awesome.css') }}" rel="stylesheet" />
	@else
		<link href="{{ elixir('css/all.css') }}" rel="stylesheet" />
	@endif
	
	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<load-template url="/build/views/templates/menu.html"></load-template>
	
	<div ng-view>

	</div>

	<!-- Scripts -->
	@if(Config::get('app.debug'))
		<script src="{{ asset('build/js/vendor/jquery.min.js') }}"></script>
		<script src="{{ asset('build/js/vendor/angular.min.js') }}"></script>
		<script src="{{ asset('build/js/vendor/angular-route.min.js') }}"></script>
		<script src="{{ asset('build/js/vendor/angular-resource.min.js') }}"></script>
		<script src="{{ asset('build/js/vendor/angular-animate.min.js') }}"></script>
		<script src="{{ asset('build/js/vendor/angular-messages.min.js') }}"></script>
		<script src="{{ asset('build/js/vendor/ui-bootstrap-tpls.min.js') }}"></script>
		<script src="{{ asset('build/js/vendor/navbar.min.js') }}"></script>
		<script src="{{ asset('build/js/vendor/angular-cookies.min.js') }}"></script>
		<script src="{{ asset('build/js/vendor/query-string.js') }}"></script>
		<script src="{{ asset('build/js/vendor/angular-oauth2.min.js') }}"></script>
		<script src="{{ asset('build/js/vendor/http-auth-interceptor.js') }}"></script>
		<script src="{{ asset('build/js/vendor/dirPagination.js') }}"></script>

		<script src="{{ asset('build/js/app.js') }}"></script>

		<!-- DIRECTIVES -->
		<script src="{{asset('build/js/directives/loginForm.js')}}"></script>
		<script src="{{asset('build/js/directives/loadTemplate.js')}}"></script>
		<script src="{{asset('build/js/directives/menuActivated.js')}}"></script>

		<!-- CONTROLLERS -->
		<script src="{{ asset('build/js/controllers/menu.js') }}"></script>
		<script src="{{ asset('build/js/controllers/login.js') }}"></script>
		<script src="{{ asset('build/js/controllers/loginModal.js') }}"></script>
		<script src="{{ asset('build/js/controllers/home.js') }}"></script>
		<script src="{{ asset('build/js/controllers/user/userList.js') }}"></script>
		<script src="{{ asset('build/js/controllers/user/userNew.js') }}"></script>
		<script src="{{ asset('build/js/controllers/user/userEdit.js') }}"></script>
		<script src="{{ asset('build/js/controllers/user/userRemove.js') }}"></script>

		<!-- SERVICES -->
		<script src="{{ asset('build/js/services/user.js') }}"></script>
		<script src="{{ asset('build/js/services/oauthFixInterceptor.js') }}"></script>

		<!-- FILTERS -->
		<script src="{{ asset('build/js/filters/date-br.js') }}"></script>
	@else
		<script src="{{ elixir('js/all.js') }}"></script>
	@endif
</body>
</html>