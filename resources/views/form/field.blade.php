<div class="form-group @if($errors->has($name)) error @endif">
    <label>{{ $title ?? trans('field.'.$name) }}</label><br/>
    <input type="{{ $type ?? 'text' }}" name="{{ $name }}" value="{{ old($name) ?? $value ?? '' }}"/><br/>
    @if($errors->has($name))
       <div class="has-error">
           {!! implode('<br/>', $errors->get($name)) !!}
       </div>
    @endif
</div>
