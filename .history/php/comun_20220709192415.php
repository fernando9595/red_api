<?php
include_once('config.php');



function kData1Error($description)
{
    $response["error"] = false;
    $response["errorDesc"] = '';
    $response["data1"] = 'error';
    $response["data2"] = $description;
    $response["data3"] = '';
    kecho(200, $response);
}
function kData1Ok($description)
{
    $response["error"] = false;
    $response["errorDesc"] = '';
    $response["data1"] = 'ok';
    $response["data2"] = $description;
    $response["data3"] = '';
    kecho(200, $response);
}


/* __________________________________________________________________________________ */
/*
function krequest($varname)
{
    return isset($_REQUEST[$varname])  ? $_REQUEST[$varname]  : NULL;
}
*/
function krequest($name, $defa = NULL)
{
    if (isset($_REQUEST[$name])) {
        return $_REQUEST[$name];
    } else {
        if (isset($defa)) {
            return $defa;
        } else {
            return NULL;
        }
    }
}

/* __________________________________________________________________________________ */
function kquery($sql)
{
    //kdebug("kquery : $sql");
    try {
        //mysql

        /* conexion */
        //echo( 'mysql:host=' .  DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8' . ',' .  DB_USERNAME . ',' .  DB_PASSWORD );


        $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USERNAME, DB_PASSWORD);

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

kdebug(1);
        /* query */
        $q = $db->query("SET @@lc_time_names = 'es_ES'");
        $q = $db->query($sql);
        if ($db->errorCode() != '0000') {
            kdebug_write("** NO DEBERIA PASAR, VER FUENTE -  ERROR EN DB **" . $db->errorCode());        //esto no deberia ejecutarse, para eso try
            die("#ERR CODE 291. kquery die");
        };
    } catch (Exception $e) {            //PDOException
        kdebug("ERROR EN LA CONEXION (1) : $e");
        if (isset($GLOBALS['idJob'])) {
            $x = $GLOBALS['idJob'];
        } else {
            $x = "no id";
        }

        //$x = $idjob;
        die("error en la conexion\n-idjob:'$x'\n-error:  $e");
        //die("error en la conexion : $x");
    }
    return $q;
}


/* __________________________________________________________________________________ */
function kexecute($sql)
{
    //para insert o update
    kdebug('kexecute ....');
    $q = kquery($sql);
    return $q;
}

/* __________________________________________________________________________________ */
function kselectone($sql)
{
    //sierve para count sum, etc
    $q = kselect($sql, "num");
    if (count($q) == 1) {
        $r = $q[0][0];
    } else {
        $r = "";
    }
    return $r;
}


/* __________________________________________________________________________________ */
function kselect($sql, $fetch = "assoc")
{
    klog2($sql, "sql", "_auditores_list.php");      //solo funciona si esta flag

    $q = kquery($sql);

    if ($q == false) {
        $arr = array(0 => array('#ERR P334. Site.' => ''));
    } else {
        if ($fetch == "both") {                                    // un array  con un array pc registro ...
            $arr = $q->fetchall(PDO::FETCH_BOTH);               //Array ( [title] => Book 1 [0] => Book 1 )

        } else if ($fetch == "num") {
            $arr = $q->fetchall(PDO::FETCH_NUM);                //Array ( [0] => Book 1 )

            //}else if ($fetch=="obj"){
            //    $arr = $q->fetchall(PDO::FETCH_OBJ);                //obj [title] =>Book 1

        } else {

            $arr = $q->fetchall(PDO::FETCH_ASSOC);             //array( [title] => Book 1) )
        }
    }

    /*
    if (count($arr) < 5  and count($arr) > 0) {
        $dump = var_export($arr, true);
        $dump = str_replace ("\n", "<br>", $dump);
    }
*/

    return $arr;
}


/* __________________________________________________________________________________ */
function kecho($status_code, $response)
{
    kdebug('FIN ==== kecho json_encode(response) : ' . json_encode($response));
    header('Content-type:application/json');
    echo json_encode($response);
    die();
}


/* __________________________________________________________________________________ */
function krequiredparams($required_fields)
{
    $error = false;
    $error_fields = "";
    $request_params = $_REQUEST;

    foreach ($required_fields as $field) {
        if (!isset($request_params[$field]) || strlen(trim($request_params[$field])) <= 0) {
            $error = true;
            $error_fields .= $field . ', ';
        }
    }

    if ($error) {
        $response = array();
        $response["error"] = true;
        $response["errorDesc"] = 'Faltan parametros : ' . substr($error_fields, 0, -2) . "  (verify idJob)";
        kecho(440, $response);
    }
}


/* __________________________________________________________________________________ */
function generar_token_seguro($longitud)
{
    if ($longitud < 4) {
        $longitud = 4;
    }

    return bin2hex(random_bytes(($longitud - ($longitud % 2)) / 2));
}


/* __________________________________________________________________________________ */
function ksessionvar($variable, $new_value = NULL)
{
    //guardo valor
    if (isset($_SESSION[$variable])) {
        $val = $_SESSION[$variable];
    } else {
        $_SESSION[$variable] = "";
        $val = "";
    }

    //asigno si tiene valor
    if ($new_value <> NULL) {
        $_SESSION[$variable] = $new_value;
    }

    //retorno valor viejo
    return $val;
}

/* __________________________________________________________________________________ */
function kdebug_query($v)
{
    //faltaria poner flag de cuando escribe
    //    kdebug_write($v);
}

/* __________________________________________________________________________________ */
function kdebug_db($v)
{
    //faltaria poner flag de cuando escribe
    // es que es otro dir en api... ver de unificar y poner todo en root que lo tienen todos    kdebug_write($v);
}

/* __________________________________________________________________________________ */
function kdebug($v)
{
    //faltaria poner flag de cuando escribe
    if (!file_exists('php/varios/no_kdebug.flg')) {
        return;
    }
    kdebug_write($v);
}

/* __________________________________________________________________________________ */
function kdebug_write($v)
{
    //SIEMPRE escribo en esta funcion, es llamada por otras que si controlan si se escribe o no

    $file = "php/varios/no_php_debug.txt";
    if (!$p = fopen($file, 'a')) {                 //lo creo
        die("#ERR p10072. kdebug_write. cant open file $file");
        //return;
    }
    $v = "gnl $v";

    if (!fwrite($p, $v)) {
        die("#ERR p10071. kdebug_write. cant write in file $file");
        //exit;
    }
    fclose($p);
}

/* __________________________________________________________________________________ */
function klog2($info, $grupo, $id = ".")
{

    $info = str_replace("'", "/", $info);        //utf8.. no va

    if (!file_exists('php/varios/no_klog2.flg')) {
        return;
    }

    $ip = kip();

    $data = detect();
    $browser = strtolower($data["browser"]);
    //    $version = intval($data["version"]);
    $version = $data["version"];

    $usuario = ksessionvar('usuario');
    /*
    if( $usuario=='r' || $usuario==''){
        return;
    }
    */

    /*
    if( $id == 'login' ) {
        $grupo = 'login';
    }
    */

    $s = "insert into log2 (fecha,id,info,ip,browser,version,usuario,grupo) values(NOW(),'$id','$info','$ip','$browser','$version','$usuario','$grupo')";
    $q = kexecute($s);
    return;
}


/* __________________________________________________________________________________ */
function kip()
{
    $client_ip = (!empty($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : ((!empty($_ENV['REMOTE_ADDR'])) ?  $_ENV['REMOTE_ADDR'] :  "unknown");
    return $client_ip;
}

/* __________________________________________________________________________________ */
function detect()
{
    //detecta navegador...

    $browser = array("IE", "OPERA", "MOZILLA", "NETSCAPE", "FIREFOX", "SAFARI", "CHROME", "DART");
    $os = array("WIN", "MAC", "LINUX");

    // definimos unos valores por defecto para el navegador y el sistema operativo
    $info['browser'] = "?";
    $info['version'] = "?";
    $info['os'] = "?";

    // buscamos el navegador con su sistema operativo
    foreach ($browser as $parent) {
        $s = -1;
        $version = '';
        $s = strpos(strtoupper('-' . $_SERVER['HTTP_USER_AGENT']), $parent);    //si esta en pos 0 se complica
        if ($s) {
            $f = $s + strlen($parent);
            $version = substr($_SERVER['HTTP_USER_AGENT'], $f, 15);
            $version = preg_replace('/[^0-9,.]/', '', $version);

            $info['browser'] = $parent;
            $info['version'] = $version;
        }
    }

    //kdebug("function detect() : 58");
    //kdebug($parent);
    //kdebug($version);


    // obtenemos el sistema operativo
    foreach ($os as $val) {
        if (strpos(strtoupper($_SERVER['HTTP_USER_AGENT']), $val) !== false) {
            $info['os'] = $val;
        }
    }

    // devolvemos el array de valores
    return $info;
}

/* __________________________________________________________________________________ */
function kst($t = '')
{
    static $s = '';
    if ($t == '') {
        $a = trim($s);
        $s = '';
        return $a;
    }
    $s = $s . " " . $t;
}

/* __________________________________________________________________________________ */
function ksqlupdate($tabla, $data, $where)
{
    $r = "update $tabla set ";
    //campos
    foreach ($data as $campo => $value) {
        $tipo = substr($campo, 0, 1);        //primero tipo
        $campo = substr($campo, 2);

        if ($tipo == 's') {            // tipos, String, Date, Numero
            //            $delim="'";
            //            $delim='"';
            $pos = strrpos($value, "'");
            if ($pos === false) {
                $delim = "'";
            } else {
                $delim = '"';
            }
        } elseif ($tipo == 'd') {
            $delim = "'";
        } else {
            $delim = '';
        }
        if ($tipo == 'n') {
            if ($value == '') {
                $value = 0;
            }
        }

        $r .= $campo . "=" . $delim . $value . $delim . ",";        //ojo si pongo espacio
    }

    $r = substr($r, 0, strlen($r) - 1);         //saco coma final

    $r .=  " where " . $where;
    //kdebug_query( 'ksqlupdate : ' . $r);
    return $r;
};

/* __________________________________________________________________________________ */
function ksqlinsert($tabla, $data)
{
    //ja, en mysql pongo todos los valores con comillas y voila... la bd transforma..jejeje
    // NOOOOOOOO AGREGO LETRA QUE IDENTIFICA, XQ VA TMA PARA SQLITE

    kdebug_db("KSQLINSERT IN. tabla=$tabla");

    //    $tipodb="sqlite";


    //es array?
    $rv = array_filter($data, 'is_array');
    if (count($rv) > 0) {
        $cantins = count($data);
        $arrtit = $data[0];
    } else {
        $cantins = 1;
        $arrtit = $data;
    }

    //---
    $r = "insert into $tabla (";

    //---campos
    foreach ($arrtit as $campo => $value) {
        //$r.="$campo, ";
        $r .= substr($campo, 2) . ", ";        //ojo espacio
    }
    $r = substr($r, 0, strlen($r) - 2);              //saco ultima coma, ojo hay un esp despues
    $r .= ") values";


    //--- datos
    for ($i = 0; $i < $cantins; $i++) {
        if ($cantins == 1) {
            $lin = $data;
        } else {
            $lin = $data[$i];
        }

        //valores
        $r .= " (";
        foreach ($lin as $campo => $value) {
            $tipo = substr($campo, 0, 1);
            $value = str_replace("'", '"', $value);

            //            if( $tipodb="mysql"){
            //                $delim="'";
            //            }else{
            if ($tipo == 's') {            // tipos, String, Date, Numero
                //$delim="'";
                $pos = strrpos($value, "'");
                if ($pos === false) {
                    $delim = "'";
                } else {
                    $delim = '"';
                }
            } elseif ($tipo == 'd') {
                $delim = "'";
            } else {
                if ($value == '') {
                    $value = 0;
                };
                $delim = '';
            }
            //            }
            $r .= " $delim$value$delim, ";
        };
        $r = substr($r, 0, strlen($r) - 2);              //saco ultima coma, ojo hay espacio
        $r .= ")";
        if ($cantins > 1) {
            $r .= ',';
        }
    }
    if ($cantins > 1) {
        //saco ultima coma, y agrego pto y coma
        $r = substr($r, 0, strlen($r) - 1);
        $r .= ';';
    }


    kdebug_db("     $r");


    kdebug_db("OUT ---------------------");


    return $r;
};
