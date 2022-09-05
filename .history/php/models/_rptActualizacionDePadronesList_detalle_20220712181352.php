
    <?php
    //http://localhost/red_api/index.php?token=123&idJob=_rptActualizacionDePadronesList_detalle
    krequiredparams(array('idDelegacion'));
    krequiredparams(array('periodo'));
    $idDelegacion = krequest('idDelegacion');
    $perioso = krequest('periodo');

    kst("select nombre,documento");
    kst("from personas");
    kst("WHERE instr(historial,'$periodo-$idDelegacion') >0");
    //kst("order by id desc");

    $a1 = kst();
    $arr = kselect($a1);

    $response["error"] = false;
    $response["errorDesc"] = "";
    $response["data1"] = $arr;
    kecho(200, $response);
