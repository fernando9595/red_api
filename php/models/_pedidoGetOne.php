<?php
    //http://localhost/red_api/index.php?idJob=_pedidoGetOne&token=123&idPedido=15076
    //http://www.redprestacional.com/redBuildWeb/red_api/index.php?idJob=_pedidoGetOne&token=123&idPedido=1507

    //sacado de php
    $idPedido = krequest('idPedido',0);

    kst("select * from pedidos where idPedido=$idPedido");
    $sql = kst();
    $arr1 = kselect($sql);

    kst("select * from pedidosmov where idPedido=$idPedido");
    $sql = kst();
    $arr2 = kselect($sql);

/*
    kst("select P.idPedido as id, date_format(P.fecha, '%d/%m/%Y') as fecha,");
    kst("M.item,lcase(M.descripcion) as descripcion,M.cantidad as cant,left(P.tipo,3) as tipo,M.estado,M.notas,");
    kst("lcase(P.diagnostico) as diagnostico ,lcase(P.prestador) as prestador,P.idDelegacion as Delegacion");
    kst("from pedidos P, pedidosmov M");
    kst("where P.idpedido=M.idPedido");
    kst("and P.documento=$documento");
    kst("and P.estado <> 'anulado'");
    if( $rol=="delegacion"){
        kst("and P.idDelegacion=$idDelegacion");
    }
    kst("order by P.fecha,P.idPedido");
    $sql = kst();
    $arr = kselect($sql);
*/

    $response["error"] = false;
    $response["errorDesc"] = '';
    $response["data1"] = $arr1;
    $response["data2"] = $arr2;
    kecho(200, $response);
?>





