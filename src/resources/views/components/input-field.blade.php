<div>
    <label class={{ $labelClass }} for="{{ $name }}">{{ $label }}</label>
    <input type={{ $type }} id="{{ $name }}" name="{{ $name }}" class={{ $inputClass }}
        value="{{ old($name) }}" required />
    <br />
    <span class="text-danger">
        @error($name)
            {{ $message }}
        @enderror
    </span>
</div>
