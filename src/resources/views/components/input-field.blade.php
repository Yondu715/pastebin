<div>
    <input type={{ $type }} id="{{ $name }}" name="{{ $name }}" class={{ $inputClass }}
        value="{{ old($name) }}" required />
    <label class={{ $labelClass }} for="{{ $name }}">{{ $label }}</label>
    <br />
    <span class="text-danger">
        @error($name)
            {{ $message }}
        @enderror
    </span>
</div>
