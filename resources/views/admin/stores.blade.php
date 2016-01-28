@extends('layouts.admin')

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
                    <span>Manage Stores</span>
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
                                    <i class="fa fa-shopping-cart"></i>Manage Stores </div>
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
                            <div class="row">
                                    <div class="col-lg-6">

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div>
                                                    <uib-alert ng-repeat="alert in alerts" type="@{{alert.type}}"
                                                               close="closeAlert($index)">
                                                        <p ng-bind-html="alertHTML"></p>
                                                    </uib-alert>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tabbable-bordered">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#media" data-toggle="tab"> Media Content
                                            </a>
                                        </li>
                                      {{-- <li>
                                            <a href="#media" data-toggle="tab">i
                                            </a>
                                        </li>--}}
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade active in"  id="media">
                                            <h4>Image Video upload</h4>
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Media Title :
                                                    </label>
                                                    <div class="col-md-4">
                                                        <input data-ng-model="mediaTitle" class="form-control"
                                                                       placeholder="Enter media title">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Media Type :
                                                    </label>
                                                    <div class="col-md-4">
                                                        <select data-ng-model="selectedMediaType"
                                                                data-ng-change="mediaTypeChange()"
                                                                class="form-control">
                                                            <option ng-repeat="media in mediaTypes"
                                                                    value="@{{ media.key }}">
                                                                @{{ media.value }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Media Link :
                                                    </label>
                                                    <div class="col-md-8">
                                                        <input data-ng-model="mediaLink"
                                                           data-ng-readonly="isMediaUploadable"
                                                           class="form-control" placeholder="Enter media link">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Mark As Hero Item :
                                                    </label>
                                                    <div class="col-md-4">
                                                        <input  type="checkbox" data-ng-model="isHeroItem" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Thumb Item :
                                                    </label>
                                                    <div class="col-md-4">
                                                        <input data-ng-model="isMainItem" type="checkbox" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div ng-show="isMediaUploadable">
                                                        <label class="col-md-2 control-label">Upload Media Content</label>
                                                        <div class="col-md-4">                                                        
                                                            <input type="file" name="file" nv-file-select=""
                                                               uploader="uploader"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-4">
                                                        <button type="button"
                                                                ng-show="isMediaUploadable"
                                                                class="btn btn-success btn-s"
                                                                ng-click="uploader.uploadAll()">Upload
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-4">
                                                        <button ng-show="isMediaEdit" type="button"
                                                                class="btn btn-warning"
                                                                ng-click="updateMediaInfo()">Update
                                                        </button>
                                                        <button ng-hide="isMediaEdit" type="button"
                                                                class="btn btn-primary"
                                                                ng-click="addMediaInfo()">Add In List
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <!-- media list  -->
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-bordered table-hover">
                                                                <thead>
                                                                <tr>
                                                                    <th class="col-md-1">#</th>
                                                                    <th class="col-md-2">Title</th>
                                                                    <th class="col-md-2">Type</th>
                                                                    <th class="col-md-1">Hero</th>
                                                                    <th class="col-md-1">Thumb</th>
                                                                    <th class="col-md-4">Link</th>
                                                                    <th class="col-md-1">Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr ng-repeat="media in mediaList">
                                                                    <td>@{{media.id}}</td>
                                                                    <td>@{{ media.media_name}}</td>
                                                                    <td>@{{ media.media_type}} </td>
                                                                    <td>@{{ media.is_hero_item == 1? 'true':''}} </td>
                                                                    <td>@{{ media.is_main_item == 1? 'true':''}} </td>
                                                                    <td>
                                                                        <a href="@{{ media.media_link}}"
                                                                           target="_blank">
                                                                            @{{ media.media_link}}
                                                                        </a>
                                                                    </td>
                                                                    <td>
                                                                        <button ng-click="editMedia($index)"
                                                                                class="btn btn-info btn-circle"
                                                                                uib-tooltip="Edit"
                                                                                tooltip-placement="bottom">
                                                                            <i class="fa fa-edit"></i>
                                                                        </button>

                                                                        <button data-ng-click="deleteMedia(media.id)"
                                                                                confirm="Are you sure to delete this item ?"
                                                                                confirm-settings="{size: 'sm'}"
                                                                                class="btn btn-danger btn-circle"
                                                                                uib-tooltip="Delete"
                                                                                tooltip-placement="bottom">
                                                                            <i class="fa fa-times"></i>
                                                                        </button>
                                                                    </td>
                                                                    <br/>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <!-- end media list  -->
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
            <!-- /.col-lg-12 --                </div>
>
        </div>
        <!-- /.row -->
        </div>
    </div>
</div>
@stop