<?php
    //order by id, por fecha sale mal.
    $arr = kselect("select date_format(fecha,'%d/%m/%Y') as fecha,tabla,chau,alta,modi from update_info where year(fecha)>=2020 order by id desc");
    $response["error"] = false;
    $response["errorDesc"] = "";
    $response["data1"] = $arr;
    kecho(200, $response);
?>
