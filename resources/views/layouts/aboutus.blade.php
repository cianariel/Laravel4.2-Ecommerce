<!DOCTYPE html>
<html>
    <head>
        @include('layouts.parts.head')
        <style type = 'text/css'>
            .space
            {
                height:30px;
            }
            .about_para_1
            {
                left:0px; width:100%; background-color:#eeeeee
            }
            .para1_center
            {
                max-width:1000px; margin-left:50%; transform:translate(-50%, 0px)
            }
            .para1_image
            {
                max-width:100%;max-height:500px
            }
            .para1_content
            {
                padding-left:10%; padding-right:10%
            }
            .para1_button
            {
                width:100px; margin-top:30px; height:60px
            }
            .about_para_2
            {
                position:relative;left:0px; width:100%; background-image:url("/assets/images/about2.png");background-size: cover;background-repeat: no-repeat;background-position: 50% 100%; z-index:1
            }
            .para2_space
            {
                height:460px
            }
            .about_para_3
            {
                overflow: auto;left:0px; width:100%; background-color:#dddddd; margin-top:-200px; z-index:0; 
            }
            .about_para_4
            {
                left:0px; width:100%; background-color:#eeeeee; z-index:0
            }
            .para3_1
            {
                position:absolute; width:400px; left:100%; top:50%; transform:translate(-120%, -50%)
            }
            .para3_2
            {
                position:absolute; width:400px; left:0%; top:50%; transform:translate(20%, -50%)
            }
            .para3_content
            {
                position:relative;min-width:300px;width:50%; background-color:#cccccc; float:left; height:400px
            }
        </style>
    </head>

    <body class="@yield('body-class', '')">
    @include('layouts.parts.header')

    





<div class = 'about_para_1'>
    <div class = 'para1_center' align='center'>
        <div class = 'space'></div>
        <div><h4>Get inspiration</h4></div>
        <div><img src = '/assets/images/about1.png' class = 'para1_image'></div>
        <div class = 'para1_content'>Get inspiration on making your home smarter. We've created a platform that will inspire you to make your home smarter. We'll recommend &amp; demonstrate the most cutting edge products designed to make your home more efficient &amp; more secure. thus making your life easier.</div>
        <div class = 'para1_button'><a class="btn btn-success col-xs-12" href="#">Get started</a></div>
    </div>
</div>




<div class = 'about_para_2'>
    <div style = 'para1_center' align='center'>
        <div class = 'space'></div>
        <div style = 'color:white'><h4>Discover the collest and most unique home decor</h4></div>
        <div class = 'para1_content' style = 'color:white'>At ideaing, we believe your home should look its best. We scour thousands of products from Amazon to major online retailers, and curate only the best &amp; most unique home decor.</div>
        <div class = 'para1_button'><a class="btn btn-success col-xs-12" href="#">Get started</a></div>
        <div class = 'para2_space'></div>
    </div>
</div>

<div class = 'about_para_3'>
    <div class = 'para3_content'>
        <div class = 'para3_1'>
	        <div><h4>A Community with Taste</h4></div>
            <div class = 'space'></div>
	        <div class = ''>We are passionate about the connected home and interior design. and we want you to be part of our vision. Vote on your favourite products and ideas.</div>
            <div class = 'space'></div>
	       <div><a class="btn btn-success col-xs-12" href="#">Get started</a></div>
        </div>
    </div>

    <div style = 'position:relative; min-width:300px;width:50%; background-color:#dddddd; float:left; height:400px'>
        <div class = 'para3_2'>
            <div><h4>Sexy up!</h4></div>
            <div class = 'space'></div>
            <div>Get inspiration from others and share your home ideas to make our homes sexier and smarter than ever before.</div>
            <div class = 'space'></div>
            <div><a class="btn btn-success col-xs-12" href="#">Get started</a></div>
        </div>
    </div>
</div>

<div class = 'about_para_4'>
    <div style = 'para1_center' align='center'>
        <div class = 'space'></div>
        <div><h4>Best Deals</h4></div>
    
        <div class = 'para1_content'>Find the best deals for home tech</div>
        <div class = 'para1_button'><a class="btn btn-success col-xs-12" href="#">Get started</a></div>
        <div><img src = '/assets/images/about3.png' style = 'max-width:100%; max-height:500px'></div>
    </div>
</div>






    @include('layouts.parts.footer')

    @include('layouts.parts.login-signup')
    

    </body>
</html>
