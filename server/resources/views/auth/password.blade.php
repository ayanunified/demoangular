@include('admin.partials.header')

<div class="psn-login-box">
	<div class="box-inner">
    	<div class="panel">
                <div class="panel-heading">{{ trans('quickadmin::auth.password-reset_password') }}</div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>{{ trans('quickadmin::auth.whoops') }}</strong> {{ trans('quickadmin::auth.some_problems_with_input') }}
                            <br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

						<form class="form-horizontal" role="form"  method="POST" action="{{ url('password/email') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-3 control-label">{{ trans('quickadmin::auth.password-email') }}</label>

                            <div class="col-md-8">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-3">
                                <button type="submit" class="btn btn-default" style="margin-right: 10px;">
                                    {{ trans('quickadmin::auth.password-btnsend_password') }}
                                </button>
                                <button type="submit" class="btn btn-default" style="margin-right: 10px;">
                                    {{ trans('quickadmin::auth.login-btnlogin') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</div>



@include('admin.partials.footer')
