@extends('layouts.main')

@section('body-class'){{ 'aboutus-page' }}@stop

@section('content')


<section itemscope itemtype="http://schema.org/Organization">
        <h1 itemprop="name" class="hidden">Ideaing.com</h1>
    <article itemprop="description">
        <div class = 'about_para_1' >
            <div class = 'para1_center' align='center'>
                <div class = 'space'></div>
                <div><h4>Get inspiration</h4></div>
                <div><img src = '/assets/images/about1.png' class = 'para1_image'></div>
                <div class = 'para1_content'>Get inspiration on making your home smarter. We've created a platform that will inspire you to make your home smarter. We'll recommend &amp; demonstrate the most cutting edge products designed to make your home more efficient &amp; more secure. thus making your life easier.</div>
                <div class = 'para1_button'><a class="btn btn-success col-xs-12" href="{{url('signup')}}">Get started</a></div>
            </div>
        </div>

        <div class = 'about_para_2'>
            <div style = 'para1_center' align='center'>
                <div class = 'space'></div>
                <div style = 'color:white'><h4>Discover the collest and most unique home decor</h4></div>
                <div class = 'para1_content' style = 'color:white'>At ideaing, we believe your home should look its best. We scour thousands of products from Amazon to major online retailers, and curate only the best &amp; most unique home decor.</div>
                <div class = 'para1_button'><a class="btn btn-success col-xs-12" href="{{url('/')}}">Get started</a></div>
                <div class = 'para2_space'></div>
            </div>
        </div>

        <div class = 'about_para_3'>
            <div class = 'para3_content col-sm-6'>
                <div class = 'para3_1'>
                    <div><h4>A Community with Taste</h4></div>
                    <div class = 'space'></div>
                    <div class = ''>We are passionate about the connected home and interior design. and we want you to be part of our vision. Vote on your favourite products and ideas.</div>
                    <div class = 'space'></div>
                </div>
            </div>

            <div class="para3_content col-sm-6" >
                <div class = 'para3_2'>
                    <div><h4>Sexy up!</h4></div>
                    <div class = 'space'></div>
                    <div>Get inspiration from others and share your home ideas to make our homes sexier and smarter than ever before.</div>
                    <div class = 'space'></div>
                </div>
            </div>
        </div>

        <div class = 'about_para_4'>
            <div style = 'para1_center' align='center'>
                <div class = 'space'></div>
                <div><h4>Best Deals</h4></div>

                <div class = 'para1_content'>Find the best deals for home tech</div>
                <div class = 'para1_button'><a class="btn btn-success col-xs-12" href="{{url('shop')}}">Get started</a></div>
                <div><img src = '/assets/images/about3.png' style = 'max-width:100%; max-height:500px'></div>
            </div>
        </div>

    </article>
</section>

@stop