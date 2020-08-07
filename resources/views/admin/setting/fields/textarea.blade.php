<div class="form-group {{ $errors->has($field['name']) ? ' has-error' : '' }}">
    <label for="{{ $field['name'] }}">{{ $field['label'] }}</label>
    
   
    {!! Form::textarea($field['name'], old($field['name'], \setting($field['name'])) , ['class' => 'form-control ']) !!}
    

    @if ($errors->has($field['name'])) <small class="help-block">{{ $errors->first($field['name']) }}</small> @endif
</div>