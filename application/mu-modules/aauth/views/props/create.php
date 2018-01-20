<?php
    $this->load->view("dashboard/properties/_framework_header");
?>

	<section class="content-header">
        <h1>
            Add a Property<small></small>
        </h1>
    </section> <!-- section .content-header -->
    
    <div class="content">
        <?php $this->load->view("dashboard/properties/create_content"); ?>
    </div> <!-- div .content -->

<?php
    $this->load->view("dashboard/properties/_framework_end");
?>

