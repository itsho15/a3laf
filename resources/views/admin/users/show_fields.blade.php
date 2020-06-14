<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', trans('backend.Name')) !!}
    <p>{!! $admin->name !!}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', trans('backend.Email')) !!}
    <p>{!! $admin->email !!}</p>
</div>

<!-- Password Field -->
<div class="form-group">
    {!! Form::label('password', trans('backend.Password')) !!}
    <p>{!! $admin->password !!}</p>
</div>

