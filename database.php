<?php
	class database {
		private static $dbName = "acsm_ab1118c255d9c37";
		private static $dbHost = "us-cdbr-azure-southcentral-e.cloudapp.net";
		private static $dbUname = "b68a57d9b1d0b8";
		private static $dbPassword = "e17c5326";

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
