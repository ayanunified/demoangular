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

{!! Form::model($dashboardimages, array('files' => true, 'class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array('admin.dashboardimages.update', $dashboardimages->id))) !!}

<div class="form-group">
    {!! Form::label('position', 'Image Position*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {{$dashboardimages->position}}
        
    </div>
</div><div class="form-group">
    {!! Form::label('img_path', 'Image', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::file('img_path') !!}
        <h4>(Recommended File Sizes: <br/>
        Homepage: 980*120px <br/>
Patient: 
Top - 980*120px <br/>
Left - 240*400px) <br/> </h4>
        {!! Form::hidden('img_path_w', 980) !!}
        {!! Form::hidden('img_path_h', 240) !!}
        

        
    </div>
    <div class="col-sm-10">
            @if($dashboardimages->img_path) <img src="{{ url('uploads') }}/thumb/{{$dashboardimages->img_path}}"> @else <img src="{{ url('frontend') }}/images/no-image.jpg" alt=""> @endif     
    </div>
</div>

<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-primary')) !!}
      {!! link_to_route('admin.dashboardimages.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-default')) !!}
    </div>
</div>

{!! Form::close() !!}

@endsection