<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/favorites.fields.id').':') !!}
    <p>{{ $favorite->id }}</p>
</div>

<!-- Ad Id Field -->
<div class="form-group">
    {!! Form::label('ad_id', __('models/favorites.fields.ad_id').':') !!}
    <p>{{ $favorite->ad_id }}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', __('models/favorites.fields.user_id').':') !!}
    <p>{{ $favorite->user_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/favorites.fields.created_at').':') !!}
    <p>{{ $favorite->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/favorites.fields.updated_at').':') !!}
    <p>{{ $favorite->updated_at }}</p>
</div>

