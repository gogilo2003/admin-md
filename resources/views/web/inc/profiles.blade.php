@if ($page->profiles->count())
<div class="bg-info py-5">
    <div class="container pb-5">
        <div class="row py-4">
            <div class="col-md-12">
                <h4 class="text-center text-uppercase border-bottom mb-5 pb-2 text-light">Our Team<br><small>Meet our team</small></h4>
            </div>
            @foreach ($page->profiles as $key => $profile)
            <div class="col-md-4">
                <div class="card shadow">
                    <img class="card-img-top" src="{{ url('public/images/profiles/'.$profile->picture) }}" alt="">
                    <div class="card-body text-center">
                        <h5 class="card-title text-uppercase">{{ $profile->name }} <small>{{ $profile->position }}</small></h5>
                        <p class="card-text">{{ str_words($profile->details) }}</p>
                        <p class="border-top pt-3"><a href="{{ route('profile',[$profile->id,$page->name]) }}" class="btn btn-outline-primary rounded-pill">Read More...</a></p>
                    </div>
                </div>
            </div>
            @if (!(($key+1) % 3) && ($key !== 0))
        </div>
        <div class="row">
            @endif
            @endforeach
        </div>
    </div>
</div>
@endif
