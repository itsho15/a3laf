<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/states.fields.id').':') !!}
    <p>{{ $state->id }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/states.fields.name').':') !!}
    <p>{{ $state->name }}</p>
</div>

<!-- Country Id Field -->
<div class="form-group">
    {!! Form::label('country_id', __('models/states.fields.country_id').':') !!}
    <p>{{ $state->country_id }}</p>
</div>

<!-- City Id Field -->
<div class="form-group">
    {!! Form::label('city_id', __('models/states.fields.city_id').':') !!}
    <p>{{ $state->city_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/states.fields.created_at').':') !!}
    <p>{{ $state->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/states.fields.updated_at').':') !!}
    <p>{{ $state->updated_at }}</p>
</div>

