<link href="/assets/admin/vendor/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet"
      type="text/css"/>
<script src="/assets/js/vendor/textAngular-sanitize.min.js"></script>
<script src="/assets/js/vendor/angular-confirm.js"></script>
<script src="/assets/js/vendor/textAngular-rangy.min.js"></script>
<script src="/assets/js/vendor/textAngular.min.js"></script>
<style>
    .ta-editor {
        min-height: 100px;
        height: auto;
        overflow: auto;
        font-family: inherit;
        font-size: 100%;
        border: double;
        color: black;
        padding: 4px;
    }
</style>
<section class="comments" id="comments">
    <div class="container">

<input type="hidden" ng-init="userId='<?php echo $userData['id']?>'">
        <input type="hidden" ng-init="isAdmin='<?php echo $isAdminForEdit?>'">
        <div ng-init="getCommentsForProduct(<?php echo $productId?>)">
            <h4><?php echo "{{ commentsCountView }}" ?></h4>
            <div ng-repeat="comment in comments">
                <div class="single-comment">
                    <div class="col-md-1 col-sm-2 col-xs-3 comment-author">
                        <!--<a class="author" href="#"></a>-->
                        <img ng-src="<?php echo "{{ comment.Picture }}"?>" width="50px">


                        <div><b class="comment-name"><?php echo "{{ comment.UserName }}" ?></b></div>
                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-7">
                        <p>
                        <div ng-bind-html="comment.Comment"></div>

                        </p>
                        <time> <?php echo "{{ comment.PostTime }}"?></time>

                        <button ng-show="(comment.UserId == userId)  || (isAdmin == 1)"
                                data-ng-click="editComment(comment)"
                                uib-tooltip="Edit"
                                class="btn btn-info btn-circle"
                                type="button">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button ng-show="(comment.UserId == userId)  || (isAdmin == 1)"
                                data-ng-click="deleteCommentForProduct(comment.CommentId)"
                                confirm="Are you sure to delete this product ?"
                                confirm-settings="{size: 'sm'}"
                                uib-tooltip="Delete"
                                class="btn btn-danger btn-circle"
                                type="button">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <?php
        //dd($userData['email'],);
        if(!empty($userData['email']))
        { ?>

        <section class="add-comment">
            <div class="single-comment">
                <div class="col-md-1 col-sm-2 col-xs-3 comment-author">
                  <!--  <a class="author" href="#"></a> -->
                    <img width="50px" src="<?php echo isset($userData['medias'][0]['media_link']) ? $userData['medias'][0]['media_link']: "" ?>">

                </div>
                <div class="">

                    <div class="form-group">
                        <label class="col-md-2 control-label">Description:
                        </label>
                        <div class="col-md-10">
                            <div text-angular data-ng-model="htmlContent" ta-disabled='disabled'
                                 name="description-editor"
                                 ta-text-editor-class="border-around ta-editor"
                                 ta-html-editor-class="border-around ta-editor">
                            </div>
                        </div>
                    </div>

                    <div class="pull-right comment-controls">
                        <button class="btn btn-info" ng-hide="isEdit"
                                ng-click="addCommentForProduct(<?php echo $userData['id'] . "," . $productId . "," . "'$permalink'" . "," . "htmlContent"?>)">
                            Post
                        </button>
                        <button class="btn btn-info" ng-show="isEdit"
                                ng-click="updateCommentForProduct()">
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <?php } ?>
    </div>
</section>
