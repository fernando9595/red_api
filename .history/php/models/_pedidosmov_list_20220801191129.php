<?php
    krequiredparams( array('idPedido') );
    $idPedido = $_REQUEST['idPedido'];

    $arr = kselect("SELECT * FROM pedidosmov WHERE idPedido=$idPedido");
    $response["error"] = false;
    $response["errorDesc"] = '';
    $response["data1"] =  $arr;
    kecho(200, $response);
