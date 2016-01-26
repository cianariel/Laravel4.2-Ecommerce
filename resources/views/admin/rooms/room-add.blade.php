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
                    <a href="/admin/dashboard">Admin</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Rooms</span>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                @if($room->id)
                    <span>Edit Room</span>
                    @else
                    <span>Add Room</span>
                    @endif
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <h5 > &nbsp;
        </h5>
        <div class="row">
            <div class="col-md-12">
                <div>
                @if($room->id)
                    <form role="form" name="add-room" enctype="multipart/form-data" method="post" action="/api/room/update-room"  class="form-horizontal form-row-seperated">
                    <input type="hidden" name="room_id" id="room_id" value="{{$room->id}}">
                    @else
                    <form role="form" name="add-room" enctype="multipart/form-data" method="post" action="/api/room/add-room"  class="form-horizontal form-row-seperated">
                    @endif
                        <div class="portlet light bordered">
                            <div class="portlet-title">

                                <div class="caption">
                                    <i class="fa fa-shopping-cart"></i>
                                    @if($room->id)
                                    Edit Room
                                    @else
                                    Add Room
                                    @endif</div>
                                <div class="actions btn-set">
                                    
                                    <button  class="btn btn-success">
                                        <i class="fa fa-check"></i> Save</button>
                                </div>
                            </div>
                            <div class="portlet-body form"  id="tag-hero">
                                <h3 class="form-section">Room Info</h3>
                                <div class="row">
                                    <div class="col-lg-9">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Room Title:</label>
                                            <div class="col-md-6">
                                                <input name="room_name" class="form-control"
                                                               placeholder="Enter Room Title" value="{{$room->room_name}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-9">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Room Permalink:</label>
                                            <div class="col-md-6">
                                                <input name="room_permalink" class="form-control"
                                                               placeholder="Enter Room Permalink" value="{{$room->room_permalink}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h3 class="form-section">Hero Images</h3>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="tabbable-bordered">
                                            <ul class="nav nav-tabs">
                                                <li class="active">
                                                    <a href="#Hero1" data-toggle="tab"> Hero Image 1 </a>
                                                </li>
                                                <li>
                                                    <a href="#Hero2" data-toggle="tab"> Hero Image 2 </a>
                                                </li>
                                                <li>
                                                    <a href="#Hero3" data-toggle="tab"> Hero Image 3 </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane fade active in" id="Hero1">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                <div class="fileinput-new thumbnail" style="width: 100%;" data-image="hero_image_1">
                                                                    @if($room->hero_image_1)
                                                                    <img src="{{$room->hero_image_1}}" alt="" id="hero_image_1_img" />
                                                                    @else
                                                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                                                    @endif
                                                                </div>    
                                                                <div class="fileinput-preview fileinput-exists thumbnail" style="width: 100%;" data-image="hero1"> </div>
                                                                <div>
                                                                    <span class="btn default btn-file">
                                                                        <span class="fileinput-new"> Select image </span>
                                                                        <span class="fileinput-exists"> Change </span>
                                                                        <input type="file" id="hero_image_1" name="hero_image_1" class="hero-image"> </span>
                                                                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" id="hero_image_products1" name="hero_image_products1" />
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Image Title:</label>
                                                                <div class="col-md-9">
                                                                    <input class="form-control"
                                                                                   placeholder="Image Title" name="hero_image_1_title" id="hero_image_1_title" value="{{$room->hero_image_1_title}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label">Alt Text:
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <input class="form-control"
                                                                                   placeholder="Alt Text" name="hero_image_1_alt" id="hero_image_1_alt" value="{{$room->hero_image_1_alt}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label">Caption:
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <input class="form-control"
                                                                                   placeholder="Image Title" name="hero_image_1_caption" id="hero_image_1_caption" value="{{$room->hero_image_1_caption}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label">Desciption:
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <input class="form-control"
                                                                                   placeholder="Desciption" name="hero_image_1_desc" id="hero_image_1_desc" value="{{$room->hero_image_1_desc}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="Hero2">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                <div class="fileinput-new thumbnail" style="width: 100%;" data-image="hero_image_2">
                                                                    @if($room->hero_image_2)
                                                                    <img src="{{$room->hero_image_2}}" alt="" id="hero_image_2_img"/> </div>
                                                                    @else
                                                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
                                                                    @endif
                                                                <div class="fileinput-preview fileinput-exists thumbnail" style="width: 100%;" data-image="hero2"> </div>
                                                                <div>
                                                                    <span class="btn default btn-file">
                                                                        <span class="fileinput-new"> Select image </span>
                                                                        <span class="fileinput-exists"> Change </span>
                                                                        <input type="file" id="hero_image_2" name="hero_image_2"  class="hero-image"> </span>
                                                                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Image Title:</label>
                                                                <div class="col-md-9">
                                                                    <input class="form-control"
                                                                                   placeholder="Image Title" name="hero_image_2_title" id="hero_image_2_title" value="{{$room->hero_image_2_title}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label">Alt Text:
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <input class="form-control"
                                                                                   placeholder="Alt Text" name="hero_image_2_alt" id="hero_image_2_alt" value="{{$room->hero_image_2_alt}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label">Caption:
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <input class="form-control"
                                                                                   placeholder="Image Title" name="hero_image_2_caption" id="hero_image_2_caption" value="{{$room->hero_image_2_caption}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label">Desciption:
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <input class="form-control"
                                                                                   placeholder="Desciption"  name="hero_image_2_desc" id="hero_image_2_desc" value="{{$room->hero_image_2_desc}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="Hero3">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                <div class="fileinput-new thumbnail" style="width: 100%;" data-image="hero_image_3">
                                                                    @if($room->hero_image_3)
                                                                    <img src="{{$room->hero_image_3}}" alt="" id="hero_image_3_img" /> </div>
                                                                    @else
                                                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
                                                                    @endif
                                                                <div class="fileinput-preview fileinput-exists thumbnail" style="width: 100%;" data-image="hero_image_3"> </div>
                                                                <div>
                                                                    <span class="btn default btn-file">
                                                                        <span class="fileinput-new"> Select image </span>
                                                                        <span class="fileinput-exists"> Change </span>
                                                                        <input type="file" id="hero_image_3" name="hero_image_3"  class="hero-image"> </span>
                                                                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Image Title:</label>
                                                                <div class="col-md-9">
                                                                    <input class="form-control"
                                                                                   placeholder="Image Title"  name="hero_image_3_title" id="hero_image_3_title" value="{{$room->hero_image_3_title}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label">Alt Text:
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <input class="form-control"
                                                                                   placeholder="Alt Text"  name="hero_image_3_alt" id="hero_image_3_alt" value="{{$room->hero_image_3_alt}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label">Caption:
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <input class="form-control"
                                                                                   placeholder="Image Caption"  name="hero_image_3_caption" id="hero_image_3_caption" value="{{$room->hero_image_3_caption}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label">Desciption:
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <input class="form-control"
                                                                                   placeholder="Desciption"  name="hero_image_3_desc" id="hero_image_3_desc" value="{{$room->hero_image_3_desc}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
                <form action="#" class="form-horizontal" id="add_product_image">
                    <input type="hidden" id="hero_image_id" name="hero_image_id" />
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
                <button class="btn green" id="btn_add_product_image" data-dismiss="modal">Save changes </button>
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
    var heroimageproducts1 = [];
    var heroimageproducts2 = [];
    var heroimageproducts3 = [];
    $(".hero-image").change(function(e) {
        setTimeout(setimage,100)
    });
    function setimage()
    {
        $('.fileinput-preview img').click(onheroclick);
    }
    @if($room->hero_image_1)
    $('#hero_image_1_img').click(onheroclick);
    @endif
    @if($room->hero_image_2)
    $('#hero_image_2_img').click(onheroclick);
    @endif
    @if($room->hero_image_3)
    $('#hero_image_3_img').click(onheroclick);
    @endif
    function onheroclick(e){
        var parentOffset = $(this).parent().offset(); 
        $('#hero_image_id').val($(this).parent().data('image'));
        var relX = e.pageX - parentOffset.left;
        var relY = e.pageY - parentOffset.top;
        $('#Xpos').val(relX);
        $('#Ypos').val(relY);
        $('#select_product_modal').modal();
         $("#select_product").select2("val", "");

    }
    $('#btn_add_product_image').click(function(){
        var obj = {'hero_image_id':$('#hero_image_id').val(),'x' : $('#Xpos').val(),'y':$('#Ypos').val(),'product_id' : $('#select_product').val()};
        heroimageproducts1.push(obj);
        $('#hero_image_products1').val(JSON.stringify(heroimageproducts1));
    });
});

</script>
@stop