<?php
    //id codigo
    //automatic script by otro
    krequiredparams(array('codigo'));
    $codigo = $_REQUEST['codigo'];

    $arr = kselect("SELECT * FROM nomenclador WHERE codigo=$codigo");
    if( count($arr) == 0 ){
        $response["data1"] =  'error';
        $response["data2"] =  'Codigo inexistente';
    }else{
        $response["data1"] =  $arr[0];
    }
    $response["error"] = false;
    $response["errorDesc"] = '';
    kecho(200, $response);
?>