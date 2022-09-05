<?php
    //automatic script by otro
    krequiredparams(array('idUsuario'));
    $idUsuario = $_REQUEST['idUsuario'];

    $data = array(
        "n idUsuario"               => $_REQUEST["idUsuario"],
        "s usuario"                 => $_REQUEST["usuario"],
        "s clave"                   => $_REQUEST["clave"],
        "s rol"                     => $_REQUEST["rol"],
        "s ayuda"                   => $_REQUEST["ayuda"],
        "n idDelegacion"            => $_REQUEST["idDelegacion"],
        "s linea1"                  => $_REQUEST["linea1"],
        "s linea2"                  => $_REQUEST["linea2"],
        "s linea3"                  => $_REQUEST["linea3"],
        "s activo"                  => $_REQUEST["activo"],
        "s automatico"              => $_REQUEST["automatico"],
        "s automatico_campo"        => $_REQUEST["automatico_campo"],
        "n grupo"                   => $_REQUEST["grupo"],
        "n grupo1"                  => $_REQUEST["grupo1"],
        "s alta_afiliado"           => $_REQUEST["alta_afiliado"],
        "s solo_consulta"           => $_REQUEST["solo_consulta"],
        "s codigos_permitidos"      => $_REQUEST["codigos_permitidos"],
        "n razon_social"            => $_REQUEST["razon_social"],
        "s anular"                  => $_REQUEST["anular"],
        "s coseguro"                => $_REQUEST["coseguro"],
        "s cobrar"                  => $_REQUEST["cobrar"],
        "s cobrar_anular"           => $_REQUEST["cobrar_anular"],
        "n version"                 => $_REQUEST["version"],
    );
    $where = " idUsuario=$idUsuario";

    $sql = ksqlupdate("usuarios",$data,$where);
    $arr = kexecute($sql);


    $response["error"] = false;
    $response["errorDesc"] = '';
    $response["data1"] =  '';
    kecho(200, $response);


?>