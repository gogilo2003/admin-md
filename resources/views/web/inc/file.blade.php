@php
    $fcs = $page->file_categories;
@endphp
@if ($fcs->count())
    <section class="bg-light py-5">
        <div class="container">
            <h3 class="text-uppercase text-center">Files<br><small>Downloadable resources</small></h3>
            @foreach ($fcs as $fc)
                <h5 class="text-uppercase pb-3 mt-5">
                    {{ $fc->title }}<br>
                    <small>{{ $fc->description }}</small>
                </h5>
                <div class="row">
                @foreach ($fc->files as $file)
                    <div class="col-lg-6">
                        <div class="row no-gutters border border-dark rounded-pill overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                            <div class="col-auto d-none d-lg-block">
                                <svg class="bd-placeholder-img rounded-lg" width="150" height="150"
                                    xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice"
                                    focusable="false" role="img" aria-label="Placeholder: Thumbnail">
                                    <title>{{ $file->title }}</title>
                                    <rect width="100%" height="100%" fill="#55595c" />
                                    <text x="50%" y="50%" fill="#fff" dy=".3em" class="fa fa-5x">{!! get_file_icon($file->name, true) !!}</text>
                                </svg>
                            </div>
                            <div class="col p-3 d-flex flex-column position-static">
                                <h3 class="mb-0">{{ $file->title }}</h3>
                                <div class="mb-1 text-muted">{{ $file->size }}</div>
                                <p class="card-text mb-auto">
                                    {{ $file->description }}
                                    
                                    <a href="{{ route('file-download',$file->id) }}" class="float-md-right stretched-link btn btn-outline-info rounded-circle"><span class="fa fa-cloud-download"></span></a>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            @endforeach
        </div>
    </section>
@endif
