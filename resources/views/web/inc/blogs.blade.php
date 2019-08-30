@php
    $cat = $page->article_categories->where('name','blogs')->first();
    $posts = $cat ? $cat->articles : [];
@endphp

@if ($cat)
<section class="py-5 bg-info">
    <div class="container">
        <h3 class="text-uppercase text-center text-light">
            Blog Posts<br>
            <small>Recent/Highllighted blog posts</small>
        </h3>
        @foreach ($posts as $post)
            <div class="card border border-light rounded-pill my-2">
                <div class="card-body p-4">
                    {{ $post->title }}
                    <a href="{{ route('article',[$post->name,$page->name]) }}" class="stretched-link btn btn-link float-md-right">Read More...</a>
                </div>
            </div>
        @endforeach
    </div>
</section>
@endif
