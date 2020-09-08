<?php
	class Materials extends Controller {
		private $materialModel;
		
		public function __construct() {
			$this->materialModel = $this->model("Material");			
		}
		
		public function index() {
			$materials = [
				"cards" => "Place cards", 
				"chart" => "Seating chart", 
				"tents" => "Table tents"
			];
			
			$data = [
				"materials" => $materials
			];

			$this->view("materials/index", $data);
		}
		
		public function print() {
			# check for POST
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				# process form
				$post    = filter_input(INPUT_POST, "materials", FILTER_SANITIZE_STRING);
				$dancers = $this->materialModel->getDancers();

				$data = [
					"dancers"  => $dancers,
					"material" => $post
				];				
				
				$this->view("materials/print", $data);
			}
		}
	}
?>