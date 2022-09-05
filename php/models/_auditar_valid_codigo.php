<?php
//http://localhost/red_api/index.php?idJob=_auditar_valid_codigo&token=123&documento=28485068&idPedido=1479&item=330101&cantidad=1&idDelegacion=7

//coseguro
//http://localhost/red_api/index.php?idJob=_auditar_valid_codigo&token=123&idPedido=1890589&item=330101&cantidad=6

//http://localhost/red_api/index.php?idJob=_auditar_valid_codigo&token=123&idPedido=189058&item=330101&cantidad=6&documento=1&idUsuario=19

//select * from pedidosmov where item='330101'
//select * from pedidos where idPedido=1479

/*
-para buscar
SELECT P.documento,year(P.fecha),sum(cantidad)
from pedidos P, pedidosmov M
where P.idPedido=M.idPedido  				falta anulado
and M.item = '330101'
group by P.documento,year(P.fecha)


-  esi esta en esta api
select sum(cantidad) 
from pedidos P, pedidosmov M 
where P.idpedido=M.idpedido 
and P.documento=25216467 
and P.estado <> 'anulado' 
and year(P.fecha)=2016 
and M.item='330101'

*/
//ojo que para alta no sirve xq pide idpedido, en alta hay que enviar documento,idusuario    ....,delegacion_idusuario,idDelegacion

krequiredparams(array('idPedido', 'item', 'cantidad', 'documento', 'idUsuario'));

$idPedido = krequest('idPedido', 0);
$item = krequest('item', 0);
$cantidad = krequest('cantidad', 0);
//$documento = krequest('documento',0);
//$idDelegacion = krequest('idDelegacion',0);

$response["error"] = false;
$response["errorDesc"] = '';
$response["data1"] = 'ok';
$response["data2"] = '';        //aca va desc error
$response["data3"] = '';        //aca van datos, asi si da error tmb mando datos		


//sacado de app.php


//
if ($idPedido > 0) {
    $existe = kselectone("select idpedido from pedidos where idPedido=$idPedido");
    if ($existe == 0) {
        $response["data1"] = 'error';
        $response["data2"] = "El numero de pedido no existe $idPedido";
        kecho(200, $response);
    }
}


//-- si tiene coseguro
$delegacion_idUsuario = kselectone("select delegacion_idUsuario from pedidos where idPedido=$idPedido");
$documento = kselectone("select documento from pedidos where idPedido=$idPedido");
$idDelegacion = kselectone("select idDelegacion from pedidos where idPedido=$idPedido");
$coseguro = kselectone("select coseguro from usuarios where idUsuario=" . $delegacion_idUsuario);

$arr = kselect("select * from nomenclador where codigo='$item'");
$descripcion = $arr[0]['descripcion'];
$acumulado_ano = 0;
$acumulado_mes = 0;
$automatico = $arr[0]['automatico'];
if ($coseguro == "si") {
    $idvalor = $arr[0]['idvalor'];
    $coseguro = $arr[0]['cs02'] * $cantidad;
    $unitario = $arr[0]['cs02'];
} else {
    $idvalor = 0;
    $coseguro = 0;
    $unitario = 0;
}

//------------------------------- restricciones ------------------------------------
//11/2019
//convencion... en el sql hay un campo error... que en js miro, si tiene data no continua
// para dejar continuar agregar campo nota
switch ($item) {
    case '330101':
        //4 al mes y 30 al año.. despues de prohibe
        $acumulado_ano = kacumulado_ano($documento, $item);
        $acumulado_mes = kacumulado_mes($documento, $item);
        if ($acumulado_ano >= 30) {
            $response["data1"] = "error";
            $response["data2"] = "ATENCION. Se permiten 30 al año de este codigo y ya acumula $acumulado_ano";
        } elseif ($acumulado_mes >= 4) {        //ano
            $response["data1"] = "error";
            $response["data2"] = "ATENCION. Se permiten 4 al mes de este codigo y ya acumula $acumulado_mes";
        } elseif (($acumulado_mes + $cantidad) > 4) {
            $response["data1"] = "error";
            $response["data2"] = "ATENCION. El acumulado del mes ($acumulado_mes) mas la cantidad ($cantidad) superan los 4 permitidos. cambie la cantidad";
        }
        break;

    default:
}

$arr = array(
    'item'              => $item,
    'descripcion'       => $descripcion,
    'coseguro'          => $coseguro,
    'unitario'          => $unitario,
    'idvalor'           => $idvalor,
    'acumulado_ano'     => $acumulado_ano,
    'acumulado_mes'     => $acumulado_mes,
    'automatico'        => $automatico,
);
$response["data3"] = json_encode($arr);

kecho(200, $response);

//----------------------------------------------------------------------------------------
function kacumulado_mes($documento, $item)
{
    $ano = date("Y");                    //mes 4 dig
    $mes = date("m");
    kst("select sum(cantidad)");
    kst("from pedidos P, pedidosmov M");
    kst("where P.idpedido=M.idpedido");
    kst("and P.documento=$documento");
    kst("and P.estado <> 'anulado'");
    kst("and year(P.fecha)=$ano");
    kst("and month(P.fecha)=$mes");
    kst("and M.item='$item'");
    $s = kst();
    $acumulado_mes =  kselectone($s);
    if (is_null($acumulado_mes)) {
        $acumulado_mes = 0;
    }
    return $acumulado_mes;
}

//----------------------------------------------------------------------------------------
function kacumulado_ano($documento, $item)
{
    //acumulado al año
    $ano = date("Y");                    //ano 4 dig
    kst("select sum(cantidad)");
    kst("from pedidos P, pedidosmov M");
    kst("where P.idpedido=M.idpedido");
    kst("and P.documento=$documento");
    kst("and P.estado <> 'anulado'");
    kst("and year(P.fecha)=$ano");
    kst("and M.item='$item'");
    $s = kst();
    $acumulado_ano =  kselectone($s);
    if (is_null($acumulado_ano)) {
        $acumulado_ano = 0;
    }
    return $acumulado_ano;
}
