<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/files.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Size Field -->
<div class="form-group col-sm-6">
    {!! Form::label('size', __('models/files.fields.size').':') !!}
    {!! Form::text('size', null, ['class' => 'form-control']) !!}
</div>

<!-- File Field -->
<div class="form-group col-sm-6">
    {!! Form::label('file', __('models/files.fields.file').':') !!}
    {!! Form::text('file', null, ['class' => 'form-control']) !!}
</div>

<!-- Path Field -->
<div class="form-group col-sm-6">
    {!! Form::label('path', __('models/files.fields.path').':') !!}
    {!! Form::text('path', null, ['class' => 'form-control']) !!}
</div>

<!-- Full File Field -->
<div class="form-group col-sm-6">
    {!! Form::label('full_file', __('models/files.fields.full_file').':') !!}
    {!! Form::text('full_file', null, ['class' => 'form-control']) !!}
</div>

<!-- Mime Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mime_type', __('models/files.fields.mime_type').':') !!}
    {!! Form::text('mime_type', null, ['class' => 'form-control']) !!}
</div>

<!-- File Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('file_type', __('models/files.fields.file_type').':') !!}
    {!! Form::text('file_type', null, ['class' => 'form-control']) !!}
</div>

<!-- Relation Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('relation_id', __('models/files.fields.relation_id').':') !!}
    {!! Form::text('relation_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.files.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
