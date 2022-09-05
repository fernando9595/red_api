 <?php
    //http://localhost/red_api/index.php?token=123&idJob=_rpt_afiliados_cantidad&idDelegacion=2
    krequiredparams(array('idDelegacion'));
    $idDelegacion = krequest('idDelegacion');
    $periodo = krequest('periodo');

   //  kst("select nombre,documento");
   //  kst("from personas");
   //  kst("WHERE instr(historial,'$periodo-$idDelegacion') >0");
   //  //kst("order by id desc");

   //  $a1 = kst();
   //  $arr = kselect($a1);

   //  $response["error"] = false;
   //  $response["errorDesc"] = "";
   //  $response["data1"] = $arr;


   kst("select date_format(fecha,'%d/%m/%Y') as fecha,idDelegacion,tabla,alta+modi as total,chau as baja,alta as nuevos,modi");
   kst("from update_info");
   //kst("where true");
   kst("where year(fecha)>=2020");
   // if ($tabla <> 'todos') {
   //    kst("and tabla = '$tabla'");
   // }

   kst("order by id desc");

   $a1 = kst();
   $arr = kselect($a1);

   $response["error"] = false;
   $response["errorDesc"] = "";
   $response["data1"] = $arr;
   kecho(200, $response);








   kecho(200, $response);
