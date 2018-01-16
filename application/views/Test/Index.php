<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?= site_url() ?>" />
    <title>Syrian Properties</title>

</head>



<body>
    <div>Hello world!</div>
    <?php
        $CI =& get_instance();
        
        $CI->load->database();
        echo $CI->db->dbprefix("users");

    ?>
</body>
</html>
