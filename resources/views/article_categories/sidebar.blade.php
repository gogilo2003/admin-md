<li class="nav-item{{ is_current_path('admin-article_categories') ? ' active' : '' }}"><a
        href="{{ route('admin-article_categories') }}" class="nav-link"><i class="fa fa-list-alt"></i> Article
        Categories</a></li>
<li class="nav-item{{ is_current_path('admin-article_categories-add') ? ' active' : '' }}"><a
        href="{{ route('admin-article_categories-add') }}" class="nav-link"><i class="fa fa-plus"></i> Create article
        Category</a></li>
<li class="nav-item{{ is_current_path('admin-articles') ? ' active' : '' }}"><a href="{{ route('admin-articles') }}"
        class="nav-link"><i class="fas fa-copy"></i> Articles</a></li>
<li class="nav-item{{ is_current_path('admin-articles-add') ? ' active' : '' }}"><a
        href="{{ route('admin-articles-add') }}" class="nav-link"><i class="fa fa-plus"></i> Create Article</a></li>
