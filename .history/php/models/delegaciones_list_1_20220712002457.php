<?php
    //modi select
    $arr = kselect("SELECT idDelegacion, delegacion,activo FROM delegaciones");
    $response["error"] = false;
    $response["errorDesc"] = '';
    $response["data1"] = $arr;
    kecho(200, $response);
?>