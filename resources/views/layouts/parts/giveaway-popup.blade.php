<?php
    if(!isset($theGiveAway)){
        if(!function_exists('is_single')){
            $theGiveAway = PageHelper::getCurrentGiveaway();
        }else{
            $json = file_get_contents('http://ideaing.dev/api/giveaway/get-current');
            $theGiveAway = json_decode($json);
        }
    }
   if(@$theGiveAway->showPopup){
?>


<div id="giveaway-popup" class="col-xs-12 hidden-soft">
     <span class="close-button close-login" data-toggle="#giveaway-popup">
        <i class="m-icon--Close"></i>
    </span>

    <h4>Ideaing Giveaway</h4>



    <a href="/giveaway/<?php echo $theGiveAway->giveaway_permalink ?>">
        <img src="<?php echo $theGiveAway->giveaway_image ?>" title="<?php echo $theGiveAway->giveaway_image_title ?>" class="col-xs-2 center-block img-responsive" alt="<?php echo $theGiveAway->giveaway_image_alt ?>" />
    </a>

    <h5>
        <a class="white" href="/giveaway/<?php echo $theGiveAway->giveaway_permalink ?>">
            <?php echo $theGiveAway->giveaway_title ?>
        </a>
    </h5>

</div>

<?php } ?>