
<aside class="share-bar sticks-on-scroll">
    <ul class="share-buttons">
        <?php
        if(!function_exists('is_single')){ ?>
            @include('room.header-menu')
        <?php     }else{
            loadLaravelView('share-buttons');
            }
        ?>
    </ul>
</aside>