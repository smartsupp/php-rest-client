<?php

namespace Smartsupp\Rest;


class Response
{
	/** @var int */
	public $code;

	/** @var array */
	public $values;


	/**
	 * @param $code Response code
	 * @param array $values Response values
	 */
	public function __construct($code, array $values = array()) {
		$this->code = $code;
		$this->values = $values;
	}


	/**
	 * @return int
	 */
	public function getCode() {
		return $this->code;
	}


	/**
	 * @return array
	 */
	public function getValues() {
		return $this->values;
	}


	/**
	 * @param $name
	 * @param mixed $default
	 * @return mixed
	 */
	public function getValue($name, $default = NULL) {
		return array_key_exists($name, $this->values) ? $this->values[$name] : $default;
	}


	/**
	 * @param $name
	 * @return mixed
	 */
	public function __get($name) {
		return $this->getValue($name);
	}

}