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
                <h1 class="page-header">Add Category Item</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div ng-app="adminApp" data-ng-controller="AdminController" class="row">
            <div class="col-lg-12" ng-cloak>
                <div class="panel panel-default">
                    <div class="panel-heading"> Basic Form Elements</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-12">
                                        {{-- <div  ng-cloak>
                                             <uib-alert  ng-repeat="alert in alerts" type="@{{alert.type}}"
                                                         close="closeAlert($index)">@{{alert.msg}}</uib-alert>
                                             <p>hi</p>
                                             --}}{{--<p ng-bind-html="alertHTML"></p>--}}{{--
                                         </div>--}}

                                        <div ng-cloak>
                                            <uib-alert ng-repeat="alert in alerts" type="@{{alert.type}}"
                                                       close="closeAlert($index)">
                                                <p ng-bind-html="alertHTML"></p>
                                            </uib-alert>

                                            {{--<p ng-bind-html="alertHTML"></p>--}}
                                        </div>

                                        <div class="panel panel-info">
                                            <div class="panel-heading"> Category Status Panel</div>
                                            <div class="panel-body">
                                                <span ng-repeat="list in tempCategoryList">@{{ list }} >> </span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <form role="form">
                                    <div class="form-group ">
                                        <label>Selects Category</label>

                                        <div class="col-lg-12 clearfix">
                                            <div class="col-lg-10 pull-left">
                                                <select data-ng-model="selectedItem" ng-change="getSubCategory()"
                                                        class="form-control">
                                                    <option value="@{{ selectedItem }}">
                                                        -- Add to This Category --
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
                                    </div>

                                    <div class="form-group">
                                        <label>Category Name</label>
                                        <input ng-model="categoryName" class="form-control" placeholder="Text Required">
                                    </div>
                                    <div class="form-group">
                                        <label>Extra Info</label>
                                        <input ng-model="extraInfo" class="form-control"
                                               placeholder="Custom URL Name Required">
                                    </div>
                                    <p>
                                        <button class="btn btn-primary" ng-click="addCategory()" type="submit">Submit
                                        </button>
                                    </p>
                                </form>

                            </div>
                        </div>
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


