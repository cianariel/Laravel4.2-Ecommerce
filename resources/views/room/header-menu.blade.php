<div id="mobile-home-menu" class="mobile-top-menu mobile-mid-menu ">
    <ul>
        @if(!isset($roomInformation['Permalink']) || $roomInformation['Permalink'] != 'bedroom')
            <li><a class="box-link" href="{{url('idea/bedroom')}}">Bedroom</a></li>
        @endif
        @if(!isset($roomInformation['Permalink']) || $roomInformation['Permalink'] != 'office')
            <li><a class="box-link" href="{{url('idea/office')}}">Office</a></li>
        @endif
        @if(!isset($roomInformation['Permalink']) || $roomInformation['Permalink'] != 'living')
            <li><a class="box-link" href="{{url('idea/living')}}">Living</a></li>
        @endif
        @if(!isset($roomInformation['Permalink']) || $roomInformation['Permalink'] != 'outdoor')
            <li><a class="box-link" href="{{url('idea/outdoor')}}">Outdoor</a></li>
        @endif
        @if(!isset($roomInformation['Permalink']) || $roomInformation['Permalink'] != 'lighting')
            <li class="hidden-xs"><a class="box-link" href="{{url('idea/lighting')}}">Lighting</a></li>
        @endif
        @if(!isset($roomInformation['Permalink']) || $roomInformation['Permalink'] != 'security')
            <li class="hidden-xs"><a class="box-link" href="{{url('idea/security')}}">Security</a></li>
        @endif
        @if(!isset($roomInformation['Permalink']) || $roomInformation['Permalink'] != 'decor')
            <li><a class="box-link" href="{{url('idea/decor')}}">Decor</a></li>
        @endif
        @if(!isset($roomInformation['Permalink']) || $roomInformation['Permalink'] != 'garage')
            <li><a class="box-link" href="{{url('idea/garage')}}">Garage</a></li>
        @endif
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

