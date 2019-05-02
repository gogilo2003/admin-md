<div class="navbar navbar-inverse navbar-fixed-top" style="margin-bottom: 0">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header" style="height: 70px">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ url('/') }}" style="height: 100%"><img src="{{ url('public/logo.png') }}" alt="" class="img-responsive" style="height: 100%"></a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				@foreach (Ogilo\AdminMd\Models\Menu::first()->links as $link)
				<li class="text-center"><a href="{{ url($link->url) }}"><i class="{{ $link->icon }}"></i><br>{{ $link->caption }}</a></li>
				@endforeach
				@yield('menu')
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</div>