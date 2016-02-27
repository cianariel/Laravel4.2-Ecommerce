<aside class="share-bar sticks-on-scroll">
    <ul class="share-buttons">
        <li class="all-shares"><b>120K </b>all shares</li>
        <li><a class="fb" href="#"><i class="m-icon m-icon--facebook-id"></i> <b class="fb share-count">189</b></a></li>
        <li><a class="twi" href="#"><i class="m-icon  m-icon--twitter-id"></i> <b class="twi share-count">189</b></a></li>
        <li><a class="gp" href="#"><i class="m-icon m-icon--google-plus-id"></i> <b class="gp share-count">189</b></a></li>
        <li><a class="pint" href="#"><i class="m-icon  m-icon--pinterest-id"></i> <b class="pint share-count">189</b></a></li>
    </ul>
</aside>

<script>
    function get_social_counts() {
        var thisUrl = window.location.host + window.location.pathname;
        $.ajax({
            type: "GET",
            url: 'http://medialoot.com/images/get_social_counts.php?thisurl='+thisUrl,
            dataType: "json",
            success: function (data){
                $('.share-count.twi').html(data.twitter);
                $('.share-count.fb').html(data.facebook);
                $('.share-count.gp').html(data.gplus);
                $('.share-count.pint').html(data.pinterest);
            }
        });
    }
</script>