<?php
    //automatic script by otro

    //https://www.redprestacional.com/redBuildWeb/red_api/index.php?idJob=clinicas_list_&token=123
    //http://localhost/red_api/index.php?idJob=clinicas_list_&token=123

    //$ = krequest('','')

    kst( 'SELECT *' );
    kst( 'FROM clinicas' );
    kst( 'LIMIT 100' );

    $a1 = kst();
    $arr = kselect($a1);

    $response["error"] = false;
    $response["errorDesc"] = '';
    $response["data1"] = $arr;
    kecho(200, $response);
?>