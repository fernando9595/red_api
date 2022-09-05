<?php
    //http://localhost/red_api/index.php?idJob=generar_apis

    $nombre_bd = 'home_redprest_red';
    $arr = kselect("SHOW TABLES FROM $nombre_bd");

    //--- todas las tablas
    for($i=0;$i<count($arr);$i++){
        $tabla=$arr[$i]['Tables_in_home_redprest_red'];
        echo("{$tabla} <br>");

        //--- los campos
        $stru = "\$data = array(\n";
        $inputData  = "  final ret = KformModel();\n";
        $inputData .= "  $tabla = initialData[0]   //si hay mas de uno \n\n";


        $pk = "";
        $field_activo='';
        $arrfields = kselect("SHOW COLUMNS FROM $tabla");
        for($j=0;$j<count($arrfields);$j++){
            $field=$arrfields[$j]['Field'];
            $type=$arrfields[$j]['Type'];
            $key=$arrfields[$j]['Key'];
            if( $key == "PRI" ){
                $pk = $field;
            }
            if( strtolower($field) == 'activo' ){
                $field_activo = $field;
            }
            echo(" * $field $type $key <br>");

            $tipo = "?";
            if( $type == 'double'){
                $tipo = 'n';
            }elseif( substr($type,0,3)=='int'){
                $tipo = "n";
            }else{    
                $tipo = "s";
            }
            $stru .= str_pad("        \"$tipo $field\" ",35," ") . " => \$_POST[\"$field\"],\n";


            //--- para dart kform
            //    formModel.addInput('', 'Nombre (o parte del nombre)', 'text', '', textLen: 20);
            if( $type == 'double'){
                $tipo = 'number';
                $p1 = "numberIntegers: 10, numberDecimals: 2";
            }elseif( substr($type,0,3)=='int'){
                $tipo = "number";
                $p1 = "numberIntegers: 10, numberDecimals: 0";
            }elseif( substr($type,0,4)=='date'){
                $tipo = "date";
            }elseif( substr($type,0,4)=='text'){
                $tipo = "text";
                $p1 = "textLen: 100";            //memo FALTA
            }else{    
                $tipo = "text";
                $pos1 = strpos($type, '(');
                $pos2 = strpos($type, ')');
                $a1 = substr($type,$pos1+1, $pos2-$pos1-1);
//echo("$field $pos1  $pos2  $a1\n");
                $p1 = "textLen: $a1";
            }
            $defa = "$tabla.$field";
            $inputData .= "    ret.addInput('$field', '$field', '$tipo', $defa, $p1);\n";

        }
        $stru .= '    );';



        //armo
        $file="php/models/no_generated/{$tabla}";

    //------------------------------------------------------------------------------- list
//    \$arr = kselect("SELECT * FROM $tabla");
    $list = <<<EOD
<?php
    //automatic script by otro

    //https://www.redprestacional.com/redBuildWeb/red_api/index.php?idJob={$tabla}_list_&token=123
    //http://localhost/red_api/index.php?idJob={$tabla}_list_&token=123

    //\$x = krequest('x','');

    kst( 'SELECT *' );
    kst( 'FROM $tabla' );
    //kst( "WHERE true" );
    //if( \$<> '' ){
    //    kst("and x like '%\$x%'");
    //}
    //kst( 'ORDER BY ' );
    kst( 'LIMIT 100' );

    \$a1 = kst();
    \$arr = kselect(\$a1);

    \$response["error"] = false;
    \$response["errorDesc"] = '';
    \$response["data1"] = \$arr;
    kecho(200, \$response);
?>
EOD;


    //------------------------------------------------------------------------------- delete
    $delete = <<<EOD
<?php
    //automatic script by otro
    krequiredparams( array('$pk') );
    \${$pk} = \$_REQUEST['$pk'];

    \$arr = kselect("DELETE FROM $tabla WHERE $pk=\${$pk}");
    \$response["error"] = false;
    \$response["errorDesc"] = '';
    \$response["data1"] =  "";
    kecho(200, \$response);
?>
EOD;

    //------------------------------------------------------------------------------- getone
    $getone = <<<EOD
<?php
    //automatic script by otro
    krequiredparams( array('$pk') );
    \${$pk} = \$_REQUEST['$pk'];

//kdebug($tabla);
    \$arr = kselect("SELECT * FROM $tabla WHERE $pk=\${$pk}");
    \$response["error"] = false;
    \$response["errorDesc"] = '';
    \$response["data1"] =  \$arr[0];
    kecho(200, \$response);
?>
EOD;



    //------------------------------------------------------------------------------- no_activo
    if( $field_activo <> '') {
        $no_activo = <<<EOD
<?php
    //automatic script by otro
    krequiredparams( array('$pk') );
    \${$pk} = \$_REQUEST['$pk'];

    \$arr = kselect("UPDATE $tabla set $field_activo='no' WHERE $pk=\${$pk}");
    \$response["error"] = false;
    \$response["errorDesc"] = '';
    \$response["data1"] =  \$arr[0];
    kecho(200, \$response);
?>
EOD;
    }


    //------------------------------------------------------------------------------- update
    $update = <<<EOD
<?php
    //automatic script by otro
    krequiredparams( array('$pk') );
    \${$pk} = \$_REQUEST['$pk'];

    $stru
    \$where = " $pk=\${$pk}";

    \$sql = ksqlupdate("$tabla",\$data,\$where);
    \$arr = kexecute(\$sql);


    \$response["error"] = false;
    \$response["errorDesc"] = '';
    \$response["data1"] =  '';
    kecho(200, \$response);


?>
EOD;


    //------------------------------------------------------------------------------- insert
    $insert = <<<EOD
<?php
    //automatic script by otro
    krequiredparams( array('$pk') );
    \${$pk} = \$_REQUEST['$pk'];

    $stru
    \$where = "WHERE $pk=\${$pk}";

    \$sql = ksqlinsert("$tabla",\$data,\$where );
    \$arr = kexecute(\$sql);


    \$response["error"] = false;
    \$response["errorDesc"] = '';
    \$response["data1"] = '';
    kecho(200, \$response);


?>
EOD;


//echo('-------------------------');
//echo($file);

        echo($getone);
        dogenerar("{$file}_list_.php",$list);
        dogenerar("{$file}_delete_.php",$delete);
        dogenerar("{$file}_getone_.php",$getone);
        dogenerar("{$file}_update_.php",$update);
        dogenerar("{$file}_insert_.php",$insert);
        dogenerar("{$file}_inputData_.dart",$inputData);
        
        /*
        if( $field_activo <> '') {
            dogenerar("{$file}_noactivo_.php",$no_activo);
        }
        */
    
        echo("<br>");
    }


die('x');
return;


/* -------------------------------------------------------------------- */
function dogenerar($file,$texto){
echo("--- $file");
    // w igual que a pero borra el contenido
    if (!$p = fopen($file, 'w')) { 
        die("#ERR p10072. kdebug_write. cant open file $file");
    }
    if (!fwrite($p, $texto)) {
        die( "#ERR p10071. kdebug_write. cant write in file $file");
    }
    fclose($p);

}




?>
