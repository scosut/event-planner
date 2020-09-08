<?php
	class Dancer {
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
		
		# find dancer by id
		public function getDancerById($id) {
			$this->db->query("CALL spGetDancerById(:dancer_id)");
			$this->db->bind(":dancer_id", $id);
			$row = $this->db->single();

			return $row;
		}
		
		# find dancer by name
		public function doesDancerExist($data) {
			$this->db->query("CALL spgetDancerByName(:dancer_id, :first, :last)");
			
			$params = [
				":dancer_id" => $data->dancerId->value,
				":first"     => $data->first->value, 
				":last"      => $data->last->value
			];
			
			$this->db->bindArray($params);
			$this->db->execute();
			
			return $this->db->rowCount() > 0;
		}
		
		# add new dancer		
		public function addDancer($data) {
			$this->db->query("CALL spAddDancer(:first, :last)");
			
			$params = [
				":first" => $data->first->value, 
				":last"  => $data->last->value
			];
			
			$this->db->bindArray($params);
			
			# execute
			if ($this->db->execute()) {
				return true;
			}
			else {
				return false;
			}
		}
		
		# update existing dancer by id		
		public function updateDancer($data) {
			$this->db->query("CALL spUpdateDancer(:dancer_id, :first, :last)");
			
			$params = [
				":dancer_id" => $data->dancerId->value,
				":first"     => $data->first->value, 
				":last"      => $data->last->value
			];
			
			$this->db->bindArray($params);
			
			# execute
			if ($this->db->execute()) {
				return true;
			}
			else {
				return false;
			}
		}
		
		# remove existing dancer by id
		# find dancer by id
		public function deleteDancer($id) {
			$this->db->query("CALL spDeleteDancer(:dancer_id)");
			$this->db->bind(":dancer_id", $id);
			
			# execute
			if ($this->db->execute()) {
				return true;
			}
			else {
				return false;
			}
		}
		
		# assign/unassign dancer to table and seat by id
		public function updateAssignment($id, $table, $seat) {
			$this->db->query("CALL spUpdateAssignment(:dancer_id, :table, :seat)");
			
			$params = [
				":dancer_id" => $id,
				":table"     => $table, 
				":seat"      => $seat
			];
			
			$this->db->bindArray($params);
			
			# execute
			if ($this->db->execute()) {
				return true;
			}
			else {
				return false;
			}
		}
	}
?>