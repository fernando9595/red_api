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
   echo "<table>";
   echo "<tr>";
   echo "<td>fecha</td><td>periodo</td><td>bariloche</td><td>el bolson>/td><td>villa angostura</td><td>san martin</td>";
   echo "</tr>";
   for ($i = 0; $i < count($arr); $i++) {
      $fecha = $arr[$i]['fecha'];

      $mes = substr($fecha, 3, 2);
      $ano = substr($fecha, 6, 4);
      $periodo ="$mes/$ano";

      //archivo 50 es bariloche
      kst("select count(nombre) as cant from personas WHERE instr(historial,'$periodo-$idDelegacion') >0 and localidad='BARILOCHE'");
      $a1 = kst();
      $arr2 = kselect($a1);
      $c_bariloche = $arr2[0]['cant'];

      kst("select count(nombre) as cant from personas WHERE instr(historial,'$periodo-$idDelegacion') >0 and localidad='EL BOLSON'");
      $a1 = kst();
      $arr2 = kselect($a1);
      $c_bolson = $arr2[0]['cant'];

      kst("select count(nombre) as cant from personas WHERE instr(historial,'$periodo-$idDelegacion') >0 and localidad='VA LA ANGOSTURA'");
      $a1 = kst();
      $arr2 = kselect($a1);
      $c_v_agostura = $arr2[0]['cant'];

      kst("select count(nombre) as cant from personas WHERE instr(historial,'$periodo-$idDelegacion') >0 and localidad='SAN MARTIN DE LOS ANDES'");
      $a1 = kst();
      $arr2 = kselect($a1);
      $c_san_martin = $arr2[0]['cant'];

      // kst("select count(nombre) as cant from personas WHERE instr(historial,'$periodo-$idDelegacion') >0 and localidad=''");
      // $a1 = kst();
      // $arr2 = kselect($a1);
      // $c_bolson = $arr2[0]['cant'];


      echo "<tr>";
      echo "<td>$fecha</td><td>$periodo-$idDelegacion</td><td>$c_bariloche</td><td>$c_bolson</td><td>$c_v_agostura</td><td>$c_san_martin</td>";
      echo "</tr>";
      flush();
      ob_flush();
   }
   echo "</table>";
   die();








   kecho(200, $response);
