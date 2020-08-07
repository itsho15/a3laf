<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/complaints.fields.id').':') !!}
    <p>{{ $complaint->id }}</p>
</div>

<!-- Content Field -->
<div class="form-group">
    {!! Form::label('content', __('models/complaints.fields.content').':') !!}
    <p>{{ $complaint->content }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/complaints.fields.created_at').':') !!}
    <p>{{ $complaint->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/complaints.fields.updated_at').':') !!}
    <p>{{ $complaint->updated_at }}</p>
</div>

