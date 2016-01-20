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
                    <span>Product List</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Product List</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div ng-app="adminApp" data-ng-controller="AdminController" class="row">

            <div class="col-lg-12" ng-cloak>
                <div class="panel panel-default">
                    <div class="panel-heading"> Basic Form Elements</div>
                    <div class="panel-body">
                        <form role="form">
                            <div class="row">
                                <div class="col-lg-12">

                                    <div class="row">
                                        <div class="col-lg-12">

                                            <div>
                                                <uib-alert ng-repeat="alert in alerts" type="@{{alert.type}}"
                                                           close="closeAlert($index)">
                                                    <p ng-bind-html="alertHTML"></p>
                                                </uib-alert>

                                            </div>

                                            <div class="col-lg-6">
                                                <div class="panel panel-info">
                                                    <div class="panel-heading"> Subcategory Status Panel</div>
                                                    <div class="panel-body">
                                                        <span ng-repeat="list in tempCategoryList">@{{ list }}
                                                            >> </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">&nbsp;</div>
                                            <div class="col-lg-3">
                                                <a class="btn btn-primary btn-circle btn-lg"
                                                   tooltip-placement="bottom"
                                                   uib-tooltip="Add New Product" href="/admin/product-add">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group ">

                                        <label>Selects Category</label>

                                        <div class="clearfix">
                                            <div class="row">
                                                <div class="col-lg-5 pull-left">
                                                    <select data-ng-model="selectedItem" ng-change="getSubCategory()"
                                                            class="form-control">
                                                        <option value="@{{ selectedItem }}">
                                                            -- View This Category --
                                                        </option>
                                                        <option ng-repeat="category in categoryItems"
                                                                value="@{{ category.id }}">
                                                            @{{ category.category }}
                                                        </option>
                                                    </select>
                                                    <div style="margin-top: 10px">
                                                        <label>Selected Category Name :</label><span class="text-danger"><strong> @{{ currentCategoryName }} </strong> </span>
                                                    </div>
                                                </div>

                                                <div class="col-lg-2">
                                                    <button class="btn btn-info btn-circle" type="button"
                                                            ng-click="resetCategory()" uib-tooltip="Refresh Category"
                                                            tooltip-placement="right">
                                                        <i class="fa fa-refresh"></i>
                                                    </button>
                                                </div>

                                                <div class="col-lg-5">
                                                    <label class="col-md-5 control-label">Show Product For:
                                                    </label>
                                                    <div class="col-md-6">
                                                        <select data-ng-model="ShowFor"
                                                                class="form-control">
                                                            <option value="">-- Select Type --</option>
                                                            <option ng-repeat="item in showForList"
                                                                    value="@{{ item }}">
                                                                @{{ item }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div style="margin-top: 5px">&nbsp;</div>
                                                <div class="col-md-6">
                                                    <div>
                                                        <div class="col-lg-6 pull-left">
                                                            <select data-ng-model="selectedFilter"
                                                                    class="form-control">
                                                                <option value="">
                                                                    -- Select Filter --
                                                                </option>
                                                                <option ng-repeat="filter in filterTypes"
                                                                        value="@{{ filter.key }}">
                                                                    @{{ filter.value }}
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <input data-ng-model="filterName"
                                                                   class="form-control"
                                                                   placeholder="Enter Item To Filter">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="btn-group col-md-6">
                                                    <label class="btn btn-primary" ng-model="ActiveItem"
                                                           uib-btn-radio="'Active'" uibButtonConfig="activeClass">With
                                                        Active Items</label>
                                                    <label class="btn btn-primary" ng-model="ActiveItem"
                                                           uib-btn-radio="'Inactive'">With Inactive Items</label>
                                                </div>

                                            </div>
                                            <div style="margin-top: 5px">&nbsp;</div>
                                            <div class="row">
                                                <div class="text-center" >
                                                    <button class="btn btn-success" ng-click="showAllProduct()"
                                                            type="button">Load Product
                                                    </button>
                                                    <button class="btn btn-warning" ng-click="resetFilter()"
                                                            type="button">Reset Filter
                                                    </button>
                                                </div>
                                            </div>
                                            <div style="margin-top: 5px">&nbsp;</div>
                                            <div class="row">
                                                <div class="text-center">
                                                    <pagination ng-show="total != 0" total-items="total"
                                                                ng-model="page" ng-change="showAllProduct()"
                                                                items-per-page="limit"></pagination>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            Products
                                                        </div>
                                                        <!-- /.panel-heading -->
                                                        <div class="panel-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-hover">
                                                                    <thead>
                                                                    <tr>
                                                                        <th class="col-md-1">Image</th>
                                                                        <th class="col-md-2">Update</th>
                                                                        <th class="col-md-1">User</th>
                                                                        <th class="col-md-3">Product Name</th>
                                                                        <th class="col-md-1">Category</th>
                                                                        <th class="col-md-1">Affiliate</th>
                                                                        <th class="col-md-1">List Price</th>
                                                                        <th class="col-md-1">Sell Price</th>
                                                                        <th class="col-md-1">Action</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <tr ng-repeat="product in ProductList">
                                                                        <td>
                                                                            <a href="/pro-details/@{{ product.product_permalink }}"
                                                                               target="_blank">
                                                                                <img id="currentPhoto"
                                                                                     ng-src='@{{ product.media_link }}'
                                                                                     onerror="this.src='http://s3-us-west-1.amazonaws.com/ideaing-01/thumb-product-568d28a6701c7-no-item.jpg'"
                                                                                     width="90">
                                                                            </a>
                                                                        </td>
                                                                        <td>@{{ product.updated_at }}</td>
                                                                        <td><b>@{{ product.user_name }}</b></td>
                                                                        <td>
                                                                            <a href="/admin/product-edit/@{{ product.id }}">@{{ product.product_name }}</a>
                                                                        </td>
                                                                        <td>@{{ product.category_name }}</td>
                                                                        <td><a ng-show="product.affiliate_link != null"
                                                                               href="@{{ product.affiliate_link }}"
                                                                               target="_blank">Link</a></td>
                                                                        <td>@{{ product.price }}</td>
                                                                        <td>@{{ product.sale_price }}</td>
                                                                        <td>
                                                                            <a href="/admin/product-edit/@{{ product.id }}"
                                                                               class="btn btn-info btn-circle"
                                                                               uib-tooltip="Edit"
                                                                               tooltip-placement="bottom"> <i class="fa fa-edit"></i></a>
                                                                            <button data-ng-click="deleteProduct( product.id,false)"
                                                                                    confirm="Are you sure to delete this product ?"
                                                                                    confirm-settings="{size: 'sm'}"
                                                                                    uib-tooltip="Delete"
                                                                                    class="btn btn-danger btn-circle" type="button">
                                                                                <i class="fa fa-times"></i>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="text-center"  ng-init="showAllProduct()">
                                                                <pagination ng-show="total != 0" total-items="total"
                                                                            ng-model="page" ng-change="showAllProduct()"
                                                                            items-per-page="limit"></pagination>
                                                            </div>
                                                            <!-- /.table-responsive -->
                                                        </div>
                                                        <!-- /.panel-body -->
                                                    </div>
                                                    <!-- /.panel -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>    
    </div>
</div>
@stop
