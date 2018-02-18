<?php

$this->load->helper("MY_user");
$this->load->helper("MY_Pms");
$loginUserId = get_login_user()->id;

$pms_list = list_unread_pms($loginUserId);

// Fetch notices from filter "ui_notices".
$ui_notices    =    $this->events->apply_filters('ui_notices', $pms_list);

$notices = array();
foreach ($ui_notices as $ui_notice)
{
    $notice["pm_id"] = $ui_notice->id;
    $notice['icon'] = "warning";
    $notice['namespace'] = "";
    $notice['prefix'] = "";
    $notice['message'] = $ui_notice->title;
    $notice['submessage'] = $ui_notice->message;
    $notice['date'] = $ui_notice->date;

    array_push($notices, $notice);
}

$notices_nbr    =    count($notices); // count($notices);

?>
<li class="dropdown notifications-menu"> 
    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
        <i class="fa fa-bell-o"></i>
        <?php if ($notices_nbr > 0):?>
        <span class="label label-warning spn-notice-nbr"><?php echo $notices_nbr;?></span>
        <?php endif;?>
    </a>
    <ul class="dropdown-menu">
        <li class="header"><?php echo sprintf(__('You have <span class="spn-notice-nbr">%s</span> notices'), $notices_nbr);?> </li>
        <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu">
            <?php
            foreach ($notices as $notice):
                if ( isset($notice[ 'icon' ])) {
                    $notice_icon    =    @$notice[ 'icon' ];
                } else {
                    switch ( @$notice[ 'type' ]) {
                        case 'success' : $notice_icon = 'thumbs-up'; break;
                        case 'warning' : $notice_icon = 'warning'; break;
                        default : $notice_icon = 'info-circle'; break;
                    }
                }
                $notice_icon    =    'info-circle';
            ?>
                <li>
                    <a style="white-space:normal" href="<?php echo xss_clean( @$notice[ 'href' ]);?>">
                        <i class="fa fa-<?php echo xss_clean($notice_icon);?> text-aqua"></i>
                        <?php echo xss_clean( @$notice[ 'message' ] );?>
                        <span
                            data-pmid = "<?= @$notice[ 'pm_id' ] ?>"
                            data-prefix="<?php echo @$notice[ 'prefix' ];?>"
                            data-namespace="<?php echo @$notice[ 'namespace' ];?>" class="btn btn-xs btn-warning pull-right remove_ui_notice">
                            <i class="fa fa-remove"></i>
                        </span>
                        <div style="color:grey;padding-left:18px;font-size:4px;">
                            <span><?= xss_clean( @$notice[ 'submessage' ] ); ?></span>
                        </div>
                        <div style="color:grey;padding-left:18px;font-size:4px;">
                            <span><?= xss_clean( @$notice[ 'date' ] ); ?></span>
                        </div>
                    </a>
                </li>
            <?php endforeach;?>
            </ul>
        </li>
        <!-- <li class="footer"><a href="#">View all</a></li> -->
    </ul>
</li>
<script type="text/javascript">
$( document ).ready( function(){
    $( '.remove_ui_notice' ).bind( 'click', function(e){
        $this       =   $( this );
        var pm_id   = $(this).data("pmid");

        var url     =    '<?php echo site_url( array( 'Pms', 'SetRead', 'app_cache' ) );?>/';
        $.ajax({
            url     :  url,
            type  :   'POST',
            data  : { pmid: pm_id},
            success :   function(){
                $this.closest( 'li' ).fadeOut( 500, function(){
                    $(this).remove();
                    decreaseNoticeNumber();
                });
            }
        })
        return false;
    })
});

function decreaseNoticeNumber()
{
    var cur_number = parseInt($(".spn-notice-nbr").html());
    var number = cur_number - 1;

    $(".spn-notice-nbr").html(number);
    if (number < 1)
    {
        $(".label-warning").hide();
    }
}

</script>