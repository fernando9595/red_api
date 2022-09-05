<?php
    //automatic script by otro
    krequiredparams(array('idPedido'));
    $idPedido = $_REQUEST['idPedido'];

    //valid
    $q=kselectone("select estado from pedidos where  idPedido=$idPedido");
    if( $q=="anulado"){
        $response["error"] = false;
        $response["errorDesc"] = '';
        $response["data1"] =  "El pedido ya se encuentra anulado\n";
        kecho(200, $response);
    }
    if( $q=="auditado"){
        $response["error"] = false;
        $response["errorDesc"] = '';
        $response["data1"] =  "No se puede anular porque esta auditado\n";
        kecho(200, $response);
    }


    //ok
    $sql="update pedidos set estado='anulado' where idPedido=$idPedido";    
    $arr = kselect($sql);

    $response["error"] = false;
    $response["errorDesc"] = '';
    $response["data1"] =  "Pedido anulado!!!\n";
    kecho(200, $response);
?>