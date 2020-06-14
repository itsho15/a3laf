<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/cities.fields.name').':') !!}
    {!! Form::text('name', (isset($city) && $city->getTranslation('name','en')) ? $city->getTranslation('name','en') : (isset($city) )? $city->name : null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/cities.fields.name_ar').':') !!}
    {!! Form::text('name_ar',(isset($city) && $city->getTranslation('name','ar')) ? $city->getTranslation('name','ar') : (isset($city) )? $city->name : null, ['class' => 'form-control']) !!}
</div>

<!-- Country Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('country_id', __('models/cities.fields.country_id').':') !!}
    {!! Form::select('country_id', App\Models\Country::pluck('name','id'),old('country_id'), ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.cities.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
