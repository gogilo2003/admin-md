<nav class="navbar navbar-expand-md navbar-dark sticky-top bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse text-uppercase" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                @foreach (Ogilo\AdminMd\Models\Menu::first()->links as $link)
                @php
                    $url = $link->url ? $link->url : '/';
                @endphp
                <li class="nav-item{{ is_current_url($url) ? ' active' : '' }}">
                    <a class="nav-link" href="{{ url($url) }}">
                        <i class="{{ $link->icon }}"></i>
                        {{ $link->caption }}
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                @endforeach
                @yield('menu')
            </ul>
            <form class="form-inline mt-2 mt-md-0">
                <div class="input-group mr-sm-2 my-2 my-sm-0 rounded-pill overflow-hidden border-light">
                    <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-search">
                    <div class="input-group-append">
                        <button class="btn btn-light" type="button" id="button-search"><span class="fa fa-search"></span></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</nav>
