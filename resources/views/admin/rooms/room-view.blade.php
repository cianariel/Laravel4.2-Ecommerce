@extends('layouts.admin')

@section('content')
<link href="/assets/admin/vendor/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/admin/vendor/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />


<div class="page-content-wrapper">


    <div class="page-content">
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="index.html">Admin</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Room List</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-header">Room List</h4>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase"> Room List</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="btn-group">
                                        <a href="/admin/room-add" class="btn sbold green"> Add New
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /> </th>
                                    <th> Room Title </th>
                                    <th> Room Permalink </th>
                                    <th> Actions </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Rooms as $room)
                                <tr>
                                    <td><input type="checkbox" class="checkboxes" value="1" /> </td>
                                    <td>{{$room->room_name }}</td>
                                    <td>{{$room->room_permalink}} </td>
                                    <td><a href="/admin/room-edit/{{$room->id}}" class="btn btn-sm btn-default blue btn-circle btn-editable"><i class="fa fa-pencil"></i> Edit</a>
                                    <a href="/admin/room-delete/{{$room->id}}" class="btn btn-sm btn-danger btn-circle btn-editable"><i class="fa fa-close"></i> Delete</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>                
            <!-- /.row -->
        </div>    
    </div>
</div>
@stop
@section('pagelevelscript')
<script src="/assets/admin/vendor/global/scripts/datatable.js" type="text/javascript"></script>
<script src="/assets/admin/vendor/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="/assets/admin/vendor/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="/assets/admin/vendor/pages/scripts/table-datatables-managed.js" type="text/javascript"></script>
<script>
$(function() {
   
});

</script>
@stop
