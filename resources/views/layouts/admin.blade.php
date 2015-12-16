<!DOCTYPE html>
<html lang="en">

@include('admin.includes.head')

<body>
<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">

        @yield('topbar')

                <!-- /.navbar-top-links -->
        @yield('sidebar')

                <!-- /.navbar-static-side -->
    </nav>

    <!-- Page Content -->
    @yield('content')
            <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
@include('admin.includes.foot')

</body>

</html>
