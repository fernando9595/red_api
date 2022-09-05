<?php
    //https://www.redprestacional.com/redBuildWeb/red_api/index.php?idJob=prestadores_list_&token=123
    //http://localhost/red_api/index.php?idJob=prestadores_list_&token=123

    //automatic script by otro

    $prestador = krequest('prestador','');
    $especialidad = krequest('especialidad','');

    kst("SELECT idPrestador,prestador,especialidad,localidad,activo");
    kst("FROM prestadores");
    kst("WHERE true");
    if( $prestador<> '' ){
        kst("and prestador like '%$prestador%'");
    }
    if( $especialidad <> '' and $especialidad <> 'todos'){
        kst("and especialidad = '$especialidad'");
    }
    kst("order by prestador limit 100");

    $a1 = kst();
    $arr = kselect($a1);
    $response["error"] = false;
    $response["errorDesc"] = '';
    $response["data1"] = $arr;
    kecho(200, $response);
?>