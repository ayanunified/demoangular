
@extends('admin.layouts.master')

@section('content')
<?php
$behaviorlist='';
?>
<div class="detailsAli">
<div class="form-group clearfix">
    <div class="col-sm-12">
        <h1>View Details</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {!! implode('', $errors->all('<li class="error">:message</li>')) !!}
                </ul>
        	</div>
        @endif
    </div>
</div>

<div class="form-group clearfix">
	<div class="col-sm-2"><label>First Name : </label></div>
    <div class="col-sm-10">
        {{$patients->first_name}}
    </div>
</div>
<div class="form-group clearfix">
	<div class="col-sm-2"><label>Last Name : </label></div>
    <div class="col-sm-10">
         {{$patients->last_name}}
    </div>
</div>
<div class="form-group clearfix">
	<div class="col-sm-2"><label>Birth Date : </label></div>
    <div class="col-sm-10">
        <?php echo date('m-d-Y',strtotime($patients->dob));?>
    </div>
</div>
<div class="form-group clearfix">
	<div class="col-sm-2"><label>Gender : </label></div>
    <div class="col-sm-10">
        {{$patients->gender}}
    </div>
</div>
<div class="form-group clearfix">
	<div class="col-sm-2"><label>SSN : </label></div>
    <div class="col-sm-10">
        {{$patients->ssn}}
    </div>
</div>
<div class="form-group clearfix">
	<div class="col-sm-2"><label>Report Customer Id : </label></div>
    <div class="col-sm-10">
        <?php if(isset($customers->legalName))
        {
		  echo $customers->legalName;
        }
        ?>      
    </div>
</div>

<div class="form-group clearfix">
	<div class="col-sm-2"><label>Balance Amount : </label></div>
    <div class="col-sm-10">
    	{{$patientreports->balance_amount}} 
    </div>
</div>
<div class="form-group clearfix">
	<div class="col-sm-2"><label>Service Date : </label></div>
    <div class="col-sm-10">
        <?php echo date('m-d-Y',strtotime($patientreports->service_date));?>
    </div>
</div>
<div class="form-group clearfix">
	<div class="col-sm-2"><label>BehaviorList : </label></div>
    <div class="col-sm-10">
	 @foreach($behaviors as $behaviorreported)
    @foreach($behaviorlists as $key => $behaviorlist)
     @if($key==$behaviorreported->behaviorlists_id)
     <?php 
     $behavior=$behaviorlist.',';
     ?>
     @endif
    @endforeach
    @endforeach
    <?php 
    echo rtrim($behavior,',');
    ?>
    </div>
</div>
<div class="form-group clearfix">
	<div class="col-sm-2"><label>Short Note : </label></div>
    <div class="col-sm-10">
    	
    	{{$patientreports->note}}
    </div>
</div>
<div class="form-group clearfix">
	<div class="col-sm-2"><label>Report Date : </label></div>
    <div class="col-sm-10">
        <?php echo date('m-d-Y',strtotime($patientreports->report_date));?>
    </div>
</div>

<div class="form-group clearfix">
	<div class="col-sm-2"><label>Created TS : </label></div>
    <div class="col-sm-10">
        <?php echo date('m-d-Y H:i:s',strtotime($patients->created_at));?>
    </div>
</div>
<div class="form-group clearfix">
	<div class="col-sm-2"><label>Created By Customer ID : </label></div>
    <div class="col-sm-10">
    	{{$patients->customers_id}} 
    </div>
</div>
<div class="form-group clearfix">
    <div class="col-sm-12">
      {!! link_to_route('admin.patientreports.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-default')) !!}
    </div>
</div>
</div>
@endsection