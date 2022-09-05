<?php
    //http://localhost/red_api/index.php?token=123&idJob=_archivos&idPedido=18687

    krequiredparams(array('idPedido'));
    
    $idPedido = krequest('idPedido',0);


//    $path="uploadx/";
    $path = "../red/upload";		// en jaus, localhost
    $data1 = array();
//    $id=0;

    if ($gd = opendir($path)) {    

        while (($file = readdir($gd)) !== false) {
            
//            $id += 1;  sirve para jquery rotar...
            
            if (is_dir("$path$file")) {
            }else{
                if( intval($file) == $idPedido ){
                    $data1[] = $file ;
                    //{"error":false,"errorDesc":"","data1":["194792_saravia carlos_00018.jpg","194792_saravia carlos_00034.jpg","194792_saravia carlos_00035.jpg"],"data2":"","data3":""}

                    // $h .= "<img id='$id' class='solicitudesred_karchivos' style='position:relative;width:600px;' src='$path$file' alt='imagen'>";
                }
            }
        } 
    }


    $response["error"] = false;
    $response["errorDesc"] = '';
    $response["data1"] = json_encode( $data1);
    $response["data2"] = '';
    $response["data3"] = '';
    kecho(200, $response);

?>



