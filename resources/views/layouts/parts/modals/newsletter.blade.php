<script type="text/ng-template" id="subscribe_email_popup.html">
    <div id="subscribe_email_popup" class="ns-effect-genie ns-hide relative">
        <div ng-app="publicApp" ng-controller="publicController" class="ng-scope">
            <div class="col-sm-6 col-xs-12 hidden-xs img-holder no-padding">
                <h4 class="white relative overhide"><span>Subscribe to the most unique community centered on Living Smarter</span></h4>
                <div class="seen-on col-xs-12 absolute">
                    <span class="caption"><b class="white">As seen on:</b></span>
                    <span class="media-logo haffington-logo">Huffington post</span>
                    <span class="media-logo entrepreneur-logo">Entrepreneur</span>
                    <span class="media-logo lifehack-logo">Lifehack</span>
                </div>
                <img class="img-responsive full-wide col-sm-6 col-xs-12 no-padding" src="/assets/images/newsletter-popup/newsletter-popup.jpg">
            </div>
            <div class="col-sm-6 col-xs-12 content-holder pale-grey-bg">
                <div class="col-xs-12 toggles center-block">
                    <div class="swing-lined col-xs-6 no-padding active grey" data-toggle=".content-register" data-hide=".content-subscribe"><span><b>Register</b></span></div>
                    <div class="swing-lined col-xs-6 no-padding pull-right grey"  data-toggle=".content-subscribe" data-hide=".content-register"><span><b>Email Only</b></span></div>
                </div>

                <div class="content-register bordering">
                    <ul class="why-join">
                        <li><i class="m-icon m-icon--deals pink"></i> Exclusive coupons and deals on the smartest gadgets</li>
                        <li><i class="m-icon m-icon--video green"></i> Be eligible for to win free smart gadgets</li>
                        <li><i class="m-icon m-icon--bulb-detailed-on-rating blue"></i> Stories and tips on transforming how you live + play</li>
                    </ul>
                    <section class="content">
                        <span class="input input--madoka big-wrap">
                            <input class="input__field input__field--madoka" required type="text" id="input-30" ng-model="FullName">
                            <label class="input__label input__label--madoka" for="input-30">
                                <svg class="graphic graphic--madoka" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none">
                                    <path d="m0,0l404,0l0,77l-404,0l0,-77z"></path>
                                </svg>
                                <span class="input__label-content input__label-content--madoka">Name</span>
                            </label>
                        </span>
                        <span class="input input--madoka big-wrap">
                            <input class="input__field input__field--madoka" required type="text" id="input-31" ng-model="Email">
                            <label class="input__label input__label--madoka" for="input-31">
                                <svg class="graphic graphic--madoka" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none">
                                    <path d="m0,0l404,0l0,77l-404,0l0,-77z"></path>
                                </svg>
                                <span class="input__label-content input__label-content--madoka">Email</span>
                            </label>
                        </span>
                        <span class="input input--madoka password-wrap">
                            <input class="input__field input__field--madoka" required type="password" id="input-32" ng-model="Password">
                            <label class="input__label input__label--madoka" for="input-32">
                                <svg class="graphic graphic--madoka" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none">
                                    <path d="m0,0l404,0l0,77l-404,0l0,-77z"></path>
                                </svg>
                                <span class="input__label-content input__label-content--madoka">Password</span>
                            </label>
                        </span>
                        <span class="input input--madoka confirm-wrap">
                            <input class="input__field input__field--madoka" required type="password" id="input-33" ng-model="PasswordConf">
                            <label class="input__label input__label--madoka" for="input-33">
                                <svg class="graphic graphic--madoka" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none">
                                    <path d="m0,0l404,0l0,77l-404,0l0,-77z"></path>
                                </svg>
                                <span class="input__label-content input__label-content--madoka">Confirm</span>
                            </label>
                        </span>
                    </section>

                    <a class="btn btn-success form-control" ng-click="registerSubscribedUser()">Join and Create a Free account</a>

                    <uib-alert ng-repeat="alert in alerts" type="@{{alert.type}}" close="closeAlert($index)">
                        <strong class="red alertme" ng-bind-html="alertHTML"></strong>
                    </uib-alert>
                </div>

                <div class="content-subscribe bordering hidden-soft">
                    <ul class="why-join">
                        <li  class="greyscale"><i class="m-icon m-icon--deals pink"></i> Exclusive coupons and deals on the smartest gadgets</li>
                        <li  class="greyscale"><i class="m-icon m-icon--video green"></i> Be eligible for to win free smart gadgets</li>
                        <li><i class="m-icon m-icon--bulb-detailed-on-rating blue"></i> Stories and tips on transforming how you live + play</li>
                    </ul>
                    <section class="content"> 
                        <span class="input input--madoka big-wrap">
                            <input class="required input__field input__field--madoka" ng-model="data.SubscriberEmail" required type="text" id="input-34">
                            <label class="input__label input__label--madoka" for="input-34">
                                <svg class="graphic graphic--madoka" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none">
                                    <path d="m0,0l404,0l0,77l-404,0l0,-77z"></path>
                                </svg>
                                <span class="input__label-content input__label-content--madoka">Email</span>
                            </label>
                        </span>

                    </section>
                    <a class="btn btn-success form-control"  ng-click="subscribe(data,'popup')">Join</a>
                    <strong class="red alertme"><?php echo '{{ responseMessage }}' ?></strong>
                </div>
                <footer class="black-footer relative full-wide text-right white overhide"><b   ng-click="hideAndForget()">Maybe Later <i class="m-icon--Close grey"></i></b></footer>
            </div>
            <footer class="black-footer relative full-wide text-right white overhide"><b   ng-click="hideAndForget()">Maybe Later <i class="m-icon--Close grey"></i></b></footer>

        </div>
    </div>

</script>