<section>
    <header><h2><?= get_lang('Categories') ?></h2></header>
    <ul class="bullets">
        <?php 
            $this->load->helper("MY_data_helper");
            $types = get_defined_types();

            foreach ($types as $type)
            {
                $href = lang_site_url('Listing/Grid?redefine-search-form&type='.$type->Id);
                echo "<li><a href=\"$href\" >".get_lang($type->Name)."</a></li>";
            } 
        ?>
    </ul>
</section>