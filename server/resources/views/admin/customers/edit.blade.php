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

{!! Form::model($customers, array('class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array('admin.customers.update', $customers->id))) !!}

<div class="form-group">
    {!! Form::label('businessName', 'Business Name*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('businessName', old('businessName',$customers->businessName), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('businesses_id', 'Business Type*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('businesses_id', $businesses, old('businesses_id',$customers->businesses_id), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('address', 'Address*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::textarea('address', old('address',$customers->address), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('suite', 'Suite*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('suite', old('suite',$customers->suite), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('city', 'City*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('city', old('city',$customers->city), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('state', 'State*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('state', old('state',$customers->state), array('class'=>'form-control')) !!}
        
    </div>
</div>
    <div class="form-group">
    {!! Form::label('zip', 'Zip Code*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('zip', old('zip',$customers->zip), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('office_phone', 'Office Phone*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('office_phone', old('office_phone',$customers->office_phone), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('email', 'Email*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::email('email', old('email',$customers->email), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('website', 'Website', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('website', old('website',$customers->website), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('noOfDoc', 'Number Of Doctors', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('noOfDoc', old('noOfDoc',$customers->noOfDoc), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('first_name', 'Contact Person First Name*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('first_name', old('first_name',$customers->first_name), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('last_name', 'Contact Person Last Name*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('last_name', old('last_name',$customers->last_name), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('username', 'User Name*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('username', old('username',$customers->username), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('status', 'Customer Status*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('status', $status, old('status',$customers->status), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('expiry_date', 'StatusExpireDate*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('expiry_date', old('expiry_date',$customers->expiry_date), array('class'=>'form-control datepicker')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('memberships_id', 'Membership Type*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('memberships_id', $memberships, old('memberships_id',$customers->memberships_id), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('sales_person_id', 'Sales Person Id', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('sales_person_id', old('sales_person_id',$customers->sales_person_id), array('class'=>'form-control')) !!}
        
    </div>
</div>
<div class="form-group">
    {!! Form::label('refer_chanel', 'ReferChannel', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('refer_chanel', old('refer_chanel',$customers->refer_chanel), array('class'=>'form-control')) !!}
        
    </div>
</div>

<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-primary')) !!}
      {!! link_to_route('admin.customers.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-default')) !!}
    </div>
</div>

{!! Form::close() !!}

@endsection
