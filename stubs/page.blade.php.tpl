<?php
echo "{{-- Modify details of $name.blade.php here as desired --}}\n";
echo "@extends('admin::web.layout.main')\n\n";

echo "@section('meta')\n";
echo "\t".'<meta name="author" content="{{ config(\'app.name\') }}">'."\n";
echo "\t".'<meta name="description" content="{{ str_words_alt($page->content,160) }}">'."\n";
echo "\t".'<meta name="keywords" content="keywords separated by comma">'."\n";
echo "\t".'<title>{{ $page->title }}</title>'."\n";
echo "@endsection\n\n";

echo "@section('content')\n";
echo "\t".'{!! $page->content !!}'."\n";
echo '@endsection'."\n\n";

if($scriptsTop){
    echo "@push('scripts_top')\n";
    echo "\t".'<script>'."\n\n";

    echo "\t".'</script>'."\n";
    echo "@endpush\n\n";
}

if($scriptsBottom){
    echo "@push('scripts_bottom')\n";
    echo "\t".'<script>'."\n\n";

    echo "\t".'</script>'."\n";
    echo "@endpush\n\n";
}

if($scriptsBottom){
    echo "@push('styles')\n";
        echo "\t".'<style>'."\n\n";

        echo "\t".'</style>'."\n";
        echo "\t".'<link href="{{ asset(\'css/'.$name.'.css\') }}" rel="stylesheet">'."\n";
    echo "@endpush\n\n";
}
?>
