<!-- Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id', __('models/messages.fields.id').':') !!}
    {!! Form::text('id', null, ['class' => 'form-control']) !!}
</div>

<!-- Content Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('content', __('models/messages.fields.content').':') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
</div>

<!-- Conversation Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('conversation_id', __('models/messages.fields.conversation_id').':') !!}
    {!! Form::text('conversation_id', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', __('models/messages.fields.user_id').':') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.messages.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
