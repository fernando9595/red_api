<?php
    if($idJob=='php/models/z_pmo_paso1_delete' ) {
        $arr = kselect("DELETE FROM z_pmo_paso1 WHERE =$pk");
        $response["error"] = false;
        $response["info"] = $token_ant;
        kecho(200, $response);
    }
?>