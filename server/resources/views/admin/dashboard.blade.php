@extends('admin.layouts.master')
@section('content')
	<div class="welcome-dashboard">
    	<h4 class="dash-heading">{{ trans('quickadmin::admin.dashboard-title') }}</h4>
        <div class="row">
            <div class="col-sm-3">
            	<div class="dash-block">
                	<h5>Customer Count</h5>
                    <span>{{$customersCount}}</span>
                </div>
                
            </div>
            <div class="col-sm-3">
            	<div class="dash-block">
                    <h5>Reports Count</h5>
                    <span>{{$patientsCount}}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
