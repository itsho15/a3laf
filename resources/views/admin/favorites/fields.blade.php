<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', __('models/favorites.fields.user_id').':') !!}
    {!! Form::select('user_id', App\User::pluck('name','id'),old('user_id'), ['class' => 'form-control']) !!}
</div>


<!-- ad Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ad_id', __('models/favorites.fields.ad_id').':') !!}
    {!! Form::select('ad_id', App\Models\Ad::pluck('name','id'),old('ad_id'), ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.favorites.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
