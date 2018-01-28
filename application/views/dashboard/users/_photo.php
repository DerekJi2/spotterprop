<?php
$current_photo = $this->users->current->Photo;
$current_photo = ($current_photo == "") ? "assets/img/syr/no-image-user.png" : $current_photo;
?>

<script>
function uploadUserPhoto()
{
    console.log("uploadUserPhoto");
}
</script>

<div class="row">
    <div class="col-md-12">
        <label for="username"><?= get_lang("My Photo") ?></label>
        <div class="form-group col-lg-12 col-md-12" style="margin-top:10px;padding-bottom:10px;">
            <!--Adding excess tenant images by PM in work order -->
            <div id="thumb-output" style="float:left;margin-left:10px;"></div>
            <label class="pm-file-container text-center" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?= get_lang("Add a photo")?>">
                <img src="<?= $current_photo ?>" style="height:100%" id="img-user-photo">
                <input type="file" id="file-input">
                <input type="hidden" name="Photo" id="input-photo" value="<?= $current_photo ?>" />
            </label>
            <!--Adding excess tenant images by PM in work order -->
        </div>            
        <!-- <a href="javascript:void(0);" onclick="javascript: uploadImages(57);" style="display:inline-block;margin:5px;">Upload</a> -->
    </div>
</div>
<link rel="stylesheet" type="text/css" href="assets/css/local.altStyle.css" />

<script type="text/javascript">

    function upload_photo()
    {
        var img = '#img-user-photo';

        var images = $(img).attr('src');
        var indexOf = images.indexOf("base64,");
        var imgSource = images.substring(indexOf + 7, images.length);

        var promise = $.ajax({
            url: 'UserProfile/upload_photo',
            data: { imgSource: imgSource },
            type: 'POST'
        });

        promise.fail((xhr, status, error) => {
            var msg = "Gallery/Upload failed: status=" + status + ",error=" + error + ", " + xhr.responseText;
            console.log(msg);
            console.log(xhr);
        });

        promise.done((result) => {              
            console.log("Gallery/Upload done: " + result);
            var filename = result;
            $("#input-photo").val(filename);
            $("input[name=Photo]").val(filename);
        });
        
        promise.always((result) => {
            console.log("Gallery/Upload always: " + result);
            
        });
    }

    $(document).ready(function () {
        /* END Static Awaiting Authorisation tutorials */

        $('#file-input').on('change', function () { //on file input change
            if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
            {
                var data = $(this)[0].files; //this file data

                $.each(data, function (index, file) { //loop though each file
                    if (/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)) { //check supported file type
                        var fRead = new FileReader(); //new filereader
                        fRead.onload = (function (file) { //trigger function on successful read
                            return function (e) {
                                $("#img-user-photo").attr('src', e.target.result);

                                upload_photo();
                            };
                        })(file);
                        fRead.readAsDataURL(file); //URL representing the file's data.
                    }
                });
            } 
            else 
            {
                alert("Your browser doesn't support File API!"); //if File API is absent
            }
        });

    });

</script>