<?php
    //http://localhost/red_api/index.php?idJob=_rpt_pedidos_cobrados&token=123

    //https://www.redprestacional.com/redBuildWeb/red_api/index.php?idJob=vademecums_list_1&token=123

    $fecha = krequest('fecha','');
    $fechaSql = $fecha;

    kst("SELECT DATE_FORMAT(P.cobrado_fecha,'%d/%m/%Y') as f_cobrado, P.idPedido,");
    kst("DATE_FORMAT(fecha,'%d/%m/%Y') as fecha,P.documento,P.nombre as afiiiado,");
    kst("P.prestador,P.estado,P.cobrado,");
    kst("format( (select sum(coseguro) from pedidosMov M where M.idpedido=P.idpedido),2) as importe");
    kst("from pedidos P");
    kst("where P.delegacion_idUsuario=$idUsuario");
    kst("and P.cobrado_fecha= '$fechaSql'");
    kst("order by P.idPedido desc");

    $a1 = kst();
kdebug($a1);
    $arr = kselect($a1);

    $response["error"] = false;
    $response["errorDesc"] = "";
    $response["data1"] = $arr;
    kecho(200, $response);
?>
