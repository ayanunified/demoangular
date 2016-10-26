@include('admin.partials.header')
<div class="psn-login-box">
	<div class="box-inner">
    	<div class="panel">
                <div class="panel-heading">{{ trans('quickadmin::auth.login-login') }}</div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>{{ trans('quickadmin::auth.whoops') }}</strong> {{ trans('quickadmin::auth.some_problems_with_input') }}
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('admin/login') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-3 control-label">{{ trans('quickadmin::auth.login-email') }}</label>

                            <div class="col-md-8">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">{{ trans('quickadmin::auth.login-password') }}</label>

                            <div class="col-md-8">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-3">
                            	<div class="custom-checkbox">
                                	<input type="checkbox" name="remember" id="rem-me">
                                	<label for="rem-me">{{ trans('quickadmin::auth.login-remember_me') }}</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-3">
                                <button type="submit" class="btn btn-default" style="margin-right: 10px;">
                                    {{ trans('quickadmin::auth.login-btnlogin') }}
                                </button>
								<a class="btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</div>
@include('admin.partials.footer')
