

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
.td-status .label { display:inline-block; width:60px; }
.td-status div { width:100%; text-align:center; }
.td-status div a { font-size:12px; }
.show-560 { display: none; }

@media screen and (max-width:768px) {
    .hdn-768 {display: none;}
}

@media screen and (max-width:560px) {
    .hdn-560 {display: none;}
    .show-560 { display:block; }
    .page-link { width: 20px; font-size: 9px; padding: 2px 2px !important; }
}
</style>

<?php 
    $list = get_property_list();

    // Filter User's Own Properties if current login account is 'Users' Level
    $userId = $this->users->current->id;
    $list->data = filter_properties($list->data, $userId);
?>
<!-- <div>
<a href="dashboard/props/create">
    <span>➕</span>
    <span><?= get_lang("Add New Property")?></span>
</a>
</div> -->
<?php $this->load->view("dashboard/properties/list_paging"); ?>

<table class="table prop-list-table table-responsive">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col"><?= get_lang("Property")?></th>
        <th scope="col" class="hdn-560"><?= get_lang("Specification")?></th>
        <th scope="col" class="hdn-768"><?= get_lang("Agent/Owner")?></th>
        <th scope="col" class="hdn-560" style="text-align:center;"><?= get_lang("Status")?></th>
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
            $property_detail_link = lang_site_url()."Property/Detail/$item->id/";
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
        <tr class="tr-row tr-row-seq-<?= $count ?>" data-seq="<?= $count ?>">
            <!-- <th scope="row"><?=$count?></th> -->
            <?php 
            ?>
            <th scope="row">
                <a href="<?= $property_detail_link ?>" target="_blank">
                    <img class="gallery" src="<?=site_url($item_gallery); ?>" alt="">
                </a>
            </th>
            <td>
                <div><?=$item->title?>, <span class="prop-list-row-loc"><?=$item->location?></span></div>
                
                <div class="prop-list-row-type">
                    <i><img class="type-icon" src="<?=site_url($item->type_icon); ?>" alt=""></i>
                    <span><?= get_lang($item->type); ?></span>
                </div>

                <div><span><?= get_lang("Price") ?>: </span>$<?=number_format($item->price)?></div>

                <div class="item-specific show-560">
                    <span class="spn-item-spec-sm" title="<?= get_lang('Bedrooms') ?>"><img class="item-spec" src="<?=site_url('assets/img/bedrooms.png'); ?>" alt=""><?=$Bedrooms; ?></span>
                    <span class="spn-item-spec-sm" title="<?= get_lang('Bathrooms') ?>"><img class="item-spec" src="<?=site_url('assets/img/bathrooms.png'); ?>" alt=""><?=$Bathrooms; ?></span>
                    <span class="spn-item-spec-sm" title="<?= get_lang('Garages') ?>"><img class="item-spec" src="<?=site_url('assets/img/garages.png'); ?>" alt=""><?=$Garages; ?></span>
                    <span class="spn-item-spec-lg" title="<?= get_lang('Area') ?>"><img class="item-spec" src="<?=site_url('assets/img/area.png'); ?>" alt=""><?=$Area; ?>m<sup>2</sup></span>
                </div>

                <div class='show-560' allign="center">
                    <div><span class="label <?= get_status_label($item->StatusId) ?>"><?= get_lang(get_status_text($item->StatusId)) ?></span></div>

                    <!-- show submit button if 'draft' -->
                    <?php if ($item->StatusId == 1 ) { ?>   
                    <div><a href="javascript:void(0);" onclick="<?= $property_submit_link ?>" title="<?= get_lang("Submit") ?>"><?= get_lang("submit now") ?>!</a></div>
                    <?php } ?>

                    <!-- show publish button if 'submitted' -->
                    <?php if (get_group_id($userId) < 6 && $item->StatusId == 2 ) { ?>
                    <br/>
                    <div><a href="javascript:void(0);" onclick="<?= $property_publish_link ?>" title="<?= get_lang("Publish") ?>" style="" class="btn-xs btn-danger"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> </a></div>
                    <?php } ?>
                </div>
            </td>

            <td class="hdn-560">
                <div class="item-specific">
                    <span class="spn-item-spec-sm" title="<?= get_lang('Bedrooms') ?>"><img class="item-spec" src="<?=site_url('assets/img/bedrooms.png'); ?>" alt=""><?=$Bedrooms; ?></span>
                    <span class="spn-item-spec-sm" title="<?= get_lang('Bathrooms') ?>"><img class="item-spec" src="<?=site_url('assets/img/bathrooms.png'); ?>" alt=""><?=$Bathrooms; ?></span>
                    <span class="spn-item-spec-sm" title="<?= get_lang('Garages') ?>"><img class="item-spec" src="<?=site_url('assets/img/garages.png'); ?>" alt=""><?=$Garages; ?></span>
                </div>
                <div class="item-specific">
                    <span class="spn-item-spec-lg" title="<?= get_lang('Area') ?>"><img class="item-spec" src="<?=site_url('assets/img/area.png'); ?>" alt=""><?=$Area; ?>m<sup>2</sup></span>
                </div>
            </td>
            <td class="td-agent hdn-768">                
                <div class="agent-image">
                    <img src="<?php echo site_url($agent_photo) ?>" alt="">
                    <strong><?=$agent_name?></strong>
                </div>                
                <?php if ($agent != null) { ?>
                <div class="agent-info agent-email"><i class="fa fa-envelope-o"></i><?=$agent_email?></div>
                <div class="agent-info agent-mobile"><i class="fa fa-mobile icon-mobile"></i><?=$agent_mobile?></div>
                <?php } ?>
            </td>
            <?php
                $property_edit_link = lang_site_url()."dashboard/props/edit/$item->id";
                $property_delete_link = "javascript: onClick_DeleteProperty($item->id);";
                $property_submit_link = "javascript: onClick_SubmitProperty(this, $item->id);";
                $property_publish_link = "javascript: onClick_PublishProperty(this, $item->id);";
                $property_history_link = lang_site_url()."dashboard/props/history/$item->id";
                // $property_submit_link = lang_site_url()."dashboard/props/submit/$item->id";
                // $property_publish_link = lang_site_url()."dashboard/props/publish/$item->id";
            ?>
            <td class='td-status hdn-560' allign="center">
                <div><span class="label <?= get_status_label($item->StatusId) ?>"><?= get_lang(get_status_text($item->StatusId)) ?></span></div>

                <!-- show submit button if 'draft' -->
                <?php if ($item->StatusId == 1 ) { ?>   
                <div><a href="javascript:void(0);" onclick="<?= $property_submit_link ?>" title="<?= get_lang("Submit") ?>"><?= get_lang("submit now") ?>!</a></div>
                <?php } ?>

                <!-- show publish button if 'submitted' -->
                <?php if (get_group_id($userId) < 6 && $item->StatusId == 2 ) { ?>
                <br/>
                <div><a href="javascript:void(0);" onclick="<?= $property_publish_link ?>" title="<?= get_lang("Publish") ?>" style="" class="btn-xs btn-danger"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> </a></div>
                <?php } ?>
            </td>
            <td>            
                <a href="<?= $property_edit_link ?>" title="<?= get_lang("Edit") ?>"><i class="fa fa-edit" style="color:blue;"></i> <span class="hdn-768"><?= get_lang("Edit") ?></span></a>
                <br/>
                <a href="javascript:void(0);" onclick="<?= $property_delete_link ?>" title="<?= get_lang("Delete") ?>"><i class="fa fa-remove" style="color:#FF5733;"></i> <span class="hdn-768"><?= get_lang("Delete") ?></span></a>
                <?php if (get_group_id($userId) == 4) { ?>
                <br/>
                <a href="<?= $property_history_link ?>" title="<?= get_lang("History") ?>" style="color:#313131;"><i class="fa fa-history"></i> <span class="hdn-768"><?= get_lang("History") ?></span></a>
                <?php } ?>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<div class='dv-publish-template' style="display:none;">
    <br/>
    <div>
        <a href="javascript:void(0);" onclick="<?= $property_publish_link ?>" 
            title="Publish" style="" class="btn-xs btn-danger">
            <i class="fa fa-thumbs-o-up" aria-hidden="true">
            </i>
        </a>
    </div>
</div>

<script type="text/javascript" src="assets/js/local.property.js"></script>

<script type="text/javascript">
function onClick_DeleteProperty(propertyId)
{
    var really = false;
    var userid = <?= $this->users->current->id ?>;
    var confirmed = confirm("<?= get_lang("Are you sure to delete this property?") ?>");

    if (confirmed) 
    {
        var promise = nsProperty.Delete(propertyId, userid, really);

        promise.fail((xhr, status, error) =>{
            ConsoleLog("nsProperty.Delete().fail() " + error);
            ConsoleLog(xhr.responseText);
        });

        promise.done((response) =>{
            ConsoleLog("nsProperty.Delete().done() " + response);
            location.href = BASEURL + "dashboard/props/list";
        });
        
        promise.always(() => {
            ConsoleLog("nsProperty.Delete().always()");
        });
    }
}

function onClick_SubmitProperty(obj, propertyId)
{
    var userid = <?= $this->users->current->id ?>;
    var groupid = <?= get_group_id($userId) ?>;
    var confirmed = confirm("<?= get_lang("Are you sure to submit this property?") ?>");

    if (confirmed) 
    {
        var promise = nsProperty.Submit(propertyId, userid);

        promise.fail((xhr, status, error) =>{
            ConsoleLog("nsProperty.Submit().fail() " + error);
            ConsoleLog(xhr.responseText);
        });

        promise.done((response) =>{
            ConsoleLog("nsProperty.Submit().done() " + response);
            // location.href = BASEURL + "dashboard/props/list";
            var parentDiv = $(obj).parent().parent();
            var span = parentDiv.find('span');
            span.html(nsProperty.StatusText(2));
            span.addClass(nsProperty.StatusLabel(2));
            $(obj).remove();

            if (groupid < 6)
            {
                var publish_button = $('.dv-publish-template').html();
                $(publish_button).appendTo(parentDiv);
            }
        });
        
        promise.always(() => {
            ConsoleLog("nsProperty.Submit().always()");
        });
    }
}

function onClick_PublishProperty(obj, propertyId)
{
    var userid = <?= $this->users->current->id ?>;
    var confirmed = confirm("<?= get_lang("Are you sure to publish this property?") ?>");

    if (confirmed) 
    {
        var promise = nsProperty.Publish(propertyId, userid);

        promise.fail((xhr, status, error) =>{
            ConsoleLog("nsProperty.Publish().fail() " + error);
            ConsoleLog(xhr.responseText);
        });

        promise.done((response) =>{
            ConsoleLog("nsProperty.Publish().done() " + response);
            // location.href = BASEURL + "dashboard/props/list";
            var span = $(obj).parent().parent().find('span');
            span.html(nsProperty.StatusText(3));
            span.addClass(nsProperty.StatusLabel(3));
            $(obj).remove();
        });
        
        promise.always(() => {
            ConsoleLog("nsProperty.Publish().always()");
        });
    }
}
</script>