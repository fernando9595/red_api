 <?php
    //http://localhost/red_api/index.php?token=123&idJob=_rpt_afiliados_cantidad&idDelegacion=2
    krequiredparams(array('idDelegacion'));
    $idDelegacion = krequest('idDelegacion');
    $periodo = krequest('periodo');

   

   $tabla = "update_ospahg";

   //kst("select date_format(fecha,'%d/%m/%Y') as fecha,idDelegacion,tabla,alta+modi as total,chau as baja,alta as nuevos,modi");
   kst("select date_format(fecha,'%d/%m/%Y') as fecha,idDelegacion");
   kst("from update_info");
   kst("where year(fecha)>=2021");
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

      $mes = substr($fecha, 3, 2);
      $ano = substr($fecha, 6, 4);
      $periodo ="$mes/$ano";

      kst("select count(nombre) as cant");
      kst("from personas");
      kst("WHERE instr(historial,'$periodo-$idDelegacion') >0");
      $a1 = kst();
      $arr2 = kselect($a1);

      $cant = $arr2[0]['cant'];

      echo "$fecha : $periodo-$idDelegacion : $cant<br>";
   }
   die();








   kecho(200, $response);
