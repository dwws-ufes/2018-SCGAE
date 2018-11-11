<div class="form-group has-feedback {{ $errors->has($field_name) ? 'has-error' : '' }}">
    <input type="hidden"
           name="{{ $field_name }}"
           value='0'>
    <label>
        <input type="checkbox"
            name="{{ $field_name }}"
            value='1'
            {{ $value ? 'checked' : '' }}>
        <span>{{ $placeholder }}</span>
    </label>
    @if ($errors->has($field_name))
    <span class="help-block">
        <strong>{{ $errors->first($field_name) }}</strong>
    </span>
    @endif
</div>