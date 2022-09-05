<?php
    kst("SELECT idlog, date_format(fecha,'%d/%m/%Y') as fecha, id, grupo, info, ip, browser, version, usuario");
    kst("FROM log2");
    kst("ORDER BY idlog DESC limit 10");
    $sql = kst();

    $arr = kselect($sql);
    $response["error"] = false;
    $response["errorDesc"] = '';
    $response["data1"] = $arr;
    kecho(200, $response);

?>