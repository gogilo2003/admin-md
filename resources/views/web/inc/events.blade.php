@if ($page->events->count())
<section class="py-5 bg-light border-bottom border-purple">
	<div class="container">
		<div class="row">
            <div class="col-md-12">
                <h3 class="text-center text-uppercase pb-5">Events<br><small>Upcoming Events</small></h3>
            </div>
		@foreach ($page->events as $event)
			<div class="col-md-4">
				<div class="card shadow-lg bg-info text-light h-100">
                    <img src="{{ asset(config('admin.path_prefix').'images/events/'.$event->picture) }}" class="card-img-top" alt="{{ $event->title }}">
                    <div class="card-body">
                        <h3 class="text-uppercase border-bottom">{{ $event->title }}<br><small>By {{ $event->leader }}</small></h3>
                        <p class="text-justify">{{ str_words($event->content) }}</p>
                        <p><a href="{{ route('event',[$event->name,$page->name]) }}" class="btn btn-outline-light rounded-pill">Read More...</a></p>
                    </div>
				</div>
			</div>
		@endforeach
		</div>
    </div>
</section>
@endif
