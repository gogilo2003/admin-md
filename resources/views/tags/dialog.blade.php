<div class="modal fade" id="tagsModal" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form class="card" method="post" action="{{ route('admin-tags-tag') }}" role="form" accept-charset="UTF-8"
                enctype="multipart/form-data">
                <div class="card-header card-signup card-header-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="card-title">Select Tags</h4>
                </div>
                <div class="card-body">
                    <div>
                        {{ $errors }}
                    </div>
                    <select id="tags" name="tags[]" multiple class="selectpicker" data-size="5" data-width="100%"
                        data-tick-icon="fa fa-check-square" data-style="btn btn-link">
                        @foreach (\Ogilo\AdminMd\Models\Tag::all() as $key => $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                    <input id="articleIdInput" type="hidden" name="article" value="">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>
                        Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts_bottom')
    <script type="text/javascript">
        $('#tagsModal').on('show.bs.modal', function(event) {
            // Button that triggered the modal
            let button = event.relatedTarget;
            // Extract info from data-bs-* attributes
            let article_id = button.getAttribute('data-id');

            $('#articleIdInput').val(article_id)

            // Use above variables to manipulate the DOM
            let tags = JSON.parse(button.getAttribute('data-tags'));

            $('#tags').selectpicker('val', tags)
        });
    </script>
@endpush
