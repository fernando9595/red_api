<?php
    // modi idpersona x documento
    //automatic script by otro
    krequiredparams(array('documento'));
    $documento = $_REQUEST['documento'];

    $data = array(
        "n idPersona"               => $_POST["idPersona"],
        "s nombre"                  => $_POST["nombre"],
        "s codigo"                  => $_POST["codigo"],
        "s carga"                   => $_POST["carga"],
        "n idDelegacion"            => $_POST["idDelegacion"],
        "s tipo"                    => $_POST["tipo"],
        "n documento"               => $_POST["documento"],
        "s sexo"                    => $_POST["sexo"],
        "s incapacidad"             => $_POST["incapacidad"],
        "s cuil"                    => $_POST["cuil"],
        "s notas"                   => $_POST["notas"],
        "s tratamiento"             => $_POST["tratamiento"],
        "s medicamentos"            => $_POST["medicamentos"],
        "s fnacimiento"             => $_POST["fnacimiento"],
        "s activo"                  => $_POST["activo"],
        "s origen"                  => $_POST["origen"],
        "s f_alta"                  => $_POST["f_alta"],
        "s localidad"               => $_POST["localidad"],
        "s valido_hasta"            => $_POST["valido_hasta"],
        "s monotributo"             => $_POST["monotributo"],
        "s historial"               => $_POST["historial"],
    );
    $where = " documento=$documento";

    $sql = ksqlupdate("personas",$data,$where);
    $arr = kexecute($sql);


    $response["error"] = false;
    $response["errorDesc"] = '';
    $response["data1"] =  '';
    kecho(200, $response);


?>