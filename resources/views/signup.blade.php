@extends('layouts.signup-layout')

@section('content')

    <img style="margin-left:40%" class="img-responsive " alt="" src="/assets/images/ideaing-logo-small.png">

    <div ng-app="publicApp" ng-controller="publicController"
         class="col-lg-4" style="float: none;
    display: block;
    margin-left: auto;
    margin-right: auto;">

        <div style="margin-top: 45px">

            <label for="email"><h2>Ideaing - Registration Form:</h2></label>
            <div class="row">
                <div>

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

            <form role="form">
                <div class="form-group">
                    <label for="email">Name:</label>
                    <input type="text" class="form-control" ng-model="FullName" placeholder="Enter Name" id="name">
                </div>
                <div class="form-group">
                    <label for="email">Email address:</label>
                    <input type="email" ng-model="Email" ng-init="Email='{{$email}}'" placeholder="Enter Email"
                           class="form-control"
                           id="email">
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" ng-model="Password" placeholder="Enter Password" class="form-control" id="pwd">
                </div>
                <div class="form-group">
                    <label for="pwd">Password Confirmation:</label>
                    <input type="password"  ng-model="PasswordConf" placeholder="Retype Password" class="form-control" id="pwd">
                </div>
                <div class="form-group">
                    <button type="submit" ng-click="registerUser()" class="btn btn-default">
                        <i class="fa fa-paper-plane"></i>
                        Register
                    </button>
                    <button type="submit" ng-click="registerWithFB()" class="btn btn-success">
                        <i class="fa fa-facebook"></i>
                        Register with Facebook
                    </button>
                </div>

            </form>
        </div>
    </div>
    <script src="/assets/js/angular-custom/public.common.js"></script>
@stop

