<?php
//http://localhost/red_api/index.php?idJob=_update_info_tables&token=1


kst("SELECT distinct tabla from update_info");
$a1 = kst();
$arr = kselect($a1);
$response["error"] = false;
$response["errorDesc"] = '$tabla';
$response["data1"] = $arr;
kecho(200, $response);
