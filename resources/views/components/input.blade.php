<div class="col-6">
    <label class="form-label">{{ $title }}</label>
    <div class="input-group">
        <input name="{{ $name }}" class="form-control" type="{{ $type }}" placeholder="{{ $placeholder }}"
               value="{{ old($name, $value) }}">
    </div>
    @if(session('error') && session('error')->has($name))
        <div class="text-danger text-xs">
            {{ session('error')->first($name) }}
        </div>
    @endif
</div>
