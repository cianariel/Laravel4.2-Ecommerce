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
                <h1 class="page-header">Product List</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div ng-app="adminApp" data-ng-controller="AdminController" class="row">

            <div class="col-lg-12" ng-cloak>
                <div class="panel panel-default">
                    <div class="panel-heading"> Basic Form Elements</div>
                    <div class="panel-body">
                        <form role="form">
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

                                            <div class="panel panel-info">
                                                <div class="panel-heading"> Category Status Panel</div>
                                                <div class="panel-body">
                                                    <span ng-repeat="list in tempCategoryList">@{{ list }} >> </span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label>Selects Category</label>

                                        <div class="col-lg-12 clearfix">
                                            <div class="row">
                                                <div class="col-lg-10 pull-left">
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
                                                </div>

                                                <div class="col-lg-2">
                                                    <button class="btn btn-info btn-circle" type="button"
                                                            ng-click="resetCategory()" uib-tooltip="Refresh Category"
                                                            tooltip-placement="right">
                                                        <i class="fa fa-refresh"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div style="margin-top: 5px">&nbsp;</div>
                                                <div class="btn-group">
                                                    <label class="btn btn-primary" ng-model="ActiveItem" uib-btn-radio="'Active'" uibButtonConfig="activeClass">With Active Items</label>
                                                    <label class="btn btn-primary" ng-model="ActiveItem" uib-btn-radio="'Inactive'">With Inactive Items</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div style="margin-top: 5px">&nbsp;</div>
                                                <button class="btn btn-primary" ng-click="showAllProduct()" type="button">Load Product</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group" style="margin-top:50px;">
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
                                                                    <th class="col-md-1">Price</th>
                                                                    <th class="col-md-1">Sell Price</th>
                                                                    <th class="col-md-1">Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr ng-repeat="product in ProductList">
                                                                    <td>
                                                                        <a href="/product-details/@{{ product.id }}" target="_blank">
                                                                        <img id="currentPhoto"
                                                                             ng-src='@{{ product.media_link }}'
                                                                             onerror="this.src='http://s3-us-west-1.amazonaws.com/ideaing-01/thumb-product-568d28a6701c7-no-item.jpg'"
                                                                             width="90">
                                                                        </a>
                                                                    </td>
                                                                    <td>@{{ product.updated_at }}</td>
                                                                    <td>@{{ product.user_name }}</td>
                                                                    <td>
                                                                        <a href="/admin/product-edit/@{{ product.id }}">@{{ product.product_name }}</a>
                                                                    </td>
                                                                    <td>@{{ product.category_name }}</td>
                                                                    <td> <a ng-hide="product.affiliate_link == ''" href="@{{ product.affiliate_link }}" target="_blank">Link</a> </td>
                                                                    <td>@{{ product.price }}</td>
                                                                    <td>@{{ product.sale_price }}</td>
                                                                    <td>
                                                                        <a href="/admin/product-edit/@{{ product.id }}"
                                                                           class="btn btn-info btn-circle"
                                                                           uib-tooltip="Edit"
                                                                           tooltip-placement="bottom">  <i class="fa fa-edit"></i></a>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div>
                                                            <pagination ng-show="total != 0" total-items="total" ng-model="page" ng-change="showAllProduct()" items-per-page="limit"></pagination>
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
        <!-- /.container-fluid -->
    </div>
</div>
@stop