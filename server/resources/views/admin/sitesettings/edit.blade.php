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

{!! Form::model($sitesettings, array('files' => true, 'class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array('admin.sitesettings.update', $sitesettings->id))) !!}

<!--div class="form-group">
    {!! Form::label('logo', 'Site Logo', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
	@if($sitesettings->logo != '')<img src="{{ asset('uploads/thumb') . '/'.  $sitesettings->logo }}">@endif
        {!! Form::file('logo') !!}
        {!! Form::hidden('logo_w', 4096) !!}
        {!! Form::hidden('logo_h', 4096) !!}
        
    </div>
</div--><div class="form-group">
    {!! Form::label('contact_mail', 'Contact Email*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::email('contact_mail', old('contact_mail',$sitesettings->contact_mail), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('admin_email', 'Admin Email*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::email('admin_email', old('admin_email',$sitesettings->admin_email), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('contact_address', 'Contact Address*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::textarea('contact_address', old('contact_address',$sitesettings->contact_address), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('contact_no', 'Contact Number', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('contact_no', old('contact_no',$sitesettings->contact_no), array('class'=>'form-control')) !!}
        
    </div>
</div>
<div class="form-group">
    {!! Form::label('search_null_msg', 'Search Null Message', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::textarea('search_null_msg', old('search_null_msg',$sitesettings->search_null_msg), array('class'=>'form-control')) !!}
        
    </div>
</div>
<div class="form-group">
    {!! Form::label('membership_pdf_link', 'Membership Agreement Link', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::file('membership_pdf_link') !!}
        
    </div>
</div>

<div class="form-group">
    {!! Form::label('footer_disclaimer', 'Footer Disclaimer', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::textarea('footer_disclaimer', old('footer_disclaimer',$sitesettings->footer_disclaimer), array('class'=>'form-control')) !!}
        
    </div>
</div>
<div class="form-group">
    {!! Form::label('email_subscribe', 'Email Subscribe Text', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::textarea('email_subscribe', old('email_subscribe',$sitesettings->email_subscribe), array('class'=>'form-control')) !!}
        
    </div>
</div>

<div class="form-group">
    {!! Form::label('faq_header', 'Faq Page Header', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::textarea('faq_header', old('faq_header',$sitesettings->faq_header), array('class'=>'form-control')) !!}
        
    </div>
</div>

<div class="form-group">
    {!! Form::label('service_header', 'Service Page Header', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::textarea('service_header', old('service_header',$sitesettings->service_header), array('class'=>'form-control')) !!}
        
    </div>
</div>

<div class="form-group">
    {!! Form::label('testimonial_header', 'Testimonial Page Header', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::textarea('testimonial_header', old('testimonial_header',$sitesettings->testimonial_header), array('class'=>'form-control')) !!}
        
    </div>
</div>
<div class="form-group">
    {!! Form::label('get_in_touch', 'Get In Touch', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::textarea('get_in_touch', old('get_in_touch',$sitesettings->get_in_touch), array('class'=>'form-control')) !!}
        
    </div>
</div>
<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-primary')) !!}
      {!! link_to_route('admin.sitesettings.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-default')) !!}
    </div>
</div>


{!! Form::close() !!}

@endsection
