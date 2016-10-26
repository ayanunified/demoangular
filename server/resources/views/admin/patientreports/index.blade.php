@extends('admin.layouts.master')

@section('content')

<p>{!! link_to_route('admin.patientreports.create', trans('quickadmin::templates.templates-view_index-add_new') , null, array('class' => 'btn btn-success')) !!}</p>
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

@if ($patientreports->count())
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">{{ trans('quickadmin::templates.templates-view_index-list') }}</div>
        </div>
        <div class="portlet-body">
            <table class="table table-striped table-hover table-responsive datatable" >
                <thead>
                    <tr>
                        <th>
                            {!! Form::checkbox('delete_all',1,false,['class' => 'mass']) !!}
                        </th>
                        <th>Patient SSN</th>
                        <th>Patient DOB</th>
<th>Customer Reported</th>
<th>Balance Amount</th>
<th>Service Date</th>
<th>Behavior</th>
<th>Report Date</th>

                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($patientreports as $row)
                        <tr>
                            <td>
                                {!! Form::checkbox('del-'.$row->id,1,false,['class' => 'single','data-id'=> $row->id]) !!}
                            </td>
                            <td>{{ isset($row->patients->ssn) ? $row->patients->ssn : '' }}</td>
                             <td>{{ isset($row->patients->dob) ? $row->patients->dob : '' }}</td>
<td>{{ isset($row->customers->legalName) ? $row->customers->legalName : '' }}</td>
<td>{{ $row->balance_amount }}</td>
<td><?php echo date('m-d-Y',strtotime($row->service_date));?></td>
<td> @if(isset($row->behaviorreported))
    @foreach($row->behaviorreported as $behaviorreported)
    @foreach($behaviorlists as $key => $behaviorlist)
     @if($key==$behaviorreported->behaviorlists_id)
     {{$behaviorlist}},
     @endif
    @endforeach
    @endforeach
 @endif</td>
<td><?php echo date('m-d-Y',strtotime($row->report_date));?></td>

                            <td>
                                {!! link_to_route('admin.patientreports.view', trans('quickadmin::templates.templates-view_index-view'), array($row->id), array('class' => 'btn btn-xs btn-info')) !!}
                                {!! link_to_route('admin.patientreports.edit', trans('quickadmin::templates.templates-view_index-edit'), array($row->id), array('class' => 'btn btn-xs btn-info')) !!}
                                {!! Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'onsubmit' => "return confirm('".trans("quickadmin::templates.templates-view_index-are_you_sure")."');",  'route' => array('admin.patientreports.destroy', $row->id))) !!}
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
            {!! Form::open(['route' => 'admin.patientreports.massDelete', 'method' => 'post', 'id' => 'massDelete']) !!}
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