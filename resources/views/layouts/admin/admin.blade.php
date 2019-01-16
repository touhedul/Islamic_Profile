<!DOCTYPE html>
<html>
<head>
    @include('layouts.admin.link')
    <title>@yield('title')</title>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    @include('layouts.admin.navbar')
    @include('layouts.admin.sidebar')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container">
                @yield('content')
            </div>
        </section>

    </div>
</div>
@include('layouts.admin.script')


@yield('script')
</body>
</html>