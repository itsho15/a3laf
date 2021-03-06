<div class="row">
    <!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/ads.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', __('models/ads.fields.price').':') !!}
    {!! Form::number('price', null, ['class' => 'form-control']) !!}
</div>

<!-- Body Field -->
<div class="form-group col-sm-12">
    {!! Form::label('body', __('models/ads.fields.body').':') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
</div>

<!-- Contact Types Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contact_types', __('models/ads.fields.contact_types').':') !!}
    {!! Form::select('contact_types[]', ['phone'=>'phone','chat'=>'chat'],old('contact_types'), ['multiple'=>'multiple','class' => 'form-control select2']) !!}
</div>

<!-- City Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('city_id', __('models/ads.fields.city_id').':') !!}
    {!! Form::select('city_id', App\Models\City::pluck('name','id'),old('city_id'), ['class' => 'form-control select2']) !!}
</div>

{!! Form::hidden('user_id', auth()->id()) !!}

<div class="form-group col-sm-6">
    {!! Form::label('category_id', __('models/ads.fields.category_id').':') !!}
    {!! Form::select('category_id', App\Models\Category::pluck('name','id'),old('category_id'), ['class' => 'form-control select2']) !!}
</div>
<!-- Primary Image Field -->
<div class="form-group col-sm-12">
    {!! Form::label('images', __('models/ads.fields.images').':') !!}
    @if(isset($ad))
    <div class="dropzone" id="dropzonefileUpload" > </div>
    @else
    {!! Form::file('images[]',['multiple'=>true,'class'=>'form-control']) !!}
    @endif
</div>
<!-- Ad Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ad_type', __('models/ads.fields.ad_type').':') !!}
    {!! Form::select('ad_type', ['sell'=>trans('front.sell_type'), 'buy'=>trans('front.buy_type')],old('ad_type'), ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.ads.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>

</div>