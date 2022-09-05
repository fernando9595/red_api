<?php
    //automatic script by otro
    krequiredparams(array('idPrestador'));
    $idPrestador = $_REQUEST['idPrestador'];

//kdebug(prestadores);
    $arr = kselect("SELECT * FROM prestadores WHERE idPrestador=$idPrestador");
    $response["error"] = false;
    $response["errorDesc"] = '';
    $response["data1"] =  $arr[0];
    kecho(200, $response);
?>