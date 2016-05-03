<?php
	include "database.php";
	include "uploader.php";
	include "include/session.php";

	if(isset($_SESSION['admin'])){
		if(isset($_GET)){
			if(!empty($_GET["id"])){
				$connect = database::connect();
				$uploader = new uploader();
				$id = $_GET["id"];
				$query = "SELECT * FROM product WHERE id = ?";

				$prepare = $connect->prepare($query);
				$prepare->bindParam(1, $id);
				$prepare->execute();
				$data = $prepare->fetch(PDO::FETCH_ASSOC);

				$img = $data['image'];
				$uploader->delete($img);

				database::disconnect();

				$connect = database::connect();
				$query = "DELETE FROM product WHERE id = ?";
				$prepare = $connect->prepare($query);
				$prepare->bindParam(1, $id);
				$prepare->execute();

				database::disconnect();
				header("Location: index.php");

			} else {
				header("Location: index.php");
			}
		} else {
			header("Location: index.php");
		}
	} else {
		header("Location: index.php");
	}

?>