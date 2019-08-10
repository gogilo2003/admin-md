@extends('admin::layout.main')

@section('title')
	Tour Packages
@stop

@section('page_title')
	Tour Packages
@stop

@section('breadcrumbs')
	@parent
	<li class="active"><span><i class="fa fa-list"></i> Packages</span></li>
@stop

@section('sidebar')
	@parent
	@include('admin::packages.sidebar')
@stop

@section('content')

	<a href="{{ route('admin-packages-add') }}" class="btn btn-info btn-round"><i class="fa fa-plus"></i> Add Package</a>
	<hr>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>&nbsp;</th>
				<th>Title</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($packages as $package)
			<tr>
				<td>{{ $loop->iteration }}.</td>
				<td>{{ $package->title }}</td>
				<td>
					<div class="btn-group">
						<a href="{{ route('admin-packages-pictures',$package->id) }}" class="btn btn-sm btn-primary btn-round"><i class="fa fa-image"></i>  Pictures&nbsp;&nbsp;<span class="badge">{{ $package->pictures->count() }}</span></a>
						<a href="{{ route('admin-packages-edit',$package->id) }}" class="btn btn-sm btn-success btn-round"><i class="fa fa-edit"></i> Edit</a>
						<a href="javascript:publishPackage({{ $package->id }})" class="btn btn-warning btn-sm btn-round"><span class="fa fa-arrow-{{ $package->published ? 'down' : 'up' }}"></span>&nbsp;&nbsp; {{ $package->published ? ' Unpublish' : 'Publish' }}</a>
						<a data-id="{{ $package->id }}" data-pages="{{ implode(',', $package->pageIds()) }}" data-toggle="modal" href='#pagesModal' class="btn btn-primary btn-sm btn-round"><i class="fa fa-file-o"></i> Pages&nbsp;&nbsp;<span class="badge">{{ $package->pages->count() }}</span></a>
					</div>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	<div class="modal fade" id="pagesModal" data-backdrop="static">
		<div class="modal-dialog">
			<form method="post" action="{{route('admin-packages-pages')}}" role="form" accept-charset="UTF-8" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="card-title">Pages</h4>
                        </div>
                        <div class="card-body">
                            <select name="pages[]" id="pages" data-live-search="true" multiple data-size="5" data-width="100%" data-style="btn btn-outline-primary btn-round">
                            @foreach (\Ogilo\AdminMd\Models\Page::all() as $page)
                                <option value="{{ $page->id }}">{{ $page->title }}</option>
                            @endforeach
                            </select>
                            <input type="hidden" name="id" value="">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-danger btn-round" data-dismiss="modal"><span class="material-icons">cancel</span> Cancel</button>
                            <button type="submit" class="btn btn-primary btn-round"><span class="material-icons">save</span> Save</button>
                        </div>
                    </div>
                </div>
			</form>
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
		var publishPackage = function (pID){
			if(confirm("Do you want to publish the selected package?")){
				$.ajax({
					url: '{{ route('admin-packages-publish') }}',
					type: 'post',
					data: { id: pID, _token: '{{ csrf_token() }}' },
					complete: function(xhr){
						// console.log(xhr)
						$.notify(
                            {
                                message:xhr.responseJSON.message,
                                icon: 'fa fa-check-circle'
                            },
                            {
                                type:'success'
                            }
                        );
					}
				})
			}else{
				alert("package not published/unpublished")
			}
		}

		$('#pagesModal').on('show.bs.modal', function (e) {
			var button = $(e.relatedTarget) // Button that triggered the modal
		  	var id = button.data('id')
			$('form input[name="id"]').val(id)
			let data = button.data('pages');
			// console.log(data.length)
			if(data.length>1)
				pages = data.split(',');
			else
				pages = data
			console.log(pages)
			$('form select#pages').selectpicker('val', pages);

		})

	</script>
@stop
