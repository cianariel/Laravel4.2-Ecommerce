<div id="myModal" class="modal login-signup-modal ">
    <div class="login-signup-modal">

        <section class="four-sections">
            <div class="container no-padding">
                <div class="col-sm-3 col-xs-6 category-block category-smart-travel hover-zoom overhide">
                    <div class="box-item__overlay category-bg"></div>
                    <img class="img-responsive" src="/assets/images/login-signup/signup-0.jpg">
                </div>
                <div class="col-sm-3 col-xs-6 category-block category-smart-body hover-zoom overhide">
                    <div class="box-item__overlay category-bg"></div>
                    <img class="img-responsive" src="/assets/images/login-signup/signup-1.jpg">
                </div>
                <div class="col-sm-3 col-xs-6 category-block category-smart-home hover-zoom overhide">
                    <div class="box-item__overlay category-bg"></div>
                    <img class="img-responsive" src="/assets/images/login-signup/signup-2.jpg">
                </div>
                <div class="col-sm-3 col-xs-6 category-block category-smart-entertainment hover-zoom overhide">
                    <div class="box-item__overlay category-bg"></div>
                    <img class="img-responsive" src="/assets/images/login-signup/signup-4.jpg">
                </div>
            </div>
        </section>

        <section class="row  pale-grey-bg">
            <div class="container text-center padding-40">
                <h1>Create a Free Account</h1>
                <h4 class="grey">Join Indeaing to live smarter</h4>
            </div>
        </section>

        <section class="row">
            <div class="container text-center padding-40 form-box relative" ng-app="publicApp" ng-controller="publicController">
                <uib-alert ng-repeat="alert in alerts" type="@{{alert.type}}"
                           close="closeAlert($index)">
                    <p ng-bind-html="alertHTML"></p>
                </uib-alert>

                <section id="signup-modal">
                    <div class="col-sm-6 col-xs-12">
                        <nav class="col-xs-12 login-controls contentable">
                            <a class="btn btn-info col-xs-12" ng-click="registerWithFB()" href="#"><i class="m-icon m-icon--facebook-id"></i>Log in with Facebook</a>
                            <span data-slidein="#login-modal" data-hide=".login-controls" class="btn btn-info col-xs-12 green-bg text-uppercase"><span class="m-icon m-icon--email-form-id white"></span> Log in with Email</span>
                        </nav>
                    </div>

                    <div class="col-sm-6 col-xs-12">
                        <div class="modal-content hero-box qiuck-signup modal-login">
                            <h3 class="text-left">Register</h3>
                            <form class="bordering">
                            <span class="input input--madoka big-wrap">
                                <input class="input__field input__field--madoka" required ng-model="FullName" type="text" id="signup-input-0">
                                <label class="input__label input__label--madoka" for="signup-input-0">
                                    <svg class="graphic graphic--madoka" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none">
                                        <path d="m0,0l404,0l0,77l-404,0l0,-77z"></path>
                                    </svg>
                                    <span class="input__label-content input__label-content--madoka">Name</span>
                                </label>
                            </span>

                            <span class="input input--madoka big-wrap">
                                <input class="input__field input__field--madoka" required  id="signup-input-1"  ng-model="Email" ng-readonly="{{empty($email)?'false':'true'}}" ng-init="Email='{{empty($email)?'':$email}}'" type="text">
                                <label class="input__label input__label--madoka" for="signup-input-1">
                                    <svg class="graphic graphic--madoka" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none">
                                        <path d="m0,0l404,0l0,77l-404,0l0,-77z"></path>
                                    </svg>
                                    <span class="input__label-content input__label-content--madoka">Email</span>
                                </label>
                            </span>
                            <span class="input input--madoka big-wrap">
                                <input class="input__field input__field--madoka" required  id="signup-input-3"  ng-model="Email" ng-readonly="{{empty($email)?'false':'true'}}" ng-init="Email='{{empty($email)?'':$email}}'" type="text">
                                <label class="input__label input__label--madoka" for="signup-input-3">
                                    <svg class="graphic graphic--madoka" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none">
                                        <path d="m0,0l404,0l0,77l-404,0l0,-77z"></path>
                                    </svg>
                                    <span class="input__label-content input__label-content--madoka">Password</span>
                                </label>
                            </span>

                                <div class="modal-minor-text">
                                    <input ng-model="rememberMe" type="checkbox" id="remember" name="remember" ><label for="remember"><span></span> <b class="grey">By Signing up, you agree to <a href="/terms-of-use">TERMS AND CONDITIONS</a> of Ideaing</b>
                                    </label>
                                </div>
                                <a class="btn btn-success col-xs-12" ng-click="registerSubscribedUser()" href="#">
                                    <span class="lamp-wrap">
                                        <span class="m-icon--bulb2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></span>
                                    </span>
                                    <b>Create new account</b>
                                </a>
                            </form>
                        </div>
                    </div>
                </section>

                <section id="login-modal">
                    <div class="modal-content contentable hero-box qiuck-signup modal-login" style="{{(isset($tab) && $tab != 'login') ? 'display: none;' : ''}}">
                            <span class="close-button" data-slidein="#login-modal" data-hide=".login-controls">
                                <i class="m-icon--Close grey"></i>
                            </span>
                        <form class="bordering">
                            <h3 class="text-left">Login</h3>

                                <span class="input input--madoka big-wrap">
                                    <input class="input__field input__field--madoka" required type="text" id="login-input-1"  ng-model="Email" name="email">
                                    <label class="input__label input__label--madoka" for="login-input-1">
                                        <svg class="graphic graphic--madoka" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none">
                                            <path d="m0,0l404,0l0,77l-404,0l0,-77z"></path>
                                        </svg>
                                        <span class="input__label-content input__label-content--madoka">Email</span>
                                    </label>
                                </span>

                                <span class="input input--madoka big-wrap">
                                    <input class="input__field input__field--madoka" required  id="login-input-2"  ng-model="Password" type="password" name="password">
                                    <label class="input__label input__label--madoka" for="login-input-2">
                                        <svg class="graphic graphic--madoka" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none">
                                            <path d="m0,0l404,0l0,77l-404,0l0,-77z"></path>
                                        </svg>
                                        <span class="input__label-content input__label-content--madoka">Password</span>
                                    </label>
                                </span>

                            <a class="btn btn-success col-xs-12" ng-click="loginUser('home')" href="#">
                                    <span class="lamp-wrap">
                                        <span class="m-icon--bulb2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></span>
                                    </span>
                                <b>Log in</b>
                            </a>
                            <div class="modal-minor-text">
                                <a class="forgot" ng-click="passwordResetRequest()" href="#">Forgot password?</a>
                            </div>

                        </form>
                    </div>
                </section>
            </div>
        </section>


        <section class="row to-home">
            <div class="container text-center padding-40">
                <a href="/">
                    <span class="m-icon--bulb2 center-block"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></span>
                </a>
                <h4 class="grey"><a href="/">HOME</a></h4>
            </div>
        </section>
    </div>
     <span class="close-button close-modal" data-dismiss="modal">
            <i class="m-icon--Close"></i>
    </span>
</div>
