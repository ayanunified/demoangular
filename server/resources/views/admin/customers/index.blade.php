@extends('admin.layouts.master')

@section('content')

<p>{!! link_to_route('admin.customers.create', trans('quickadmin::templates.templates-view_index-add_new') , null, array('class' => 'btn btn-success')) !!}</p>
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

@if ($customers->count())
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
<th>Business Name</th>
<th>Business Type</th>
<th>Suite</th>
<th>City</th>
<th>State</th>
<th>Office Phone</th>
<th>Email</th>
<th>Website</th>
<th>Number Of Doctors</th>
<th>Contact Person First Name</th>
<th>Contact Person Last Name</th>

<th>Login Id</th>
<th>Customer Status</th>
<th>StatusExpireDate</th>
<th>Membership Type</th>
<th>Sales Person Id</th>

<th>ReferChannel</th>

                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($customers as $row)
                        <tr>
                            <td>
                                {!! Form::checkbox('del-'.$row->id,1,false,['class' => 'single','data-id'=> $row->id]) !!}
                            </td>
<td>{{ $row->businessName }}</td>
<td>{{ isset($row->businesses->name) ? $row->businesses->name : '' }}</td>
<td>{{ $row->suite }}</td>
<td>{{ $row->city }}</td>
<td>{{ $row->state }}</td>
<td>{{ $row->office_phone }}</td>
<td>{{ $row->email }}</td>
<td>{{ $row->website }}</td>
<td>{{ $row->noOfDoc }}</td>
<td>{{ $row->first_name }}</td>
<td>{{ $row->last_name }}</td>

<td>{{ $row->username }}</td>
<td>{{ $row->status }}</td>
<td><?php echo date('m-d-Y',strtotime($row->expiry_date));?></td>
<td>{{ isset($row->memberships->type_name) ? $row->memberships->type_name : '' }}</td>
<td>{{ $row->sales_person_id }}</td>

<td>{{ $row->refer_chanel }}</td>

                            <td>
                                {!! link_to_route('admin.customers.edit', trans('quickadmin::templates.templates-view_index-edit'), array($row->id), array('class' => 'btn btn-xs btn-info')) !!}
                                {!! Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'onsubmit' => "return confirm('".trans("quickadmin::templates.templates-view_index-are_you_sure")."');",  'route' => array('admin.customers.destroy', $row->id))) !!}
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
            {!! Form::open(['route' => 'admin.customers.massDelete', 'method' => 'post', 'id' => 'massDelete']) !!}
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
