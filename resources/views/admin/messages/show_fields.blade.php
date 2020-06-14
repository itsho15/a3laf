<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/messages.fields.id').':') !!}
    <p>{{ $message->id }}</p>
</div>

<!-- Content Field -->
<div class="form-group">
    {!! Form::label('content', __('models/messages.fields.content').':') !!}
    <p>{{ $message->content }}</p>
</div>

<!-- Conversation Id Field -->
<div class="form-group">
    {!! Form::label('conversation_id', __('models/messages.fields.conversation_id').':') !!}
    <p>{{ $message->conversation_id }}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', __('models/messages.fields.user_id').':') !!}
    <p>{{ $message->user_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/messages.fields.created_at').':') !!}
    <p>{{ $message->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/messages.fields.updated_at').':') !!}
    <p>{{ $message->updated_at }}</p>
</div>

