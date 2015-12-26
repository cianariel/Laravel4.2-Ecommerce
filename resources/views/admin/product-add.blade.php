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
                <h1 class="page-header">Add Product</h1>
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
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-10">

                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            Add Product Panel
                                        </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a aria-expanded="true" href="#home"
                                                                      data-toggle="tab">Home</a>
                                                </li>
                                                <li class=""><a aria-expanded="false" href="#profile" data-toggle="tab">Profile</a>
                                                </li>
                                                <li class=""><a aria-expanded="false" href="#messages"
                                                                data-toggle="tab">Messages</a>
                                                </li>
                                                <li class=""><a aria-expanded="false" href="#settings"
                                                                data-toggle="tab">Settings</a>
                                                </li>
                                            </ul>

                                            <!-- Tab panes -->
                                            <div class="tab-content">
                                                <div class="tab-pane fade active in" id="home">
                                                    <div class="row row-grid">&nbsp;</div>
                                                    <div class="col-lg-8">
                                                        <div class="row">
                                                            <div class="from-group">
                                                                <div class="">
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
                                                            <div class="form-group">
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
                                                                <label>Text Input with Placeholder</label>
                                                                <input class="form-control" placeholder="Enter text">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Text Input with Placeholder</label>
                                                                <input class="form-control" placeholder="Enter text">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Text Input with Placeholder</label>
                                                                <input class="form-control" placeholder="Enter text">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Text Input with Placeholder</label>
                                                                <input class="form-control" placeholder="Enter text">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Text Input with Placeholder</label>
                                                                <input class="form-control" placeholder="Enter text">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Text Input with Placeholder</label>
                                                                <input class="form-control" placeholder="Enter text">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Text Input with Placeholder</label>
                                                                <input class="form-control" placeholder="Enter text">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Text Input with Placeholder</label>
                                                                <input class="form-control" placeholder="Enter text">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Text Input with Placeholder</label>
                                                                <input class="form-control" placeholder="Enter text">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Text Input with Placeholder</label>
                                                                <input class="form-control" placeholder="Enter text">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Text Input with Placeholder</label>
                                                                <input class="form-control" placeholder="Enter text">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Text Input with Placeholder</label>
                                                                <input class="form-control" placeholder="Enter text">
                                                            </div>

                                                            <div class="form-group">
                                                                <button class="btn btn-primary" type="submit">
                                                                    Save As Druft
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="tab-pane fade" id="profile">
                                                    <h4>Profile Tab</h4>

                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                                                        enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                                        nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                                                        in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                                                        nulla pariatur. Excepteur sint occaecat cupidatat non proident,
                                                        sunt in culpa qui officia deserunt mollit anim id est
                                                        laborum.</p>
                                                </div>
                                                <div class="tab-pane fade" id="messages">
                                                    <h4>Messages Tab</h4>

                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                                                        enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                                        nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                                                        in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                                                        nulla pariatur. Excepteur sint occaecat cupidatat non proident,
                                                        sunt in culpa qui officia deserunt mollit anim id est
                                                        laborum.</p>
                                                </div>
                                                <div class="tab-pane fade" id="settings">
                                                    <h4>Settings Tab</h4>

                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                                                        enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                                        nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                                                        in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                                                        nulla pariatur. Excepteur sint occaecat cupidatat non proident,
                                                        sunt in culpa qui officia deserunt mollit anim id est
                                                        laborum.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.panel-body -->
                                    </div>
                                    <!-- /.panel -->

                                </div>
                            </div>
                        </form>
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