xxxxxxxxxxxxxxxx
<?php
yyyyyyyyyyy;
	//https://www.redprestacional.com/red_api/index.php?idJob=error_sql&token=1
    //automatic script by otro

    //cambio select
    //agregado idDelegacion para filtro
    //agregado order by

//    $idDelegacion = krequest('idDelegacion',0);

    kst("EER SELECT U.idUsuario,U.usuario,U.rol,D.Delegacion,U.activo,U.automatico,U.grupo,U.grupo1,");
    kst("U.alta_afiliado,U.solo_consulta,U.codigos_permitidos,U.razon_social,U.anular,U.coseguro,U.cobrar,U.cobrar_anular");
    kst("FROM usuariosXXX U, delegaciones D");
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
?>