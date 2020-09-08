<?php
	class Utility {
		public static function isActive($path) {
			return $_SERVER["REQUEST_URI"] == $path;
		}
		
		public static function setActive($path) {
			return self::isActive($path) ? " class=\"active\"" : "";
		}		
		
		public static function redirect($location) {
			header("location: ".URL_ROOT."/$location");
		}		
	}
?>