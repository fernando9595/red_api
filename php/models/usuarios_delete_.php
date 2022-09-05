<?php
    //automatic script by otro
    krequiredparams(array('idUsuario'));
    $idUsuario = $_REQUEST['idUsuario'];

    $arr = kselect("DELETE FROM usuarios WHERE idUsuario=$idUsuario");
    $response["error"] = false;
    $response["errorDesc"] = '';
    $response["data1"] =  "";
    kecho(200, $response);
?>