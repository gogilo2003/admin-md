@extends('admin::layout.main')

@section('title')
	File Categories
@stop

@section('page_title')
	File Categories
@stop

@section('breadcrumbs')
	@parent
	<li class="active"><span><i class="fa fa-folder-open-o"></i> File Categories</span></li>
@stop

@section('sidebar')
	@parent
	@include('admin::file_categories.sidebar')
@stop

@section('content')
	<a href="{{ route('admin-file_categories-add') }}" class="btn btn-blue btn-round"><i class="fa fa-plus"></i> Add File Category</a>
	<hr>
	<div class="row">
	@foreach ($file_categories as $category)
		<div class="col-sm-6 col-md-4 col-lg-4">
			<div class="thumbnail text-center text-default">
				<h3>{{ $category->title }}</h3>
				<i class="fa fa-folder-o fa-5x"></i><br>
				<hr>
				@if ($category->pages->count())
					@foreach ($category->pages as $page)
						<span class="badge">{{ $page->title }}</span>
					@endforeach
					<hr>
				@endif
				<p>
					<a href="{{route('admin-file_categories-edit',$category->id)}}" class="btn btn-primary btn-round"><span class="fa fa-edit"></span>&nbsp;&nbsp; Edit</a>
					<a data-id="{{ $category->id }}" data-pages="{{ json_encode($category->pageIds() )  }}" class="btn btn-info btn-round" data-toggle="modal" href='#pagesModal'><i class="fas fa-copy"></i> Pages</a>
				</p>
			</div>
		</div>
	@endforeach
	</div>

	<div class="modal fade" id="pagesModal" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centers">
            <div class="modal-content">
                <form method="post" action="{{route('admin-file_categories-pages')}}" role="form" accept-charset="UTF-8" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <button type="button" class="close btn btn-danger btn-fab btn-round btn-sm" data-dismiss="modal" aria-hidden="true"><span class="material-icons">close</span></button>
                            <h4 class="card-title">Select Pages</h4>
                        </div>
                        <div class="card-body">
                            <select name="pages[]" id="pages" data-live-search="true" data-size="5" data-tick-icon="fa fa-check-square" multiple data-width="100%" data-style="btn btn-link">
                                @foreach (Ogilo\AdminMd\Models\Page::all() as $page)
                                    <option value="{{ $page->id }}">{{ $page->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-danger btn-round" data-dismiss="modal"><span class="material-icons">close</span> Cancel</button>
                            <button type="submit" class="btn btn-primary btn-round"><span class="material-icons">save</span> Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

	</div>
@stop

@section('styles')
	<style type="text/css">

	</style>
@stop
@section('scripts_top')
	<script type="text/javascript">

	</script>
@stop

@section('scripts_bottom')
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$('.deletePictureCategory').click(function(){
				if(confirm('Do you want to delete this Picture category ' + $(this).data('title'))){
					var varData = {
						id: $(this).data('id'),
						_token: '{{ csrf_token() }}'
					}

					var varUrl = '{{ route('admin-video_categories-delete') }}'

					$.ajax({
						url:varUrl,
						type: 'POST',
						data: varData
					}).done(function(){
						alert('Picture category deleted' );
						window.location = '{{ route('admin-video_categories') }}'
					});
				}

			});
		});

		$('#pagesModal').on('show.bs.modal', function (e) {
			var button = $(e.relatedTarget) // Button that triggered the modal
		  	var id = button.data('id')
			$('form input[name="id"]').val(id)

			var pages = button.data('pages');
			// console.log(pages)
			$('form select#pages').selectpicker('val', pages);

		})
	</script>
@stop
