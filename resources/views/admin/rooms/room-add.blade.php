@extends('layouts.admin')

@section('content')

<link href="/assets/admin/vendor/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
<link href="/assets/admin/vendor/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css" />
<link href="/assets/admin/vendor/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css" />
<link href="/assets/admin/vendor/global/plugins/typeahead/typeahead.css" rel="stylesheet" type="text/css" />
<link href="/assets/admin/vendor/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/admin/vendor/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />

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
                @if( !empty($id))
                    <div ng-init="loadProductData({{$id}})"></div>
                @endif
                <div ng-init="loadAddProduct()">
                    <form role="form" name="myForm" enctype="multipart/form-data" class="form-horizontal form-row-seperated">
                        <div class="portlet">
                            <div class="portlet-title">

                                <div class="caption">
                                    <i class="fa fa-shopping-cart"></i>Add Room </div>
                                <div class="actions btn-set">
                                    
                                    <button data-ng-click="updateProduct()" class="btn btn-success">
                                        <i class="fa fa-check"></i> Save</button>
                                    <button ng-hide="Permalink == ''"
                                        data-ng-click="previewProduct(Permalink)" class="btn btn-success">
                                        <i class="fa fa-eye"></i> Preview</button>
                                    <button ng-hide="PostStatus == 'Active'"
                                            data-ng-click="changeProductActivation()"
                                            class="btn btn-info" type="button">
                                        <i class="fa fa-check-circle"></i> Active</button>
                                    <button ng-hide="PostStatus == 'Inactive'"
                                                        data-ng-click="changeProductActivation()"
                                                        class="btn btn-warning" type="button">
                                        <i class="fa fa-angle-left"></i> Inactive</button>
                                    <button ng-hide="ProductId == ''"
                                                        data-ng-click="deleteProduct(ProductId,true)"
                                                        confirm="Are you sure to delete this product ?"
                                                        confirm-settings="{size: 'sm'}"
                                                        class="btn btn-danger" type="button">
                                        <i class="fa fa-times"></i> Delete</button>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="form-group last">
                                    <label class="control-label col-md-3">Image Upload #2</label>
                                    <div class="col-md-9">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                            <div>
                                                <span class="btn default btn-file">
                                                    <span class="fileinput-new"> Select image </span>
                                                    <span class="fileinput-exists"> Change </span>
                                                    <input type="file" name=""> </span>
                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div id="tag-hero">
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

<div id="responsive" class="modal fade" tabindex="-1"  data-width="760">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Tag Product</h4>
    </div>
    <div class="modal-body">
        <form action="#" class="form-horizontal form-row-seperated">
            <div class="form-group form">
                <label class="col-sm-4 control-label">Select Product</label>
                <div class="col-sm-8">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-cogs"></i>
                        </span>
                        <input type="text" id="product" name="product" class="form-control" /> </div>
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
        <button type="button" data-dismiss="modal" class="btn btn-outline dark">Cancel</button>
        <button type="button" data-dismiss="modal" class="btn green">Save</button>
    </div>
</div>
@stop
@section('pagelevelscript')
<script src="/assets/admin/vendor/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<script src="/assets/admin/vendor/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
<script src="/assets/admin/vendor/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
<script src="/assets/admin/vendor/pages/scripts/ui-extended-modals.min.js" type="text/javascript"></script>
<script src="/assets/admin/vendor/global/plugins/typeahead/handlebars.min.js" type="text/javascript"></script>
<script src="/assets/admin/vendor/global/plugins/typeahead/typeahead.bundle.min.js" type="text/javascript"></script>
<script src="/assets/admin/vendor/pages/scripts/components-typeahead.js" type="text/javascript"></script>
<script src="/assets/admin/vendor/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>

<script>
$(function() {
    $('#tag-hero img').click(function(e){
        var parentOffset = $(this).parent().offset(); 
        var relX = e.pageX - parentOffset.left;
        var relY = e.pageY - parentOffset.top;
        $('#Xpos').val(relX);
        $('#Ypos').val(relY);
        $('#responsive').modal();
    });
});

</script>
@stop