<?php

$this->load->helper("MY_data_helper");
$features = get_defined_features();
?>

<ul class="list-unstyled checkboxes">
    <?php
    foreach($features as $feature)
    {
        $featureName = get_lang($feature->Name);
        echo "<li>
            <div class=\"checkbox\">
                <label class='label-feature-checkbox'>
                    <input type=\"checkbox\" name=\"features[]\" value=\"".$feature->Id."\" >".$featureName.
                "</label>
            </div>
        </li>";
    }
    ?>
</ul>