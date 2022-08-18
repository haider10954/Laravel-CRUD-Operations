<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">


<head>

    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    @include('includes.style')
</head>

<body>

    <div id="layout-wrapper">

        @include('includes.header')

        @include('includes.sidebar')
        
        @yield('content')

        @include('includes.footer')
    </div>

@include('includes.script')
</body>


<!-- Mirrored from themesbrand.com/velzon/html/default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 18 Jul 2022 09:57:25 GMT -->
</html>