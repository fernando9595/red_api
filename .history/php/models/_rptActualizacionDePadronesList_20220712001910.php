<?php
$tabla = krequest('tabla', 'todos');

//order by id, por fecha sale mal.
//$arr = kselect("select date_format(fecha,'%d/%m/%Y') as fecha,tabla,chau,alta,modi from update_info where year(fecha)>=2020 order by id desc");

kst("select date_format(fecha,'%d/%m/%Y') as fecha,tabla,chau,alta,modi");
kst("from update_info");
kst("where year(fecha)>=2020");
if ($tabla <> 'todos') {
    kst("and tabla = '$tabla'");
}

kst("order by id desc");

$a1 = kst();
$arr = kselect($a1);

$response["error"] = false;
$response["errorDesc"] = "";
$response["data1"] = $arr;
kecho(200, $response);
