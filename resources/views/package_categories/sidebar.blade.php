<li class="nav-item{{ is_current_path('admin-package_categories') ? ' active' : ''}}"><a href="{{ route('admin-package_categories') }}" class="nav-link"><i class="fa fa-folder-open-o"></i> Package Categories</a></li>
<li class="nav-item{{ is_current_path('admin-package_categories-add') ? ' active' : ''}}"><a href="{{ route('admin-package_categories-add') }}" class="nav-link"><i class="fa fa-plus"></i> Create package Category</a></li>
<li class="nav-item{{ is_current_path('admin-packages') ? ' active' : ''}}"><a href="{{ route('admin-packages') }}" class="nav-link"><i class="fa fa-calendar"></i> Packages</a></li>
<li class="nav-item{{ is_current_path('admin-packages-add') ? ' active' : ''}}"><a href="{{ route('admin-packages-add') }}" class="nav-link"><i class="fa fa-plus"></i> Create package</a></li>