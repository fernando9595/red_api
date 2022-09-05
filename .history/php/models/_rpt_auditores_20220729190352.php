 <?php
    //http://localhost/red_api/index.php?idJob=_rpt_auditores&desde=2022-05-01&hasta=2022-06-01&token=123

    //https://www.redprestacional.com/redBuildWeb/red_api/index.php?idJob=vademecums_list_1&token=123

    $desde = krequest('desde', '');
    $hasta = krequest('hasta', '');
    $desdeSql = $desde;
    $hastaSql = $hasta;

    kst("SELECT U.usuario,substr(P.f_auditado,1,10),count(P.fecha)");
    kst("FROM pedidos P, usuarios U");
    kst("WHERE P.red_idUsuario = U.idUsuarioa)");
    kst("and f_auditado >= '2022-05-01'");
    kst("and f_auditado <= '2022-06-01'");
    kst("GROUP BY U.usuario, substr(P.f_auditado,1,10)");

    $a1 = kst();
    $ar = kselect($a1);

    $response["error"] = false;
    $response["errorDesc"] = "";
    $response["data1"] = $arr;
    kecho(200, $response);
    ?>