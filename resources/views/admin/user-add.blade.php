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
                        <span>Add / Update User</span>
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
                        <form role="form" name="myForm" enctype="multipart/form-data"
                              class="form-horizontal form-row-seperated">
                            <div class="portlet">
                                <div class="portlet-title">

                                    <div class="caption">
                                        <i class="fa fa-shopping-cart"></i>Add / Update User Information
                                    </div>
                                    <div class="actions btn-set">

                                        <button data-ng-click="addUser()" class="btn btn-success">
                                            <i class="fa fa-check"></i> Save
                                        </button>
                                        {{--<button ng-hide="Permalink == ''"
                                            data-ng-click="previewProduct(Permalink)" class="btn btn-success">
                                            <i class="fa fa-eye"></i> Preview</button>
                                        <button ng-hide="PostStatus == 'Active'"
                                                data-ng-click="changeProductActivation()"
                                                class="btn btn-info" type="button">
                                            <i class="fa fa-check-circle"></i> Active
                                        </button>

                                        <button ng-hide="PostStatus == 'Inactive'"
                                                data-ng-click="changeProductActivation()"
                                                class="btn btn-warning" type="button">
                                            <i class="fa fa-angle-left"></i> Inactive
                                        </button>
                                          --}}
                                        {{-- <button ng-hide="ProductId == ''"
                                                             data-ng-click="deleteProduct(ProductId,true)"
                                                             confirm="Are you sure to delete this product ?"
                                                             confirm-settings="{size: 'sm'}"
                                                             class="btn btn-danger" type="button">
                                             <i class="fa fa-times"></i> Delete</button>--}}
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


                                        <div class="form-body col-md-6">
                                            <div class="form-group">
                                                <label for="email">Name:</label>
                                                <input type="text" class="form-control" ng-model="FullName" placeholder="Enter Name" id="name">
                                            </div>
                                            @if(isset($id) && $id != null)
                                                <div class="form-group">
                                                    <label for="email">Email address:</label>
                                                    <input type="email" ng-model="Email" ng-readonly="true" ng-init="Email='{{$id}}'"
                                                           placeholder="Enter Email"
                                                           class="form-control"
                                                           id="email">
                                                </div>
                                            @else
                                                <div class="form-group">
                                                    <label for="email">Email address:</label>
                                                    <input type="email" ng-model="Email" placeholder="Enter Email"
                                                           class="form-control"
                                                           id="email">
                                                </div>
                                            @endif
                                            <div class="form-group">
                                                <label for="pwd">Password:</label>
                                                <input type="password" ng-model="Password" placeholder="Enter Password" class="form-control"
                                                       id="pwd">
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