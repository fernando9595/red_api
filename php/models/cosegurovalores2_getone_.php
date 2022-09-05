<?php
    //automatic script by otro
//    krequiredparams(array('id'));
//    $id = $_REQUEST['id'];
    $id=1;
    $arr = kselect("SELECT * FROM cosegurovalores2 WHERE id=$id");
    $response["error"] = false;
    $response["errorDesc"] = '';
    $response["data1"] =  $arr[0];
    kecho(200, $response);
?>