<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/followers.fields.id').':') !!}
    <p>{{ $follower->id }}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', __('models/followers.fields.user_id').':') !!}
    <p>{{ $follower->user_id }}</p>
</div>

<!-- Follower Id Field -->
<div class="form-group">
    {!! Form::label('follower_id', __('models/followers.fields.follower_id').':') !!}
    <p>{{ $follower->follower_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/followers.fields.created_at').':') !!}
    <p>{{ $follower->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/followers.fields.updated_at').':') !!}
    <p>{{ $follower->updated_at }}</p>
</div>

