<script type="text/ng-template" id="subscribe_email_popup.html">
    <div id="subscribe_email_popup" class="ns-effect-genie ns-hide relative">
        <div id="publicApp">
            <div class="col-sm-6 col-xs-12 hidden-xs img-holder no-padding">
                <h4 class="white relative"><span>Subscribe to the most unique community centered on Living Smarter</span></h4>
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
                <ul class="why-join">
                    <li><i class="m-icon m-icon--deals pink"></i> Exclusive coupons and deals on the smartest gadgets</li>
                    <li><i class="m-icon m-icon--video green"></i> Be eligible for to win free smart gadgets</li>
                    <li><i class="m-icon m-icon--bulb-detailed-on-rating blue"></i> Stories and tips on transforming how you live + play</li>
                </ul>
                <strong class="red"><?php echo '{{ responseMessage }}' ?></strong>
                <div class="content-register">

                    <span class="password-input-holder bordering">
                        <label class="input__label input__label--madoka">
                            <svg class="graphic graphic--madoka" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none">
                                <path d="m0,0l404,0l0,77l-404,0l0,-77z"></path>
                            </svg>
                            <input class="form-control not-rounded input__field--madoka" placeholder="Password" type="text">
                        </label>

                        <label class="input__label input__label--madoka">
                            <svg class="graphic graphic--madoka" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none">
                                <path d="m0,0l404,0l0,77l-404,0l0,-77z"></path>
                            </svg>
                             <input class="form-control not-rounded pull-right input__field--madoka" placeholder="Confirm" type="text">
                        </label>
                    </span>

                    <span class="email-input-holder bordering">
                                <i class="m-icon m-icon--email-form-id black"></i>
                                <label class="input__label input__label--madoka">
                                    <svg class="graphic graphic--madoka" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none">
                                    <path d="m0,0l404,0l0,77l-404,0l0,-77z"></path>
                                    </svg>
                                   <input class="form-control not-rounded input__field--madoka" ng-model="data.SubscriberEmail" placeholder="me@email.com" type="text">
                               </label>
                        </span>
                    <a class="btn btn-success form-control not-rounded" ng-click="registerSubscribedUser()">Join and Create a Free account</a>
                </div>
                <div class="content-subscribe hidden-soft">
                    <strong class="red"><?php echo '{{ responseMessage }}' ?></strong>
                         <span class="email-input-holder ">
                                <i class="m-icon m-icon--email-form-id black"></i>
                               <input class="form-control not-rounded" placeholder="me@email.com"
                                      type="text">
                        </span>
                    <a class="btn btn-success form-control not-rounded"  ng-click="subscribe(data,'popup')">Join</a>
                </div>
            </div>
            <footer class="black-footer relative black-bg full-wide text-right white overhide"><b   ng-click="hideAndForget()">Maybe Later <i class="m-icon--Close white"></i></b></footer>
        </div>
    </div>

</script>