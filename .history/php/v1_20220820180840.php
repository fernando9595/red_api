<?php

/*
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

set_error_handler("customError",E_ALL);
function customError($errno, $errstr)
  {
  echo "<b>Error   VERRRRRRRRRRRRRRRRRRRRR:</b> [$errno] $errstr<br>";
  echo "Ending Script";
  die();
  }
*/

//http://localhost/red_api/index.php?idJob=usuarios_list_1&token=1
//http://localhost/red_api/index.php?idJob=usuarios_list_1&token=localhost/red_api/index.php?idJob=usuarios_list_1&token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZFVzdWFyaW8iOjQwfQ==.vvf4rzvTtDcaWwwBHxsPK1VMbmU9G5jnN5QTUgufybs=

//http://localhost/red_api/index.php?idJob=cosegurovalores_getone_&id=1&token=1


/*
 *
 * @About:      API Interface
 * @File:       index.php
 * @Date:       $Date:$ Nov-2015
 * @Version:    $Rev:$ 1.0
 * @Developer:  Federico Guzman (federicoguzman@gmail.com)
*/

/* Los headers permiten acceso desde otro dominio (CORS) a nuestro REST API o desde un cliente remoto via HTTP
 * Removiendo las lineas header() limitamos el acceso a nuestro RESTfull API a el mismo dominio
 * metodos permitidos en Access-Control-Allow-Methods. Esto nos permite limitar los metodos de consulta a nuestro RESTfull API
 * Mas informacion: https://developer.mozilla.org/en-US/docs/Web/HTTP/Access_control_CORS
*/
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: text/html; charset=utf-8');
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');


include_once 'php/comun.php';

//retorno, defino aca todos los valores, despues los voy cambiado segun de...
$response = array();
$response["error"] = '';
$response["errorDesc"] = '';
$response["data1"] = '';
$response["data2"] = '';
$response["data3"] = '';
$response["token"] = '';

/* -------------- params ------------- */
$idJob = krequest('idJob');
$GLOBALS['idJob'] = $idJob;
klog2(json_encode($_REQUEST), "connect", $idJob);

kdebug('ini ===========================================================================================');
kdebug( "idjob : $idJob" );
kdebug('-----');
kdebug('$_REQUEST : ' . json_encode($_REQUEST));
kdebug('-----');


/* ----------------------------------------------------------------------------------------------------- */
//caso especial, al ppio de todo, sino controla token
if ($idJob == 'generar_apis') {
    //localhost/red_api/index.php?token=1&idJob=generar_apis
    require 'php/generar_apis.php';
}



/* ----------------------------------------------------------------------------------------------------- */
// login o no... y continuan if con idjob
if ($idJob == 'login') {
    doLogin();
}else{
    doVerify();    
}



/* ----------------------------------------------------------------------------------------------------- */
function doLogin(){

    // no necesita token
    //http://localhost/red_api/index.php?idJob=login&usuario=prueba&password=prueba

    krequiredparams( array('usuario') );

    $server_name = $_SERVER["SERVER_NAME"];
    $usuario = $_REQUEST['usuario'];
    $pwd     = $_REQUEST['password'];

    $response = array();
    kst("select '$server_name' as data, U.*,D.delegacion");
    kst("from usuarios U, delegaciones D");
    kst("where U.idDelegacion=D.idDelegacion");
    kst("and U.usuario='$usuario' and U.clave='$pwd' and U.activo='si'");

    $response["error"] = 'false';
    $response["errorDesc"] = '';
    $response["data1"] = '';
    $response["data2"] = '';
    $response["data3"] = '';
    $response["token"] = '';

    $a1 = kst();
    $arr = kselect($a1);
    if (count($arr) == 1) {
        //$response["error"] = false;
        $response["data1"] = $arr;

        //armo token
        // solo 'muevo' idUsuario, y de ahi saco los demas datos
        $idUsuario = $arr[0]['idUsuario'];


        //header -  base64 encodes the header json
        $arr2 = array('alg' => 'HS256', 'typ' => 'JWT');
        $arr22 = json_encode($arr2);
        $encoded_header = base64_encode($arr22);

        //payload -  base64 encodes the payload json
        $arr3 = array('idUsuario' => $idUsuario);
        $arr33 = json_encode($arr3);
        $encoded_payload = base64_encode($arr33);

        // Creating the signature, a hash with the s256 algorithm and the secret key. The signature is also base64 encoded.
        $secret_key = 'clave secreta';
        $signature = base64_encode(hash_hmac('sha256', $encoded_header . '.' . $encoded_payload , $secret_key, true));

        // Creating the JWT token by concatenating the signature with the header and payload, that looks like this:
        $jwt_token = $encoded_header . '.' . $encoded_payload . '.' . $signature;

        //listing the resulted  JWT
        $token = $jwt_token;

    } else {
        //$response["error"] = true;
        $response["data1"] = "Usuario y/o clave incorrecto !!!";

    }

    $response["token"] = $token;
    kecho(200, $response);

}

/* ----------------------------------------------------------------------------------------------------- */
function doVerify(){
    $tokenQueViene = krequest('token');


    //falta verificar, obtener datos y ver rol, permisos etc
    $token = $tokenQueViene;


    //-- analizo token que viene

    $recievedJwt = $token;

    $secret_key = 'clave secreta';

    // Split a string by '.'
    $f_ok = false;        //asumo mal
$f_ok = true;

    $jwt_values = explode('.', $recievedJwt);
    if( count($jwt_values) == 3 ){
        // extracting the signature from the original JWT
        $recieved_signature = $jwt_values[2];
    
        // concatenating the first two arguments of the $jwt_values array, representing the header and the payload
        $recievedHeaderAndPayload = $jwt_values[0] . '.' . $jwt_values[1];
    
        // creating the Base 64 encoded new signature generated by applying the HMAC method to the concatenated header and payload values
        $resultedsignature = base64_encode(hash_hmac('sha256', $recievedHeaderAndPayload, $secret_key, true));
    
        // checking if the created signature is equal to the received signature
        if($resultedsignature == $recieved_signature) {
            //OK
            // If everything worked fine, if the signature is ok and the payload was not modified you should get a success message
            $f_ok = true;
        }
    }

    if( $f_ok == false ){
        //bad
        $response["error"] = true;
        $response["errorDesc"] = 'Invalid token. Login again';
        kecho(200, $response);
    }    
    //--


    if ($token == '') {
        kecho(200, '#ERR. bad params, without token- ' . json_encode($_REQUEST));
    }
}


/* ----------------------------------------------------------------------------------------------------- */
//caso especial
if ($idJob == 'sql') {
    $sql = $_REQUEST['sql'];
    $arr = kselect($sql);
    $response["error"] = false;
    $response["errorDesc"] = '';
    $response["data1"] = $arr;
    kecho(200, $response);
}



// -----------------------------------------------------------------------------------------------------  
// $response = array();
// $response["error"] = false;
// $response["errorDesc"] = '';
// $response["data1"] = '';
// $response["data2"] = '';
// $response["data3"] = '';


/* ----------------------------------------------------------------------------------------------------- */
// debe existir archivo $idjob.php
if (file_exists("php/models/$idJob.php")) {
    require "php/models/$idJob.php";
}


// ----------------------------------------------------------------------------------------------------- 
//  si llego hasta aca error de idJob
// ----------------------------------------------------------------------------------------------------- 
$response["error"] = true;        //ojo, este error es para la conexion,no para mi, usar data1 con 'error' y data 2 con info del error, pero si para si no existe idjob
//$fe = file_exists("php/models/$idJob.php");
//$response["errorDesc"] = "verify idJob : $idJob and/or path/file  (file: php/models/$idJob.php)  (file_exists: '$fe' 1=true)";
$response["errorDesc"] = "verify idJob : $idJob and/or path/file  (file: php/models/$idJob.php)";
kecho(200, $response);
