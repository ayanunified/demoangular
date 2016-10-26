@extends('admin.layouts.master')

@section('content')
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
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

{!! Form::model($patientslooks, array('class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array('admin.patientslooks.update', $patientslooks->id))) !!}

<div class="form-group">
    {!! Form::label('first_name', 'First Name', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('first_name', old('first_name',$patientslooks->first_name), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('middle_name', 'Middle Name', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('middle_name', old('middle_name',$patientslooks->middle_name), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('last_name', 'Last Name', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('last_name', old('last_name',$patientslooks->last_name), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('dob', 'Birth Date', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('dob', old('dob',$patientslooks->dob), array('class'=>'form-control datepicker')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('ssn', 'SSN', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('ssn', old('ssn',$patientslooks->ssn), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('gender', 'Gender', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('gender', old('gender',$patientslooks->gender), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('customers_id', 'Customer', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('customers_id', $customers, old('customers_id',$patientslooks->customers_id), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('found_match', 'Found Match', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('found_match', old('found_match',$patientslooks->found_match), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('patient_ids', 'Patient Id', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('patient_ids', old('patient_ids',$patientslooks->patient_ids), array('class'=>'form-control')) !!}
        
    </div>
</div>

<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-primary')) !!}
      {!! link_to_route('admin.patientslooks.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-default')) !!}
    </div>
</div>

{!! Form::close() !!}

@endsection