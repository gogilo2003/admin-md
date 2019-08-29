@php
    $cats = $page->picture_categories->whereNotIn('name',['slideshow']);
@endphp
@if ($cats)
<section class="py-5">
    <div class="container">
        @foreach ($cats as $cat)
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center text-uppercase">{{ $cat->title }}<br><small>{{ $cat->description }}</small></h3>
            </div>
            @foreach ($cat->pictures as $picture)
            <div class="col-md-4">
                <div class="card text-purple shadow-lg">
                    <img class="card-img" src="{{ asset('public/images/pictures/'.$picture->name) }}" alt="{{ $picture->alt }}">
                    <div class="card-img-overlay">
                        <h3 class="card-title">{{ $picture->title }}</h3>
                        <p class="card-text">{{ $picture->caption }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>
</section>
@endif


