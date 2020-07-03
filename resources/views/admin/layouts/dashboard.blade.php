<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('admin/css/mdb.min.css') }}" rel="stylesheet">
	<link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
	<title>@yield('title' ?? 'Административная часть')</title>
</head>
<body class="fixed-sn light-blue-skin">

<!--Double navigation-->
<header>
	<!-- Sidebar navigation -->
	<div id="slide-out" class="side-nav black fixed">
		<ul class="custom-scrollbar">
			<!-- Logo -->
			<li>
				<div class="logo-wrapper waves-light">
					<a href="#"><img src="https://mdbootstrap.com/img/logo/mdb-transparent.png"
									 class="img-fluid flex-center"></a>
				</div>
			</li>
			<!--/. Logo -->
			<!--Social-->
			<li>
				<ul class="social">
					<li><a href="#" class="icons-sm fb-ic"><i class="fab fa-facebook-f"> </i></a></li>
					<li><a href="#" class="icons-sm pin-ic"><i class="fab fa-pinterest"> </i></a></li>
					<li><a href="#" class="icons-sm gplus-ic"><i class="fab fa-google-plus-g"> </i></a></li>
					<li><a href="#" class="icons-sm tw-ic"><i class="fab fa-twitter"> </i></a></li>
				</ul>
			</li>
			<!--/Social-->
			<!--Search Form-->
			<li>
				<form class="search-form" role="search">
					<div class="form-group md-form mt-0 pt-1 waves-light">
						<input type="text" class="form-control" placeholder="Search">
					</div>
				</form>
			</li>
			<!--/.Search Form-->
			<!-- Side navigation links -->
			<li>
				<ul class="collapsible collapsible-accordion">
					<li><a href="{{route('admin')}}">Dashboard</a></li>
					<li><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-chevron-right"></i> Аниме
							<i class="fas fa-angle-down rotate-icon"></i></a>
						<div class="collapsible-body">
							<ul>
								<li><a href="{{route('admin.anime')}}" class="waves-effect">Редактировать</a>
								</li>
								<li><a href="{{route('admin.anime.add')}}" class="waves-effect">Добавить</a>
								</li>
							</ul>
						</div>
					</li>
					<li><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-hand-pointer-o"></i>
							Категории<i class="fas fa-angle-down rotate-icon"></i></a>
						<div class="collapsible-body">
							<ul>
								<li><a href="{{route('admin.category')}}" class="waves-effect">Редактировать</a>
								</li>
								<li><a href="{{route('admin.category.add')}}" class="waves-effect">Добавить</a>
								</li>
							</ul>
						</div>
					</li>
					<li><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-eye"></i> Персонажи
							<i class="fas fa-angle-down rotate-icon"></i></a>
						<div class="collapsible-body">
							<ul>
								<li><a href="#" class="waves-effect">Редактировать</a>
								</li>
								<li><a href="#" class="waves-effect">Добавить</a>
								</li>
							</ul>
						</div>
					</li>
					<li><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-eye"></i> Люди
							<i class="fas fa-angle-down rotate-icon"></i></a>
						<div class="collapsible-body">
							<ul>
								<li><a href="#" class="waves-effect">Редактировать</a>
								</li>
								<li><a href="#" class="waves-effect">Добавить</a>
								</li>
							</ul>
						</div>
					</li>
					<li><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-eye"></i> Озвучка
							<i class="fas fa-angle-down rotate-icon"></i></a>
						<div class="collapsible-body">
							<ul>
								<li><a href="#" class="waves-effect">Редактировать</a>
								</li>
								<li><a href="#" class="waves-effect">Добавить</a>
								</li>
							</ul>
						</div>
					</li>
					<li><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-eye"></i> Студии
							<i class="fas fa-angle-down rotate-icon"></i></a>
						<div class="collapsible-body">
							<ul>
								<li><a href="#" class="waves-effect">Редактировать</a>
								</li>
								<li><a href="#" class="waves-effect">Добавить</a>
								</li>
							</ul>
						</div>
					</li>
					<li><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-eye"></i> Страны
							<i class="fas fa-angle-down rotate-icon"></i></a>
						<div class="collapsible-body">
							<ul>
								<li><a href="#" class="waves-effect">Редактировать</a>
								</li>
								<li><a href="#" class="waves-effect">Добавить</a>
								</li>
							</ul>
						</div>
					</li>
					<li><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-eye"></i> Пользователи
							<i class="fas fa-angle-down rotate-icon"></i></a>
						<div class="collapsible-body">
							<ul>
								<li><a href="#" class="waves-effect">Редактировать</a>
								</li>
								<li><a href="#" class="waves-effect">Добавить</a>
								</li>
							</ul>
						</div>
					</li>
					<li><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-eye"></i> Статические
																									  страницы
							<i class="fas fa-angle-down rotate-icon"></i></a>
						<div class="collapsible-body">
							<ul>
								<li><a href="#" class="waves-effect">Редактировать</a>
								</li>
								<li><a href="#" class="waves-effect">Добавить</a>
								</li>
							</ul>
						</div>
					</li>
				</ul>
			</li>
			<!--/. Side navigation links -->
		</ul>
		<div class="sidenav-bg mask-strong"></div>
	</div>
	<!--/. Sidebar navigation -->
	<!-- Navbar -->
	<nav class="navbar fixed-top navbar-toggleable-md navbar-expand-lg scrolling-navbar double-nav black">
		<!-- SideNav slide-out button -->
		<div class="float-left">
			<a href="#" data-activates="slide-out" class="button-collapse"><i class="fas fa-bars"></i></a>
		</div>
		<!-- Breadcrumb-->
		<div class="breadcrumb-dn mr-auto">
			<p>Material Design for Bootstrap</p>
		</div>
		<ul class="nav navbar-nav nav-flex-icons ml-auto">
			<li class="nav-item">
				<a class="nav-link"><i class="fas fa-envelope"></i> <span class="clearfix d-none d-sm-inline-block">Contact</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link"><i class="far fa-comments"></i> <span class="clearfix d-none d-sm-inline-block">Support</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link"><i class="fas fa-user"></i> <span
							class="clearfix d-none d-sm-inline-block">Account</span></a>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
				   aria-haspopup="true" aria-expanded="false">
					Dropdown
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
					<a class="dropdown-item" href="#">Action</a>
					<a class="dropdown-item" href="#">Another action</a>
					<a class="dropdown-item" href="#">Something else here</a>
				</div>
			</li>
		</ul>
	</nav>
	<!-- /.Navbar -->
</header>
<!--/.Double navigation-->

<!--Main Layout-->
<main id="app">
	<div class="container-fluid">
		<div class="card">
			<h5 class="card-header h5">
				@yield('title')
			</h5>
			<div class="card-body">
				@yield('content')
			</div>
			<div class="card-footer">
				@yield('footer')
			</div>
		</div>
	</div>
</main>
<!--Main Layout-->
<!-- Footer -->
<footer class="page-footer font-small black bottom">

	<!-- Copyright -->
	<div class="footer-copyright text-center py-3">© 2020 Copyright:
		<a href="https://mdbootstrap.com/education/bootstrap/"> MDBootstrap.com</a>
	</div>
	<!-- Copyright -->

</footer>
<!-- Footer -->
<script src="{{asset('admin/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>

<script src="{{ asset('admin/js/popper.min.js') }}"></script>
<script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/js/mdb.min.js') }}"></script>
<script src="{{asset('admin/js/tinymce/tinymce.min.js')}}"></script>
<script>tinymce.init({selector: 'textarea'});</script>

<script>
	$(".button-collapse").sideNav();

	$(document).ready(function () {
		$('.mdb-select').materialSelect();
	});

	$('.datepicker').pickadate({
		weekdaysShort: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
		firstDay: 1,
		showMonthsShort: true
	})
</script>
<script>
	$('#searchVideo').click(function () {
		const arr = {};
		arr['wa'] = $('#wa_id').val();
		arr['shiki'] = $('#shikimori_id').val();
		let i = 1;
		console.log(arr);
		$.ajax({
				url: '{{ route('admin.parseCDN') }}',
				type: "GET",
				data: {arr: JSON.stringify(arr)},
				success: function (data) {
					console.log(data, data.length, arr);
					$.each(data, function (key, item) {
						$('#searchVideoRes').append('<li id="item_' + i++ + '" class="list-group-item">' + item['title'] +
							'<span class="badge badge-primary">' + item['translation']['title'] + '</span>' +
							'<div class="btn btn-default right" onclick="document.getElementById(\'video\').value =\'' + item['link'] + '\'">Вставить</div>' +
							'</li>');
					})
				},
				error: function (data) {
					console.error(data);
				}
			},
		)
	});
</script>
</body>
</html>
