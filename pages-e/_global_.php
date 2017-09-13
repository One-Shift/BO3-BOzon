<?php

class _global_ {

	public static $helloWorldString = "Hello World!";

	public function __construct() {}

	public static function start () {
		print self::$helloWorldString;
	}
}
