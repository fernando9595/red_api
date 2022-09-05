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
   echo "<style>";
   echo "   table, th, td {";
   echo "   border: 1px solid white;";
   echo " border-collapse: collapse;";
   echo "}";
   echo "</style>";

   echo "<table style='border :1px solid grey; border-collapse: collapse;'>";
   echo "<tr style='border :1px solid grey; border-collapse: collapse;'>";
   echo "<td>fecha</td>";
   echo "<td>periodo</td>";
   echo "<td>bariloche</td>";
   echo "<td>el bolson</td>";
   echo "<td>villa angostura</td>";
   echo "<td>san martin</td>";
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

      kst("select count(nombre) as cant from personas WHERE instr(historial,'$periodo-$idDelegacion') >0 and localidad='SAN MARTIN DE LOS AN'");
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
