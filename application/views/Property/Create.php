<?php

echo $Address;
echo "\r\n";

echo $guid;
echo "\r\n";
if ($DbResult == null)
{
    echo "NULL DbResult";
}
else
{
    echo "Id = ".$DbResult->Id;
}
echo "\r\n";

?>