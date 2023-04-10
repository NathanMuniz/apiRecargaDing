<?php

namespace App\DingConnect;


error_reporting(E_ALL);
ini_set('display_errors', 1);

class Recarga
{
  /**
   *URL base da API 
   *@var string 
   */
  const BASE_URL = "https://api.dingconnect.com/";


  /**
   *Metodo para pegar token 
   * @param string $clientID 
   * @param string $clientSecret
   * @return array 
   */
  public function autenticacao($clientID, $clientSecret)
  {
    // Chama função que faz request na api 
    return $this->getToken($clientID, $clientSecret);
  }

  /**
   *Metodo faz resquest na resorse para pegar token 
   * @param string $client_id 
   * @param string $clientSecret
   * @return array     
   */
  public function getToken($client_id, $client_secret)
  {


    $curl = curl_init();

    // Configuração request ideal para pegar um token 
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

    // Execulta o request 
    $response = curl_exec($curl);

    // Response do request: token 
    return json_decode($response, true);
  }

  // api/V1/GetAccountLookup?accountNumber=<string>
  // api/V1/GetAccountLookupaccountNumber=%2B5511987301184

  public function pesquisaConta($token, $numero)
  {

    $params = ["accountNumber" => $numero];

    $uri = "api/V1/GetAccountLookup";

    return $this->get($token, $uri, $params);
  }




  public function get($token, $uri, $params)
  {

    $queryParams = http_build_query($params);

    $url = self::BASE_URL . $uri . $queryParams;


    $curl = curl_init();


    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json",
        "Authorization: Bearer $token"
      ),
    ));

    $response = curl_exec($curl);

    echo json_decode($response, true);
  }
}
