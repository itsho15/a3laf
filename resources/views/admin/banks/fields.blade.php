<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/banks.fields.name').':') !!}
    {!! Form::text('name', (isset($bank) && $bank->getTranslation('name','en')) ? $bank->getTranslation('name','en') : null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/banks.fields.name_ar').':')!!}
    {!! Form::text('name_ar',(isset($bank) && $bank->getTranslation('name','ar')) ? $bank->getTranslation('name','ar') : null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.banks.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
