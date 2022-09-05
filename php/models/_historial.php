<?php
    //http://localhost/red_api/index.php?idJob=_historial&token=123&documento=36435097

    //sacado de php
    $rol = krequest('rol','NI IDEA');
    $documento = krequest('documento',0);
 	
    kst("select P.idPedido as pedido, date_format(P.fecha, '%d/%m/%Y') as fecha,");
    kst("M.item,lcase(M.descripcion) as descripcion,M.cantidad as cant,left(P.tipo,3) as tipo,M.estado,M.notas,");
    kst("lcase(P.diagnostico) as diagnostico ,lcase(P.prestador) as prestador,P.idDelegacion as Delegacion");
    kst("from pedidos P, pedidosmov M");
    kst("where P.idpedido=M.idPedido");
    kst("and P.documento=$documento");
    kst("and P.estado <> 'anulado'");
    if( $rol=="delegacion"){
        kst("and P.idDelegacion=$idDelegacion");
    }
    kst("order by P.fecha desc,P.idPedido");
    $sql = kst();
    $arr1 = kselect($sql);


    $sql = "select * from personas where documento=$documento";
    $arr2 = kselect($sql);

    $response["error"] = false;
    $response["errorDesc"] = '';
    $response["data1"] = $arr1;
    $response["data2"] = $arr2;
    kecho(200, $response);
?>





