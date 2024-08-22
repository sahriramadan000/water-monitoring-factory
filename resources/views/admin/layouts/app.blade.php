<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Water Monitoring Factory</title>
    <link rel="icon" type="image/x-icon" href=""/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('admin.layouts.partials.head')

</head>
<body>
    <!--  BEGIN NAVBAR  -->
    @include('admin.layouts.partials.navbar')
    <!--  END NAVBAR  -->

    <!--  BEGIN CONTENT  -->
    <main class="container-fluid mt-4">
        @yield('content')
    </main>

    @include('admin.layouts.partials.footer')

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    @include('admin.layouts.partials.foot')
    <!-- END GLOBAL MANDATORY SCRIPTS -->
</body>
</html>
