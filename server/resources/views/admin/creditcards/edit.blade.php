@extends('admin.layouts.master')

@section('content')

<div class="row">
    <div class="col-sm-10 col-sm-offset-2">
        <h1>{{ trans('quickadmin::templates.templates-view_edit-edit') }}</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {!! implode('', $errors->all('<li class="error">:message</li>')) !!}
                </ul>
        	</div>
        @endif
    </div>
</div>

{!! Form::model($creditcards, array('class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array('admin.creditcards.update', $creditcards->id))) !!}

<div class="form-group">
    {!! Form::label('card_number', 'Card Number*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('card_number', old('card_number',$creditcards->card_number), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('expire_month', 'Expire Month*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('expire_month', old('expire_month',$creditcards->expire_month), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('expire_year', 'Expire Year*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('expire_year', old('expire_year',$creditcards->expire_year), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('name', 'Name*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('name', old('name',$creditcards->name), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('security_code', 'Security Code', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('security_code', old('security_code',$creditcards->security_code), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('creditcardtypes_id', 'Credit Card Types*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('creditcardtypes_id', $creditcardtypes, old('creditcardtypes_id',$creditcards->creditcardtypes_id), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('customers_id', 'Customer*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('customers_id', $customers, old('customers_id',$creditcards->customers_id), array('class'=>'form-control')) !!}
        
    </div>
</div>

<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-primary')) !!}
      {!! link_to_route('admin.creditcards.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-default')) !!}
    </div>
</div>

{!! Form::close() !!}

@endsection