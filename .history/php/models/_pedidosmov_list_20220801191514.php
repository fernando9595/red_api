<?php
    krequiredparams( array('idPedido') );
    $idPedido = $_REQUEST['idPedido'];

    kst("SELECT cantidad,item,descripcion,coseguro,idvalor,unitario");
     kst("FROM pedidosmov");
     kst("WHERE idPedido=$idPedido");
    
    

        $a1 = kst();
    $arr = kselect($a1);

     $response["error"] = false;
    $response["errorDesc"] = '';
    $response["data1"] =  $arr;
    kecho(200, $response);
