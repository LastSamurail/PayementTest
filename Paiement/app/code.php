<?php

function checkPayment($identifier)
{
//The URL that we want to send a PUT request to.
    $url = 'https://paygateglobal.com/api/v2/status';
    $params = array(
      'auth_token' => env("PAYGATE_AUTH_TOKEN"),
      'identifier' => $identifier
  );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);

// This should be the default Content-type for POST requests
//curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/x-www-form-urlencoded"));

    $result = curl_exec($ch);
    if(curl_errno($ch) !== 0) {
      error_log('cURL error when connecting to ' . $url . ': ' . curl_error($ch));
  }

  curl_close($ch);
  if($result == '{"error_code":403,"error_message":"Transaction non trouvée."}'){
      return -1;
  }
  else if($result == null){
      return -1;
  }else{
      $manage = json_decode($result, true);
      return $manage["status"];
  }
}

?>