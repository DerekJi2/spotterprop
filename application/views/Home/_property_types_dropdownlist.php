<?php

$this->load->helper("MY_data_helper");
$types = get_defined_types();
?>

<select name="type" multiple title="<?= get_lang('All') ?>" data-live-search="true" id="type" class="select-property-types-ddl">
    <?php
    foreach($types as $type)
    {
        $typeName = get_lang($type->Name);
        echo "<option value=\"".$type->Id."\" class=\"sub-category\">".$typeName."</option>";
    }
    ?>
</select>