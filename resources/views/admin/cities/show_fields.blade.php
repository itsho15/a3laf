<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/cities.fields.id').':') !!}
    <p>{{ $city->id }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/cities.fields.name').':') !!}
    <p>{{ $city->name }}</p>
</div>

<!-- Country Id Field -->
<div class="form-group">
    {!! Form::label('country_id', __('models/cities.fields.country_id').':') !!}
    <p>{{ $city->country_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/cities.fields.created_at').':') !!}
    <p>{{ $city->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/cities.fields.updated_at').':') !!}
    <p>{{ $city->updated_at }}</p>
</div>

