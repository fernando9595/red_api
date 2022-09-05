<?php
    //automatic script by otro
    krequiredparams(array('idUsuario'));
    $idUsuario = $_REQUEST['idUsuario'];

    $data = array(
        "n idUsuario"               => $_POST["idUsuario"],
        "s usuario"                 => $_POST["usuario"],
        "s clave"                   => $_POST["clave"],
        "s rol"                     => $_POST["rol"],
        "s ayuda"                   => $_POST["ayuda"],
        "n idDelegacion"            => $_POST["idDelegacion"],
        "s linea1"                  => $_POST["linea1"],
        "s linea2"                  => $_POST["linea2"],
        "s linea3"                  => $_POST["linea3"],
        "s activo"                  => $_POST["activo"],
        "s automatico"              => $_POST["automatico"],
        "n grupo"                   => $_POST["grupo"],
        "n grupo1"                  => $_POST["grupo1"],
        "s alta_afiliado"           => $_POST["alta_afiliado"],
        "s solo_consulta"           => $_POST["solo_consulta"],
        "s codigos_permitidos"      => $_POST["codigos_permitidos"],
        "n razon_social"            => $_POST["razon_social"],
        "s anular"                  => $_POST["anular"],
        "s coseguro"                => $_POST["coseguro"],
        "s cobrar"                  => $_POST["cobrar"],
        "s cobrar_anular"           => $_POST["cobrar_anular"],
        "n version"                 => $_POST["version"],
    );
    $where = "WHERE idUsuario=$idUsuario";

    $sql = ksqlinsert("usuarios",$data,$where );
    $arr = kexecute($sql);


    $response["error"] = false;
    $response["errorDesc"] = '';
    $response["data1"] = '';
    kecho(200, $response);


?>