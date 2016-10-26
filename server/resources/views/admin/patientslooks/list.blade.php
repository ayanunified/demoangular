@extends('admin.layouts.master')

@section('content')
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
{!! Form::open(array('route' => 'admin.patientslooks.list', 'class' => 'form-horizontal')) !!}
<div class="row" style="margin-bottom:20px;">
    <div class="col-sm-3">
        <lable>Customer</lable>
        <select name="customer_search_id" class="form-control">
            @foreach($customers as $key=>$customer)
            <option value="{{$key}}" @if($key==$reqarray['customer_search_id']) selected @endif>{{$customer}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-sm-3">
        <lable>From Date</lable>
        <input type="text" name="from_date" class="form-control datepicker" value="{{$reqarray['from_date']}}">
    </div>
    <div class="col-sm-3">
        <lable>To Date</lable>
        <input type="text" name="to_date" class="form-control datepicker" value="{{$reqarray['to_date']}}">
    </div>
    <div class="col-sm-3">
        {!! Form::submit( 'Search' , array('class' => 'btn btn-primary topadj18')) !!}
    </div>
</div>    
{!! Form::close() !!}
@if ($patientslooks->count())
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">{{ trans('quickadmin::templates.templates-view_index-list') }}</div>
        </div>
        <div class="portlet-body">
            <table class="table table-striped table-hover table-responsive datatable">
                <thead>
                    <tr>
                        <th>
                            {!! Form::checkbox('delete_all',1,false,['class' => 'mass']) !!}
                        </th>
                        <th>First Name</th>
<th>Last Name</th>
<th>Birth Date</th>
<th>SSN</th>
<th>Gender</th>
<th>Customer</th>
<th>Search Time</th>

                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($patientslooks as $row)
                        <tr>
                            <td>
                                {!! Form::checkbox('del-'.$row->id,1,false,['class' => 'single','data-id'=> $row->id]) !!}
                            </td>
                            <td>{{ $row->first_name }}</td>
<td>{{ $row->last_name }}</td>
<td><?php echo date('m-d-Y',strtotime($row->dob));?></td>
<td>{{ $row->ssn }}</td>
<td>{{ $row->gender }}</td>
<td>{{ isset($row->customers->legalName) ? $row->customers->legalName : '' }}</td>
<td><?php echo date('m-d-Y H:i:s',strtotime($row->created_at));?></td>


                            <td>
                                {!! link_to_route('admin.patientslooks.view', trans('quickadmin::templates.templates-view_index-view'), array($row->found_match), array('class' => 'btn btn-xs btn-info')) !!}
                                {!! Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'onsubmit' => "return confirm('".trans("quickadmin::templates.templates-view_index-are_you_sure")."');",  'route' => array('admin.patientslooks.destroy', $row->id))) !!}
                                {!! Form::submit(trans('quickadmin::templates.templates-view_index-delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-xs-12">
                    <button class="btn btn-danger" id="delete">
                        {{ trans('quickadmin::templates.templates-view_index-delete_checked') }}
                    </button>
                </div>
            </div>
            {!! Form::open(['route' => 'admin.patientslooks.massDelete', 'method' => 'post', 'id' => 'massDelete']) !!}
                <input type="hidden" id="send" name="toDelete">
            {!! Form::close() !!}
        </div>
	</div>
@else
    {{ trans('quickadmin::templates.templates-view_index-no_entries_found') }}
@endif

@endsection

@section('javascript')
    <script>
        $(document).ready(function () {
            $('#delete').click(function () {
                if (window.confirm('{{ trans('quickadmin::templates.templates-view_index-are_you_sure') }}')) {
                    var send = $('#send');
                    var mass = $('.mass').is(":checked");
                    
                        var toDelete = [];
                        $('.single').each(function () {
                            if ($(this).is(":checked")) {
                                toDelete.push($(this).data('id'));
                            }
                        });
                        send.val(JSON.stringify(toDelete));
                        if($('#send').val().length==2)
                        {
                            alert('Please Select Something To Delete.');
                        }
                        else
                        {    
                            $('#massDelete').submit();
                        }
                }
            });
        });
    </script>
@stop
