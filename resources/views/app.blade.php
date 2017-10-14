<!DOCTYPE html>
<html lang="en" ng-app="app">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MultiSchool</title>
	@if(Config::get('app.debug'))
		<link href="{{ asset('build/css/app.css') }}" rel="stylesheet" />

		<link href="{{ asset('build/css/vendor/bootstrap.min.css') }}" rel="stylesheet" />
		<link href="{{ asset('build/css/vendor/ionicons.min.css') }}" rel="stylesheet" />
		<link href="{{ asset('build/css/vendor/AdminLTE.min.css') }}" rel="stylesheet" />
		<link href="{{ asset('build/css/vendor/_all-skins.min.css') }}" rel="stylesheet" />
		<link href="{{ asset('build/css/vendor/font-awesome.min.css') }}" rel="stylesheet" />
		
	@else
		<link href="{{ elixir('css/all.css') }}" rel="stylesheet" />
	@endif
	
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic" />	
</head>
<body class="hold-transition skin-red layout-top-nav">
	<div class="wrapper">
		<load-template url="/build/views/templates/menu.html"></load-template>

		<div class="content-wrapper">
    		<div class="container">
				<div ng-view>

				</div>
			</div>
		</div>

		<footer class="main-footer">
			<div class="container">
				<div class="pull-right hidden-xs">
					<b>Version</b> 2.4.0
				</div>
				<strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
				reserved.
			</div>
		</footer>
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