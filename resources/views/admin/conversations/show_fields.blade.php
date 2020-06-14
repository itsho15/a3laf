<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/conversations.fields.id').':') !!}
    <p>{{ $conversation->id }}</p>
</div>

<!-- Offer Id Field -->
<div class="form-group">
    {!! Form::label('offer_id', __('models/conversations.fields.offer_id').':') !!}
    <p>{{ $conversation->offer_id }}</p>
</div>

<!-- Order Id Field -->
<div class="form-group">
    {!! Form::label('order_id', __('models/conversations.fields.order_id').':') !!}
    <p>{{ $conversation->order_id }}</p>
</div>

<!-- From Id Field -->
<div class="form-group">
    {!! Form::label('from_id', __('models/conversations.fields.from_id').':') !!}
    <p>{{ $conversation->from_id }}</p>
</div>

<!-- To Id Field -->
<div class="form-group">
    {!! Form::label('to_id', __('models/conversations.fields.to_id').':') !!}
    <p>{{ $conversation->to_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/conversations.fields.created_at').':') !!}
    <p>{{ $conversation->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/conversations.fields.updated_at').':') !!}
    <p>{{ $conversation->updated_at }}</p>
</div>

