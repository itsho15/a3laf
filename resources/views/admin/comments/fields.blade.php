<!-- Body Field -->
<div class="form-group col-sm-6">
    {!! Form::label('body', __('models/comments.fields.body').':') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', __('models/comments.fields.user_id').':') !!}
    {!! Form::select('user_id', App\User::pluck('name','id'),old('user_id'), ['class' => 'form-control']) !!}
</div>


<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ad_id', __('models/comments.fields.ad_id').':') !!}
    {!! Form::select('ad_id', App\Models\Ad::pluck('name','id'),old('ad_id'), ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.comments.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
