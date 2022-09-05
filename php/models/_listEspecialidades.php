<?php
    $arr = kselect("select especialidad from especialidades order by especialidad");
    $response["error"] = false;
    $response["errorDesc"] = '';
    $response["data1"] =  $arr;
    kecho(200, $response);
?>


