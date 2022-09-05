 <?php
    //http://localhost/red_api/index.php?idJob=_rpt_auditores_detalle&desde=2022-05-01&hasta=2022-06-01&idUsuario=26&token=123

    $desde = krequest('desde');
    $hasta = krequest('hasta');
    $idUsuario = krequest('idUsuario');

    // $desdeSql = $desde;
    // $hastaSql = $hasta;

    kst("SELECT DATE_FORMAT(P.fecha,'%d/%m/%Y') as fecha,");
    kst("P.idPedido,P.documento,P.nombre,P.diagnostico,");
    kst("DATE_FORMAT(P.f_auditado,'%d/%m/%Y') as f_auditado, P.estado");
    kst("FROM pedidos P, usuarios U");
    kst("WHERE P.red_idUsuario = U.idUsuario");
    kst("and f_auditado >= '$desde'");
    kst("and f_auditado <= '$hasta'");
    kst("and P.red_idUsuario = $idUsuario");
    //kst("ORDER BY DATE_FORMAT(P.fecha,'%d/%m/%Y')");
    kst("ORDER BY P.fecha,P.idPedido");
    
    $a1 = kst();
    //die($a1);
    $arr = kselect($a1);

    $response["error"] = false;
    $response["errorDesc"] = "";
    $response["data1"] = $arr;
    kecho(200, $response);
    ?>