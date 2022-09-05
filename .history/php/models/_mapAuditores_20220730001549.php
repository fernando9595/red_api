<?php
    $arr = kselect("select usuario,idUsuario from usuarios where rol='auditor' and activo='si' order by usuario");
    $response["error"] = false;
    $response["errorDesc"] = '';
    $response["data1"] =  $arr;
    kecho(200, $response);
