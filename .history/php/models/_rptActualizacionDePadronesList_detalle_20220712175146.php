    //http://localhost/red_api/index.php?token=123&idJob=_rptActualizacionDePadronesList_detalle

    <?php
    $tabla = krequest('idDelegacion', '');

    kst("select date_format(fecha,'%d/%m/%Y') as fecha,idDelegacion,tabla,chau as baja,alta,modi");
    kst("from personas");
    kst("WHERE instr(historial,'01/2022-5') >0");
    //kst("order by id desc");

    $a1 = kst();
    $arr = kselect($a1);

    $response["error"] = false;
    $response["errorDesc"] = "";
    $response["data1"] = $arr;
    kecho(200, $response);
