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
                <h1 class="page-header">Add / Update Product</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div ng-app="adminApp" data-ng-controller="AdminController" class="row">

            <div class="col-lg-12" ng-cloak>
                @if( !empty($id))
                    <div ng-init="loadProductData({{$id}})"></div>
                @endif
                <div class="panel panel-default" ng-init="loadAddProduct()">
                    <div class="panel-heading"> Basic Form Elements</div>
                    <div class="panel-body">
                  {{--    <form role="form" enctype="multipart/form-data" >--}}
                        {!! Form::open(array('url'=>'/api/product/media-upload/','method'=>'POST', 'files'=>true)) !!}

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
                                <div uib-collapse="isCollapsed">
                                    <div class="col-lg-8">
                                        <p class="row">

                                        @if( empty($id))
                                            <div class="from-group">
                                                <label>Enter Permalink</label>
                                                <input ng-model="desiredPermalink" class="form-control"
                                                       placeholder="Enter desired permalink">

                                                <div style="margin-top: 5px">&nbsp;</div>
                                                <p>
                                                    <button class="btn btn-primary" type="button"
                                                            ng-click="addProduct()">
                                                        Check and Proceed
                                                    </button>
                                                </p>
                                            </div>
                                        @endif

                                    </div>
                                </div>

                            </div>
                            <div uib-collapse="isCollapsedToggle" class="col-lg-10">

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
                                                                        <div class="panel-heading"> Category Status
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
                                                                <label>Selects Category</label>

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
                                                                </div>
                                                            </div>
                                                            <div class="row">&nbsp;</div>
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
                                                                         ta-text-editor-class="border-around"
                                                                         ta-html-editor-class="border-around"></div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Price</label>
                                                                <input data-ng-model="Price" class="form-control"
                                                                       placeholder="Enter text">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Sale Price</label>
                                                                <input data-ng-model="SalePrice" class="form-control"
                                                                       placeholder="Enter text">
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
                                                                <label>Free Shipping</label>
                                                                <input data-ng-model="FreeShipping" class="form-control"
                                                                       placeholder="Enter text">
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
                                                                            display-property="name">

                                                                    <auto-complete source="searchProductByName($query)"
                                                                                   ng-model-options="{debounce: 1000}"></auto-complete>

                                                                </tags-input>

                                                            </div>
                                                            <div class="form-group">
                                                                <label>Product Availability</label>
                                                                <input data-ng-model="ProductAvailability"
                                                                       class="form-control" placeholder="Enter text">
                                                            </div>

                                                            <div class="form-group">
                                                                <button data-ng-click="updateProduct()"
                                                                        class="btn btn-primary" type="button">
                                                                    Save As Draft
                                                                </button>
                                                                <button ng-hide="PostStatus == 'Active'"
                                                                        data-ng-click="changeProductActivation()"
                                                                        class="btn btn-warning" type="button">
                                                                    Active
                                                                </button>
                                                                <button ng-hide="PostStatus == 'Inactive'"
                                                                        data-ng-click="changeProductActivation()"
                                                                        class="btn btn-danger" type="button">
                                                                    Inactive
                                                                </button>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="tab-pane fade" id="specification">
                                                    <h4>Specification</h4>

                                                    <p>
                                                        <input type='text' ng-model="spKey" placeholder="key">
                                                        <input type='text' ng-model="spVal" placeholder="value">

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
                                                                                <th>#</th>
                                                                                <th>Key</th>
                                                                                <th>Value</th>
                                                                                <th>Action</th>
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
                                                        <button data-ng-click="updateProduct()"
                                                                class="btn btn-primary" type="button">
                                                            Save As Draft
                                                        </button>
                                                        <button ng-hide="PostStatus == 'Active'"
                                                                data-ng-click="changeProductActivation()"
                                                                class="btn btn-warning" type="button">
                                                            Active
                                                        </button>
                                                        <button ng-hide="PostStatus == 'Inactive'"
                                                                data-ng-click="changeProductActivation()"
                                                                class="btn btn-danger" type="button">
                                                            Inactive
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="review">
                                                    <h4>Review</h4>

                                                    <p>
                                                        <input type='text' ng-model="reviewKey" placeholder="key">
                                                        <uib-rating ng-model="reviewValue"
                                                                    max="5"
                                                                    aria-labelledby="default-rating">
                                                        </uib-rating>


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
                                                                                <th>Value</th>
                                                                                <th>Action</th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            <tr ng-repeat="review in reviews">
                                                                                <td>@{{$index}}</td>
                                                                                <td>@{{ review.key }}</td>
                                                                                <td>
                                                                                    <uib-rating ng-model="review.value"
                                                                                                max="5"
                                                                                                aria-labelledby="default-rating"
                                                                                                readonly="true">
                                                                                    </uib-rating>
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
                                                    <div class="form-group">
                                                        <button data-ng-click="updateProduct()"
                                                                class="btn btn-primary" type="button">
                                                            Save As Draft
                                                        </button>
                                                        <button ng-hide="PostStatus == 'Active'"
                                                                data-ng-click="changeProductActivation()"
                                                                class="btn btn-warning" type="button">
                                                            Active
                                                        </button>
                                                        <button ng-hide="PostStatus == 'Inactive'"
                                                                data-ng-click="changeProductActivation()"
                                                                class="btn btn-danger" type="button">
                                                            Inactive
                                                        </button>
                                                    </div>
                                                </div>


                                                <div class="tab-pane fade" id="media">
                                                    <h4>Image Video upload</h4>

                                                    <div class="row">
                                                        <div class="form-group">
                                                            <input type="file" name="media" id="exampleInputFile" file-model="productMedia">
                                                            <button type="button" class="btn btn-default" ng-click="addMedia()">Add Media</button>
                                                            <div class="col-sm-4 dropzone" id="my-awesome-dropzone"  dropzone="dropzoneConfig" >

                                                            </div>
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
            <!-- /.container-fluid -->

        </div>
    </div>
@stop