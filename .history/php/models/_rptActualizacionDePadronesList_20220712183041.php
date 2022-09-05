<?php
$tabla = krequest('tabla', 'todos');

kst("select date_format(fecha,'%d/%m/%Y') as fecha,idDelegacion,tabla,alta+modi as total,chau as baja,alta as nuevos,modi");
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
