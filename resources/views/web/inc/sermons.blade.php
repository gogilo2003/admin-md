@if ($page->sermons->count())
<section class="my-5">
	<div class="container">
		<div class="row">
            <div class="col-md-12">
                <h4 class="text-center text-uppercase border-bottom mb-5 pb-2 text-purple">Sermorns<br><small>Sermorn Highlights</small></h4>
            </div>
		@foreach ($page->sermons as $sermon)
			<div class="col-md-6">
				<div class="card text-purple mb-4 border-0 shadow-sm">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="{{ asset(config('admin.path_prefix').'images/sermons/thumbnails/'.$sermon->picture) }}" class="img-fluid rounded-circle rounded mt-4 ml-4 border-purple border" alt="{{ $sermon->name }}">
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h4 class="card-title text-uppercase">{{ $sermon->title }}<br> <small>By {{ $sermon->sermon_by }}</small></h4>
                                <p class="text-justify">{{ str_words($sermon->content) }}</p>
                                <p class=""><a class="btn btn-outline-purple rounded-pill" href="{{ route('sermon',[$sermon->name,$page->name]) }}">Read More...</a></p>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		@endforeach
		</div>
    </div>
</section>
@endif
