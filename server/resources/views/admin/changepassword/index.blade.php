@extends('admin.layouts.master')

@section('content')
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="row">
    <div class="col-sm-10 col-sm-offset-2">
        <!--<h1>{{ trans('quickadmin::templates.templates-view_edit-edit') }}</h1>-->
	<h1>Change Password</h1>
        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {!! implode('', $errors->all('<li class="error">:message</li>')) !!}
                </ul>
        	</div>
        @endif
    </div>
</div>

{!! Form::model('change_password', array('class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array('admin.changepassword.update'))) !!}
<div class="form-group">
    {!! Form::label('old_password', 'Old Password*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::password('old_password', array('class'=>'form-control','placeholder'=>'Old Password')) !!}
        
    </div>
</div>
<div class="form-group">
    {!! Form::label('new_password', 'New Password*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::password('new_password', array('class'=>'form-control','placeholder'=>'New Password')) !!}
        
    </div>
</div>
<div class="form-group">
     {!! Form::label('confirm_password', 'Confirm Password*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::password('confirm_password', array('class'=>'form-control','placeholder'=>'Confirm Password')) !!}
        
    </div>
</div>

<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-primary')) !!}
     
    </div>
</div>

{!! Form::close() !!}

@endsection
