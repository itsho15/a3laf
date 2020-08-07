<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/pages.fields.id').':') !!}
    <p>{{ $page->id }}</p>
</div>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', __('models/pages.fields.title').':') !!}
    <p>{{ $page->title }}</p>
</div>

<!-- Slug Field -->
<div class="form-group">
    {!! Form::label('slug', __('models/pages.fields.slug').':') !!}
    <p>{{ $page->slug }}</p>
</div>

<!-- Body Field -->
<div class="form-group">
    {!! Form::label('body', __('models/pages.fields.body').':') !!}
    <p>{{ $page->body }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/pages.fields.created_at').':') !!}
    <p>{{ $page->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/pages.fields.updated_at').':') !!}
    <p>{{ $page->updated_at }}</p>
</div>

