<?php
    $arr = kselect("select delegacion,idDelegacion from delegaciones order by delegacion");
    $response["error"] = false;
    $response["errorDesc"] = '';
    $response["data1"] =  $arr;
    kecho(200, $response);
?>


