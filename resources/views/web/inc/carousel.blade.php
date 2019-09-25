@php
$cat = $page->picture_categories->where('name','=','slideshow')->first();
@endphp

@if ($cat)
<?php $slides = $cat->pictures; ?>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        @foreach ($slides as $key => $slide)
        <li data-target="#myCarousel" data-slide-to="{{ $key }}" {{ $key === 0 ? 'class="active"' : '' }}></li>
        @endforeach
    </ol>
    <div class="carousel-inner">
        @foreach($slides as $key => $slide)
        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
            <img class="img-fluid w-100" src="{{ asset(config('admin.path_prefix').'images/pictures/'.$slide->name) }}" alt="">
            @if ($slide->title || $slide->caption || $slide->url)
            <div class="container">
                <div class="carousel-caption text-left">
                    @if ($slide->title)
                        <h1>{{ $slide->title }}</h1>
                    @endif

                    @if ($slide->caption)
                        <p>{{ $slide->caption }}</p>
                    @endif

                    @if ($slide->url)
                        <p><a class="btn btn-lg btn-primary" href="{{ $slide->url }}" role="button">Sign up today</a></p>
                    @endif

                </div>
            </div>
            @endif
        </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
@endif

