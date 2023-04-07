<?php

namespace App\DingConnect;

class Recarga
{

  const BASE_URL = "https://idp.ding.com/";

  public function autenticacao($clientID, $clientSecret)
  {

    return $this->getToken($clientID, $clientSecret);
  }


  public function getToken($client_id, $client_secret)
  {

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://idp.ding.com/connect/token",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => http_build_query([
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'grant_type' => "client_credentials"
      ]),
      CURLOPT_HTTPHEADER => array(
        "Content-Type: application/x-www-form-urlencoded"
      ),
    ));

    $response = curl_exec($curl);

    echo $response;
  }
}
