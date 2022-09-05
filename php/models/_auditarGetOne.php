<?php
    //http://localhost/red_api/index.php?idJob=_auditarGetOne&token=123&idPedido=15076
    //http://www.redprestacional.com/redBuildWeb/red_api/index.php?idJob=_auditarGetOne&token=123&idPedido=1507

    //sacado de php
    $idPedido = krequest('idPedido',0);

    //ama
    kst("SELECT P.idPedido, date_format(P.fecha,'%d/%m/%Y') as fecha,P.estado,");
    kst("date_format(PER.fnacimiento,'%d/%m/%Y') as fnacimiento,P.documento,");

    kst("P.nombre,P.prestador,");
    kst("P.diagnostico,P.notas,P.informacion,P.red_idUsuario,P.delegacion_idUsuario,");
    kst("date_format(P.f_alta,'%d/%m/%Y') as f_alta,");
    kst("P.idDelegacion,P.idPrestador,P.impresiones,P.f_auditado,P.observaciones,P.razon_social,");
    kst("D.delegacion,U2.usuario as usuario,");        
    kst("P.coseguro_cobrar,P.coseguro_cobrar_no_razon");

    kst("FROM pedidos P");
    kst("left JOIN usuarios U      ON P.red_idUsuario=U.idUsuario");
    kst("left JOIN delegaciones D  ON P.idDelegacion=D.idDelegacion");
    kst("left JOIN usuarios U2     ON P.delegacion_idUsuario=U2.idUsuario");
    kst("left JOIN personas PER    ON P.documento=PER.documento");
    kst("where P.idPedido=$idPedido");
    kst("and P.idDelegacion=D.idDelegacion");            //me aseguro que sea el que la creo
    $sql = kst();
    $arr1 = kselect($sql);
    $documento = $arr1[0]['documento'];

    //mov
    kst("SELECT P.item,P.cantidad,P.estado,P.descripcion,P.notas,");
    kst("P.coseguro,P.idpedido as id,P.unitario,P.idPedidoMov,P.idvalor,N.automatico");    //17/06/2017
    kst("FROM pedidosmov P, nomenclador N");
    kst('where P.item=N.codigo');
    kst("and idPedido=$idPedido");
    $sql = kst();
    $arr2 = kselect($sql);

    //per
    kst("select * from personas where documento=$documento");
    $sql = kst();
    $arr3 = kselect($sql);


    $response["error"] = false;
    $response["errorDesc"] = '';
    $response["data1"] = $arr1;         //ama
    $response["data2"] = $arr2;         //mov
    $response["data3"] = $arr3;         //per
    kecho(200, $response);
?>





