<!DOCTYPE html>
<html dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
@include('layouts.dashboard.head')
<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">

  @include('layouts.dashboard.navbar')

    @include('layouts.dashboard._aside')
<div class="content-wrapper">

   @yield('content-header')

    <section class="content">
        @yield('content')
    </section>
</div>


    @include('partials._session')

    @include('layouts.dashboard.footer')

</div><!-- end of wrapper -->

@include('layouts.dashboard.footer_scripts')
</body>
</html>
