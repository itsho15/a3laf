<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/types.fields.name').':') !!}
    {!! Form::text('name', (isset($type) && $type->getTranslation('name','en')) ? $type->getTranslation('name','en') : (isset($type) ) ? $type->name :null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/types.fields.name_ar').':') !!}

    {!! Form::text('name_ar',(isset($type) && $type->getTranslation('name','ar') != null) ? $type->getTranslation('name','ar') : (isset($type) ) ? $type->name :null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.types.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
