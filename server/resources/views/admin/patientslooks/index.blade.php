@extends('admin.layouts.master')

@section('content')
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
{!! Form::open(array('route' => 'admin.patientslooks.list', 'class' => 'form-horizontal')) !!}
<div class="row patients_looks">
    <div class="col-sm-3">
        <lable>Customer</lable>
        <select name="customer_search_id" class="form-control">
            @foreach($customers as $key=>$customer)
            <option value="{{$key}}">{{$customer}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-sm-3">
        <lable>From Date</lable>
        <input type="text" name="from_date" class="form-control datepicker">
    </div>
    <div class="col-sm-3">
        <lable>To Date</lable>
        <input type="text" name="to_date" class="form-control datepicker">
    </div>
    <div class="col-sm-3">
        {!! Form::submit( 'Search' , array('class' => 'btn btn-primary topadj18')) !!}
    </div>
</div>    
{!! Form::close() !!}

@endsection
