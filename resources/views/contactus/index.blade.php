<!DOCTYPE html>
<html>
    <head>
        @include('layouts.parts.head')
        <style type = 'text/css'>
        </style>
    </head>

    <body class="@yield('body-class', 'contactus-page')">
        @include('layouts.parts.header')

        <nav class="mid-nav">
            <div class="container full-sm fixed-sm">
                <ul class="wrap col-lg-9">
                    <li class="box-link-ul active-ul ">
                        <a class="box-link active" href="#">
                            <span class="box-link-active-line"></span>
                            Contact us
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        
        <section id="hero">
            <div class="hero-background"></div>
            <div class="contactus-form-container ">
                <p class="title">Get in touch</p>
                <div class="row control-row " id="support-dropdown-holder">
                    <a href="#" class="support-button" data-toggle="#support-list">
                        Support
                        <i class=" m-icon--Actions-Down-Arrow-Active pull-right"></i>
                        <ul class="support-list">
                            <li>First Menu</li>
                            <li>Second Menu</li>
                        </ul>
                    </a>
                </div>
                <div class="row control-row">
                    <input class="form-control" placeholder="Your name">
                </div>
                <div class="row control-row">
                    <input class="form-control" placeholder="Email address">
                </div>
                <div class="row control-row">
                    <textarea class="form-control" placeholder="Start typing question or comment"></textarea>
                </div><br>
                <div class="row text-center">
                    <button class="btn">Send</button>
                </div>
            </div>
        </section>
        <div class="clearfix"></div>
        <div class="container author-container">
            <div class="row">
                <div class="col-sm-6 author-holder">
                    <p>Are you a customer in need of support? If you have an issue with an order, please contact us at (We should have an order issue resolution link in the user account order history page).</p>
                    <p>Support@</p>
                </div>
                <div class="col-sm-6 author-holder">
                    <p>
                        We are always looking for great business partners including media outlets that need content and OEMs looking for exposure.
                    </p>
                    <p>Partnerships@</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 author-holder">
                    <p>
                        Do you have your own interior design studio or are a contractor working on beautiful homes? Contact us to be listed on our site to get connected with more customers in your area!
                    </p>
                    <p>Professionals@</p>
                </div>
                <div class="col-sm-6 author-holder">
                    <p>
                        Ideaing is a fun site dedicated to growing the smart home market. If you are looking for more information information to write an article about us or the smart home market, please contact us! (We should have a link to our press kit).
                    </p>
                    <p>Press@</p>
                </div>
            </div>
            <div class="row ">
                <div class="col-sm-6 author-holder">
                    <p>If you would like to contact us regarding any trademark, copyright, or other legal issues, please let us know. (link T&C and PP).</p>
                    <p>Legal@</p>
                </div>
                <div class="col-sm-6 author-holder">
                    <p>
                        If you made it this far and still can't nd what you're looking for, or have a general inquiry, email our general address and we'll find someone on our team to help!
                    </p>
                    <p>Info@</p>
                </div>
            </div>
        </div>
        
        <div class="contactus-footer">
            <div class="container text-center">
                <p>Are you super smart and savvy? Do you love tech and beautiful houses?<br>
                We're building an incredible team. Submit your resume here!</p>
                <p>Careers@ </p>
            </div>
        </div>

        @include('layouts.parts.footer')

        @include('layouts.parts.login-signup')
    

    </body>
</html>
