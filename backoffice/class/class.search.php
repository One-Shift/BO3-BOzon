<?php

class search {

	protected $id;
	protected $tags;
	protected $module;
	protected $id_ass;
	protected $date;
	protected $date_update;

	public function __construct() {

	}

	public function setDate($d = null) {
		$this->date = ($d !== null) ? $d : date("Y-m-d H:i:s", time());
	}

	public function setDateUpdate($d = null) {
		$this->date_update = ($d !== null) ? $d : date("Y-m-d H:i:s", time());
	}

}
