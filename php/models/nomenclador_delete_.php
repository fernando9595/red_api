<?php
    //automatic script by otro
    krequiredparams(array('idNomenclador'));
    $idNomenclador = $_REQUEST['idNomenclador'];

    $arr = kselect("DELETE FROM nomenclador WHERE idNomenclador=$idNomenclador");
    $response["error"] = false;
    $response["errorDesc"] = '';
    $response["data1"] =  "";
    kecho(200, $response);
?>