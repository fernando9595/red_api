<?php
    // ojo, es vademecumS   no es igual que la tabla
    //automatic script by otro

    //https://www.redprestacional.com/redBuildWeb/red_api/index.php?idJob=vademecums_list_1&token=123
    //http://localhost/red_api/index.php?idJob=vademecums_list_1&token=123

    $codigo = krequest('codigo','');
    $descripcion = krequest('descripcion','');

    kst( 'SELECT *' );
    kst( 'FROM vademecum' );
    kst( "WHERE true" );
    if( $codigo <> '' ){
        kst("and codigo like '%$codigo%'");
    }
    if( $descripcion <> '' ){
        kst("and descripcion like '%$descripcion%'");
    }
    kst('order by descripcion');
    kst( 'LIMIT 100' );

    $a1 = kst();
    $arr = kselect($a1);

    $response["error"] = false;
    $response["errorDesc"] = '';
    $response["data1"] = $arr;
    kecho(200, $response);
?>