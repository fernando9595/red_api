 <?php
    //http://localhost/red_api/index.php?token=123&idJob=_rpt_afiliados_cantidad&idDelegacion=2
    krequiredparams(array('idDelegacion'));
    $idDelegacion = krequest('idDelegacion');
    $periodo = krequest('periodo');

   

   $tabla = "update_ospahg";

   //kst("select date_format(fecha,'%d/%m/%Y') as fecha,idDelegacion,tabla,alta+modi as total,chau as baja,alta as nuevos,modi");
   kst("select date_format(fecha,'%d/%m/%Y') as fecha,idDelegacion");
   kst("from update_info");
   kst("where year(fecha)>=2020");
   kst("and idDelegacion = '$idDelegacion'");
   kst("order by id");
   $a1 = kst();
   $arr = kselect($a1);


   // $response["error"] = false;
   // $response["errorDesc"] = "";
   // $response["data1"] = $arr;
   // kecho(200, $response);
   for ($i = 0; $i < count($arr); $i++) {
      $fecha = $arr[$i]['fecha'];


      // kst("select nombre,documento");
      // kst("from personas");
      // kst("WHERE instr(historial,'$periodo-$idDelegacion') >0");
      // //kst("order by id desc");

      // $a1 = kst();
      // $arr2 = kselect($a1);

      echo "$fecha";
   }
   die();








   kecho(200, $response);
