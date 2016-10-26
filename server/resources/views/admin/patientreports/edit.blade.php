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
<?php
$behaviorShown = "";
foreach($behaviors as $behavior)
{ 
        $behaviorShown=$behavior->behaviorlists_id;
}
?>
{!! Form::model($patientreports, array('class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array('admin.patientreports.update', $patientreports->id))) !!}

<div class="form-group">
    {!! Form::label('first_name', 'First Name*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('first_name', old('first_name',$patients->first_name), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('last_name', 'Last Name*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('last_name', old('last_name',$patients->last_name), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('dob', 'Birth Date*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('dob', old('dob',$patients->dob), array('class'=>'form-control datepicker')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('gender', 'Gender*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('gender', $gender, old('gender',$patients->gender), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('ssn', 'SSN*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('ssn', old('ssn',$patients->ssn), array('class'=>'form-control')) !!}
        
    </div>
</div>
<div class="form-group">
    {!! Form::label('customers_id', 'Customer Reported*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('customers_id', $customers, old('customers_id',$patientreports->customers_id), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('balance_amount', 'Balance Amount*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('balance_amount', old('balance_amount',$patientreports->balance_amount), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('service_date', 'Service Date*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('service_date', old('service_date',$patientreports->service_date), array('class'=>'form-control datepicker')) !!}
        
    </div>
</div><div class="form-group">

    {!! Form::label('behaviorlists_id', 'Behavior*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('behaviorlists_id[]', $behaviorlists, old('behaviorlists_id',$behaviourShown), array('class'=>'form-control','multiple'=>'multiple')) !!}
    </div>
</div><div class="form-group">
    {!! Form::label('note', 'Short Note', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::textarea('note', old('note',$patientreports->note), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('report_date', 'Report Date*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('report_date', old('report_date',$patientreports->report_date), array('class'=>'form-control datepicker')) !!}
        
    </div>
</div>

<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-primary')) !!}
      {!! link_to_route('admin.patientreports.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-default')) !!}
    </div>
</div>

{!! Form::close() !!}

@endsection