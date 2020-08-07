<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', trans('backend.Name en')) !!}
    {!! Form::text('name', (isset($category) && $category->getTranslation('name','en')) ? $category->getTranslation('name','en') : null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('name', trans('backend.Name ar')) !!}
    {!! Form::text('name_ar',(isset($category) && $category->getTranslation('name','ar')) ? $category->getTranslation('name','ar') : null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(trans('backend.Save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.categories.index') !!}" class="btn btn-default">@lang('backend.Cancel')</a>
</div>
