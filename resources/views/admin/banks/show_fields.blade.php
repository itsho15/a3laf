<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/banks.fields.id').':') !!}
    <p>{{ $bank->id }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/banks.fields.name').':') !!}
    <p>{{ $bank->name }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/banks.fields.created_at').':') !!}
    <p>{{ $bank->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/banks.fields.updated_at').':') !!}
    <p>{{ $bank->updated_at }}</p>
</div>

