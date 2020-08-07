<div class="row">
	<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', __('models/pages.fields.title').':') !!}
    {!! Form::text('title', (isset($page) && $page->getTranslation('title','en')) ? $page->getTranslation('title','en') : null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('title_ar', __('models/pages.fields.title_ar').':') !!}
    {!! Form::text('title_ar', (isset($page) && $page->getTranslation('title','ar')) ? $page->getTranslation('title','ar') : null, ['class' => 'form-control']) !!}
</div>

<!-- Slug Field -->
<div class="form-group col-sm-6">
    {!! Form::label('slug', __('models/pages.fields.slug').':') !!}
    {!! Form::text('slug', null, ['class' => 'form-control']) !!}
</div>

<!-- Slug Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', __('models/pages.fields.type').':') !!}
    {!! Form::select('type',  ['menu'=>'menu','default'=>'default'],old('type'), ['class' => 'form-control']) !!}
</div>

<!-- Body Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('body', __('models/pages.fields.body').':') !!}
    {!! Form::textarea('body', (isset($page) && $page->getTranslation('body','en')) ? $page->getTranslation('body','en') : null, ['class' => 'form-control mymce']) !!}
</div>

<!-- Body Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('body_ar', __('models/pages.fields.body_ar').':') !!}
    {!! Form::textarea('body_ar', (isset($page) && $page->getTranslation('body','ar')) ? $page->getTranslation('body','ar') : null, ['class' => 'form-control mymce']) !!}
</div>
	<!-- Submit Field -->
	<div class="form-group col-sm-12">
	    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
	    <a href="{{ route('admin.pages.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
	</div>
</div>

@push('js')

 <script src="{{ url('design/adminlte/assets/') }}/node_modules/tinymce/tinymce.min.js"></script>
    <script>
    $(document).ready(function() {

        if ($(".mymce").length > 0) {
            tinymce.init({
                selector: "textarea.mymce",
                theme: "modern",
                height: 300,
                /*
                 plugins: [
                    "advlist autolink link lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],
                 */
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | print preview fullpage | forecolor backcolor emoticons",
            });
        }
    });
    </script>
@endpush

