<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');

$_DEBUG_ = true;
$_Timestamp = "?v=";
$_Timestamp .= $_DEBUG_ ? time() : date("Y.m.d");
?>
                                    <div class="social">
                                        <a href="#" class="social-button"><i class="fa fa-twitter"></i></a>
                                        <a href="#" class="social-button"><i class="fa fa-facebook"></i></a>
                                        <a href="#" class="social-button"><i class="fa fa-pinterest"></i></a>
                                    </div>

                                    <a href="<?php echo site_url('contact.html') ?>" class="btn framed icon">Contact Us<i class="fa fa-angle-right"></i></a>
                                </section>
                            </div>
                            <!--/.col-md-4-->
                        </div>
                        <!--/.row-->
                    </div>
                    <!--/.container-->
                </div>
                <!--/.footer-top-->
                <div class="footer-bottom">
                    <div class="container">
                        <span class="left">(C) ThemeStarz, All rights reserved</span>
                            <span class="right">
                                <a href="<?php echo site_url('#page-top') ?>" class="to-top roll"><i class="fa fa-angle-up"></i></a>
                            </span>
                    </div>
                </div>
                <!--/.footer-bottom-->
            </div>
        </footer>
        <!--end Page Footer-->
    </div>
    <!-- end Inner Wrapper -->
</div>
<!-- end Outer Wrapper-->

    <script type="text/javascript" src="<?php echo site_url('assets/js/before.load.js'.$_Timestamp) ?>"></script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;libraries=places&key=AIzaSyCVbV919dtZDR5eKhk1LuRpuS26tdeyHBc"></script>
    <script type="text/javascript" src="<?php echo site_url('assets/js/jquery-migrate-1.2.1.min.js'.$_Timestamp) ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('assets/js/markerclusterer.js'.$_Timestamp) ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('assets/bootstrap/js/bootstrap.min.js'.$_Timestamp) ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('assets/js/richmarker-compiled.js'.$_Timestamp) ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('assets/js/smoothscroll.js'.$_Timestamp) ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('assets/js/infobox.js'.$_Timestamp) ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('assets/js/bootstrap-select.min.js'.$_Timestamp) ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('assets/js/icheck.min.js'.$_Timestamp) ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('assets/js/jquery.hotkeys.js'.$_Timestamp) ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('assets/js/jquery.mCustomScrollbar.concat.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('assets/js/jquery.nouislider.all.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('assets/js/custom.js'.$_Timestamp) ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('assets/js/maps.js'.$_Timestamp) ?>"></script>


<!--[if lte IE 9]>
<script type="text/javascript" src="<?php echo site_url('assets/js/ie-scripts.js') ?>"></script>
<![endif]-->
</body>
</html>