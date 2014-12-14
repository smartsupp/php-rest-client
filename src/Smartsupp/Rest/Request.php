<?php

namespace Smartsupp\Rest;

/**
 * Class Request
 *
 * @package Smartsupp\Rest
 *
 * @method \Smartsupp\Rest\Request users($userId=null)
 * @method \Smartsupp\Rest\Request triggers($triggerId=null)
 */
class Request
{

	/** @var Api */
	private $api;

	/** @var string */
	private $query;



	public function __construct(Api $api) {
		$this->api = $api;
	}


	public function get() {
		return $this->send('get');
	}


	public function update($params) {
		return $this->send('update', $params);
	}


	public function delete() {
		return $this->send('delete');
	}


	public function create($params) {
		return $this->send('create', $params);
	}


	public function send($method = null, array $params = null) {
		$query = $method ? $this->query.=$method : $this->query;
		return $this->api->request($query, $params);
	}


	public function __call($name, $arguments) {
		$this->query .= $name.'/';
		if (isset($arguments[0])) {
			$this->query .= $arguments[0].'/';
		}
		return $this;
	}

}