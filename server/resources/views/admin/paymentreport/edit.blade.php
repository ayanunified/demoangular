@extends('admin.layouts.master')

@section('content')

<div class="row">
    <div class="col-sm-10 col-sm-offset-2">
        <h1>View</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {!! implode('', $errors->all('<li class="error">:message</li>')) !!}
                </ul>
        	</div>
        @endif
    </div>
</div>

{!! Form::model($paymentreport, array('class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array('admin.paymentreport.update', $paymentreport->id))) !!}

<div class="form-group">
    {!! Form::label('customers_id', 'Customer*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('customers_id', $customers, old('customers_id',$paymentreport->customers_id), array('class'=>'form-control','disabled'=>'disabled')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('transaction_id', 'Transaction Id*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('transaction_id', old('transaction_id',$paymentreport->transaction_id), array('class'=>'form-control','disabled'=>'disabled')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('amount_paid', 'Paid Amount*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('amount_paid', old('amount_paid',$paymentreport->amount_paid), array('class'=>'form-control','disabled'=>'disabled')) !!}
        
    </div>
</div>

<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
    
      {!! link_to_route('admin.paymentreport.index', 'Back', null, array('class' => 'btn btn-default')) !!}
    </div>
</div>

{!! Form::close() !!}

@endsection