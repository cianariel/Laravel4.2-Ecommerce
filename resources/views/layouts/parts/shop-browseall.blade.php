            <nav id="all-shop-menu" class="shop-menu hidden-soft ">
                <div class="container full-sm">
                    <section class="col-xs-4 shop-by-category" >
                        <p class="title"><a href="/shop/">Shop by Category</a></p>
                        @foreach($categoryTree as $name => $unused)
                            <div class="link-row">
                                <a href="/shop/{{$name}}">{{ucfirst(str_replace('-', ' ', $name))}}</a>
                            </div>
                        @endforeach
                    </section>



                            @foreach($categoryTree as $parent => $children)
                                <section class="{{$parent}} col-xs-8 {{$parent != 'smart-home' ? 'hidden' : ''}}">
                                    <div class="col-md-12">
                                        <p class="title"><a href="/shop/{{$parent}}">{{ucfirst(str_replace('-', ' ', $parent))}}</a></p>
                                        @foreach($children as $child)
                                            <div class="col-sm-4 link-row"><a href="/shop/{{$parent}}/{{$child->extra_info}}">{{$child->category_name}}</a></div>
                                        @endforeach
                                    </div>
                                </section>
                            @endforeach
                </div>
            </nav>

        