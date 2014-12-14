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

}