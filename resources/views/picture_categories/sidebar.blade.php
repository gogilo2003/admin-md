<li class="nav-item{{ is_current_path('admin-picture_categories') ? ' active' : '' }}"><a
        href="{{ route('admin-picture_categories') }}" class="nav-link"><i class="fa fa-list-alt"></i> Picture
        Categories</a></li>
<li class="nav-item{{ is_current_path('admin-picture_categories-add') ? ' active' : '' }}"><a
        href="{{ route('admin-picture_categories-add') }}" class="nav-link"><i class="fa fa-plus"></i> Create Picture
        Category</a></li>
<li class="nav-item{{ is_current_path('admin-pictures') ? ' active' : '' }}"><a href="{{ route('admin-pictures') }}"
        class="nav-link"><i class="fas fa-copy"></i> Pictures</a></li>
<li class="nav-item{{ is_current_path('admin-pictures-add') ? ' active' : '' }}"><a
        href="{{ route('admin-pictures-add') }}" class="nav-link"><i class="fa fa-plus"></i> Create Picture</a></li>
