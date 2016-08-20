@if(@$item->product_name) <!-- this is a product -->
<div class="box-item product-box">
    <a href="/product/{{$item->product_permalink}}" >
        <img class="img-responsive" src="{{ $item->media_link_full_path }}">
    </a>
    <a href="{{$item->product_permalink}}" class="category-{{$item->master_category}}">
        <div class="box-item__overlay category-bg"></div>
    </a>
</div>
@else
    <div class="box-item">
        <a href="{{$item->url}}">
            @if(is_array(@$item->feed_image))
                <img alt="{{@$item->feed_image['alt']}}" title="{{@$item->feed_image['title']}}"
                     src="{{ @$item->feed_image['url']}}">
            @else
                <img alt="{{@$item->feed_image->alt}}" title="{{@$item->feed_image->title}}"
                     src="{{@$item->feed_image->url}}">
            @endif
        </a>
        <a href="{{$item->url}}" class="category-{{$item->category_main}}">
            <div class="box-item__overlay category-bg"></div>
        </a>
    </div>
@endif