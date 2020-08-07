<!-- Name Field -->

<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/countries.fields.name').':') !!}
    {!! Form::text('name', (isset($country) && $country->getTranslation('name','en')) ? $country->getTranslation('name','en') : null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/countries.fields.name_ar').':') !!}

    {!! Form::text('name_ar',(isset($country) && $country->getTranslation('name','ar') != null) ? $country->getTranslation('name','ar') : (isset($country) ) ? $country->name :null, ['class' => 'form-control']) !!}
</div>


{{-- 
<!-- Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', __('models/countries.fields.image').':') !!}
    {!! Form::file('image',['class'=>'form-control']) !!}
</div>
<div class="clearfix"></div>
--}}

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.countries.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
