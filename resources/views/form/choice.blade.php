<div class="form-group">
    <label>{{ $title ?? trans('field.'.$name) }}</label><br/>
    <select name="{{ $name }}">
        @foreach($options as $option)
            <option value="{{ $option }}" @if($option == ($value ?? old($name))) selected @endif>{{ $option }}</option>
        @endforeach
    </select>
</div>
