<?php
    //http://localhost/red_api/index.php?idJob=_solicitudes_list&token=123
    // estado sacado de php

    $fecha = krequest('fecha','');
    $idPedido= krequest('idPedido',0);
    $estado = krequest('estado','todos');
    $documento = krequest('documento',0);
    $prestador = krequest('prestador',0);
    $nombre = krequest('nombre','');
	
    kst("SELECT P.idPedido as pedido, date_format(P.fecha,'%d/%m/%Y') as fecha,");
    kst("P.estado,P.documento,P.nombre,P.prestador,");
    kst("P.impresiones as imp,");
    //kst("P.diagnostico,P.notas,P.informacion,P.impresiones,");
    //kst("P.delegacion_idUsuario,U2.usuario as usuario,P.tipo,");
    //kst("date_format(P.f_alta,'%d/%m/%Y %T') as ingreso,");
    //kst("date_format(P.f_auditado,'%d/%m/%Y %T') as auditado,");
    //kst("P.idDelegacion,P.idPrestador,");
    //kst("D.delegacion,P.red_idUsuario as idauditor,U.usuario as auditor,P.cobrado");
    kst("D.delegacion,U.usuario as auditor,P.cobrado,P.informacion,P.delegacion_idUsuario");
    kst("FROM pedidos P");
    kst("left JOIN usuarios U ON P.red_idUsuario=U.idUsuario");
    kst("left join delegaciones D on P.idDelegacion=D.idDelegacion");
    kst("left JOIN usuarios U2 ON P.delegacion_idUsuario=U2.idUsuario");

    kst( "WHERE true" );
    if( $fecha <> '' ){
        kst("and P.fecha='$fecha'");
    }
    if( $idPedido <> 0 ){
        kst("and P.idPedido = $idPedido");
    }

    if( $estado == "todos"){
    }elseif($estado=="pendientes/sin imprimir"){
        kst("and (P.estado='pendiente' or (P.estado='auditado' and P.impresiones=0)) " );
    }else{
        kst("and P.estado='$estado'" );
    }

    if( $documento <> 0 ){
        kst("and P.documento = $documento");
    }
    if( $prestador <> '' ){
        kst("and P.prestador like '%$prestador%'");
    }
    if( $nombre <> '' ){
        kst("and P.nombre like '%$nombre%'");
    }

    kst("order by P.idPedido");         //desc
    kst("limit 100");

    $sql = kst();

    $arr = kselect($sql);
    $response["error"] = false;
    $response["errorDesc"] = '';
    $response["data1"] = $arr;
    kecho(200, $response);
?>





