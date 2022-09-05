<?php
    //automatic script by otro
    krequiredparams(array('idNomenclador'));
    $idNomenclador = $_REQUEST['idNomenclador'];

    $data = array(
        "n idNomenclador"           => $_POST["idNomenclador"],
        "s codigo"                  => $_POST["codigo"],
        "s descripcion"             => $_POST["descripcion"],
        "s autoriza"                => $_POST["autoriza"],
        "s activo"                  => $_POST["activo"],
        "s origen"                  => $_POST["origen"],
        "s pmo"                     => $_POST["pmo"],
        "s descripcionpmo"          => $_POST["descripcionpmo"],
        "n idvalor"                 => $_POST["idvalor"],
        "s automatico"              => $_POST["automatico"],
        "n cs01"                    => $_POST["cs01"],
        "n cs02"                    => $_POST["cs02"],
        "n cs03"                    => $_POST["cs03"],
        "n cs04"                    => $_POST["cs04"],
        "n cs05"                    => $_POST["cs05"],
        "n cs06"                    => $_POST["cs06"],
        "n cs07"                    => $_POST["cs07"],
        "n cs08"                    => $_POST["cs08"],
        "n cs09"                    => $_POST["cs09"],
        "n cs10"                    => $_POST["cs10"],
        "n cs11"                    => $_POST["cs11"],
        "n cs12"                    => $_POST["cs12"],
        "n cs13"                    => $_POST["cs13"],
        "n cs14"                    => $_POST["cs14"],
        "n cs15"                    => $_POST["cs15"],
        "n cs01_2"                  => $_POST["cs01_2"],
        "n cs02_2"                  => $_POST["cs02_2"],
        "n cs03_2"                  => $_POST["cs03_2"],
        "n cs04_2"                  => $_POST["cs04_2"],
        "n cs05_2"                  => $_POST["cs05_2"],
        "n cs06_2"                  => $_POST["cs06_2"],
        "n cs07_2"                  => $_POST["cs07_2"],
        "n cs08_2"                  => $_POST["cs08_2"],
        "n cs09_2"                  => $_POST["cs09_2"],
        "n cs10_2"                  => $_POST["cs10_2"],
        "n cs11_2"                  => $_POST["cs11_2"],
        "n cs12_2"                  => $_POST["cs12_2"],
        "n cs13_2"                  => $_POST["cs13_2"],
        "n cs14_2"                  => $_POST["cs14_2"],
        "n cs15_2"                  => $_POST["cs15_2"],
        "n cs01_r"                  => $_POST["cs01_r"],
        "n cs02_r"                  => $_POST["cs02_r"],
        "n cs03_r"                  => $_POST["cs03_r"],
        "n cs04_r"                  => $_POST["cs04_r"],
        "n cs05_r"                  => $_POST["cs05_r"],
        "n cs06_r"                  => $_POST["cs06_r"],
        "n cs07_r"                  => $_POST["cs07_r"],
        "n cs08_r"                  => $_POST["cs08_r"],
        "n cs09_r"                  => $_POST["cs09_r"],
        "n cs10_r"                  => $_POST["cs10_r"],
        "n cs11_r"                  => $_POST["cs11_r"],
        "n cs12_r"                  => $_POST["cs12_r"],
        "n cs13_r"                  => $_POST["cs13_r"],
        "n cs14_r"                  => $_POST["cs14_r"],
        "n cs15_r"                  => $_POST["cs15_r"],
    );
    $where = " idNomenclador=$idNomenclador";

    $sql = ksqlupdate("nomenclador",$data,$where);
    $arr = kexecute($sql);


    $response["error"] = false;
    $response["errorDesc"] = '';
    $response["data1"] =  '';
    kecho(200, $response);


?>