

<style>
td { text-align:center; }
</style>

<?php 
    // Filter User's Own Properties if current login account is 'Users' Level
    $userId = $this->users->current->id;

    $_property = get_property($property_id);
    $_history = get_property_history($property_id);
    $_address = $_property->title . ", " . $_property->location;

    
?>

<h3><?= $_address ?></h3>
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
    <thead class="thead-dark">
        <tr>
        <th scope="col">#</th>
        <th scope="col" style="text-align:center;"><?= get_lang("Date/Time")?></th>
        <th scope="col" style="text-align:center;"><?= get_lang("Account")?></th>
        <th scope="col" style="text-align:center;"><?= get_lang("Operation")?></th>
        <th scope="col"><?= get_lang("Details")?></th>
        <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
<?php 
    $count = 0;
    $total_count = sizeof($_history);
    foreach ($_history as $item) { ?>
        <?php
            $count++; 
            $item_operation = $item->Operation;
            $item_operation = str_replace("STATUS (1)", "Draft", $item_operation);
            $item_operation = str_replace("STATUS (2)", "Submit", $item_operation);
            $item_operation = str_replace("STATUS (3)", "Publish", $item_operation);

            $detail = $item->DetailJson;
            $detail = str_replace('"', "", $detail);
            $detail = str_replace('[', "", $detail);
            $detail = str_replace(']', "", $detail);
            $detail = str_replace('{', "", $detail);
            $detail = str_replace('}', "", $detail);
            $details = explode(',', $detail);
            $detail = implode('<br/>', $details);
        ?>
        <tr>
            <!-- <th scope="row"><?=$count?></th> -->
            <?php 
            ?>
            <th scope="row">
                <?= $count ?>
            </th>
            <td>
                <div><?= $item->CreatedOn ?></div>
            </td>

            <td>
                <div><?= $item->name ?></div>
            </td
            >
            <td>
                <div><?= $item_operation ?></div>
            </td>
           
            <td style="text-align:left">
                <div><?= $detail ?></div>
            </td>

            <td>                        
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</div>

<script type="text/javascript" src="assets/js/local.property.js"></script>

<script type="text/javascript">

</script>