<ul>
    <li><a href="<?php echo site_url(); ?>"><?= get_lang('Home') ?></a></li>
    <!-- <li><a href="#home" class="has-child" data-toggle="collapse" aria-expanded="false" aria-controls="home">Home</a>
        <div class="collapse" id="home">
            <ul>
                <li><a href="index-directory.html">Google Maps</a></li>
                <li><a href="index-osm.html">OpenStreetMaps</a></li>
                <li><a href="index-here.html">Here Maps</a></li>
                <li><a href="index-directory.html">Universal Directory</a></li>
                <li><a href="index-cars.html">Car Dealership</a></li>
                <li><a href="index-real-estate.html">Real Estate</a></li>
                <li><a href="index-restaurants.html">Restaurants</a></li>
                <li><a href="index-travel.html">Travel</a></li>
            </ul>
        </div>
    </li> -->
    <li><a href="<?=lang_site_url('Listing/Grid'); ?>"><?= get_lang('Listing') ?></a></li>
    <li><a href="<?=lang_site_url('Home/AboutUs'); ?>"><?= get_lang('About_Us') ?></a></li>
    <li><a href="<?=lang_site_url('Home/Contact'); ?>"><?= get_lang('Contact') ?></a></li>
    <li><a href="#" class=".btn-admin-signin" onclick="nsRedirect.SignIn()"><?= get_lang('SignIn') ?></a></li>
    <li><a href="#" class=".btn-admin-register" onclick="nsRedirect.Register()"><?= get_lang('Register') ?></a></li>
</ul>

<!--[if lte IE 9]>
<script type="text/javascript" src="assets/js/ie-scripts.js"></script>
<![endif]-->
