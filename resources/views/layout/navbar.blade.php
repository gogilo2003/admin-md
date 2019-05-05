<nav class="navbar navbar-expand-lg bg-primary navbar-absolute fixed-top ">
	<div class="container-fluid">
		<div class="navbar-wrapper">
			{!! Auth::guard('admin')->check() ? '<a class="navbar-brand" href="'. url('admin') .'">'.config('app.short_name','<i class="material-icons">dashboard</i>') .'</a>' : '' !!} 
		</div>
		<button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
			aria-expanded="false" aria-label="Toggle navigation">
			<span class="sr-only">Toggle navigation</span>
			<span class="navbar-toggler-icon icon-bar"></span>
			<span class="navbar-toggler-icon icon-bar"></span>
			<span class="navbar-toggler-icon icon-bar"></span>
		</button>
		<div class="collapse navbar-collapse justify-content-end">
			@if(auth()->check())
			<ul class="navbar-nav">
				<!-- <li class="active"><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i>&nbsp;Dashboard <span class="sr-only">(current)</span></a></li> -->
				{{-- <li><a href="{{ route('admin-pages') }}"><i class="fa fa-file-o"></i>&nbsp;Pages</a></li> --}}
				<li class="nav-item dropdown">
					<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						Menus
					</a>
					<div class="dropdown-menu" role="menu">
						@foreach (Ogilo\AdminMd\Models\Menu::all() as $key => $menu)
						<a class="dropdown-item" href="{{ route('admin-menus-edit',$menu->id) }}">
							<i class="fa fa-circle-thin"></i>&nbsp;
							{{ $menu->caption }}
						</a>
						@endforeach
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="{{ route('admin-menus-add') }}"><i class="fa fa-plus-circle"></i>&nbsp;Create a New
								menu</a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Links</a>
					<div class="dropdown-menu" role="menu">
						@foreach (Ogilo\AdminMd\Models\Link::all() as $key => $link)
						<a class="dropdown-item" href="{{ route('admin-links-edit',$link->id) }}">
							<i class="fa fa-circle-thin"></i>&nbsp;
							{{ $link->caption }}
						</a>
						@endforeach
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="{{ route('admin-links-add') }}">
							<i class="fa fa-plus-circle"></i>&nbsp;
							Create a New Link
						</a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Pages</a>
					<div class="dropdown-menu" role="menu">
						@foreach (Ogilo\AdminMd\Models\Page::all() as $key => $page)
						<a class="dropdown-item" href="{{ route('admin-pages-edit',$page->id) }}">
							<i class="fa fa-circle-thin"></i>&nbsp;
							{{ $page->title }}
						</a>
						@endforeach
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="{{ route('admin-pages-add') }}">
							<i class="fa fa-plus-circle"></i>&nbsp; 
							Create a New Page
						</a>
					</div>
				</li>
				@if(config('admin.menu'))
					@foreach (config('admin.menu') as $key => $menu)
						@if($menu)
						
							@if (is_array($menu))
								@if (isset($menu['caption']))
									<li class="nav-item dropdown">
										<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											{{ $menu['caption'] }}
										</a>
										<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
											@foreach($menu['submenu'] as $key => $value)
											<a class="dropdown-item" href="{{ route($key) }}">{{ $value }}</a>
											@endforeach
										</div>
									</li>
								@else
									@foreach ($menu as $item)
										<li class="nav-item dropdown">
											<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												{{ $item['caption'] }}
											</a>
											<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
												@foreach($item['submenu'] as $key => $value)
												<a class="dropdown-item" href="{{ route($key) }}">{{ $value }}</a>
												@endforeach
											</div>
										</li>
									@endforeach
								@endif
								
							@else
								<li class="nav-item">
									<a class="nav-link" href="{{ route($key) }}">
										{{ $menu }}
									</a>
								</li>
							@endif
						@endif
					@endforeach
				@endif

				<!--
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Dropdown link
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						<a class="dropdown-item" href="#">Action</a>
						<a class="dropdown-item" href="#">Another action</a>
						<a class="dropdown-item" href="#">Something else here</a>
					</div>
				</li>
				-->
			
				<li class="nav-item dropdown">
					<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						<i class="fa fa-user-circle"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-right" role="menu">
						<a class="dropdown-item" href="{{ route('admin-settings') }}"><i class="fa fa-wrench"></i>&nbsp;Settings</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="{{ route('admin-profile') }}">Profile</a>
						<a class="dropdown-item" href="{{ route('admin-password') }}">Password</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="{{ route('admin-logout') }}">Logout</a>
					</div>
				</li>
			</ul>
			@else
			<ul class="navbar-nav">
				<li>
					<a href="{{ route('admin-login') }}">
						<i class="fa fa-exclamation-circle"></i> 
						You need to loginfirst
					</a>
				</li>
			</ul>
			@endif
			
		</div>
	</div>
</nav>