<?php namespace BtcRelax;
require_once ('vendor/autoload.php');
use GuzzleHttp\Client;

class WPApi {
    
    protected $serverUrl = "";
    protected $lastError = '';
    
    public function __constructor($vServerUrl) {
        $this->serverUrl = $vServerUrl;
    }
}