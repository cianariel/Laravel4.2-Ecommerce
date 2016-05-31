@extends('layouts.admin')

@section('content')

    <div class="page-content-wrapper">


        <div class="page-content">
            <!-- BEGIN PAGE BAR -->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="/admin/dashboard">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>Subscription Report</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <div ng-app="adminApp" data-ng-controller="AdminController" class="row">
                <div class="col-md-12" ng-cloak>
                    {{--<form role="form" name="myForm" enctype="multipart/form-data"
                          class="form-horizontal form-row-seperated">--}}

                    <div class="portlet">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-shopping-cart"></i>Add / Update Product
                            </div>
                            <div class="actions btn-set">
                                <!-- button -->

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
                            <div class="form-body">
                                <div class="row widget-row">
                                    <div class="col-md-3" ng-init="loadSubscriptionReport()">
                                        <!-- BEGIN WIDGET THUMB -->
                                        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                                            <h4 class="widget-thumb-heading">Subscribed User Info</h4>
                                            <div class="widget-thumb-wrap">
                                                <i class="widget-thumb-icon bg-green icon-bulb"></i>
                                                <div class="widget-thumb-body">
                                                    <span class="widget-thumb-subtitle">Pop Up</span>
                                                    <span class="widget-thumb-body-stat" data-counter="counterup"
                                                          ng-bind='reportData["subscribe-popup"]'>0</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- END WIDGET THUMB -->
                                    </div>
                                    <div class="col-md-3">
                                        <!-- BEGIN WIDGET THUMB -->
                                        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                                            <h4 class="widget-thumb-heading">Subscribed User Info</h4>
                                            <div class="widget-thumb-wrap">
                                                <i class="widget-thumb-icon bg-green icon-bulb"></i>
                                                <div class="widget-thumb-body">
                                                    <span class="widget-thumb-subtitle">Ideas</span>
                                                    <span class="widget-thumb-body-stat" data-counter="counterup"
                                                          ng-bind='reportData["subscribe-ideas"]'>0</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- END WIDGET THUMB -->
                                    </div>
                                    <div class="col-md-3">
                                        <!-- BEGIN WIDGET THUMB -->
                                        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                                            <h4 class="widget-thumb-heading">Subscribed User Info</h4>
                                            <div class="widget-thumb-wrap">
                                                <i class="widget-thumb-icon bg-green icon-bulb"></i>
                                                <div class="widget-thumb-body">
                                                    <span class="widget-thumb-subtitle">Footer</span>
                                                    <span class="widget-thumb-body-stat" data-counter="counterup"
                                                          ng-bind='reportData["subscribe-footer"]'>0</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- END WIDGET THUMB -->
                                    </div>
                                    <div class="col-md-3">
                                        <!-- BEGIN WIDGET THUMB -->
                                        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                                            <h4 class="widget-thumb-heading">Subscribed User Info</h4>
                                            <div class="widget-thumb-wrap">
                                                <i class="widget-thumb-icon bg-green icon-bulb"></i>
                                                <div class="widget-thumb-body">
                                                    <span class="widget-thumb-subtitle">Total</span>
                                                    <span class="widget-thumb-body-stat" data-counter="counterup"
                                                          ng-bind='reportData["subscribe-total"]'>0</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- END WIDGET THUMB -->
                                    </div>
                                </div>
                                <div class="row widget-row">
                                    <div class="col-md-3">
                                        <!-- BEGIN WIDGET THUMB -->
                                        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                                            <h4 class="widget-thumb-heading">Registered User Info</h4>
                                            <div class="widget-thumb-wrap">
                                                <i class="widget-thumb-icon bg-blue-steel icon-badge"></i>
                                                <div class="widget-thumb-body">
                                                    <span class="widget-thumb-subtitle">Normal</span>
                                                    <span class="widget-thumb-body-stat" data-counter="counterup"
                                                          ng-bind='reportData["register-direct"]'>0</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- END WIDGET THUMB -->
                                    </div>
                                    <div class="col-md-3">
                                        <!-- BEGIN WIDGET THUMB -->
                                        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                                            <h4 class="widget-thumb-heading">Registered User Info</h4>
                                            <div class="widget-thumb-wrap">
                                                <i class="widget-thumb-icon bg-blue-steel icon-badge"></i>
                                                <div class="widget-thumb-body">
                                                    <span class="widget-thumb-subtitle">facebook</span>
                                                    <span class="widget-thumb-body-stat" data-counter="counterup"
                                                          ng-bind='reportData["register-facebook"]'>0</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- END WIDGET THUMB -->
                                    </div>
                                    <div class="col-md-3">
                                        <!-- BEGIN WIDGET THUMB -->
                                        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                                            <h4 class="widget-thumb-heading">Registered User Info</h4>
                                            <div class="widget-thumb-wrap">
                                                <i class="widget-thumb-icon bg-blue-steel icon-badge"></i>
                                                <div class="widget-thumb-body">
                                                    <span class="widget-thumb-subtitle">Total</span>
                                                    <span class="widget-thumb-body-stat" data-counter="counterup"
                                                          n++g-bind='reportData["register-total"]'>0</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- END WIDGET THUMB -->
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- </form>--}}
                </div>
            </div>
        </div>
    </div>

@stop


