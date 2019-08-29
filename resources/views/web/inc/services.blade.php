@php
    $cat = $page->article_categories->where('name','services')->first();
    $services = $cat ? $cat->articles : null
@endphp
@if ($services)
<div class="bg-light py-5 text-info">
    <div class="container marketing">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-uppercase text-center py-5">
                    {{ $cat->name }}<br>
                    <small>{{ $cat->description }}</small>
                </h3>
            </div>
            @foreach ($services as $service)
                <div class="col-lg-4 p-3">
                    <div class="shadow h-100 p-3">
                        <img src="{{ url('public/images/articles/'.$service->picture) }}" alt="" width="140" height="140" class="bd-placeholder-img rounded-circle border border-info">
                        <h2 class="text-uppercase pt-3 border-bottom">{{ $service->title }}</h2>
                        <p>{{ str_words(strip_tags($service->content),25) }}</p>
                        <p><a class="btn btn-secondary" href="{{ route('article',[$service->name,$page->name]) }}" role="button">View details &raquo;</a></p>
                    </div>
                </div><!-- /.col-lg-4 -->
            @endforeach
        </div>
    </div>
</div>
@endif
