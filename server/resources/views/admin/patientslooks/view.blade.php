<?php $count = count($data);?>
@extends('admin.layouts.master')

@section('content')
@if ($count>0)
<div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">Report Generated :- TOTAL BALANCE:-{{ $data['totalDue'] }} , REPORTED BEHAVIOR:-{{ $data['totalBehaviorReport'] }} ,NUMBER OF CLINIC REPORTED:-{{ $data['reportCount'] }} </div>
        </div>
        <div class="portlet-body">
            <table class="table table-striped table-hover table-responsive datatable" id="datatable">
                <thead>
                    <tr>
                        
                        <th>NAME</th>
                        <th>SSN</th>
<th>DUE AMOUNT</th>
<th>SERVICE DATE</th>
<th>BEHAVIOR</th>

                    </tr>
                </thead>

                <tbody>
                    @foreach ($data['data'] as $row)
                        <tr>
                           
                            <td>{{ $row['name'] }}</td>
                            <td>{{ $row['ssn'] }}</td>
                             <td>{{ $row['balance_amount'] }}</td>
                             <td><?php echo date('m-d-Y',strtotime($row['service_date']));?></td>
                               <td>{{ $row['behavior'] }}</td>



                           
                        </tr>
                    @endforeach
                </tbody>
            </table>
           
        </div>
	</div>
@else
    {{ trans('quickadmin::templates.templates-view_index-no_entries_found') }}
@endif

@endsection