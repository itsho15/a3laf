<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/countries.fields.id').':') !!}
    <p>{{ $country->id }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/countries.fields.name').':') !!}
    <p>{{ $country->name }}</p>
</div>

<!-- Image Field -->
<div class="form-group">
    {!! Form::label('image', __('models/countries.fields.image').':') !!}
    <p>{{ $country->image }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/countries.fields.created_at').':') !!}
    <p>{{ $country->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/countries.fields.updated_at').':') !!}
    <p>{{ $country->updated_at }}</p>
</div>

