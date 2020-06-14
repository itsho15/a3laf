<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', __('models/followers.fields.user_id').':') !!}
    {!! Form::select('user_id', App\User::pluck('name','id'),old('user_id'), ['class' => 'form-control']) !!}
</div>

<!-- Follower Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('follower_id', __('models/followers.fields.follower_id').':') !!}
    {!! Form::select('follower_id', App\User::pluck('name','id'),old('follower_id'), ['class' => 'form-control']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.followers.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
