

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
?>
<div>
<a href="#">
    <span>➕</span>
    <span>Add New Property</span>
</a>
</div>
<table class="table prop-list-table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Property</th>
        <th scope="col">Specification</th>
        <th scope="col">Agent/Owner</th>
        <th scope="col">Status</th>
        <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
<?php 
    $count = 0;
    $total_count = sizeof($list->data);
    foreach ($list->data as $item) { $count++; $agent = get_agent($item->id); ?>
        <tr>
            <!-- <th scope="row"><?=$count?></th> -->
            <th scope="row"><img class="gallery" src="<?=site_url($item->gallery[0]); ?>" alt=""></th>
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
                    <span class="spn-item-spec-sm" title="<?= get_lang('Bedrooms') ?>"><img class="item-spec" src="<?=site_url('assets/img/bedrooms.png'); ?>" alt=""><?=$item->item_specific["Bedrooms"]; ?></span>
                    <span class="spn-item-spec-sm" title="<?= get_lang('Bathrooms') ?>"><img class="item-spec" src="<?=site_url('assets/img/bathrooms.png'); ?>" alt=""><?=$item->item_specific["Bathrooms"]; ?></span>
                    <span class="spn-item-spec-sm" title="<?= get_lang('Garages') ?>"><img class="item-spec" src="<?=site_url('assets/img/garages.png'); ?>" alt=""><?=$item->item_specific["Garages"]; ?></span>
                </div>
                <div class="item-specific">
                    <span class="spn-item-spec-lg" title="<?= get_lang('Area') ?>"><img class="item-spec" src="<?=site_url('assets/img/area.png'); ?>" alt=""><?=$item->item_specific["Area"]; ?>m<sup>2</sup></span>
                </div>
            </td>
            <td class="td-agent">
                <div class="agent-image">
                    <img src="<?php echo site_url($agent->Photo) ?>" alt="">
                    <strong><?=$agent->Name?></strong>
                </div>
                
                <div class="agent-info agent-email"><i class="fa fa-envelope-o"></i><?=$agent->Email?></div>
                <div class="agent-info agent-mobile"><i class="fa fa-mobile"></i><?=$agent->Mobile?></div>
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