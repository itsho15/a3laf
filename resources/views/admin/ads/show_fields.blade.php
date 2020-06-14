<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/ads.fields.id').':') !!}
    <p>{{ $ad->id }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/ads.fields.name').':') !!}
    <p>{{ $ad->name }}</p>
</div>

<!-- Body Field -->
<div class="form-group">
    {!! Form::label('body', __('models/ads.fields.body').':') !!}
    <p>{{ $ad->body }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', __('models/ads.fields.status').':') !!}
    <p>{{ $ad->status }}</p>
</div>

<!-- Ad Type Field -->
<div class="form-group">
    {!! Form::label('ad_type', __('models/ads.fields.ad_type').':') !!}
    <p>{{ $ad->ad_type }}</p>
</div>

<!-- Contact Types Field -->
<div class="form-group">
    {!! Form::label('contact_types', __('models/ads.fields.contact_types').':') !!}
    <p>{{ $ad->contact_types }}</p>
</div>

<!-- Price Field -->
<div class="form-group">
    {!! Form::label('price', __('models/ads.fields.price').':') !!}
    <p>{{ $ad->price }}</p>
</div>

<!-- City Id Field -->
<div class="form-group">
    {!! Form::label('city_id', __('models/ads.fields.city_id').':') !!}
    <p>{{ $ad->city_id }}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', __('models/ads.fields.user_id').':') !!}
    <p>{{ $ad->user_id }}</p>
</div>

<!-- Category Id Field -->
<div class="form-group">
    {!! Form::label('category_id', __('models/ads.fields.category_id').':') !!}
    <p>{{ $ad->category_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/ads.fields.created_at').':') !!}
    <p>{{ $ad->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/ads.fields.updated_at').':') !!}
    <p>{{ $ad->updated_at }}</p>
</div>

