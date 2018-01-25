

<style>
.prop-list-table  tr img.gallery { width:100px;} 
.prop-list-row-loc { color: grey; display:inline-block; margin-left:5px; }
.type-icon { height:24px; }
.item-specific { margin: 4px 0; }
.item-specific img.item-spec { width:12px; margin-right:3px; }
.item-specific span { display:inline-block; }
.item-specific span.spn-item-spec-sm { width:30px; }
.item-specific span.spn-item-spec-lg { width:60px; }

.agent-image img { width:60px; margin-right:10px; }
.td-agent { width:120px; }
.agent-info i { display:inline-block; margin-right:3px; width:14px; }
</style>

<?php 
    $list = get_property_list();

    // Filter User's Own Properties if current login account is 'Users' Level
    $userId = $this->users->current->id;
    $list->data = filter_properties($list->data, $userId);
?>
<div>
<a href="dashboard/props/create">
    <span>➕</span>
    <span><?= get_lang("Add New Property")?></span>
</a>
</div>
<table class="table prop-list-table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col"><?= get_lang("Property")?></th>
        <th scope="col"><?= get_lang("Specification")?></th>
        <th scope="col"><?= get_lang("Agent/Owner")?></th>
        <th scope="col"><?= get_lang("Status")?></th>
        <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
<?php 
    $count = 0;
    $total_count = sizeof($list->data);
    foreach ($list->data as $item) { ?>
        <?php
            $count++; 
            $agent = get_agent($item->id); 
            $item_gallery = ($item->gallery == null|| sizeof($item->gallery) < 1) ? "assets/img/syr/no-image-house.png" : $item->gallery[0];
            $agent_photo = ($agent == null) ? "assets/img/syr/no-image-user.png" : $agent->Photo;
            $agent_name = ($agent == null) ? "<i style=\"color:grey\">(unknown)</i>" : $agent->name;
            $agent_email = ($agent == null) ? "" : $agent->email;
            $agent_mobile = ($agent == null) ? "" : $agent->Mobile;
            $Bedrooms = array_value($item->item_specific, "Bedrooms", 0); 
            $Bathrooms = array_value($item->item_specific, "Bathrooms", 0);
            $Garages = array_value($item->item_specific, "Garages", 0); 
            $Area = array_value($item->item_specific, "Area", 0); 
        ?>
        <tr>
            <!-- <th scope="row"><?=$count?></th> -->
            <?php 
            ?>
            <th scope="row"><img class="gallery" src="<?=site_url($item_gallery); ?>" alt=""></th>
            <td>
                <div><?=$item->title?>, <span class="prop-list-row-loc"><?=$item->location?></span></div>
                
                <div class="prop-list-row-type">
                    <i><img class="type-icon" src="<?=site_url($item->type_icon); ?>" alt=""></i>
                    <span><?= get_lang($item->type); ?></span>
                </div>

                <div><span>Price: </span>$<?=number_format($item->price)?></div>
            </td>

            <td>
                <div class="item-specific">
                    <span class="spn-item-spec-sm" title="<?= get_lang('Bedrooms') ?>"><img class="item-spec" src="<?=site_url('assets/img/bedrooms.png'); ?>" alt=""><?=$Bedrooms; ?></span>
                    <span class="spn-item-spec-sm" title="<?= get_lang('Bathrooms') ?>"><img class="item-spec" src="<?=site_url('assets/img/bathrooms.png'); ?>" alt=""><?=$Bathrooms; ?></span>
                    <span class="spn-item-spec-sm" title="<?= get_lang('Garages') ?>"><img class="item-spec" src="<?=site_url('assets/img/garages.png'); ?>" alt=""><?=$Garages; ?></span>
                </div>
                <div class="item-specific">
                    <span class="spn-item-spec-lg" title="<?= get_lang('Area') ?>"><img class="item-spec" src="<?=site_url('assets/img/area.png'); ?>" alt=""><?=$Area; ?>m<sup>2</sup></span>
                </div>
            </td>
            <td class="td-agent">                
                <div class="agent-image">
                    <img src="<?php echo site_url($agent_photo) ?>" alt="">
                    <strong><?=$agent_name?></strong>
                </div>                
                <?php if ($agent != null) { ?>
                <div class="agent-info agent-email"><i class="fa fa-envelope-o"></i><?=$agent_email?></div>
                <div class="agent-info agent-mobile"><i class="fa fa-mobile icon-mobile"></i><?=$agent_mobile?></div>
                <?php } ?>
            </td>
            <td>
            </td>
            <td>
                <a href="#" title="Edit"><i class="fa fa-edit"></i></a>
                <a href="#" title="Delete"><i class="fa fa-remove"></i></a>
                <a href="#" title="Complete"><i class="fa fa-check"></i></a>
                <a href="#" title="Approve"><i class="fa fa-thumbs-up"></i></a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>