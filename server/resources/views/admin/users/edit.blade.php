@extends('admin.layouts.master')

@section('content')

    <div class="row">
        <div class="col-sm-10 col-sm-offset-2">
            <h1>{{ trans('quickadmin::admin.users-edit-edit_user') }}</h1>

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

    {!! Form::open(['route' => ['users.update', $user->id], 'class' => 'form-horizontal', 'method' => 'PATCH','files'=>true]) !!}

    <div class="form-group">
        {!! Form::label('first_name', 'First Name', ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('first_name', old('first_name', $user->first_name), ['class'=>'form-control', 'placeholder'=> 'First name']) !!}
        </div>
    </div>
        
    <div class="form-group">
        {!! Form::label('last_name', 'Last Name', ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('last_name', old('last_name', $user->last_name), ['class'=>'form-control', 'placeholder'=> 'Last name']) !!}
        </div>
    </div>    

    <div class="form-group">
        {!! Form::label('email', trans('quickadmin::admin.users-edit-email'), ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::email('email', old('email', $user->email), ['class'=>'form-control', 'placeholder'=> trans('quickadmin::admin.users-edit-email_placeholder')]) !!}
        </div>
    </div>

    <!--<div class="form-group">
        {!! Form::label('password', trans('quickadmin::admin.users-edit-password'), ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::password('password', ['class'=>'form-control', 'placeholder'=> trans('quickadmin::admin.users-edit-password_placeholder')]) !!}
        </div>
    </div>-->

    <!--<div class="form-group">
        {!! Form::label('role_id', trans('quickadmin::admin.users-edit-role'), ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::select('role_id', $roles, old('role_id', $user->role_id), ['class'=>'form-control']) !!}
        </div>
    </div>-->
    <div class="form-group">
        {!! Form::label('status', 'Status', ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::select('status', array('1' => 'Active', '0' => 'Inactive'), old('status', $user->status), ['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('image', 'Image', ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::file('image') !!}
        </div>
        <div class="col-sm-10">
            @if($user->image) <img src="{{ url('uploads') }}/profile/thumb/{{ $user->image }}"> @else <img src="{{ url('frontend') }}/images/no-image.jpg" alt=""> @endif     
        </div>     
    </div>
    {!! Form::hidden('role_id', old('role_id', $user->role_id), ['class'=>'form-control']) !!}

    <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
            {!! Form::submit(trans('quickadmin::admin.users-edit-btnupdate'), ['class' => 'btn btn-primary']) !!}
        </div>
    </div>

    {!! Form::close() !!}

@endsection


