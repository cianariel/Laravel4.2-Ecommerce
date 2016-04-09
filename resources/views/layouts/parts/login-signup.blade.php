<div id="myModal" class="modal login-signup-modal col-sm-7 col-sm-9 col-xs-12 col-offset-md-2">


    <div class="modal-intro contentable">
        <a class="logo" href="/">
                <i class="m-icon m-icon--logo-with-text-blues">
                <span class="path1"></span><span class="path2"></span><span class="path3"></span><span
                        class="path4"></span><span class="path5"></span><span class="path6"></span><span
                        class="path7"></span><span class="path8"></span><span class="path9"></span><span
                        class="path10"></span><span class="path11"></span><span class="path12"></span><span
                        class="path13"></span><span class="path14"></span><span class="path15"></span><span
                        class="path16"></span><span class="path17"></span><span class="path18"></span><span
                        class="path19"></span><span class="path20"></span><span class="path21"></span><span
                        class="path22"></span><span class="path23"></span><span class="path24"></span><span
                        class="path25"></span><span class="path26"></span><span class="path27"></span><span
                        class="path28"></span><span class="path29"></span><span class="path30"></span><span
                        class="path31"></span><span class="path32"></span><span class="path33"></span><span
                        class="path34"></span><span class="path35"></span><span class="path36"></span><span
                        class="path37"></span><span class="path38"></span><span class="path39"></span><span
                        class="path40"></span>
            </i>

            <i class="m-icon m-icon--WhiteRed">
                <span class="path1"></span><span class="path2"></span><span class="path3"></span><span
                        class="path4"></span><span class="path5"></span><span class="path6"></span><span
                        class="path7"></span><span class="path8"></span><span class="path9"></span><span
                        class="path10"></span><span class="path11"></span><span class="path12"></span><span
                        class="path13"></span><span class="path14"></span><span class="path15"></span><span
                        class="path16"></span><span class="path17"></span><span class="path18"></span><span
                        class="path19"></span><span class="path20"></span><span class="path21"></span><span
                        class="path22"></span><span class="path23"></span><span class="path24"></span><span
                        class="path25"></span><span class="path26"></span><span class="path27"></span><span
                        class="path28"></span><span class="path29"></span><span class="path30"></span><span
                        class="path31"></span><span class="path32"></span><span class="path33"></span><span
                        class="path34"></span><span class="path35"></span><span class="path36"></span><span
                        class="path37"></span><span class="path38"></span><span class="path39"></span><span
                        class="path40"></span>
            </i>

        </a>

        <p>Join <b>Ideaing</b> to get tips on transforming your home to a Smart Home. Plus share photos of your home,
            engage with others, and earn rewards for being part of of the best platform on smart home & interior design.
        </p>



    </div>


    <div ng-app="publicApp" ng-controller="publicController">
        <div>
            <uib-alert ng-repeat="alert in alerts" type="@{{alert.type}}"
                       close="closeAlert($index)">
                <p ng-bind-html="alertHTML"></p>
            </uib-alert>
        </div>
        <nav class="col-xs-12 login-controls contentable">
            <span data-toggle="#login-modal" data-hide="#signup-modal" class="col-xs-6 active">Log in</span>
            <span data-toggle="#signup-modal" data-hide="#login-modal" class="col-xs-6">Sign up</span>
        </nav>
        <div id="login-modal" class="modal-content contentable hero-box qiuck-signup modal-login">
            <form>
                <a class="btn btn-info col-xs-12"  ng-click="registerWithFB()" href="#"><i class="icon fb-icon"></i>Log in with Facebook</a>
                <div class="line-wrap modal-minor-text">or</div>

                <input class="form-control" ng-model="Email" type="text" placeholder="Email" name="email">
                <input class="form-control" ng-model="Password" type="password" placeholder="Password" name="password">
                <div class="modal-minor-text">
                    <input type="checkbox"  ng-model="rememberMe"  id="remember" name="remember"><label for="remember"><span></span>Remember me
                    </label>
                </div>

                <a class="btn btn-success col-xs-12" ng-click="loginUser()" href="#">Log in</a>

                <div class="modal-minor-text">
                    <a class="forgot" ng-click="passwordResetRequest()" href="#">Forgot password?</a>
                </div>

            </form>
        </div>
        <div id="signup-modal" style="display: none" class="modal-content hero-box qiuck-signup modal-login">
            <form>
                <a class="btn btn-info col-xs-12" ng-click="registerWithFB()" href="#"><i class="fa fa-facebook"></i>Sign
                    up with Facebook</a>
                <div class="line-wrap modal-minor-text">or</div>

                <input class="form-control" ng-model="FullName" type="text" placeholder="Name" >
                <input class="form-control" ng-model="Email" type="text" placeholder="Email" >
                <input class="form-control" ng-model="Password" type="password" placeholder="Password" >
                <input class="form-control" ng-model="PasswordConf" type="password" placeholder="Retype Password" >

                <a class="btn btn-success col-xs-12" ng-click="registerUser()" href="#">Sign up</a>

            </form>
        </div>
    </div>
    <span class="close-button" data-dismiss="modal">
        <i class="m-icon--Close"></i>
    </span>
</div>
