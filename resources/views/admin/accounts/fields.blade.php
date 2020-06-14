<!-- Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('number', __('models/accounts.fields.number').':') !!}
    {!! Form::text('number', null, ['class' => 'form-control']) !!}
</div>

<!-- Iban Field -->
<div class="form-group col-sm-6">
    {!! Form::label('iban', __('models/accounts.fields.iban').':') !!}
    {!! Form::text('iban', null, ['class' => 'form-control']) !!}
</div>

<!-- Note Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('note', __('models/accounts.fields.note').':') !!}
    {!! Form::textarea('note', null, ['class' => 'form-control']) !!}
</div>

<!-- bank Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bank_id', __('models/accounts.fields.bank_id').':') !!}
    {!! Form::select('bank_id', App\Models\Bank::pluck('name','id'),old('bank_id'), ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.accounts.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
