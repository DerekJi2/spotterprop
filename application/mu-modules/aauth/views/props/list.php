<?php
    $this->load->view("dashboard/properties/_framework_header");
?>
	<section class="content-header">
        <h1>
            Property List <small></small>
        </h1>
    </section> <!-- section .content-header -->
    
    <div class="content">
        <?php $this->load->view("dashboard/properties/list_content"); ?>
    </div> <!-- div .content -->

<?php
    $this->load->view("dashboard/properties/_framework_end");
?>

