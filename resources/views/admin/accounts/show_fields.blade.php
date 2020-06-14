<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/accounts.fields.id').':') !!}
    <p>{{ $account->id }}</p>
</div>

<!-- Number Field -->
<div class="form-group">
    {!! Form::label('number', __('models/accounts.fields.number').':') !!}
    <p>{{ $account->number }}</p>
</div>

<!-- Iban Field -->
<div class="form-group">
    {!! Form::label('iban', __('models/accounts.fields.iban').':') !!}
    <p>{{ $account->iban }}</p>
</div>

<!-- Note Field -->
<div class="form-group">
    {!! Form::label('note', __('models/accounts.fields.note').':') !!}
    <p>{{ $account->note }}</p>
</div>

<!-- Bank Id Field -->
<div class="form-group">
    {!! Form::label('bank_id', __('models/accounts.fields.bank_id').':') !!}
    <p>{{ $account->bank_id }}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', __('models/accounts.fields.user_id').':') !!}
    <p>{{ $account->user_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/accounts.fields.created_at').':') !!}
    <p>{{ $account->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/accounts.fields.updated_at').':') !!}
    <p>{{ $account->updated_at }}</p>
</div>

