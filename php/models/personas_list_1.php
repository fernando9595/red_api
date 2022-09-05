<?php
    //http://localhost/red_api/index.php?idJob=personas_list_1&token=1
    //automatic script by otro


    $documento = krequest('documento',0);
    $apellido = krequest('apellido','');
    $idDelegacion = krequest('idDelegacion',0);



    kst("SELECT P.tipo,P.documento,P.nombre,P.activo,D.delegacion,");
    kst("date_format(P.fnacimiento,'%d/%m/%Y') as f_nacimiento,");
    kst("cud");
    kst("FROM personas P, delegaciones D");
    kst("where P.idDelegacion=D.idDelegacion");
    if( $documento <> 0){
        kst("and documento like '%$documento%'");
    }
    if( $apellido <> '' ){
        kst("and nombre like '%$apellido%'");
    }
    if( $idDelegacion <> 0 ){
        kst("and P.idDelegacion = $idDelegacion"); 
    }
    kst("order by nombre");
    kst("limit 100");

    $a1 = kst();
    $arr = kselect($a1);
    $response["error"] = false;
    $response["errorDesc"] = '';
    $response["data1"] = $arr;
    kecho(200, $response);

?>