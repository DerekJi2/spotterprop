<style>
.please-respond {
    display: none;
    margin-bottom: 12px;
}
.contact-alert { 
    display: none; 
}
.btn-primary {     color: #ffffff;
    background-color: #005bab;
    border-color: #005bab; 
    border-radius: 4px; 
    padding: 8px 18px;
}
.form-group label {
    display: inline-block;
    font-weight: normal;
}
</style>

<section>
<form class="form" id="contact-form">
    <div class="form-group">
        <label>Tell us what you think *</label>
        <textarea name="yoursay" class="form-control" rows="6"></textarea>
    </div>
    <div class="form-group">
        <input type="checkbox" name="plsRespond" id="cb-please-respond" aria-invalid="false">
        <label for="cb-please-respond" class="">Yes, please respond. We'll reply to you shortly.</label>
    </div>
    <div class="form-group please-respond">
        <span>Name</span>
        <input type="text" name="name" class="form-control" required/>
    </div>
    <div class="form-group please-respond">
        <span>Email</span>
        <input type="text" name="email" class="form-control" required/>
    </div>
    <div class="form-group please-respond">
        <span>Phone</span>
        <input type="text" name="phone" class="form-control" required/>
    </div>
    <div>
        <input type="hidden" name="debug" value="true" />
    </div>
    <div class="alert alert-danger contact-alert"></div>
    <div class="alert alert-success contact-alert"></div>
    <div class="form-group">
        <button type="button" id="btnSend" class="btn-primary" onclick="sendEmail()">Send</button>
    </div>
</form>
</section>

<script type="text/javascript">
    $("#cb-please-respond").change(function(e) {
        var checked = e.target.checked;
        if (checked == true)
            $(".please-respond").show();
        else
            $(".please-respond").hide();
    });

    function sendEmail() {
        var url = "<?= site_url() ?>SgEmail/Send";
        var data = $("#contact-form").serialize();

        console.log("sending request to " + url + " with data: \r\n" + data);
        var promise = $.ajax({
            type: "GET",
            url: url,
            data: data
        });

        promise.done((response) => {
            
            if (response.indexOf("2") == 0 || response < 300)
            {
                alertSuccess("An email has been sent successfully to our staff!");
            }
            else
            {
                alertError("System error: your message can't be delivered. Sorry, please try again later.");
            }
            setTimeout(function(){ hideAlerts(); }, 5000);
            console.log(response);
        });

        promise.fail((xhr, status, err) => {
            var errmsg = "Error: " 
                + status + " - " + err + ": "
                + xhr.responseText;
            alertError(errmsg);
        });
    }

    function alertError(msg) {
        hideAlerts();

        $(".alert-danger").html(msg);
        $(".alert-danger").show();
    }

    function alertSuccess(msg) {
        hideAlerts();

        $(".alert-success").html(msg);
        $(".alert-success").show();
    }

    function hideAlerts(msg) {
        $(".contact-alert").hide();
        $(".contact-alert").empty();
    }
</script>