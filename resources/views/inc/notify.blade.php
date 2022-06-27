<script type="text/javascript">
    @if (Session::has('global-info'))
        {!! "$.notify( { title: 'INFO', message: '" . Session::get('global-info') . "',icon: 'fas fa-info'}, {type: 'info', timer: 10000, width: '360px'})" !!}
    @endif

    @if (Session::has('global-success'))
        {!! "$.notify( { title: 'SUCCESS', message: '" . Session::get('global-success') . "',icon: 'far fa-check-circle'}, {type: 'success', timer: 10000, width: '360px'})" !!}
    @endif

    @if (Session::has('global-warning'))
        {!! "$.notify( { title: 'WARNING', message: '" . Session::get('global-warning') . "',icon: 'fas fa-exclamation-triangle'}, {type: 'warning', timer: 10000, width: '360px'})" !!}
    @endif

    @if (Session::has('global-danger'))
        {!! "$.notify( { title: 'ERROR', message: '" . Session::get('global-danger') . "',icon: 'fas fa-ban'}, {type: 'danger', timer: 10000, width: '360px'})" !!}
    @endif
</script>
