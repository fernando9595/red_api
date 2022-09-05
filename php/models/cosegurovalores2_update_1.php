<?php
    //automatic script by otro
    krequiredparams(array('idForm'));
//    $id = $_REQUEST['id'];
    $idForm = $_REQUEST['idForm'];
    $id=1;

    switch (strtolower($idForm)) {
    case '1':
		$data = array(
			"n v01"                     => $_POST["v01"],
			"n v02"                     => $_POST["v02"],
			"n v03"                     => $_POST["v03"],
			"n v04"                     => $_POST["v04"],
			"n v05"                     => $_POST["v05"],
			"n v06"                     => $_POST["v06"],
			"n v07"                     => $_POST["v07"],
			"n v08"                     => $_POST["v08"],
			"n v09"                     => $_POST["v09"],
			"n v10"                     => $_POST["v10"],
			"n v11"                     => $_POST["v11"],
			"n v12"                     => $_POST["v12"],
			"n v13"                     => $_POST["v13"],
			"n v14"                     => $_POST["v14"],
			"n v15"                     => $_POST["v15"],
			"n v16"                     => $_POST["v16"],
			"n v17"                     => $_POST["v17"],
			"n v18"                     => $_POST["v18"]
		);
        break;

    case 'm':
		$data = array(
			"n v01_m"                   => $_POST["v01_m"],
			"n v02_m"                   => $_POST["v02_m"],
			"n v03_m"                   => $_POST["v03_m"],
			"n v04_m"                   => $_POST["v04_m"],
			"n v05_m"                   => $_POST["v05_m"],
			"n v06_m"                   => $_POST["v06_m"],
			"n v07_m"                   => $_POST["v07_m"],
			"n v08_m"                   => $_POST["v08_m"],
			"n v09_m"                   => $_POST["v09_m"],
			"n v10_m"                   => $_POST["v10_m"],
			"n v11_m"                   => $_POST["v11_m"],
			"n v12_m"                   => $_POST["v12_m"],
			"n v13_m"                   => $_POST["v13_m"],
			"n v14_m"                   => $_POST["v14_m"],
			"n v15_m"                   => $_POST["v15_m"],
			"n v16_m"                   => $_POST["v16_m"],
			"n v17_m"                   => $_POST["v17_m"],
			"n v18_m"                   => $_POST["v18_m"]
		);
        break;

    case 'r':
		$data = array(
			"n v01_r"                   => $_POST["v01_r"],
			"n v02_r"                   => $_POST["v02_r"],
			"n v03_r"                   => $_POST["v03_r"],
			"n v04_r"                   => $_POST["v04_r"],
			"n v05_r"                   => $_POST["v05_r"],
			"n v06_r"                   => $_POST["v06_r"],
			"n v07_r"                   => $_POST["v07_r"],
			"n v08_r"                   => $_POST["v08_r"],
			"n v09_r"                   => $_POST["v09_r"],
			"n v10_r"                   => $_POST["v10_r"],
			"n v11_r"                   => $_POST["v11_r"],
			"n v12_r"                   => $_POST["v12_r"],
			"n v13_r"                   => $_POST["v13_r"],
			"n v14_r"                   => $_POST["v14_r"],
			"n v15_r"                   => $_POST["v15_r"],
			"n v16_r"                   => $_POST["v16_r"],
			"n v17_r"                   => $_POST["v17_r"],
			"n v18_r"                   => $_POST["v18_r"]
		);
        break;
	
    case 'd12':
		$data = array(
			"n v01_d12"                 => $_POST["v01_d12"],
			"n v02_d12"                 => $_POST["v02_d12"],
			"n v03_d12"                 => $_POST["v03_d12"],
			"n v04_d12"                 => $_POST["v04_d12"],
			"n v05_d12"                 => $_POST["v05_d12"],
			"n v06_d12"                 => $_POST["v06_d12"],
			"n v07_d12"                 => $_POST["v07_d12"],
			"n v08_d12"                 => $_POST["v08_d12"],
			"n v09_d12"                 => $_POST["v09_d12"],
			"n v10_d12"                 => $_POST["v10_d12"],
			"n v11_d12"                 => $_POST["v11_d12"],
			"n v12_d12"                 => $_POST["v12_d12"],
			"n v13_d12"                 => $_POST["v13_d12"],
			"n v14_d12"                 => $_POST["v14_d12"],
			"n v15_d12"                 => $_POST["v15_d12"],
			"n v16_d12"                 => $_POST["v16_d12"],
			"n v17_d12"                 => $_POST["v17_d12"],
			"n v18_d12"                 => $_POST["v18_d12"]
		);
        break;
		
    case 'g2':
		$data = array(
			"n v01_g2"                 => $_POST["v01_g2"],
			"n v02_g2"                 => $_POST["v02_g2"],
			"n v03_g2"                 => $_POST["v03_g2"],
			"n v04_g2"                 => $_POST["v04_g2"],
			"n v05_g2"                 => $_POST["v05_g2"],
			"n v06_g2"                 => $_POST["v06_g2"],
			"n v07_g2"                 => $_POST["v07_g2"],
			"n v08_g2"                 => $_POST["v08_g2"],
			"n v09_g2"                 => $_POST["v09_g2"],
			"n v10_g2"                 => $_POST["v10_g2"],
			"n v11_g2"                 => $_POST["v11_g2"],
			"n v12_g2"                 => $_POST["v12_g2"],
			"n v13_g2"                 => $_POST["v13_g2"],
			"n v14_g2"                 => $_POST["v14_g2"],
			"n v15_g2"                 => $_POST["v15_g2"],
			"n v16_g2"                 => $_POST["v16_g2"],
			"n v17_g2"                 => $_POST["v17_g2"],
			"n v18_g2"                 => $_POST["v18_g2"]
		);
        break;

    default:
    }

    $where = " id=$id";

    $sql = ksqlupdate("cosegurovalores2",$data,$where);
    $arr = kexecute($sql);


    $response["error"] = false;
    $response["errorDesc"] = '';
    $response["data1"] =  '';
    kecho(200, $response);


?>