<?php
class Shortener {
	protected $db;

	public function __construct(){
		// For Demo Purposes
		$this->db = new mysqli('localhost', 'root', 'root', 'website');
	}

	protected function generateCode($num) {
		return base_convert($number, 10, 36);
	}

	public function makeCode($url) {
		$url = trim($url);

		if(!filter_var($url, FILTER_VALIDATE_URL)) {
			return '';
		}

		$url = $this->db->escape_string($url);

		// Check if URL already exists
		$exists = $this->db->query("SELECT code FROM links WHERE url = '{$url}'");

		if($exists->num_rows) {
			// return code
			return $exists->fetch_object()->code;
		} else {
			// generate and store url and code
			// insert record without a code
			$insert = $this->db->query("INSERT INTO links (url, created) VALUES ('{$url}', NOW())");

			// generate code based on inserted ID
			$code = $this->generatedCode($this->db->insert_id);

			// update the record with the generated code
			$this->db->query("UPDATE links SET code = '{$code}' WHERE url = '{$url}'");

			return $code;

		}	
	}

	public function getUrl($code) {
		$code = $this->db->escape_string($code);

		$code = $this->db->query("SELECT url FROM links WHERE code = '$code'");

		if($code->num_rows) {
			return $code->fetch_object()->url;
		}

		return '';
	}
}
