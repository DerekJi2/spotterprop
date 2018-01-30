<?php
    $this->load->view("dashboard/properties/_framework_header");
?>
<style>

.circleSubtitle { position: relative; top: 70px; }
.oper { font-size:48px; }
.oper-equal { color:brown; }
.dot-red { background-color: #c21919; }
.dot-yellow { background-color: #c6bd03; }
.dot-green { background-color: #6cbf6c; }
.dot-blue { background-color: #428bca; }
.circle-overview span {
    color: #FFFFFF;
    font-weight: 300;
    position: relative;
    top: 19px;
    font-size: 16px;
}
.circle-overview {
    width: 64px;
    height: 64px;
    border-radius: 64px;
    position: absolute;
    margin: 0 auto;
    left: 0;
    right: 0;
}

@media (max-width: 530px) {
    .circle-overview {
        width: 48px;
        height: 48px;
        border-radius: 48px;
    }
    .oper { font-size:28px; }
    .circleSubtitle { position: relative; top: 48px; font-size:6px; }
    .circle-overview span {
        font-weight: 300;
        position: relative;
        top: 12px;
        font-size: 9px;
    }
}


</style>
	<section class="content-header">
        <h1>
            <?= get_lang("Dashboard") ?> <small></small>
        </h1>
    </section> <!-- section .content-header -->
    
    <div class="content">
        
        <div class="row dv-dashboard-stats">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 posRela text-center">
                
                <div class="circle-overview dot-red">
                    <span class="number-of-issues" id="span-number-total">0</span>
                </div>
                <p class="circleSubtitle">Total</p>                
            </div>

            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 posRela text-center oper oper-equal">=</div>

            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 posRela text-center">
                <div class="circle-overview dot-green">
                    <span class="number-of-issues" id="span-number-publish">0</span>
                </div>
                <p class="circleSubtitle">Publish</p>
            </div>

            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 posRela text-center oper oper-plus">+</div>

            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 posRela text-center">
                <div class="circle-overview dot-yellow">
                    <span class="number-of-issues" id="span-number-submit">0</span>
                </div>
                <div class="circleSubtitle">Submit</div>
            </div>

            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 posRela text-center oper oper-plus">+</div>

            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 posRela text-center">
                <div class="circle-overview dot-blue">
                    <span class="number-of-issues" id="span-number-draft">0</span>
                </div>
                <p class="circleSubtitle">Draft</p>
            </div>

            
        </div>
    </div> <!-- div .content -->

<?php
    $this->load->view("dashboard/properties/_framework_end");
?>

<script>
var number_span_id = [ "", 
                        "#span-number-draft",
                        "#span-number-submit",
                        "#span-number-publish",
                        ];

var _Login_Id = <?= $this->users->current->id ?>;
var _Group_Id = <?= get_group_id($this->users->current->id) ?>;
$(".dv-dashboard-stats").ready(function() {
    var URL = "<?= site_url() ?>Property/status_stats/";
    if (_Group_Id == 6)
        URL += _Login_Id;
    else
        URL += "0";

    $.ajax({
        type: 'POST',
        url: URL,
        data: {},
        error: function(xhr, status, error){
            console.log("error: " + xhr.responseText);
        },
        success: function(response) {
            var total = 0;
            for (var i = 0; i < response.length; i++)
            {
                var status = response[i];
                var id = status.StatusId;
                var num = status.Num;
                var span = number_span_id[id];

                total += parseInt(num);
                $(span).html(num);
            }
            $('#span-number-total').html(total);
        }
    });


});
</script>