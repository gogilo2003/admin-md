@extends('admin::layout.main')

@section('title')
    @parent
    Links
@endsection

@section('page_title')
    <i class="fa fa-link"></i> Links
@endsection

@section('breadcrumbs')
    @parent
    <li class="active"><span><i class="fa fa-link"></i> Links</span></li>
@endsection

@section('sidebar')
    @parent
    @include('admin::links.sidebar')
@stop

@section('content')
    <div>
        <a href="{{ route('admin-links-add') }}" class="btn btn-primary btn-sm"><span
                class="fa fa-plus"></span>&nbsp;&nbsp; New Link</a>
        <a href="{{ route('admin-menus') }}" class="btn btn-primary btn-sm"><span class="fa fa-link"></span>&nbsp;&nbsp;
            Menus</a>
    </div>
    <hr>
    <table id="linksDataTable" class="table table-hover table-striped">
        <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Caption</th>
                <th>Icon</th>
                <th>Url</th>
                <th>Menu</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($links as $link)
                <tr data-id="{{ $link->id }}">
                    <td>{{ $link->id }}</td>
                    <td>{{ $link->name }}</td>
                    <td>{{ $link->caption }}</td>
                    <td><i class="fa {{ $link->icon }}"></i></td>
                    <td>{{ $link->url }}</td>
                    <td>{{ $link->menu->caption }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('admin-links-edit', $link->id) }}" class="btn btn-success btn-sm"><span
                                    class="fa fa-edit"></span>&nbsp;&nbsp; Edit</a>
                            <a href="javascript:" data-id="{{ $link->id }}" class="btn btn-warning btn-sm inMenuLink">
                                {!! $link->in_menu ? '<span class="fas fa-times"></span>&nbsp;&nbsp;Hide' : '<span class="fas fa-check"></span>&nbsp;&nbsp;Show' !!}
                            </a>
                            <a href="javascript:" data-id="{{ $link->id }}"
                                class="btn btn-danger btn-sm deleteLink"><span class="fas fa-trash"></span>&nbsp;&nbsp;
                                Delete</a>

                        </div>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
@endsection

@section('styles')
    <style type="text/css">
        .ui-sortable-handle {
            cursor: move;
            cursor: grab;
            cursor: -moz-grab;
            cursor: -webkit-grab;

            .thumbnails-list {
                cursor: pointer;
            }
        }

        .ui-sortable-handle:active {
            cursor: grabbing;
            cursor: -moz-grabbing;
            cursor: -webkit-grabbing;
        }

    </style>
@endsection
@section('scripts_top')
    <script type="text/javascript">

    </script>
@endsection

@section('scripts_bottom')
    <script type="text/javascript">
        document.querySelectorAll('.inMenuLink').forEach(link => {
            link.addEventListener('click', e => {
                let button = e.target;
                let id = button.getAttribute('data-id')
                $.post('{{ route('api-admin-links-in_menu') }}', {
                    id,
                    api_token: '{{ api_token() }}'
                }).then(response => {
                    console.log(response)
                    if (response.success) {
                        if (response.link.in_menu) {
                            button.innerHTML = '<span class="fas fa-times"></span>&nbsp;&nbsp;Hide'
                        } else {
                            button.innerHTML = '<span class="fas fa-check"></span>&nbsp;&nbsp;Show'
                        }

                        $.notify({
                            message: response.message,
                            icon: 'check_circle'
                        }, {
                            type: 'success'
                        });
                    } else {
                        $.notify({
                            message: response.message,
                            icon: 'check_circle'
                        }, {
                            type: 'danger'
                        });
                    }
                })
            })
        })
        jQuery(document).ready(function($) {
            // $('#linksDataTable').dataTable();
            $('#linksDataTable tbody').sortable({
                onDrop: function($item, container, _super) {
                    let data = {
                        _token: "{!! csrf_token() !!}",
                        rows: []
                    }

                    $('#linksDataTable > tbody > tr').each((index, item) => {
                        let row = {
                            id: $(item).data('id'),
                            order: $(item).index(),
                        }
                        data.rows.push(row)
                    })

                    $.post('/admin/links/order', data).then(xhr => {
                        if (xhr.success) {
                            $.notify({
                                message: xhr.msg
                            }, {
                                type: 'success'
                            })
                        } else {
                            $.notify({
                                message: xhr.msg
                            }, {
                                type: 'danger'
                            })
                        }
                        // console.log(xhr)
                    })
                },

                containerSelector: 'table',
                itemPath: '> tbody',
                itemSelector: 'tr',
                placeholder: '<tr class="placeholder"/>'

            })


            $('a.deleteLink').click(function() {
                answer = confirm("Are you sure you want to delete this link?");

                if (answer) {

                    $.ajax({
                        url: '{{ route('admin-links-delete') }}',
                        type: 'POST',
                        data: {
                            id: $(this).data('id'),
                            _token: '{{ csrf_token() }}'
                        }
                    }).done(function() {
                        alert('Link Deleted');
                        window.location = '{{ route('admin-links') }}';
                    });

                } else {
                    alert('Link deletion canceled by link');
                }

            });

        });
    </script>
@endsection
