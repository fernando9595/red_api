<?php
    //automatic script by otro
    krequiredparams( array('idPedidoMov') );
    $idPedidoMov = $_REQUEST['idPedidoMov'];

//kdebug(pedidosmov);
    $arr = kselect("SELECT * FROM pedidosmov WHERE idPedidoMov=$idPedidoMov");
    $response["error"] = false;
    $response["errorDesc"] = '';
    $response["data1"] =  $arr[0];
    kecho(200, $response);
?>