@extends('layouts.admin')
@section('pagelevelstyle')
<link href="/assets/admin/vendor/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
<link href="/assets/admin/vendor/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/admin/vendor/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
@stop
@section('content')


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
                    <span>Nice</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <div ng-app="adminApp" data-ng-controller="AdminController" class="row" nv-file-drop="" uploader="uploader"
             filters="queueLimit, customFilter">

            <div class="col-md-12" ng-cloak>
                <div>
                    <form role="form" name="myForm" enctype="multipart/form-data" class="form-horizontal form-row-seperated">
                        <div class="portlet">
                            <div class="portlet-title">

                                <div class="caption">
                                    <i class="fa fa-shopping-cart"></i>Add Room </div>
                                <div class="actions btn-set">
                                    
                                    <button  class="btn btn-success">
                                        <i class="fa fa-check"></i> Save</button>
                                    <button class="btn btn-success">
                                        <i class="fa fa-eye"></i> Preview</button>
                                    <button class="btn btn-info" type="button">
                                        <i class="fa fa-check-circle"></i> Active</button>
                                    <button class="btn btn-warning" type="button">
                                        <i class="fa fa-angle-left"></i> Inactive</button>
                                    <button class="btn btn-danger" type="button">
                                        <i class="fa fa-times"></i> Delete</button>
                                </div>
                            </div>
                            <div class="portlet-body"  id="tag-hero">
                                <div class="form-group last">
                                    <div class="col-md-12">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 100%;">
                                                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="width: 100%;"> </div>
                                            <div>
                                                <span class="btn default btn-file">
                                                    <span class="fileinput-new"> Select image </span>
                                                    <span class="fileinput-exists"> Change </span>
                                                    <input type="file" id="hero-image1" name="hero-image1"> </span>
                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div>
                                            <img src="/assets/images/room-landing-hero.jpg" width="100%" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.col-lg-12 --                </div>
>
        </div>
        <!-- /.row -->
        </div>
    </div>
</div>

<div id="select_product_modal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Select Product</h4>
            </div>
            <div class="modal-body">
                <form action="#" class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-md-4">Product</label>
                        <div class="col-md-8">
                            <select id="select_product" class="form-control select2 js-data-example-ajax select2-allow-clear">
                            </select>
                        </div>
                    </div>
                    <div class="form-group form">
                        <label class="col-sm-4 control-label">X Position</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" id="Xpos" name="Xpos" class="form-control" /> </div>
                        </div>
                    </div>
                    <div class="form-group form">
                        <label class="col-sm-4 control-label">Y Position</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" id="Ypos" name="Ypos" class="form-control" /> </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">Close</button>
                <button class="btn green" data-dismiss="modal">Save changes</button>
            </div>
        </div>
    </div>
</div>

@stop
@section('pagelevelscript')
<script src="/assets/admin/vendor/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<script src="/assets/admin/vendor/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="/assets/admin/vendor/pages/scripts/components-select2.js" type="text/javascript"></script>

<script>
$(function() {
    $(".fileinput-preview").change(function(e) {
        $('#tag-hero img').click(onheroclick);
        return false;
    });
    $('#tag-hero img').click(onheroclick);
    function onheroclick(e){
        var parentOffset = $(this).parent().offset(); 
        var relX = e.pageX - parentOffset.left;
        var relY = e.pageY - parentOffset.top;
        $('#Xpos').val(relX);
        $('#Ypos').val(relY);
        $('#select_product_modal').modal();
    }
});

</script>
@stop