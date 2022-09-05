<?php
    //modi select
    $arr = kselect("SELECT idDelegacion, delegacion,activo FROM delegaciones");
    //chau ,coseguro... en delegaciones no lo uso mas, esta en cada usuario (ya se depende de una delegacion, pero asi pueden haber usuarios distintos!! no se para que, peroooo)
    $response["error"] = false;
    $response["errorDesc"] = '';
    $response["data1"] = $arr;
    kecho(200, $response);
?>