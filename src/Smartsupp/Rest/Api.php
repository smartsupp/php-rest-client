<?php

namespace Smartsupp\Rest;

class Api
{

	public $apiKey = null;

	public $apiUrl = 'http://api.smartsupp.com';



	public function __construct($apiKey) {
		if (!$apiKey){
			throw new \Exception("Undefined apiKey");
		}
		$this->apiKey = $apiKey;
	}


	public function accounts($accountId = null) {
		$request = $this->createRequest();
		$request->accounts($accountId);
		return $request;
	}


	public function request($url, array $params = null) {
		$headers = array("apiKey: $this->apiKey");

		$curl = curl_init($this->apiUrl.'/'.$url);

		if($params) {
			curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));
			$headers[] = 'Content-Type: application/json';
		}

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($curl);
		$info = curl_getinfo($curl);
		curl_close($curl);

		$code = $info['http_code'];
		$values = $result ? json_decode($result, true) : array();
		$values = $values===null ? array() : $values;

		$response = new Response($code, $values);
		return $response;
	}


	public function createRequest() {
		$request = new Request($this);
		return $request;
	}

}