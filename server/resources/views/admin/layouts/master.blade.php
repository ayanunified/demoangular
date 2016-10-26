@include('admin.partials.header')
@include('admin.partials.topbar')
<div class="clearfix"></div>
<div class="page-container">

    @include('admin.partials.sidebar')

    <div class="page-content-wrapper">
        <div class="page-content">

            <h3 class="page-title">
             @if (session('pageName'))
                {{ session('pageName') }}
             @else  
                Dashboard Management 
             @endif
            </h3>

            <div class="row">
                <div class="col-md-12">

                    @if (Session::has('message'))
                        <div class="note note-info">
                            <p>{{ Session::get('message') }}</p>
                        </div>
                    @endif

                    @yield('content')

                </div>
            </div>

        </div>
    </div>
</div>

<div class="scroll-to-top"
     style="display: none;">
    <i class="fa fa-arrow-up"></i>
</div>
@include('admin.partials.javascripts')

@yield('javascript')
@include('admin.partials.footer')


