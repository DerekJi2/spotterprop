<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
function load_langs_by_file($filename)
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

/**
 * 
 */
function load_langs_by_lang($lang)
{
    $langfile = get_lang_file($lang);

    if ($langfile != "" && file_exists($langfile))
    {
        return load_langs_by_file($langfile);
    }

    return null;
}

/**
 * 
 */
function get_lang_file($lang)
{
    if ($lang == "ar")
    {
        $basepath = str_replace("/", "\\", BASEPATH);
        $basefile = "language\arabic\home_lang.php";
        $filename = $basepath . $basefile;

        return $filename;
    }

    return "";
}