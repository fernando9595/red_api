<?php
    //http://localhost/red_api/index.php?idJob=_rpt_pedidos_ospahg&id=1&token=1&delegacion_idUsuario=57

    krequiredparams(array('delegacion_idUsuario'));
    $delegacion_idUsuario = $_REQUEST['delegacion_idUsuario'];


    kst("select date_format(f_alta,'%d/%m/%Y') as fecha,dayname(P.f_alta) as dia,");
    kst("count(*) as cantidad,  P.delegacion_idUsuario as idUsuario,");
    kst("(select usuario from usuarios where idUsuario=P.delegacion_idUsuario) as usuario,");
    kst("Sum( If( P.estado='auditado',1,0)   ) AS auditado,");
    kst("Sum( If( P.estado='rechazado',1,0)   ) AS rechazado,");   
    kst("Sum( If( P.estado='anulado',1,0)   ) AS anulado,");
    kst("Sum( If( P.estado='pendiente',1,0)   ) AS pendiente"); 
    kst("from pedidos P,delegaciones D");
    kst("where P.idDelegacion=D.idDelegacion");
    kst("and P.idDelegacion=2");


//    kst("and P.delegacion_idUsuario = $delegacion_idUsuario");

    $t = '';
    switch (strtolower($delegacion_idUsuario)) {
    case 'todos':
        break;
    case 'zona bariloche':
//        $t = "and P.delegacion_idUsuario = 7";			//falta
        $t = "and delegacion_idUsuario IN (54,55,56,57,59,60,61)"; 
        break;
    case 'bariloche':
        $t = "and P.delegacion_idUsuario = 59";			//falta
        break;
    case 'el bolson':
        $t = "and P.delegacion_idUsuario = 54";
        break;
    case 'villa la angostura':
        $t = "and P.delegacion_idUsuario = 55";
        break;
    case 'neuquen':
        $t = "and P.delegacion_idUsuario = 16";
        break;
    case 'cipolletti':
        $t = "and P.delegacion_idUsuario = 17";
        break;
    case 'roca':
        $t = "and P.delegacion_idUsuario = 18";
        break;
    case 'san martin':
        $t = "and P.delegacion_idUsuario = 19";
        break;
    case 'viedma':
        $t = "and P.delegacion_idUsuario = 20";
        break;
    case 'zapala':
        $t = "and P.delegacion_idUsuario = 35";
        break;
    default:
    }
    if( $t != '' ){	
        kst($t);
    }

    kst("group by date(f_alta),dayname(P.f_alta)");
    kst("order by date(f_alta) desc");
    kst("limit 120");


    $sql = kst();

    $arr = kselect($sql);
    $response["error"] = false;
    $response["errorDesc"] = '';
    $response["data1"] = $arr;
    kecho(200, $response);
?>


