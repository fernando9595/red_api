<?php
    //automatic script by otro
    krequiredparams(array('idUsuario'));
    $idUsuario = $_REQUEST['idUsuario'];

    $arr = kselect("SELECT * FROM usuarios WHERE idUsuario=$idUsuario");
    $response["error"] = false;
    $response["errorDesc"] = '';
    $response["data1"] =  $arr[0];
    kecho(200, $response);
?>