<div class="">
    <label class="form-label">{{ $label }}</label>
    <select @if (Auth::user()->user_id !== 1) readonly @endif class="form-control" name="{{ $name }}">
        @foreach ($options as $value => $text)
            <option value="{{ $value }}" @selected(old($name, $selected) == $value)>{{ $text }}</option>
        @endforeach
    </select>
    @if (session('error') && session('error')->has($name))
        <div class="text-danger text-xs">
            {{ session('error')->first($name) }}
        </div>
    @endif
</div>
