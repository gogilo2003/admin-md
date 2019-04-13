<div class="navbar navbar-inverse navbar-static-top" role="navigation" style="margin:0">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			{!! Auth::guard('admin')->check() ? '<a class="navbar-brand" href="'. url('admin') .'">'. config('app.short_name','<i class="fa fa-dashboard"></i>') .'</a>' : '' !!}
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			@if(Auth::guard('admin')->check())
			<ul class="nav navbar-nav">
				<!-- <li class="active"><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i>&nbsp;Dashboard <span class="sr-only">(current)</span></a></li> -->
				{{-- <li><a href="{{ route('admin-pages') }}"><i class="fa fa-file-o"></i>&nbsp;Pages</a></li> --}}
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Menus <span class="fa fa-angle-double-down"></span></a>
					<ul class="dropdown-menu" role="menu">
						@foreach (Ogilo\AdminMd\Models\Menu::all() as $key => $menu)
							<li><a href="{{ route('admin-menus-edit',$menu->id) }}"><i class="fa fa-circle-thin"></i> {{ $menu->caption }}</a></li>
						@endforeach
						<li class="divider"></li>
						<li><a href="{{ route('admin-menus-add') }}"><i class="fa fa-plus-circle"></i> Create a New menu</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Links <span class="fa fa-angle-double-down"></span></a>
					<ul class="dropdown-menu" role="menu">
						@foreach (Ogilo\AdminMd\Models\Link::all() as $key => $link)
							<li><a href="{{ route('admin-links-edit',$link->id) }}"><i class="fa fa-circle-thin"></i> {{ $link->caption }}</a></li>
						@endforeach
						<li class="divider"></li>
						<li><a href="{{ route('admin-links-add') }}"><i class="fa fa-plus-circle"></i> Create a New Link</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Pages <span class="fa fa-angle-double-down"></span></a>
					<ul class="dropdown-menu" role="menu">
						@foreach (Ogilo\AdminMd\Models\Page::all() as $key => $page)
							<li><a href="{{ route('admin-pages-edit',$page->id) }}"><i class="fa fa-circle-thin"></i> {{ $page->title }}</a></li>
						@endforeach
						<li class="divider"></li>
						<li><a href="{{ route('admin-pages-add') }}"><i class="fa fa-plus-circle"></i> Create a New Page</a></li>
					</ul>
				</li>
			@if(config('admin.menu'))
			@foreach (config('admin.menu') as $route => $caption)
				@if($caption)
					<li><a href="{{ route($route) }}">{{ $caption }}</a></li>
				@endif
			@endforeach
			@endif
			</ul>
			<!--
			<form class="navbar-form navbar-left" role="search">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Search">
				</div>
				<button type="submit" class="btn btn-default">Submit</button>
			</form>
			-->
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-user-circle"></i> <span class="fa fa-angle-double-down"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="{{ route('admin-settings') }}"><i class="fa fa-wrench"></i> Settings</a></li>
						<li class="divider"></li>
						<li><a href="{{ route('admin-profile') }}">Profile</a></li>
						<li><a href="{{ route('admin-password') }}">Password</a></li>
						<li class="divider"></li>
						<li><a href="{{ route('admin-logout') }}">Logout</a></li>
					</ul>
				</li>
			</ul>
			@else
			<ul class="nav navbar-nav navbar-right">
				<li><a href="{{ route('admin-login') }}"><i class="fa fa-exclamation-circle"></i> You need to login first</a></li>
			</ul>
			@endif
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</div>
