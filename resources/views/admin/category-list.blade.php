@extends('layouts.admin')

@section('content')

        <!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">

    @include('admin.includes.topbar')

            <!-- /.navbar-top-links -->
    @include('admin.includes.sidebar')

            <!-- /.navbar-static-side -->
</nav>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Category List</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@stop


