<!--Page Footer-->
<footer id="page-footer">
    <div class="inner">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                <?php
                    $this->view("templates/_page_footer_new_items");
                    $this->view("templates/_page_footer_featured");
                    $this->view("templates/_page_footer_about_us");
                ?>
                </div>
                <!--/.row-->
            </div>
            <!--/.container-->
        </div>
        <!--/.footer-top-->
        <div class="footer-bottom">
            <div class="container">
                <span class="left">(C) ThemeStarz, <?=get_lang('All_rights_reserved') ?></span>
                    <span class="right">
                        <a href="<?php echo site_url('#page-top') ?>" class="to-top roll"><i class="fa fa-angle-up"></i></a>
                    </span>
            </div>
        </div>
        <!--/.footer-bottom-->
    </div>
</footer>
<!--end Page Footer-->

