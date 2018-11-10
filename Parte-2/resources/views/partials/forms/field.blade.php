<div {{ $attributes ?? ''  }}
     class="form-group has-feedback {{ $errors->has($field_name) ? 'has-error' : '' }}">
    <input type="{{ $type }}"
           name="{{ $field_name }}"
           class="{{ $type != 'checkbox' ? 'form-control' : ''}}"
           placeholder="{{ $placeholder }}"
           value='<?php echo $value ?>'>
    @if($type == 'checkbox')
        <span class="">{{ $placeholder }}</span>
    @endif
    <span class="{{ $icon ?? ''  }} form-control-feedback"></span>
    @if ($errors->has($field_name))
    <span class="help-block">
        <strong>{{ $errors->first($field_name) }}</strong>
    </span>
    @endif
</div>