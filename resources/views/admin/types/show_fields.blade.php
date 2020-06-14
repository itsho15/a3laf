<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/types.fields.id').':') !!}
    <p>{{ $type->id }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/types.fields.name').':') !!}
    <p>{{ $type->name }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/types.fields.created_at').':') !!}
    <p>{{ $type->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/types.fields.updated_at').':') !!}
    <p>{{ $type->updated_at }}</p>
</div>

