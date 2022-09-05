<?php
    //http://localhost/red_api/index.php?idJob=nomenclador_list_1&token=1               //&codigo=''&descripcion=''
    //automatic script by otro

    $codigo= krequest('codigo','');
    $descripcion = krequest('descripcion','');


    kst("SELECT codigo,descripcion,activo,idvalor,automatico,autoriza,pmo");
    //kst("select codigo");
    kst("FROM nomenclador");
    kst("WHERE true");
    if( $codigo<> '' ){
        kst("and codigo like '%$codigo%'");
    }
    if( $descripcion <> '' ){
        kst("and descripcion like '%$descripcion%'");
    }
    kst("order by codigo limit 100");

    $a1 = kst();
    $arr = kselect($a1);
    $response["error"] = false;
    $response["errorDesc"] = '';
    $response["data1"] = $arr;
    //die($a1);
    kecho(200, $response);
?>