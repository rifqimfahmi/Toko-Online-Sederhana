 <!DOCTYPE html>
<html>
	<?php 
	include "include/session.php";
	include "include/header.php";
	include "database.php";

	if(isset($_SESSION['admin'])){
		if(isset($_GET)){
			if(!empty($_GET["id"])){
				$id = $_GET['id'];
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
	
		<div class="content">
		    <div class='featuredProduct' id="products">
		    	<div class="delete">Are your sure want to delete this data </div>
				<div class="confirmation">
					<a href="deleteprocess.php?id=<?php echo $id; ?>" class="deleteProcess">Yes</a>
					<a href="product.php?id=<?php echo $id; ?>" class="back">Back</a>
				</div>
		    </div>
		</div>
		<?php include "include/footer.php" ?>
	</body>
</html>