@php
    $fcs = $page->file_categories;
@endphp
@if ($fcs->count())
    <section class="bg-light py-5">
        <div class="container">
            @foreach ($fcs as $fc)
                <h3 class="text-center text-uppercase pb-3">
                    {{ $fc->title }}
                    <small>{{ $fc->description }}</small>
                </h3>
                <div class="row mb-2">
                    <div class="col-md-6">

                    </div>
                </div>
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
                                <p class="card-text mb-auto">{{ $file->description }}</p>
                                <a href="{{ route('file-download',$file->id) }}" class="stretched-link">Download</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            @endforeach
        </div>
    </section>
@else
    <section class="bg-light py-5">
        <div class="container">
            <h3 class="text-center text-uppercase text-light">No files</h3>
        </div>
    </section>
@endif
