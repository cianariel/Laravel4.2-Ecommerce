<div class="popular-wrap single-thumb">
    @if(@$item->product_name) <!-- this is a product -->
        <div class="box-item product-box overhide">
            <a href="/product/{{$item->product_permalink}}" >
                <img class="img-responsive" src="{{ $item->media_link_full_path }}">
            </a>
            <a href="/product/{{$item->product_permalink}}" class="category-{{$item->master_category}}">
                <div class="box-item__overlay category-bg opaque"></div>
            </a>
            <a href="/product/{{$item->product_permalink}}" class="box-item__label" itemprop="name">{{$item->product_name}}</a>
        </div>
        <div class="social-stats__item views center-block">
            <i class="m-icon m-icon--flame pink"></i>
            <span class="social-stats__text ng-binding"> {{$item->count}} views</span>
        </div>
    @else
        <div class="box-item overhide">
            <a href="{{$item->url}}">
                @if(is_array(@$item->feed_image))
                    <img alt="{{@$item->feed_image['alt']}}" title="{{@$item->feed_image['title']}}"
                         src="{{ @$item->feed_image['url']}}">
                @else
                    <img alt="{{@$item->feed_image->alt}}" title="{{@$item->feed_image->title}}"
                         src="{{@$item->feed_image->url}}">
                @endif
            </a>
            <a href="{{$item->url}}" class="box-item__label" itemprop="name">{{$item->title}}</a>
            <a href="/product/{{$item->url}}" class="box-item__label" itemprop="name">{{$item->title}}</a>
            <a href="{{$item->url}}" class="category-{{$item->category_main}}">
                <div class="box-item__overlay category-bg opaque"></div>
            </a>
        </div>
        <div class="social-stats__item views center-block">
            <i class="m-icon m-icon--flame pink"></i>
            <span class="social-stats__text ng-binding">{{$item->views}} views</span>
        </div>
    @endif
</div>