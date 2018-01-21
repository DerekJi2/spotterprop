<?php
    $this->load->helper("MY_model_helper");
    $specs =$vw->item_specific;
    $bedrooms = array_value($specs, "Bedrooms", 0);
    $bathrooms = array_value($specs, "Bathrooms", 0);
    $area = array_value($specs, "Area", 0);
    $garages = array_value($specs, "Garages", 0);
    $rooms = array_value($specs, "Rooms", 0);
?>

<!--Overview-->
<section>
    <header><h3><?= get_lang('Overview') ?></h3></header>
    <figure>
        <dl>
            <dt><?= get_lang('Bedrooms') ?></dt>
            <dd><?= $bedrooms ?></dd>
            <dt><?= get_lang('Bathrooms') ?></dt>
            <dd><?= $bathrooms ?></dd>
            <dt><?= get_lang('Area') ?></dt>
            <dd><?= $area ?></dd>
            <dt><?= get_lang('Garages') ?></dt>
            <dd><?= $garages ?></dd>
            <dt><?= get_lang('Rooms') ?></dt>
            <dd><?= $rooms ?></dd>
            <dt><?= get_lang('Build Year') ?></dt>
            <dd><?= $vw->year ?></dd>
        </dl>
    </figure>
</section>
<!--end Overview-->