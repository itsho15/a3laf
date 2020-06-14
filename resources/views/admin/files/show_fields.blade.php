<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/files.fields.name').':') !!}
    <p>{{ $file->name }}</p>
</div>

<!-- Size Field -->
<div class="form-group">
    {!! Form::label('size', __('models/files.fields.size').':') !!}
    <p>{{ $file->size }}</p>
</div>

<!-- File Field -->
<div class="form-group">
    {!! Form::label('file', __('models/files.fields.file').':') !!}
    <p>{{ $file->file }}</p>
</div>

<!-- Path Field -->
<div class="form-group">
    {!! Form::label('path', __('models/files.fields.path').':') !!}
    <p>{{ $file->path }}</p>
</div>

<!-- Full File Field -->
<div class="form-group">
    {!! Form::label('full_file', __('models/files.fields.full_file').':') !!}
    <p>{{ $file->full_file }}</p>
</div>

<!-- Mime Type Field -->
<div class="form-group">
    {!! Form::label('mime_type', __('models/files.fields.mime_type').':') !!}
    <p>{{ $file->mime_type }}</p>
</div>

<!-- File Type Field -->
<div class="form-group">
    {!! Form::label('file_type', __('models/files.fields.file_type').':') !!}
    <p>{{ $file->file_type }}</p>
</div>

<!-- Relation Id Field -->
<div class="form-group">
    {!! Form::label('relation_id', __('models/files.fields.relation_id').':') !!}
    <p>{{ $file->relation_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/files.fields.created_at').':') !!}
    <p>{{ $file->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/files.fields.updated_at').':') !!}
    <p>{{ $file->updated_at }}</p>
</div>

<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/files.fields.id').':') !!}
    <p>{{ $file->id }}</p>
</div>

