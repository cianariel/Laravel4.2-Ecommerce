
<aside class="share-bar sticks-on-scroll">
    <ul class="share-buttons">
        <?php
        if(!function_exists('is_single')){ ?>
            @include('layouts.parts.share-buttons')
        <?php     }else{
            loadLaravelView('share-buttons');
            }
        ?>
    </ul>
</aside>