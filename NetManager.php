<?php namespace BtcRelax;
require 'vendor/autoload.php';
use GuzzleHttp\Client;


class  NetManager  {


  const base_url = 'https://www.proxy-list.download/';   

  protected $proxiesList = [];
  protected $lastError = '';
  
  function __construct() {
     
   }

  function getLastError() {
    return $this->lastError;
  }
  
  function getProxiesList() {  
   $client = new GuzzleHttp\Client();
    $requestURI = \sprintf("%s:%s",  self::base_url );
    $response = $client->request('GET', $requestURI , [
        'query' => ['type' => 'http', 'country' => 'UA' ],
        'headers' => [ 'User-Agent' => 'bitganj', 'protocol'     => '1', 'cmd' => 'auth']
        ]);
    if ( $response->getStatusCode() === 200)
    {
        $sessionsObjects = $response->getHeader('session');
        $this->session = array_pop($sessionsObjects);
        $this->lastError = '';
    } else { $this->lastError = \sprint("Server retuen code:%s", $response->getStatusCode()); };
    return $this->isInited();
  
     return  $this->proxiesList ;
  }

}

