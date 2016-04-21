<?php
	class database {
		private static $dbName = "products";
		private static $dbHost = "localhost";
		private static $dbUname = "root";
		private static $dbPassword = "";

		public function __construct(){
			die("Init function is not allowed");
		}

		private static $pdo = null;

		public static function connect(){
			try {
				self::$pdo = new PDO("mysql:host=".self::$dbHost.";dbname=".self::$dbName, self::$dbUname, self::$dbPassword);
			} catch (Exception $e) {
				echo $e->getMessage();
			}

			return self::$pdo;
		}

		public static function disconnect(){
			self::$pdo = null;
		}
	}

?>