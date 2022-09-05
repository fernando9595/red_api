<?php
    $amaJson = krequest('ama','x');
    $movJson = krequest('mov', 'x');
    $tratamiento = krequest('tratamiento','');
    $medicamentos = krequest('medicamentos','');

    $ama = json_decode($amaJson,true);
    $mov = json_decode($movJson,true);

    $idPedido = $ama['idPedido'];
    $documento = $ama['documento'];
    $red_idUsuario = $ama['red_idUsuario'];
    $informacion = $ama['informacion'];
    $observaciones = $ama['observaciones'];

    //print_r($mov);


    //1
    $estado = kselectone("select estado from pedidos where idPedido=$idPedido");

    //2
    kst("update pedidos");
    kst("set red_idUsuario=$red_idUsuario,");
    kst("f_auditado='" . date("Y-m-d H:i:s") . "'");
    kst("where idPedido=$idPedido");
    $sql = kst();
    if (kexecute($sql) == false) {
        kData1Error('#ERR 2106. Ocurrio un error al actualizar los datos');
    }


    //3
    $sql = "update personas set tratamiento='$tratamiento', medicamentos='$medicamentos' where documento=$documento";
    if (kexecute($sql) == false) {
        kData1Error('#ERR 2107. Ocurrio un error al actualizar los datos');
    }


    //4 - solo sigo si pendiente.
    if ($estado != "pendiente") {
        kData1Ok("Se actualizo tratamiento y medicamentos.");
    }
    

    //5 - 
    $sql="update pedidos set observaciones='$observaciones', informacion='$informacion' where idPedido=$idPedido";
    if (kexecute($sql) == false) {
        kData1Error('#ERR 2108. Ocurrio un error al actualizar los datos');
    }



    kData1Ok('pedido pendiente FALTA - actualizado observaciones e informacion');


    //6 - validar... y recalcular, esta en una api
    //      aca miro todos los items y analizo, si hay error return, si no... despues update (si update sobre la marcha y hay error al final..psss)
    $ok = true;
    $errorDesc = '';

    foreach($mov as $row){
        $item = $row['item'];
        $cantidad = $row['cantidad'];
        $estado = $row['estado'];
        $notas = $row['notas'];
        $coseguro = $row['coseguro'];
        $unitario = $row['unitario'];
        $idPedidoMov = $row['idPedidoMov'];
        $arr = kselect("select * from pedidosmov where idPedidoMov=$idPedidoMov");
        //analizar... jeje
    }
    if( $ok==false){
        kData1Error($errorDesc);
    }


    //ver en red  js : function solicitudesred_aceptar(){
    //      php :solicitudesred_aceptar
    //3
    // $sql = "delete from pedidos  where idPedido=$idPedido";
    // $arr = kexecute($sql);


    //
    kData1Error('no esta terminado ...');


?>
