<?php
    //automatic script by otro
    krequiredparams(array('idDelegacion'));
    $idDelegacion = $_REQUEST['idDelegacion'];

    $arr = kselect("DELETE FROM delegaciones WHERE idDelegacion=$idDelegacion");
    $response["error"] = false;
    $response["errorDesc"] = '';
    $response["data1"] =  "";
    kecho(200, $response);
?>