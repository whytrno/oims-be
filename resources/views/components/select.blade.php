<div class="col-6">
    <label class="form-label">{{ $label }}</label>
    <select class="form-control" name="{{ $name }}">
        @foreach($options as $value => $text)
            <option value="{{ $value }}"
                    @selected(old($name, $selected) == $value)>{{ $text }}</option>
        @endforeach
    </select>
    @if(session('error') && session('error')->has($name))
        <div class="text-danger text-xs">
            {{ session('error')->first($name) }}
        </div>
    @endif
</div>
