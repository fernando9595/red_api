<?php
    //http://localhost/red_api/index.php?idJob=usuarios_list_1&token=123
    //https://www.redprestacional.com/redBuildWeb/red_api/index.php?idJob=usuarios_list_1&token=123
    //automatic script by otro

    //cambio select
    //agregado idDelegacion para filtro
    //agregado order by

    $idDelegacion = krequest('idDelegacion',0);

    // kst("SELECT U.idUsuario,U.usuario,U.rol,D.Delegacion,U.activo,");
    // kst("U.automatico as automatico_no_usar,U.automatico_campo,");
    // kst("U.grupo,U.grupo1,");
    // kst("U.alta_afiliado,U.solo_consulta,U.codigos_permitidos,U.razon_social,U.anular,U.coseguro,U.cobrar,U.cobrar_anular");


    kst("SELECT U.idUsuario,U.usuario,U.rol,D.Delegacion,U.activo,");
//    kst("U.automatico as automatico_no_usar,U.automatico_campo,");
    kst("U.grupo,U.grupo1,");
    kst("U.alta_afiliado,U.solo_consulta,U.codigos_permitidos,U.razon_social,U.anular,U.coseguro,U.cobrar,U.cobrar_anular");


    kst("FROM usuarios U, delegaciones D");
    kst("where U.idDelegacion=D.idDelegacion");
    if( $idDelegacion <> 0 ){
        kst("and U.idDelegacion = $idDelegacion"); 
    }
    kst("order by usuario");


    $a1 = kst();
    $arr = kselect($a1);

    $response["error"] = false;
    $response["errorDesc"] = '';
    $response["data1"] = $arr;
    kecho(200, $response);
