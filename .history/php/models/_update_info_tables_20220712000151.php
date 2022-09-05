<?php
//http://localhost/red_api/index.php?idJob=_update_info_tables&token=1
$tabla = krequest('tabla', 'todos');

kst("SELECT distinct tabla from update_info");
if ($tabla <> 'todos') {
    kst("and tabla = $tabla");
}

echo($tabla);
$a1 = kst();
$arr = kselect($a1);
$response["error"] = false;
$response["errorDesc"] = '';
$response["data1"] = $arr;
kecho(200, $response);
