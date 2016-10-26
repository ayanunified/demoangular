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

{!! Form::model($loginlogs, array('class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array('admin.loginlogs.update', $loginlogs->id))) !!}

<div class="form-group">
    {!! Form::label('customers_id', 'Customer*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('customers_id', $customers, old('customers_id',$loginlogs->customers_id), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('login_time', 'Login Time*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('login_time', old('login_time',$loginlogs->login_time), array('class'=>'form-control datetimepicker')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('logout_time', 'Logout Time*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('logout_time', old('logout_time',$loginlogs->logout_time), array('class'=>'form-control datetimepicker')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('patients_ids', 'Patient Added Ids', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('patients_ids', old('patients_ids',$loginlogs->patients_ids), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('patients_search_id', 'Patients Search Ids', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('patients_search_id', old('patients_search_id',$loginlogs->patients_search_id), array('class'=>'form-control')) !!}
        
    </div>
</div>

<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-primary')) !!}
      {!! link_to_route('admin.loginlogs.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-default')) !!}
    </div>
</div>

{!! Form::close() !!}

@endsection