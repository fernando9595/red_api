 <?php
    //http://localhost/red_api/index.php?idJob=_rpt_auditores_resumen_usuario&desde=2022-05-01&hasta=2022-06-01&token=123

    $desde = krequest('desde');
    $hasta = krequest('hasta');

    $desdeSql = $desde;
    $hastaSql = $hasta;

    kst("SELECT U.usuario,count(P.f_auditado) as cantidad");
    kst("FROM pedidos P, usuarios U");
    kst("WHERE P.red_idUsuario = U.idUsuario");
    kst("and f_auditado >= '$desde'");
    kst("and f_auditado <= '$hasta'");
    kst("GROUP BY U.usuario ");
    kst("ORDER BY U.usuario");

    $a1 = kst();
    //die($a1);
    $arr = kselect($a1);

    $response["error"] = false;
    $response["errorDesc"] = "";
    $response["data1"] = $arr;
    kecho(200, $response);
    ?>