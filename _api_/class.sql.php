<?php
class iSQL {
	private $ip, $username, $userpassword, $namedb;
	public $connect;

	function __construct() {
	}

	public function connect() {
		$this->ip = "127.0.0.1";
		$this->username = "vc_sql";
		$this->userpassword = "ZjAKcZZ4fzzHZMeH";
		$this->namedb = "vc_sql";

		$this->connect = new mysqli($this->ip, $this->username, $this->userpassword, $this->namedb);
	}
}

class sql_prep extends iSQL {
	public $return_data;

	public function __construct(string $dem, string $query, $typeData = "", $data = null) {
		$this->connect();
		switch($dem) {
			case 'query':
				$this->query($query);
				break;
			case 'prepare':
				$this->prepare($query, $typeData, $data);
		}
	}

	private function query(string $str) {
		$data = $this->connect->query($str);
		
		$this->return_data = $data;
		return true;
	}

	private function prepare(string $query, string $type, $dataParse) {
		$data = $this->connect->prepare($query);
		$data->bind_param($type, ...$dataParse);
		$data->execute();
		$this->return_data = $data->get_result();
	}
}