<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/states.fields.name').':') !!}
    {!! Form::text('name', (isset($state) && $state->getTranslation('name','en')) ? $state->getTranslation('name','en') : null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/states.fields.name_ar').':') !!}
    {!! Form::text('name_ar',(isset($state) && $state->getTranslation('name','ar')) ? $state->getTranslation('name','ar') : null, ['class' => 'form-control']) !!}
</div>

<!-- Country Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('country_id', __('models/states.fields.country_id').':') !!}
      {!! Form::select('country_id', App\Models\Country::pluck('name','id'),old('country_id'), ['class' => 'form-control']) !!}
</div>

<!-- City Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('city_id', __('models/states.fields.city_id').':') !!}
      {!! Form::select('city_id', App\Models\City::pluck('name','id'),old('city_id'), ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.states.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
