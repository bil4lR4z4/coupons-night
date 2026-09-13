<div class="mb-3 {{ $wrapperClass }}">

    @if($label)
        <label for="{{ $id }}" class="form-label {{ $labelClass }}">
            {{ $label }}
        </label>
    @endif

    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $id }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"

        class="form-control {{ $size ? 'form-control-'.$size : '' }} {{ $errors->has($name) ? 'border-danger' : '' }} {{ $class }}"

        {{ $readonly ? 'readonly' : '' }}
        {{ $required ? 'required' : '' }}
        {{ $disabled ? 'disabled' : '' }}
        {{ $autofocus ? 'autofocus' : '' }}

        @if($maxlength) maxlength="{{ $maxlength }}" @endif
        @if($minlength) minlength="{{ $minlength }}" @endif
        @if($min) min="{{ $min }}" @endif
        @if($max) max="{{ $max }}" @endif
        @if($step) step="{{ $step }}" @endif
        @if($pattern) pattern="{{ $pattern }}" @endif

        autocomplete="{{ $autocomplete }}"
    >

    @error($name)
        <div class="text-danger">
            {{ $message }}
        </div>
    @enderror

</div>