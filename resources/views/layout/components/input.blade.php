@php
$value = isset($value) ? $value : '';
@endphp
<div class="form-group{!! $errors->has($name) ? ' has-error' : '' !!}">
    <label for="{{ $id }}">{{ $label }}</label>
    <input type="text" class="form-control" id="{{ $id }}" name="title"
        placeholder="Enter {{ $name }}" {!! old($name) ? ' value="' . old($name) . '"' : ' value="' . $value . '"' !!}>
    {!! $errors->has($name) ? '<span class="text-danger">' . $errors->first($name) . '</span>' : '' !!}
</div>
