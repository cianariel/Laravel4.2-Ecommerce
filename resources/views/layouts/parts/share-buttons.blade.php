        <li class="all-shares"><b class="share-count all"></b><br/>all <span class="hidden-620">shares</span></li>
        <li><a data-service="facebook" class="fb" href="#" ng-click="openSharingModal('facebook')"><i class="m-icon m-icon--facebook-id"></i> <b class="fb share-count"></b></a></li>
        <li><a data-service="twitter"  class="twi" href="#" ng-click="openSharingModal('twitter')"><i class="m-icon  m-icon--twitter-id"></i> <b class="twi share-count"></b></a></li>
        <li><a data-service="googleplus"  class="gp" href="#"  ng-click="openSharingModal('googleplus')"><i class="m-icon m-icon--google-plus-id"></i> <b class="gp share-count"></b></a></li>
        <li><a data-service="pinterest"  class="pint" href="#" ng-click="openSharingModal('pinterest')"><i class="m-icon  m-icon--pinterest-id"></i> <b class="pint share-count"></b></a></li>

        <?php
          if(function_exists('is_single')){
              $theTitle = get_the_title();
          }else{
              $theTitle = '';
          }
        ?>

        <li class="email-wrap"><a  class="email" href="mailto:?subject=Check this out: <?php echo $theTitle ?>&amp;body=Check  this out on IDEAING: <?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>" href="#" ><i class="m-icon m-icon--email-form-id"></i></a></li>
