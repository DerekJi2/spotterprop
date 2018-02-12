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
    $arr = array();
    $arr["ar"] = "arabic";
    $arr["en"] = "english";
    $arr["cn"] = "chinese";

    if ($lang == "ar" || $lang == "cn" || $lang == "en")
    {
        $langdir = $arr[$lang];

        $basepath = str_replace("/", "\\", BASEPATH);
        $basefile = "language\\$langdir\home_lang.php";
        $filename = $basepath . $basefile;

        return $filename;
    }

    return "";
}

/**
 * 
 */
function save_as_lang($lang, $configs)
{
    $langfile = get_lang_file($lang);

    save_to_file($langfile, $configs);
}

/**
 * 
 */
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