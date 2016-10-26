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

{!! Form::model($packageimages, array('files' => true, 'class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array('admin.packageimages.update', $packageimages->id))) !!}

<div class="form-group">
    {!! Form::label('position', 'Banner Position', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {{$packageimages->position}}
        
    </div>
</div><div class="form-group">
    {!! Form::label('image_path', 'Banner Image', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::file('image_path') !!}
        {!! Form::hidden('image_path_w', 980) !!}
        {!! Form::hidden('image_path_h', 120) !!}
                <h4>(Recommended File Sizes: <br/>
        Homepage: 980*120px <br/>
Patient: 
Top - 980*120px <br/>
Left - 240*400px) <br/> </h4>
    </div>
    <div class="col-sm-10">
            @if($packageimages->image_path) <img src="{{ url('uploads') }}/thumb/{{$packageimages->image_path}}"> @else <img src="{{ url('frontend') }}/images/no-image.jpg" alt=""> @endif     
    </div>
</div>

<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-primary')) !!}
      {!! link_to_route('admin.packageimages.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-default')) !!}
    </div>
</div>

{!! Form::close() !!}

@endsection