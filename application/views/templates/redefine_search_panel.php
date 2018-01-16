<div class="content">
    <div class="container">
        <form class="main-search" role="form" method="post" action="?">
            <div class="input-row">
                <div class="form-group">
                    <input type="text" class="form-control" id="keyword" placeholder="<?= get_lang('Enter_Keyword') ?>">
                </div><!-- /.form-group -->
                <div class="form-group">
                    <input type="text" class="form-control" id="location" placeholder="<?= get_lang('Enter_Location') ?>">
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                <?php // Dynamically load 'Property Type' Dropdown List 
                    $this->view("Home/_property_types_dropdownlist");                                                 
                ?>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    <button type="button" class="btn btn-default" onclick="nsRedefineSearch.Search()"><i class="fa fa-search"></i></button>
                </div>
                <!-- /.form-group -->
            </div>
        </form>
        <!-- /.main-search -->
    </div>
    <!-- /.container -->
</div>

<script type="text/javascript" src="<?php echo site_url('assets/js/jquery-2.1.0.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/bootstrap-select.min.js'); ?>"></script>



<script>
    // $('select').selectpicker('render');
</script>



<!--[if lte IE 9]>
<script type="text/javascript" src="assets/js/ie-scripts.js"></script>
<![endif]-->
