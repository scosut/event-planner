<?php
	class Material {
		private $db;
		
		public function __construct() {
			$this->db = new Database();
		}
		
		# find all dancers
		public function getDancers() {
			$this->db->query("CALL spGetDancers()");
			$results = $this->db->resultSet();

			return $results;
		}
	}
?>