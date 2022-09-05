<?php
$tabla = krequest('tabla');

kst("select date_format(fecha,'%d/%m/%Y') as fecha,idDelegacion,tabla,chau as baja,alta,modi");
kst("from update_info");
//kst("where true");
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
