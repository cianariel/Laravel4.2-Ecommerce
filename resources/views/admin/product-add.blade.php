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
                    <span>Add / Update Product</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add / Update Product</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div ng-app="adminApp" data-ng-controller="AdminController" class="row" nv-file-drop="" uploader="uploader"
             filters="queueLimit, customFilter">

            <div class="col-lg-12" ng-cloak>
                @if( !empty($id))
                    <div ng-init="loadProductData({{$id}})"></div>
                @endif
                <div class="panel panel-default" ng-init="loadAddProduct()">
                    <div class="panel-heading"> Basic Form Elements</div>
                    <div class="panel-body">
                        <form role="form" name="myForm" enctype="multipart/form-data">

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

                            <div class="row">


                            </div>

                            <div class="row" class="col-lg-10">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Add Product Panel
                                    </div>
                                    <div class="row">
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a aria-expanded="true" href="#home"
                                                                      data-toggle="tab">Home</a>
                                                </li>
                                                <li class=""><a aria-expanded="false" href="#specification"
                                                                data-toggle="tab">Specification</a>
                                                </li>
                                                <li class=""><a aria-expanded="false" href="#review"
                                                                data-toggle="tab">Review</a>
                                                </li>
                                                <li class=""><a aria-expanded="false" href="#media"
                                                                data-toggle="tab">Media Content</a>
                                                </li>
                                            </ul>

                                            <!-- Tab panes -->
                                            <div class="tab-content">
                                                <div class="tab-pane fade active in" id="home">
                                                    <div class="row row-grid">&nbsp;</div>
                                                    <div class="col-lg-8">
                                                        <div ng-hide="hideCategoryPanel">
                                                            <div class="row">
                                                                <div class="from-group">
                                                                    <div class="panel panel-info">
                                                                        <div class="panel-heading"> Subcategory Status
                                                                            Panel
                                                                        </div>
                                                                        <div class="panel-body">
                                                                            <span ng-repeat="list in tempCategoryList">@{{ list }}
                                                                                >> </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div ng-hide="!hideCategoryPanel">
                                                                <label>Selected Category: @{{ selectedItem }}</label>

                                                                <button ng-click="hideCategoryPanel = !hideCategoryPanel"
                                                                        tooltip-placement="right"
                                                                        uib-tooltip="Reset Category"
                                                                        class="btn btn-warning btn-circle">
                                                                    <i class="fa fa-refresh"></i>
                                                                </button>
                                                            </div>
                                                            <div ng-hide="hideCategoryPanel" class="form-group">
                                                                <label>Select Category</label>

                                                                <div class="col-lg-12 clearfix">
                                                                    <div class="col-lg-10 pull-left">
                                                                        <select data-ng-model="selectedItem"
                                                                                ng-change="getSubCategory()"
                                                                                class="form-control">
                                                                            <option value="@{{ selectedItem }}">
                                                                                -- View This Category --
                                                                            </option>
                                                                            <option ng-repeat="category in categoryItems"
                                                                                    value="@{{ category.id }}">
                                                                                @{{ category.category }}
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                        <button class="btn btn-info btn-circle"
                                                                                type="button"
                                                                                ng-click="resetCategory()"
                                                                                uib-tooltip="Refresh Category"
                                                                                tooltip-placement="right">
                                                                            <i class="fa fa-refresh"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div style="margin-top: 10px">
                                                                        <label>Selected Category Name :</label><span
                                                                                class="text-danger"><strong> @{{ currentCategoryName }} </strong> </span>
                                                                    </div>


                                                                </div>
                                                            </div>
                                                            <div class="form-group row">&nbsp;
                                                                <div class="col-lg-6">
                                                                    <label>Product ID</label>
                                                                    <input data-ng-model="ProductVendorId"
                                                                           class="form-control"
                                                                           placeholder="Amazon - ASIN">
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <div style="height: 15px">&nbsp;</div>
                                                                    <button class="btn btn-info btn-circle"
                                                                            type="button"
                                                                            ng-click="loadProductInfoFromApi(ProductVendorId)"
                                                                            uib-tooltip="Load Information"
                                                                            tooltip-placement="right">
                                                                        <i class="fa fa-refresh"></i>
                                                                    </button>
                                                                </div>

                                                            </div>
                                                            <div class="form-group">
                                                                <label>Prodcut Name</label>
                                                                <input data-ng-model="Name" class="form-control"
                                                                       placeholder="Enter product name">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Permalink</label>
                                                                <input data-ng-model="Permalink" class="form-control"
                                                                       placeholder="Modify permalink">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Description</label>

                                                                <div class="col-sm-12 outline: 1px solid orange;">
                                                                    <div text-angular data-ng-model="htmlContent"
                                                                         name="description-editor"
                                                                         ta-text-editor-class="border-around ta-editor"
                                                                         ta-html-editor-class="border-around ta-editor">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>List Price</label>
                                                                <input type="text"
                                                                       valid-number
                                                                       data-ng-model="Price"
                                                                       class="form-control"
                                                                       placeholder="Enter Price (Decimal number only)">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Sale Price</label>
                                                                <input type="text"
                                                                       valid-number
                                                                       data-ng-model="SalePrice"
                                                                       class="form-control"
                                                                       placeholder="Enter Sale Price (Decimal number only)">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Store Name</label>
                                                                <input data-ng-model="StoreId" class="form-control"
                                                                       placeholder="Enter text">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Affiliate Link</label>
                                                                <input data-ng-model="AffiliateLink"
                                                                       class="form-control"
                                                                       placeholder="Enter text">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Price Grabber Id</label>
                                                                <input data-ng-model="PriceGrabberId"
                                                                       class="form-control"
                                                                       placeholder="Enter text">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Free Shipping Available : </label>
                                                                <input type="checkbox" data-ng-model="FreeShipping"
                                                                       class="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Coupon Code</label>
                                                                <input data-ng-model="CouponCode" class="form-control"
                                                                       placeholder="Enter text">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Page Title</label>
                                                                <input data-ng-model="PageTitle" class="form-control"
                                                                       placeholder="Enter text">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Meta Description</label>
                                                                <input data-ng-model="MetaDescription"
                                                                       class="form-control"
                                                                       placeholder="Enter text">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Similar Products (Auto Complete)</label>
                                                                <tags-input ng-model="productTags"
                                                                            display-property="name"
                                                                            add-from-autocomplete-only="true">
                                                                    <auto-complete min-length="4"
                                                                                   source="searchProductByName($query)">
                                                                    </auto-complete>
                                                                </tags-input>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Product Availability</label>
                                                                <input data-ng-model="ProductAvailability"
                                                                       class="form-control" placeholder="Enter text">
                                                            </div>

                                                            <div class="form-group">
                                                                <div style="height: 3px">&nbsp;</div>
                                                                <button data-ng-click="updateProduct()"
                                                                        class="btn btn-primary" type="button">
                                                                    Save
                                                                </button>
                                                                <button ng-hide="Permalink == ''"
                                                                        data-ng-click="previewProduct(Permalink)"
                                                                        class="btn btn-success" type="button">
                                                                    Preview
                                                                </button>

                                                                <button ng-hide="PostStatus == 'Active'"
                                                                        data-ng-click="changeProductActivation()"
                                                                        class="btn btn-info" type="button">
                                                                    Active
                                                                </button>
                                                                <button ng-hide="PostStatus == 'Inactive'"
                                                                        data-ng-click="changeProductActivation()"
                                                                        class="btn btn-warning" type="button">
                                                                    Inactive
                                                                </button>
                                                                <button ng-hide="ProductId == ''"
                                                                        data-ng-click="deleteProduct(ProductId,true)"
                                                                        confirm="Are you sure to delete this product ?"
                                                                        confirm-settings="{size: 'sm'}"
                                                                        class="btn btn-danger" type="button">
                                                                    Delete
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="specification">
                                                    <h4>Specification</h4>

                                                    <p>
                                                        <input type='text'  ng-model="spKey" placeholder="key">
                                                        <input type='text'  ng-model="spVal" placeholder="value">

                                                        <button ng-click="addSpecFormField()"
                                                                ng-show="!isUpdateSpecShow"
                                                                class="btn btn-primary btn-circle" uib-tooltip="Add"
                                                                tooltip-placement="bottom">
                                                            <i class="fa fa-plus"></i>
                                                        </button>

                                                        <button ng-click="updateSpecFormField()"
                                                                ng-show="isUpdateSpecShow"
                                                                class="btn btn-success btn-circle" uib-tooltip="Update"
                                                                tooltip-placement="bottom">
                                                            <i class="fa fa-check"></i>
                                                        </button>
                                                    </p>
                                                    <div class="row">
                                                        <div class="col-lg-8">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading"> Specification Key Value List
                                                                </div>
                                                                <div class="panel-body">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-striped table-bordered table-hover">
                                                                            <thead>
                                                                            <tr>
                                                                                <th class="col-lg-1">#</th>
                                                                                <th class="col-lg-3">Key</th>
                                                                                <th class="col-lg-6">Value</th>
                                                                                <th class="col-lg-2">Action</th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            <tr ng-repeat="spec in Specifications">
                                                                                <td>@{{$index}}</td>
                                                                                <td>@{{ spec.key }}</td>
                                                                                <td>@{{ spec.value }}</td>
                                                                                <td>
                                                                                    <button ng-click="editSpecFormField($index)"
                                                                                            class="btn btn-info btn-circle"
                                                                                            uib-tooltip="Edit"
                                                                                            tooltip-placement="bottom">
                                                                                        <i class="fa fa-edit"></i>
                                                                                    </button>
                                                                                    <button ng-click="deleteSpecFormField($index)"
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
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="form-group">
                                                        <div style="height: 3px">&nbsp;</div>
                                                        <button data-ng-click="updateProduct()"
                                                                class="btn btn-primary" type="button">
                                                            Save
                                                        </button>
                                                        <button ng-hide="Permalink == ''"
                                                                data-ng-click="previewProduct(Permalink)"
                                                                class="btn btn-success" type="button">
                                                            Preview
                                                        </button>

                                                        <button ng-hide="PostStatus == 'Active'"
                                                                data-ng-click="changeProductActivation()"
                                                                class="btn btn-info" type="button">
                                                            Active
                                                        </button>
                                                        <button ng-hide="PostStatus == 'Inactive'"
                                                                data-ng-click="changeProductActivation()"
                                                                class="btn btn-warning" type="button">
                                                            Inactive
                                                        </button>
                                                        <button ng-hide="ProductId == ''"
                                                                data-ng-click="deleteProduct(ProductId,true)"
                                                                confirm="Are you sure to delete this product ?"
                                                                confirm-settings="{size: 'sm'}"
                                                                class="btn btn-danger" type="button">
                                                            Delete
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="review">
                                                    <h4>Review</h4>

                                                    <p>
                                                        <input type='text' ng-model="reviewKey" placeholder="key">
                                                        <input type='text' ng-model="reviewLink" placeholder="Link">
                                                        <input type='text' ng-model="reviewCounter"
                                                               placeholder="Counter">
                                                        <ng-rate-it ng-model="reviewValue"
                                                                    read-only="false"
                                                                    resetable="false">
                                                        </ng-rate-it>

                                                        <button ng-click="addReviewFormField()"
                                                                ng-show="!isUpdateReviewShow"
                                                                class="btn btn-primary btn-circle" uib-tooltip="Add"
                                                                tooltip-placement="bottom">
                                                            <i class="fa fa-plus"></i>
                                                        </button>


                                                        <button ng-click="updateReviewFormField()"
                                                                ng-show="isUpdateReviewShow"
                                                                class="btn btn-success btn-circle" uib-tooltip="Update"
                                                                tooltip-placement="bottom">
                                                            <i class="fa fa-check"></i>
                                                        </button>

                                                    </p>
                                                    <div class="row">
                                                        <div class="col-lg-8">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading"> Rating Key Value List
                                                                </div>
                                                                <div class="panel-body">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-striped table-bordered table-hover">
                                                                            <thead>
                                                                            <tr>
                                                                                <th>#</th>
                                                                                <th>Key</th>
                                                                                <th>Counter</th>
                                                                                <th>Value</th>
                                                                                <th>Action</th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            <tr ng-repeat="review in reviews">
                                                                                <td>@{{$index}}</td>
                                                                                <td><a ng-hide="$index==0"
                                                                                       href="@{{ review.link }}"
                                                                                       target="_blank">
                                                                                        @{{ review.key }}
                                                                                    </a>

                                                                                    <div ng-show="$index==0">
                                                                                        @{{ review.key }}
                                                                                    </div>
                                                                                </td>
                                                                                <td>@{{ review.counter }}</td>

                                                                                <td>

                                                                                    <ng-rate-it ng-model="review.value"
                                                                                                read-only="true"
                                                                                                resetable="false">
                                                                                    </ng-rate-it>

                                                                                </td>
                                                                                <td>

                                                                                    <button ng-click="editReviewFormField($index)"
                                                                                            ng-hide="$index==0"
                                                                                            class="btn btn-info btn-circle"
                                                                                            uib-tooltip="Edit"
                                                                                            tooltip-placement="bottom">
                                                                                        <i class="fa fa-edit"></i>
                                                                                    </button>


                                                                                    <button ng-click="deleteReviewFormField($index)"
                                                                                            ng-hide="$index==0"
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
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div style="margin-left: 5px;" class=row>

                                                            <label>Ideaing Review</label>
                                                        <div class="form-group">
                                                            <ng-rate-it ng-model="ideaingReviewScore"
                                                                        read-only="false"
                                                                        resetable="true">
                                                            </ng-rate-it>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>External Review Link</label>

                                                                <div class="col-sm-12 outline: 1px solid orange;">
                                                                    <div text-angular data-ng-model="externalReviewLink"
                                                                         name="review-editor"
                                                                         ta-text-editor-class="border-around ta-editor"
                                                                         ta-html-editor-class="border-around ta-editor">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div style="height: 3px">&nbsp;</div>
                                                        <button data-ng-click="updateProduct()"
                                                                class="btn btn-primary" type="button">
                                                            Save
                                                        </button>
                                                        <button ng-hide="Permalink == ''"
                                                                data-ng-click="previewProduct(Permalink)"
                                                                class="btn btn-success" type="button">
                                                            Preview
                                                        </button>

                                                        <button ng-hide="PostStatus == 'Active'"
                                                                data-ng-click="changeProductActivation()"
                                                                class="btn btn-info" type="button">
                                                            Active
                                                        </button>
                                                        <button ng-hide="PostStatus == 'Inactive'"
                                                                data-ng-click="changeProductActivation()"
                                                                class="btn btn-warning" type="button">
                                                            Inactive
                                                        </button>
                                                        <button ng-hide="ProductId == ''"
                                                                data-ng-click="deleteProduct(ProductId,true)"
                                                                confirm="Are you sure to delete this product ?"
                                                                confirm-settings="{size: 'sm'}"
                                                                class="btn btn-danger" type="button">
                                                            Delete
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="tab-pane fade" id="media">
                                                    <h4>Image Video upload</h4>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Media Title</label>
                                                            <input data-ng-model="mediaTitle"
                                                                   class="form-control" placeholder="Enter media title">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Media Title</label>
                                                            <select data-ng-model="selectedMediaType"
                                                                    data-ng-change="mediaTypeChange()"
                                                                    class="form-control">
                                                                <option ng-repeat="media in mediaTypes"
                                                                        value="@{{ media.key }}">
                                                                    @{{ media.value }}
                                                                </option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Media Link</label>
                                                            <input data-ng-model="mediaLink"
                                                                   data-ng-readonly="isMediaUploadable"
                                                                   class="form-control" placeholder="Enter media link">
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Mark As Hero Item :</label>
                                                            <input data-ng-model="isHeroItem"
                                                                   type="checkbox">
                                                        </div>

                                                        <div class="form-group">
                                                            <div ng-show="isMediaUploadable">
                                                                <label>Upload Media Content</label>
                                                                <input type="file" name="file" nv-file-select=""
                                                                       uploader="uploader"/>
                                                            </div>
                                                            <br>
                                                            <button type="button"
                                                                    ng-show="isMediaUploadable"
                                                                    class="btn btn-success btn-s"
                                                                    ng-click="uploader.uploadAll()">Upload
                                                            </button>
                                                        </div>
                                                        <p>
                                                            <button type="button"
                                                                    class="btn btn-primary"
                                                                    ng-click="addMediaInfo()">Add In List
                                                            </button>
                                                        </p>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <!-- media list  -->
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-bordered table-hover">
                                                                <thead>
                                                                <tr>
                                                                    <th class="col-md-1">#</th>
                                                                    <th class="col-md-3">Title</th>
                                                                    <th class="col-md-2">Type</th>
                                                                    <th class="col-md-1">Hero</th>
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
                                                                    <td>
                                                                        <a href="@{{ media.media_link}}"
                                                                           target="_blank">
                                                                            @{{ media.media_link}}
                                                                        </a>
                                                                    </td>
                                                                    <td>
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
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->

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