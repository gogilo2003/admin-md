<li class="nav-item{{ is_current_path('admin-blogs') ? ' active' : '' }}"><a href="{{ route('admin-blogs') }}"
        class="nav-link"><i class="fas fa-copy"></i> Blogs</a></li>
<li class="nav-item{{ is_current_path('admin-blogs-add') ? ' active' : '' }}"><a href="{{ route('admin-blogs-add') }}"
        class="nav-link"><i class="fa fa-plus"></i> Create Blog</a></li>
<li class="nav-item{{ is_current_path('admin-authors') ? ' active' : '' }}"><a href="{{ route('admin-authors') }}"
        class="nav-link"><i class="fa fa-users"></i> Authors</a></li>
