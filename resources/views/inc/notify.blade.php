<script type="text/javascript">
    // Notification
    @if (session()->has('global-info'))
        {!! "$.notify( { title: 'INFO', message: '" .
            session()->get('global-info') .
            "',icon: 'fas fa-info'}, {type: 'info', timer: 10000, width: '360px'})" !!}
    @endif

    @if (session()->has('global-success'))
        {!! "$.notify( { title: 'SUCCESS', message: '" .
            session()->get('global-success') .
            "',icon: 'far fa-check-circle'}, {type: 'success', timer: 10000, width: '360px'})" !!}
    @endif

    @if (session()->has('global-warning'))
        {!! "$.notify( { title: 'WARNING', message: '" .
            session()->get('global-warning') .
            "',icon: 'fas fa-exclamation-triangle'}, {type: 'warning', timer: 10000, width: '360px'})" !!}
    @endif

    @if (session()->has('global-danger'))
        {!! "$.notify( { title: 'ERROR', message: '" .
            session()->get('global-danger') .
            "',icon: 'fas fa-ban'}, {type: 'danger', timer: 10000, width: '360px'})" !!}
    @endif
    // Access token
    @if (session()->has('access_token'))
        {!! "localStorage.setItem('access_token','" . session()->get('access_token') . "')" !!}
    @endif
</script>
