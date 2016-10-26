@extends('admin.layouts.master')

@section('content')

    <p>{!! link_to_route('users.create', trans('quickadmin::admin.users-index-add_new'), [], ['class' => 'btn btn-success']) !!}</p>
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

    @if($users->count() > 0)
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">{{ trans('quickadmin::admin.users-index-users_list') }}</div>
            </div>
            <div class="portlet-body">
                <table id="datatable" class="table table-striped table-hover table-responsive datatable">
                    <thead>
                    <tr>
                        <th>
                            {!! Form::checkbox('delete_all',1,false,['class' => 'mass']) !!}
                        </th>
                        <th>{{ trans('quickadmin::admin.users-index-name') }}</th>
                        <th>Email</th>
                        <th>Status</th>     
                        <th>&nbsp;</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>
                                {!! Form::checkbox('del-'.$user->id,1,false,['class' => 'single','data-id'=> $user->id,'data-image'=> $user->image]) !!}
                            </td>
                            <td>
                           @if($user->image) <img src="{{ url('uploads') }}/profile/thumb/{{ $user->image }}"> @else <img src="{{ url('frontend') }}/images/no-image.jpg" alt=""> @endif
                            <p>{{ $user->name }}</p></td>
                            <td>{{ $user->email }}</td>
                            <td>@if($user->status==1) {{ 'Active' }} @else {{ 'Inactive' }} @endif</td>     
                            <td>
                                {!! link_to_route('users.edit', trans('quickadmin::admin.users-index-edit'), [$user->id], ['class' => 'btn btn-xs btn-info']) !!}
                                {!! Form::open(['style' => 'display: inline-block;', 'method' => 'DELETE', 'onsubmit' => 'return confirm(\'' . trans('quickadmin::admin.users-index-are_you_sure') . '\');',  'route' => array('users.destroy', $user->id)]) !!}
                                {!! Form::submit(trans('quickadmin::admin.users-index-delete'), array('class' => 'btn btn-xs btn-danger')) !!}
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
            {!! Form::open(['route' => 'users.massDelete', 'method' => 'post', 'id' => 'massDelete']) !!}
                <input type="hidden" id="send" name="toDelete">
                <input type="hidden" id="delete_image" name="delete_image">
            {!! Form::close() !!}    
            </div>
        </div>

    @else
        {{ trans('quickadmin::admin.users-index-no_entries_found') }}
    @endif

@endsection
@section('javascript')
    <script>
        $(document).ready(function () {
            $('#delete').click(function () {
                if (window.confirm('{{ trans('quickadmin::templates.templates-view_index-are_you_sure') }}')) {
                    var send = $('#send');
                    var delete_image = $('#delete_image');
                    var mass = $('.mass').is(":checked");
                    var toDelete = [];
                    var toDeleteImage = [];
                    //if (mass == true) {
                    //    send.val('mass');
                    //    $('.single').each(function () {
                    //        if ($(this).is(":checked")) {
                    //            toDeleteImage.push($(this).data('image'));
                    //        }
                    //    });
                    //    delete_image.val(JSON.stringify(toDeleteImage));
                    //} else {
                        
                        $('.single').each(function () {
                            if ($(this).is(":checked")) {
                                toDelete.push($(this).data('id'));
                                toDeleteImage.push($(this).data('image'));
                            }
                        });
                        send.val(JSON.stringify(toDelete));
                        delete_image.val(JSON.stringify(toDeleteImage));
                    }
                    $('#massDelete').submit();
               // }
            });
        });
    </script>
@stop
