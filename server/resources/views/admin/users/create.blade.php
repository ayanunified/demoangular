@extends('admin.layouts.master')

@section('content')

    <div class="row">
        <div class="col-sm-10 col-sm-offset-2">
            <h1>{{ trans('quickadmin::admin.users-create-create_user') }}</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        {!! implode('', $errors->all('
                        <li class="error">:message</li>
                        ')) !!}
                    </ul>
                </div>
            @endif
        </div>
    </div>

    {!! Form::open(['route' => 'users.store', 'class' => 'form-horizontal']) !!}

    <div class="form-group">
        {!! Form::label('name', 'First Name', ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('first_name', old('first_name'), ['class'=>'form-control', 'placeholder'=> 'First Name']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('name', 'Last Name', ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('last_name', old('last_name'), ['class'=>'form-control', 'placeholder'=> 'Last Name']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('email', trans('quickadmin::admin.users-create-email'), ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::email('email', old('email'), ['class'=>'form-control', 'placeholder'=> trans('quickadmin::admin.users-create-email_placeholder')]) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('password', trans('quickadmin::admin.users-create-password'), ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::password('password', ['class'=>'form-control', 'placeholder'=> trans('quickadmin::admin.users-create-password_placeholder')]) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('status', 'Status', ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::select('status', array('1' => 'Active', '0' => 'Inactive'), old('status'), ['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('image', 'Image', ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::file('image') !!}
        </div>
    </div>
     {!! Form::hidden('role_id', old('role_id', 2), ['class'=>'form-control']) !!}    
    <!--<div class="form-group">
        {!! Form::label('role_id', trans('quickadmin::admin.users-create-role'), ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::select('role_id', $roles, old('role_id'), ['class'=>'form-control']) !!}
        </div>
    </div>-->

    <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
            {!! Form::submit(trans('quickadmin::admin.users-create-btncreate'), ['class' => 'btn btn-primary']) !!}
        </div>
    </div>

    {!! Form::close() !!}

@endsection


