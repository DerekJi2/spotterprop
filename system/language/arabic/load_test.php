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

foreach ($langs as $key => $value)
{
    echo "$key => $value";
}

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
?>