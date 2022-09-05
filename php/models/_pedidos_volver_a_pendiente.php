<?php
    //automatic script by otro
    krequiredparams(array('idPedido'));
    $idPedido = $_REQUEST['idPedido'];

    //valid
    $q=kselectone("select estado from pedidos where  idPedido=$idPedido");
    if( $q=="anulado"){
        $sql="update pedidos set estado='pendiente' where idPedido=$idPedido";    
        $arr = kselect($sql);

        $response["error"] = false;
        $response["errorDesc"] = '';
        $response["data1"] =  "Pedido vuelto a pendiente!!!\n";
        $response["data2"] =  '';
        $response["data3"] =  '';

    }else{
        $response["error"] = false;
        $response["errorDesc"] = '';
        $response["data1"] =  "Solo se pueden volver a pendiente pedidos anulados\n";
        $response["data2"] =  '';
        $response["data3"] =  '';
    }

    kecho(200, $response);
?>