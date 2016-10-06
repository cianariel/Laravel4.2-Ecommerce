<div class="col-xs-12 activity-item">
    <div class="col-xs-3 text-right">
        <span class="time grey lightfont">3 months ago</span>
        <div class="pull-right activity-tags">
            <div class="favorite white-bg relative"><i class="m-icon--heart-solid pink"></i></div>
            <div class="comment white-bg"><i class="m-icon--buble blue"></i></div>
        </div>
    </div>
    <div class="feed-content col-xs-9 radius-5">
        <div class="feed-header">
            <div class="row">
                <div class="col-xs-12">
                    <div class="pull-left name-time">
                        <!-- ngIf: item['Type']=='comment' -->
                        <!-- ngIf: item['Type']!='comment' --><span ng-if="item['Type']!='comment'" class="ng-scope"> Liked</span><!-- end ngIf: item['Type']!='comment' -->
                    </div>
                </div>
            </div>
        </div>
        <div class="feed-body">
            <div class="row">
                <div class="col-xs-3 no-padding">
                    <img class="radius-5" ng-src="https://d3f8t323tq9ys5.cloudfront.net/uploads/2016/03/2016-03-30-SpeakerSystems_380.jpg">
                </div>

                <div ng-class="item['Type'] =='heart' ? 'col-xs-12':'col-xs-12'" class="col-xs-9">
                    <a href="https://staging.ideaing.com/ideas/?p=6683" target="_blank" class="ng-binding">How the August Smart Doorbell Cam Makes My Life Simpler &amp; Safer</a>
                    <p>
                        Epic sale happening right now of all Apple devices in the 2015 Festive season across the boards!
                    </p>
                    <div class="col-xs-12 no-padding">
                        <div class="pull-left activity-stats">
                            <span class="favorite white pink-bg radius-5"><i class="m-icon--heart-solid white"></i> 5</span>
                            <span class="comment black pale-grey-bg radius-5"><i class="m-icon--buble blue"></i> 0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>