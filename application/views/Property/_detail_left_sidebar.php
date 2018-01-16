<!--Detail Sidebar-->
<aside class="col-md-4 col-sm-4" id="detail-sidebar">
    <?php 
        $this->view("Property/_detail_sidebar_overview"); 
        $this->view("Property/_detail_sidebar_contact_agent", $agent); 
        // $this->view("Property/_detail_sidebar_contact_form"); 
        // $this->view("Property/_detail_sidebar_rating"); 
    ?>
</aside>
<!--end Detail Sidebar-->