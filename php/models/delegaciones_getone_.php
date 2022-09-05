<?php
    //automatic script by otro
    krequiredparams(array('idDelegacion'));
    $idDelegacion = $_REQUEST['idDelegacion'];

//kdebug(delegaciones);
    $arr = kselect("SELECT * FROM delegaciones WHERE idDelegacion=$idDelegacion");
    $response["error"] = false;
    $response["errorDesc"] = '';
    $response["data1"] =  $arr[0];
    kecho(200, $response);
?>