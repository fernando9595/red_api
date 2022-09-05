<?php
    //automatic script by otro
    krequiredparams(array('idPrestador'));
    $idPrestador = $_REQUEST['idPrestador'];

    $data = array(
        "n idPrestador"             => $_POST["idPrestador"],
        "s prestador"               => $_POST["prestador"],
        "s localidad"               => $_POST["localidad"],
        "s provincia"               => $_POST["provincia"],
        "s especialidad"            => $_POST["especialidad"],
        "s activo"                  => $_POST["activo"],
        "s idusuarios"              => $_POST["idusuarios"],
    );
    $where = " idPrestador=$idPrestador";

    $sql = ksqlupdate("prestadores",$data,$where);
    $arr = kexecute($sql);


    $response["error"] = false;
    $response["errorDesc"] = '';
    $response["data1"] =  '';
    kecho(200, $response);


?>