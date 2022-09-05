<?php
    //automatic script by otro
    krequiredparams( array('idPedido') );
    $idPedidoMov = $_REQUEST['idPedido'];

    $arr = kselect("SELECT * FROM pedidosmov WHERE idPedido=$idPedido");
    $response["error"] = false;
    $response["errorDesc"] = '';
    $response["data1"] =  $arr[0];
    kecho(200, $response);
?>