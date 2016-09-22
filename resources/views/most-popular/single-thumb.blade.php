<div class="popular-wrap single-thumb white-bg no-padding relative">
        <div ng-if="item.type == 'product'" class="box-item product-box overhide">
            <a href="/product/@{{item.product_permalink}}" >
                <img class="img-responsive" src="@{{ item.media_link_full_path }}">
            </a>
            <a href="/product/@{{item.product_permalink}}" class="category-@{{item.master_category}}">
               <!-- <div class="box-item__overlay category-bg opaque"></div> -->
            </a>

        </div>
        <div ng-if="item.type == 'product'" class="popular-title col-xs-12">
            <a href="/product/@{{item.product_permalink}}" class="black" itemprop="name"><span><b>@{{item.product_name}}</b></span></a>

            <div class="views absolute">
                <i class="m-icon m-icon--flame black"></i>
                <span class="ng-binding"> <b>@{{item.count}}</b></span>
            </div>
        </div>

        <div ng-if="item.type == 'idea'" class="box-item overhide">
            <a href="@{{item.url}}">
                    <img alt="@{{item.feed_image.alt}}" title="@{{item.feed_image.title}}"
                         src="@{{item.feed_image.url}}">
            </a>
            <a href="/product/@{{item.url}}" class="box-item__label" itemprop="name"><span>@{{item.title}}</span></a>
            <a href="@{{item.url}}" class="category-@{{item.category_main}}">
                <div class="box-item__overlay category-bg opaque"></div>
            </a>
        </div>
        <div ng-if="item.type == 'idea'" class="social-stats__item views center-block">
            <i class="m-icon m-icon--flame pink"></i>
            <span class="social-stats__text ng-binding">@{{item.views}} views</span>
        </div>
</div>