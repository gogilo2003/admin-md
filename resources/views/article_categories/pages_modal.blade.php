<div class="modal fade" id="pagesModal" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<form class="card" method="post" action="{{route('admin-article_categories-pages')}}" role="form" accept-charset="UTF-8" enctype="multipart/form-data">
					<div class="card-header card-signup card-header-primary">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="card-title">Select Pages</h4>
					</div>
					<div class="card-body">
						<select id="pages" name="pages[]" multiple class="selectpicker" data-size="5" data-width="100%" data-tick-icon="fa fa-check-square" data-style="btn btn-link">
						@foreach (\Ogilo\AdminMd\Models\Page::all() as $key => $page)
							<option value="{{ $page->id }}">{{ $page->title }}</option>
						@endforeach
						</select>
						<input type="hidden" name="id" value="">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
						<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>