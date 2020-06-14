<!-- Offer Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('offer_id', __('models/conversations.fields.offer_id').':') !!}
    {!! Form::select('offer_id', ['' => ''], null, ['class' => 'form-control']) !!}
</div>

<!-- Order Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order_id', __('models/conversations.fields.order_id').':') !!}
    {!! Form::select('order_id', ['' => ''], null, ['class' => 'form-control']) !!}
</div>

<!-- From Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('from_id', __('models/conversations.fields.from_id').':') !!}
    {!! Form::select('from_id', ['' => ''], null, ['class' => 'form-control']) !!}
</div>

<!-- To Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('to_id', __('models/conversations.fields.to_id').':') !!}
    {!! Form::select('to_id', ['' => ''], null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.conversations.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
