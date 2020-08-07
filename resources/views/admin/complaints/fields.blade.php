<div class="row">
	<!-- Content Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('content', __('models/complaints.fields.content').':') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
</div>
<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ad_id', __('models/comments.fields.ad_id').':') !!}
    {!! Form::select('ad_id', App\Models\Ad::pluck('name','id'),old('ad_id'), ['class' => 'form-control']) !!}
</div>
	<!-- Submit Field -->
	<div class="form-group col-sm-12">
	    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
	    <a href="{{ route('admin.complaints.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
	</div>
</div>
