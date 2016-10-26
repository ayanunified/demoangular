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

{!! Form::model($sliderimages, array('files' => true, 'class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array('admin.sliderimages.update', $sliderimages->id))) !!}

<div class="form-group">
    {!! Form::label('img_title', 'Image Title*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('img_title', old('img_title',$sliderimages->img_title), array('class'=>'form-control')) !!}
        
    </div>
    
</div>
    <div class="form-group">
    {!! Form::label('img_desc', 'Image Description', array('class'=>'col-sm-2 control-label')) !!}
        <div class="col-sm-10">
        {!! Form::text('img_desc', old('img_desc',$sliderimages->img_desc), array('class'=>'form-control')) !!}
        
        </div>
    </div>    

<div class="form-group">
    {!! Form::label('img_path', 'Image', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::file('img_path') !!}
        {!! Form::hidden('img_path_w', 4096) !!}
        {!! Form::hidden('img_path_h', 4096) !!}
        <div class="col-sm-10">
            @if($sliderimages->img_path) <img src="{{ url('uploads') }}/thumb/{{ $sliderimages->img_path }}"> @else <img src="{{ url('frontend') }}/images/no-image.jpg" alt=""> @endif     
        </div>
    </div>
</div>
   
<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-primary')) !!}
      {!! link_to_route('admin.sliderimages.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-default')) !!}
    </div>
</div>

{!! Form::close() !!}

@endsection