<?php

    // base64 encodes the header json
    $arr = array('alg' => 'HS256', 'typ' => 'JWT');
    $arr2 = json_encode($arr);
    $encoded_header = base64_encode($arr2);


    // base64 encodes the payload json
    $arr3 = array('country' => 'Venezuela', 'name' => 'Julio Gonzalez', 'email' => 'email@gmail.com');
    $arr33 = json_encode($arr3);
    $encoded_payload = base64_encode($arr33);

    // base64 strings are concatenated to one that looks like this
    $header_payload = $encoded_header . '.' . $encoded_payload;

    //Setting the secret key
    $secret_key = 'clave secreta';

    // Creating the signature, a hash with the s256 algorithm and the secret key. The signature is also base64 encoded.
    $signature = base64_encode(hash_hmac('sha256', $header_payload, $secret_key, true));

    // Creating the JWT token by concatenating the signature with the header and payload, that looks like this:
    $jwt_token = $header_payload . '.' . $signature;

    //listing the resulted  JWT
    echo $jwt_token;

    /////////////////////////////////////////////////////////////////////////////////////////////////////



    echo "<br><hr>";

    //AQUI VERIFICAMOS LA FIRMA

    //Verifying the Signature

    $recievedJwt = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJjb3VudHJ5IjoiVmVuZXp1ZWxhIiwibmFtZSI6Ikp1bGlvIEdvbnphbGV6IiwiZW1haWwiOiJlbWFpbEBnbWFpbC5jb20ifQ==.h3tBXSN978DPxKxgJh20mc2DaqSdWuYhKJ9O1iBV6Pk=';

    $secret_key = 'clave secreta';

    // Split a string by '.'
    $jwt_values = explode('.', $recievedJwt);

    // extracting the signature from the original JWT
    $recieved_signature = $jwt_values[2];

    // concatenating the first two arguments of the $jwt_values array, representing the header and the payload
    $recievedHeaderAndPayload = $jwt_values[0] . '.' . $jwt_values[1];

    // creating the Base 64 encoded new signature generated by applying the HMAC method to the concatenated header and payload values
    $resultedsignature = base64_encode(hash_hmac('sha256', $recievedHeaderAndPayload, $secret_key, true));

    // checking if the created signature is equal to the received signature
    if($resultedsignature == $recieved_signature) {

        // If everything worked fine, if the signature is ok and the payload was not modified you should get a success message
        echo "Success";
    } else {

        echo "Password no valida";

    }

?>