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

{!! Form::model($reportpatients, array('files' => true, 'class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array('admin.reportpatients.update', $reportpatients->id))) !!}

<div class="form-group">
    {!! Form::label('position', 'Banner Position', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {{$reportpatients->position}}
        
    </div>
</div><div class="form-group">
    {!! Form::label('image_path', 'Banner Image', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::file('image_path') !!}
        {!! Form::hidden('image_path_w', 980) !!}
        {!! Form::hidden('image_path_h', 240) !!}
        
    </div>
    <div class="col-sm-10">
            @if($reportpatients->image_path) <img src="{{ url('uploads') }}/thumb/{{$reportpatients->image_path}}"> @else <img src="{{ url('frontend') }}/images/no-image.jpg" alt=""> @endif     
    </div>
</div>

<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-primary')) !!}
      {!! link_to_route('admin.reportpatients.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-default')) !!}
    </div>
</div>

{!! Form::close() !!}

@endsection