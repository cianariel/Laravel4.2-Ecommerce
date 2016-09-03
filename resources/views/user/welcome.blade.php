@extends('layouts.main')

@section('body-class'){{ 'aboutus-page' }}@stop

@section('content')

<section>
    <article id="weclome-page">
        <section class="row">
            <div class="container">
                <div class="center-block">
                    <span class="m-icon--bulb2">
                        <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span>
                    </span>
                </div>
                <h1>Welcome to the<br/> family</h1>
            </div>
        </section>

        <section class="row pink-bg">
            <div class="container">
                <p>Ideaing was designed to help change the way you live. To live smarter.           Our team & community are here to provide the most interesting stories, best how-to tips, and surface the most amazing smart gadgets. </p>
            </div>
        </section>

        <section class="four-sections">
            <div class="container no-padding">
                <div class="col-sm-6 col-xs-12 category-block category-smart-home">
                    <div class="z-wrap relative">
                        <span class="m-icon m-icon--smart-home"></span>
                        <h3>Shart Home</h3>
                        <p>Improve your home security, lighting, and automation for smarter living.</p>
                        <a class="learn-more white box-link category-bg">Learn more</a>
                        <br/>
                        <a href="/smart-home" class="shop-now white">Shop now</a>
                    </div>
                    <div class="box-item__overlay category-bg"></div>
                </div>
                <div class="col-sm-6 col-xs-12 category-block category-smart-body">
                    <div class="z-wrap relative">
                        <span class="m-icon m-icon--wearables"></span>
                        <h3>Shart Body</h3>
                        <p>Increase your performance, or simply stay fashionable while connected.</p>
                        <a href="/smart-body" class="learn-more white box-link category-bg">Learn more</a>
                        <br/>
                        <a class="shop-now white">Shop now</a>
                    </div>

                    <div class="box-item__overlay category-bg"></div>
                </div>
                <div class="col-sm-6 col-xs-12 category-block category-smart-travel">
                    <div class="z-wrap relative">
                        <span class="m-icon m-icon--travel"></span>
                        <h3>Shart Travel</h3>
                        <p>Stay connected and fully charged with smart luggage, bags, and gadgets.</p>
                        <a href="/smart-travel" class="learn-more white box-link category-bg">Learn more</a>
                        <br/>
                        <a class="shop-now white">Shop now</a>
                    </div>

                    <div class="box-item__overlay category-bg"></div>
                </div>
                <div class="col-sm-6 col-xs-12 category-block category-smart-entertainment">
                    <div class="z-wrap relative">
                        <span class="m-icon m-icon--video"></span>
                        <h3>Shart Entertainment</h3>
                        <p>Create the best audio / video entertainment systems for your home.</p>
                        <a href="/smart-entertainment" class="learn-more white box-link category-bg">Learn more</a>
                        <br/>
                        <a class="shop-now white">Shop now</a>
                    </div>

                    <div class="box-item__overlay category-bg"></div>
                </div>
            </div>
        </section>

        <section class="row">
            <div class="container no-padding">
                <div class="col-sm-6 col-xs-12 giveaways">
                    <h3>Giveaways</h3>
                    <p>Freebies are great, aren't they? We almost always have a giveaway going on, so make sure to come back frequently to enter to win.</p>
                    <a class="get-started" href="/giveaway">Get started</a>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <img src="/assets/images/welcome/welcome-giveaway.jpg">
                </div>
            </div>
        </section>

        <section class="row pink-bg">
            <div class="container">
            <h3>Join us</h3>
            <p>Our community gets better with people like you joining and interacting with others. Invite your friends to join you in getting the latest reviews, news, and deals!</p>
            </div>
        </section>


    </article>
</section>

@stop
