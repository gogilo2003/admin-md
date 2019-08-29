@php
    $cats = $page->project_categories;
@endphp
@if ($cats)
    <section class="py-5 bg-purple text-light">
        <div class="container">
            @foreach ($cats as $cat)
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-uppercase text-center text-light mb-5">{{ $cat->title }}<br><small>{{ $cat->description }}</small></h3>
                </div>
                @foreach ($cat->projects as $project)
                <div class="col-md-6">
                    <div class="card bg-purple border-light shadow-lg rounded-pill">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="{{ asset('public/images/projects/160x160/'.$project->picture) }}" alt="" class="img-fluid w-100 rounded-circle">
                            </div>
                            <div class="card-body col-md-9 pr-5">
                                <h5 class="card-title text-uppercase"><a href="{{ route('project',[$project->id,$page->id]) }}" class="text-light">{{ $project->title }}</a></h5>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>
    </section>
@endif
