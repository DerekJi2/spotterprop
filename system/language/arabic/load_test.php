<?php

$filename = "home_lang.php";

// $langs = array();

// $lines = file($filename);
// foreach ($lines as $line)
// {
//     if (strpos($line, 'lang') > 0)
//     {
//         $line = str_replace("\$lang['home_", "", $line);
//         $line = str_replace("\$lang[\"home_", "", $line);
//         $line = str_replace("']", "", $line);
//         $line = str_replace("\"]", "", $line);
//         $line = str_replace("'", "", $line);
//         $line = str_replace("\"", "", $line);
//         // $line = str_replace(";", "", $line);
//         $line = preg_replace('/^\s+/', "", $line);
//         $line = preg_replace('/^\/.*/', "", $line);
//         $line = preg_replace('/;.*/', "", $line);
//         $line = preg_replace('/^\s*$/', "", $line);

//         $items = explode(' = ', $line);
//         if (sizeof($items) > 1)
//         {
//             $langs[$items[0]] = $items[1];
//         }
//     }
// }
$langs = load_file($filename);

$savefile = "save_home.php";

save_to_file($savefile, $langs);

// foreach ($langs as $key => $value)
// {
//     echo "$key => $value";
// }

function load_file($filename)
{
    $results = array();

    $lines = file($filename);
    foreach ($lines as $line)
    {
        if (strpos($line, 'lang') > 0)
        {
            $line = str_replace("\$lang['home_", "", $line);
            $line = str_replace("\$lang[\"home_", "", $line);
            $line = str_replace("']", "", $line);
            $line = str_replace("\"]", "", $line);
            $line = str_replace("'", "", $line);
            $line = str_replace("\"", "", $line);
            // $line = str_replace(";", "", $line);
            $line = preg_replace('/^\s+/', "", $line);
            $line = preg_replace('/^\/.*/', "", $line);
            $line = preg_replace('/;.*/', "", $line);
            $line = preg_replace('/^\s*$/', "", $line);

            $items = explode(' = ', $line);
            if (sizeof($items) > 1)
            {
                $results[$items[0]] = $items[1];
            }
        }
    }

    return $results;
}

function save_to_file($langfile, $configs)
{
    if ($configs == null || sizeof($configs) < 1)
    {
        return;
    }

    $content = "";

    $content .= "<?php defined('BASEPATH') OR exit('No direct script access allowed');";
    $content .= "\r\n";
    $content .= "\r\n";

    foreach ($configs as $key => $value)
    {
        $value = str_replace("\r", "", $value);
        $value = str_replace("\n", "", $value);
        $line = "\$lang['home_$key'] = '$value';";
        $content .= $line . "\r\n";
    }

    file_put_contents($langfile, $content);
}
?>