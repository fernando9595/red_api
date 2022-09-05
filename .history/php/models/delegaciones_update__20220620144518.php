<?php
    //automatic script by otro
    // chau         "s coseguro"                => $_POST["coseguro"],
    krequiredparams(array('idDelegacion'));
    $idDelegacion = $_REQUEST['idDelegacion'];

    $data = array(
        "n idDelegacion"            => $_POST["idDelegacion"],
        "s delegacion"              => $_POST["delegacion"],
        "s Notas"                   => $_POST["Notas"],
        "s texto1"                  => $_POST["texto1"],
        "s activo"                  => $_POST["activo"],
    );
    $where = " idDelegacion=$idDelegacion";

    $sql = ksqlupdate("delegaciones",$data,$where);
    $arr = kexecute($sql);


    $response["error"] = false;
    $response["errorDesc"] = '';
    $response["data1"] =  '';
    kecho(200, $response);


?>