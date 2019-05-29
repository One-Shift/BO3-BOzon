<?php

class _global_ {

	public static $helloWorldString = "Hello World!";

	public function __construct() {}

	public static function start () {
		print self::$helloWorldString;
	}
	
	// WE USE THIS OBJECT FOR API, BUT U CAN USE IT FOR OTHER COM THINGS, IS UP TO U
	public static function generateReturn () {
		return [
			'status' => false,
			'message' => '',
			'object' => []
		];
	}
}
