<?php
    //pk es documento, no idpersona
    //automatic script by otro
    krequiredparams(array('documento'));
    $documento = $_REQUEST['documento'];

//kdebug(personas);
    $arr = kselect("SELECT * FROM personas WHERE documento=$documento");
    $response["error"] = false;
    $response["errorDesc"] = '';
    $response["data1"] =  $arr[0];
    kecho(200, $response);
?>