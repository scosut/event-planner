<?php
	class Validate {
		public static function isValid($obj) {
			foreach($obj as $key => $childObj) {
				if (strlen($childObj->error) > 0) {
					return false;
				}
			}
			
			return true;
		}
		
		public static function getFirstError($obj) {
			foreach($obj as $key => $childObj) {
				if (strlen($childObj->error) > 0) {
					return $key;
				}
			}
			
			return false;
		}
		
		public static function isNotEmpty($obj, $msg) {	
			$test = empty($obj->value);
			
			return self::toggleError($obj, $test, $msg);
		}
		
		public static function toggleError($obj, $bln, $msg) {
			if ($bln) {
				$obj->error = $msg;
				return false;
			}
			else {
				$obj->error = "";
				return true;
			}
		}
		
		public static function setProperties($props, $arr=[]) {
			$obj  = new stdClass();
			
			foreach($props as $prop) {
				$obj->$prop = new stdClass();
				$obj->$prop->value = array_key_exists($prop, $arr) ? trim($arr[$prop]) : "";
				$obj->$prop->error = "";
			}
			
			return $obj;
		}
	}
?>