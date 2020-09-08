<?php
	class Dancers extends Controller {
		private $dancerModel;
		
		public function __construct() {
			$this->dancerModel = $this->model("Dancer");
		}
		
		public function index() {
			$dancers = $this->dancerModel->getDancers();

			$data = [
				"dancers" => $dancers
			];
			
			$this->view("dancers/index", $data);
		}
		
		public function assign() {
			# check for POST
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				# process form
				$post       = filter_input(INPUT_POST, "seating", FILTER_SANITIZE_STRING);
				$assignment = json_decode(urldecode($post));
				$flag       = false;
				
				foreach ($assignment as $id => $dancer) {					
					if ($this->dancerModel->updateAssignment($id, $dancer->table, $dancer->seat)) {
						$flag = true;
					}
					else {
						$flag = false;
						break;						
					}
				}
				
				if ($flag) {
					Utility::redirect("dancers");
				}
				else {
					die("Something went wrong");
				}
			}
			else {
				$dancers = $this->dancerModel->getDancers();
				$data = [
					"dancers" => $dancers
				];

				$this->view("dancers/assign", $data);
			}
		}
		
		public function add() {
			# check for POST
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				# process form
				$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				$post["dancerId"] = 0;
				
				$data = Validate::setProperties(["dancerId", "first", "last"], $post);
				
				Validate::isNotEmpty($data->first, "Please enter first name.");
				
				Validate::isNotEmpty($data->last, "Please enter last name.");
				
				if (Validate::isValid($data)) {
					if ($this->dancerModel->doesDancerExist($data))	{
						Validate::toggleError($data->first, true, "'{$data->first->value} {$data->last->value}' already exists.");						
					}
				}
				
				if (Validate::isValid($data)) {
					if ($this->dancerModel->addDancer($data)) {
						Utility::redirect("dancers");
					}
					else {
						die("Something went wrong");
					}
				}
				else {
					$this->view("dancers/add", $data);
				}
			}
			else {
				$dancers = $this->dancerModel->getDancers();
				
				if (count($dancers) >= 24) {
					Utility::redirect("dancers");	
				}
				else {
					# load view
					$data = Validate::setProperties(["first", "last"]);		
					$this->view("dancers/add", $data);
				}
			}
		}
		
		public function edit($id) {
			# check for POST
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				# process form
				$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				$post["dancerId"] = $id;
				
				$data = Validate::setProperties(["dancerId", "first", "last"], $post);
				
				Validate::isNotEmpty($data->first, "Please enter first name.");
				
				Validate::isNotEmpty($data->last, "Please enter last name.");
				
				if (Validate::isValid($data)) {
					if ($this->dancerModel->doesDancerExist($data))	{
						Validate::toggleError($data->first, true, "{$data->first->value} {$data->last->value} already exists.");					
					}
				}
				
				if (Validate::isValid($data)) {
					if ($this->dancerModel->updateDancer($data)) {
						Utility::redirect("dancers");
					}
					else {
						die("Something went wrong");
					}
				}
				else {
					$this->view("dancers/edit", $data);
				}
			}
			else {
				# load view
				$dancer = $this->dancerModel->getDancerById($id);
				$data = Validate::setProperties(["dancerId", "first", "last"], ["dancerId" => $id, "first" => $dancer->first, "last" => $dancer->last]);
				$this->view("dancers/edit", $data);
			}
		}	
		
		public function delete($id) {
			# check for POST
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				# process form
								
				if ($this->dancerModel->deleteDancer($id)) {
					Utility::redirect("dancers");
				}
				else {
					die("Something went wrong");
				}
			}
		}
	}
?>