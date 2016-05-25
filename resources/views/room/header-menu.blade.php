<div id="mobile-home-menu" class="mobile-top-menu mobile-mid-menu ">
    <ul>
        <li><a class="box-link @if(isset($roomInformation['Permalink']) && $roomInformation['Permalink'] == 'bedroom') active @endif " href="{{url('idea/bedroom')}}">Bedroom</a></li>
        <li><a class="box-link @if(isset($roomInformation['Permalink']) && $roomInformation['Permalink'] == 'office') active @endif " href="{{url('idea/office')}}">Office</a></li>
        <li><a class="box-link @if(isset($roomInformation['Permalink']) && $roomInformation['Permalink'] == 'living') active @endif " href="{{url('idea/living')}}">Living</a></li>
        <li><a class="box-link @if(isset($roomInformation['Permalink']) && $roomInformation['Permalink'] == 'outdoor') active @endif " href="{{url('idea/outdoor')}}">Outdoor</a></li>
        <li><a class="box-link @if(isset($roomInformation['Permalink']) && $roomInformation['Permalink'] == 'lighting') active @endif " href="{{url('idea/lighting')}}">Lighting</a></li>
        <li><a class="box-link @if(isset($roomInformation['Permalink']) && $roomInformation['Permalink'] == 'security') active @endif" href="{{url('idea/security')}}">Security</a></li>
        <li><a class="box-link @if(isset($roomInformation['Permalink']) && $roomInformation['Permalink'] == 'decor') active @endif" href="{{url('idea/decor')}}">Decor</a></li>
        <li><a class="box-link @if(isset($roomInformation['Permalink']) && $roomInformation['Permalink'] == 'garage') active @endif" href="{{url('idea/garage')}}">Garage</a></li>
    </ul>
</div>

<div class="container desktop-home-deopdown-container full-sm fixed-sm">
<div id="desktop-home-deopdown-menu" class="mobile-top-menu mobile-mid-menu ">
    <ul>
        <li><a class="box-link @if(isset($roomInformation['Permalink']) && $roomInformation['Permalink'] == 'decor') active @endif" href="{{url('idea/decor')}}">Decor</a></li>
        <li><a class="box-link @if(isset($roomInformation['Permalink']) && $roomInformation['Permalink'] == 'garage') active @endif" href="{{url('idea/garage')}}">Garage</a></li>
    </ul>
</div>
</div>

<nav class="mid-nav rooms ">
    <div class="container full-sm fixed-sm hidden-xs ">
        <ul class="wrap col-lg-9">
            <li class="home ">
                <a class="box-link @if(!isset($roomInformation['Permalink']) || $roomInformation['Permalink'] == '/') active @endif"   href="/">
                    <span class="box-link-active-line"></span>
                    <i class="m-icon m-icon--smart-home"></i> Smart Home
                </a>
            </li>

            <li><a class="box-link @if(isset($roomInformation['Permalink']) && $roomInformation['Permalink'] == 'kitchen') active @endif " href="{{url('idea/kitchen')}}">Kitchen</a></li>
            <li><a class="box-link @if(isset($roomInformation['Permalink']) && $roomInformation['Permalink'] == 'bath') active @endif " href="{{url('idea/bath')}}">Bath</a></li>
            <li><a class="box-link @if(isset($roomInformation['Permalink']) && $roomInformation['Permalink'] == 'bedroom') active @endif " href="{{url('idea/bedroom')}}">Bedroom</a></li>
            <li><a class="box-link @if(isset($roomInformation['Permalink']) && $roomInformation['Permalink'] == 'office') active @endif " href="{{url('idea/office')}}">Office</a></li>
            <li><a class="box-link @if(isset($roomInformation['Permalink']) && $roomInformation['Permalink'] == 'living') active @endif " href="{{url('idea/living')}}">Living</a></li>
            <li><a class="box-link @if(isset($roomInformation['Permalink']) && $roomInformation['Permalink'] == 'outdoor') active @endif " href="{{url('idea/outdoor')}}">Outdoor</a></li>
            <li><a class="box-link @if(isset($roomInformation['Permalink']) && $roomInformation['Permalink'] == 'lighting') active @endif " href="{{url('idea/lighting')}}">Lighting</a></li>
            <li><a class="box-link @if(isset($roomInformation['Permalink']) && $roomInformation['Permalink'] == 'security') active @endif" href="{{url('idea/security')}}">Security</a></li>

        </ul>
        <a class="right-menu-arrow pull-right" data-toggle="#desktop-home-deopdown-menu" href="#">
            <i class="m-icon--Header-Dropdown down"></i>
            <i class="m-icon--footer-up-arrow up"></i>
        </a>
    </div>
    
    <div class="container mobile-menu visible-xs full-sm fixed-sm">
        <ul class="wrap col-lg-9">
            <li><a class="box-link @if(isset($roomInformation['Permalink']) && $roomInformation['Permalink'] == 'kitchen') active @endif " href="{{url('idea/kitchen')}}">Kitchen</a></li>
            <li><a class="box-link @if(isset($roomInformation['Permalink']) && $roomInformation['Permalink'] == 'bath') active @endif " href="{{url('idea/lighting')}}">Lighting</a></li>           <li><a class="box-link @if(isset($roomInformation['Permalink']) && $roomInformation['Permalink'] == 'bath') active @endif " href="{{url('idea/security')}}">Security</a></li>
        </ul>
        <a class="right-menu-arrow pull-right" data-toggle="#mobile-home-menu" href="#">
            <i class="m-icon--Header-Dropdown down"></i>
            <i class="m-icon--footer-up-arrow up"></i>
        </a>

    </div>
</nav>