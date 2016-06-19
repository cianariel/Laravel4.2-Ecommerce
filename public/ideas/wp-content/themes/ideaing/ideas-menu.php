<?php
$cat = get_category( get_query_var( 'cat' ) );
$currentCat = $cat->slug;

?>
                <ul class="wrap col-lg-4">
                     <li class="box-link-ul {{$currentCat}}">
                                <a href="/ideas/smart-home" class="box-link <?php echo $currentCat == 'smart-home' ? 'active' : '' ?>">Smart Home</a>
                            </li>
                            <li class="box-link-ul">
                                <a href="/ideas/reviews" class="box-link <?php echo $currentCat == 'reviews' ? 'active' : '' ?>">Reviews</a>
                            </li>
                             <li class="box-link-ul">
                                <a href="/ideas/style" class="box-link <?php echo $currentCat == 'style' ? 'active' : '' ?>">Style</a>
                            </li>
                            <li class="box-link-ul">
                                <a href="/ideas/how-to" class="box-link <?php echo $currentCat == 'how-to' ? 'active' : '' ?>">How To</a>
                            </li>
                </ul>