<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/comments.fields.id').':') !!}
    <p>{{ $comment->id }}</p>
</div>

<!-- Body Field -->
<div class="form-group">
    {!! Form::label('body', __('models/comments.fields.body').':') !!}
    <p>{{ $comment->body }}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', __('models/comments.fields.user_id').':') !!}
    <p>{{ $comment->user_id }}</p>
</div>

<!-- Ad Id Field -->
<div class="form-group">
    {!! Form::label('ad_id', __('models/comments.fields.ad_id').':') !!}
    <p>{{ $comment->ad_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/comments.fields.created_at').':') !!}
    <p>{{ $comment->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/comments.fields.updated_at').':') !!}
    <p>{{ $comment->updated_at }}</p>
</div>

