@extends('admin.layouts.master')

@section('content')


@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

@if ($paymentreport->count())
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
                        <th>Customer</th>
<th>Transaction Id</th>
<th>Paid Amount</th>
<th>Pack Taken</th>
<th>Valid Till</th>
<th>Purchased On</th>

                        
                    </tr>
                </thead>

                <tbody>
                    @foreach ($paymentreport as $row)
                        <tr>
                            <td>
                                {!! Form::checkbox('del-'.$row->id,1,false,['class' => 'single','data-id'=> $row->id]) !!}
                            </td>
                            <td>{{ isset($row->customers->legalName) ? $row->customers->legalName : '' }}</td>
<td>{{ $row->transaction_id }}</td>
<td>{{ $row->amount_paid }}</td>
<td>{{ $row->memberships->type_name }}</td>
<td>{{ $row->valid_till }}</td>
<td>{{ $row->created_at }}</td>


                            
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