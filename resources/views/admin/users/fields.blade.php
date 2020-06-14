<div class="row">
	<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/users.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', __('models/users.fields.email').':') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', __('models/users.fields.password').':') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone', __('models/users.fields.phone').':') !!}
    {!! Form::tel('phone', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('type', __('models/users.fields.type').':') !!}
    {!! Form::select('type', ['user'=>'user','moderator'=>'moderator'],old('type'), ['class' => 'form-control']) !!}
</div>

<!-- city Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('city_id', __('models/users.fields.city_id').':') !!}
    {!! Form::select('city_id', App\Models\City::pluck('name','id'),old('city_id'), ['class' => 'form-control']) !!}
</div>

<!-- lat Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lat', __('models/users.fields.lat').':') !!}
    {!! Form::text('lat', null, ['class' => 'form-control']) !!}
</div>

<!-- lng Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lng', __('models/users.fields.lng').':') !!}
    {!! Form::text('lng', null, ['class' => 'form-control']) !!}
</div>

<!-- avatar Field -->
<div class="form-group col-sm-6">
     {!! Form::label('avatar', __('models/users.fields.avatar').':') !!}
    {!! Form::file('avatar',['class'=>'form-control']) !!}
    @if(isset($user) && $user->avatar)
    <img src="{{ Storage::url($user->avatar) }}" class="card-img-top img-responsive" alt="{{ $user->avatar }}">
    @endif
</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.users.index') !!}" class="btn btn-default">@lang('backend.Cancel')</a>
</div>

</div>