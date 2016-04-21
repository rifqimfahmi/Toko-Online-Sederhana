 <!DOCTYPE html>
<html>
	<?php 
	include "include/session.php";
	include "include/header.php";
	include "database.php";
	include "uploader.php";

	if(isset($_SESSION['admin'])){
		if(isset($_GET)){
			if(!empty($_GET["id"])){
				$id = $_GET['id'];
				$connect = database::connect();
				$query = "SELECT * FROM product WHERE id = ?";

				$prepare = $connect->prepare($query);
				$prepare->bindParam(1, $id);
				$prepare->execute();
				$data = $prepare->fetch(PDO::FETCH_ASSOC);

				$img = $data['image'];
				$desc = $data['description'];
				$price = $data['price'];
				$title = $data['title'];

				if(!empty($_POST)){
					$title = $_POST['title'];
					$price = $_POST['price'];
					$description = $_POST['description'];
					$image = $_FILES['img'];
					$valid = true;
					$validateImage = true;


					if(strlen($image['name']) != 0){
						$uploader = new uploader();
						$validateImage = $uploader->validate($image);
						list($imageWidth, $imageHeight) = getimagesize($image['tmp_name']);			
					}

					if(strlen($title) < 10){
						$errorTitle = "The title must be 10 characters or more in length";
						$valid = false;
					}
					if(!ctype_digit($price)){
						$errorPrice = "The price Must be numeric";
						$valid = false;
					}
					if(empty($title)){
						$errorTitle = "The title cannot be empty";
						$valid = false;
					}
					if(empty($price)){
						$errorPrice = "The price cannot be empty";
						$valid = false;
					}
					if(strlen($description) < 166){
						$errorDesc = "The description must be 166 characters or more in length";
						$valid = false;
					}
					if(empty($description)){
						$errorDesc = "The description cannot be empty";
						$valid = false;
					}


					if(!$validateImage){
						$errorImage = "Invalid image type upload";
						$valid = false;
					}
					if(strlen($image['name']) != 0){
						if($validateImage){
							if($imageWidth != 640 && $imageWidth != 480){
								$errorImage = "The image resolution must be 640 x 480";
								$valid = false;
							}
						}
					}
					if(strlen($image['name']) == 0){
						$errorImage = "The image cannot be empty";
						$valid = false;
					}

					if($valid){
				
						database::disconnect();
						$database = database::connect();
						$uploader->delete($img);
						$imageUpload = $uploader->upload($image);
						$query = "UPDATE product SET title=?, price=?, description=?, image=? WHERE id=?";
						$prepare = $database->prepare($query);
						$prepare->bindParam(1, $title);
						$prepare->bindParam(2, $price);
						$prepare->bindParam(3, $description);
						$prepare->bindParam(4, $imageUpload);
						$prepare->bindParam(5, $id);
						$prepare->execute();
						database::disconnect();
						header("Location: index.php");
					}
				}
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
	<link rel="stylesheet" type="text/css" href="css/newitem.css">
		<div class="content">
		    <div class='featuredProduct' id="products">

				<div class="form" >
					<form action="update.php?id=<?php echo $id; ?>" method="post" class="innerForm" enctype="multipart/form-data">
						<label>Judul: </label>
						<input type="text" name="title" value="<?php echo !empty($title) ? $title : '' ?>"  ></input>
						<label class="warning"><?php echo !empty($errorTitle) ? $errorTitle : '' ?></label>
						<label>Harga: </label>
						<input type="text" name="price" value="<?php echo !empty($price) ? $price : '' ?>"  ></input>
						<label class="warning"><?php echo !empty($errorPrice) ? $errorPrice : '' ?></label>
						<label>Deskripsi: </label>
						<textarea rows="10" name="description" ><?php echo !empty($desc) ? $desc : '' ?></textarea>
						<label class="warning"><?php echo !empty($errorDesc) ? $errorDesc : '' ?></label>
						<div>
							<label>Image: </label>
							<input type="file" name="img"> </input>
						<label class="warning"><?php echo !empty($errorImage) ? $errorImage : '' ?></label>
						</div>
						<div class="head toDelImg">
							<img src="<?php echo $img; ?>">
						</div>
						<input type="submit" name="submit" value="Update" class="btnSell"></input>
					</form>
				</div>
		    </div>
		</div>
		<?php include "include/footer.php" ?>
	</body>
</html>