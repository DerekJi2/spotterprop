<div class="container">
    <div class="redefine-search">
        <?php 
        $uri = strtolower($_SERVER['REQUEST_URI']);
        $href = (strpos($uri, "listing")) ? "#redefine-search-form" : lang_site_url("Listing/Grid?redefine-search-form");
        
        ?>
        <a href="<?= $href; ?>" class="inner" data-toggle="collapse" aria-expanded="false" aria-controls="redefine-search-form">
            <span class="icon"></span>
            <span><?= get_lang('Redefine_Search') ?></span>
        </a>
    </div>
    <ol class="breadcrumb">
        <li><a href="<?= lang_site_url(''); ?>"><i class="fa fa-home"></i></a></li>
        <!-- <li><a href="#">Page</a></li>
        <li class="active">Detail</li> -->
    </ol>
    <!-- /.breadcrumb-->
</div>