<section class="comments" id="comments">
    <div class="container">
        <h4>211 Comments</h4>

        <div class="single-comment">
            <div class="col-md-1 col-sm-2 col-xs-3 comment-author">
                <a class="author" href="#"></a>

                <div><b class="comment-name">Carrie</b></div>
            </div>
            <div class="col-md-8 col-sm-8 col-xs-7">
                <p>
                    Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit
                    laboriosam, nisi ut aliquid ex ea commodi consequatur?
                </p>
                <time>August 2015</time>
            </div>
        </div>

        <section class="add-comment">
            <div class="single-comment">
                <div class="col-md-1 col-sm-2 col-xs-3 comment-author">
                    <a class="author" href="#"></a>
                </div>
                <div class="col-xs-8">

                    <div  class="form-control" name="comment" id="you-comment" text-angular data-ng-model="htmlContent"
                         name="description-editor"
                         ta-text-editor-class="border-around ta-editor"
                         ta-html-editor-class="border-around ta-editor">
                    </div>

                   {{-- <div class="pull-right comment-controls">
                        <a href="#" class="add-photo"><i class="m-icon m-icon--camera"></i> Add a photo</a>
                        <button class="btn btn-info">Post</button>
                    </div>--}}
                </div>
            </div>
        </section>
    </div>
</section>
<script src="/assets/js/vendor/textAngular-sanitize.min.js"></script>
<script src="/assets/js/vendor/angular-confirm.js"></script>
<script src="/assets/js/vendor/textAngular-rangy.min.js"></script>
<script src="/assets/js/vendor/textAngular.min.js"></script>
