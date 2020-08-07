<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/banks.fields.name').':') !!}
    {!! Form::text('name', (isset($bank) && $bank->getTranslation('name','en')) ? $bank->getTranslation('name','en') : null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/banks.fields.name_ar').':')!!}
    {!! Form::text('name_ar',(isset($bank) && $bank->getTranslation('name','ar')) ? $bank->getTranslation('name','ar') : null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{!! Form::label('image', __('models/banks.fields.image').':') !!}</h4>
            <input type="file" id="input-file-now-custom-1" name="image" class="dropify" @if(isset($bank) && $bank->image)  data-default-file="{{ Storage::url($bank->image) }}" @endif data-show-remove="false"/>
        </div>
    </div>
</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.banks.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
