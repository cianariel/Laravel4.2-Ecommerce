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
                    <span>Giveaway List</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-header">Giveaway List</h4>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase"> Giveaway List</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="btn-group">
                                        <a href="/admin/giveaway-add" class="btn sbold green"> Add New
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="giveaway">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" class="group-checkable" data-set="#giveaway .checkboxes" /> </th>
                                    <th> Giveaway Title </th>
                                    <th> Actions </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($giveaways as $giveaway)
                                <tr>
                                    <td><input type="checkbox" class="checkboxes" value="1" /> </td>
                                    <td>{{$giveaway->giveaway_image_title }}</td>
                                    <td><a href="/admin/giveaway-edit/{{$giveaway->id}}" class="btn btn-sm btn-default blue btn-editable"><i class="fa fa-pencil"></i> Edit</a>
                                    @if($giveaway->giveaway_status!=1)
                                    <button class="btn btn-sm btn-danger btn-editable btn_delete_giveaway" data-giveawayid="{{$giveaway->id}}" id="btn_delete_giveaway" data-dismiss="modal"><i class="fa fa-close"></i> Delete</button></td>
                                    @endif
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

<script>
$(function() {
    $('.btn_delete_giveaway').click(function(){
        var post={};
         post.GiveawayId = $(this).data("giveawayid");
        $.ajax({
            type : 'POST',
            url : '/api/giveaway/delete-giveaway',
            data : post,
            success : function(x) { alert('Giveaway Deleted'); },
            error : function(r) { alert('errror'); }
        });
    });
});

</script>
<script src="/assets/admin/vendor/global/scripts/datatable.js" type="text/javascript"></script>
<script src="/assets/admin/vendor/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="/assets/admin/vendor/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="/assets/admin/vendor/pages/scripts/table-datatables-managed.js" type="text/javascript"></script>
@stop
