<!DOCTYPE html>
<html>
	<?php 
	include "include/session.php";
	include "include/header.php";
	include "database.php";

	if(isset($_GET)){
		if(!empty($_GET["id"])){
			$connect = database::connect();
			$id = $_GET["id"];
			$query = "SELECT * FROM product WHERE id = ?";

			$prepare = $connect->prepare($query);
			$prepare->bindParam(1, $id);
			$prepare->execute();
			$data = $prepare->fetch(PDO::FETCH_ASSOC);

			$img = $data['image'];
			$desc = $data['description'];
			$price = $data['price'];
			$title = $data['title'];

			database::disconnect();
		} else {
			header("Location: index.php");
		}
	} else {
		header("Location: index.php");
	}

	 ?>
	
		<div class="content">
		    <div class='featuredProduct' id="products">
			    <div class="head head2">
				    <div class="headInner">
				    	<img src="<?php echo $img; ?>">
				    </div>
				    <a class="priceButton previewPriceButton">Rp <?php echo $price; ?> </a>
			    </div>
			    <div class="previewDesc">
				    <div class="headProduct">	
				   		 <h2><?php echo $title; ?></h2>
				    </div>
				    <div class="productDesc">
				    	<p><?php echo $desc; ?></p>
				 	  	<div class="contactPreview">
					   		<h3>Contact Person</h3>
					    	<table>	 
					    		<tr>
					    			<td><p>Tel / Whatsapp </p></td>
					    			<td>:  081384726848</td>
					    		</tr>
					    		<tr>
					    			<td><p>Line</p></td>
					    			<td><p>:  zcabez</p></td>
					    		</tr>
					    		<tr>
					    			<td><p>Instagram</p></td>
					    			<td><p>:  Weeaboogeek</p></td>
					    		</tr>
					    		<tr>
					    			<td><p>Email</p></td>
					    			<td><p>:  buy@weaboogeek.com</p></td>
					    		</tr>
					    		<tr>
					    			<td><p>Pin BBM</p></td>
					    			<td><p>:  67DE896</p></td>
					    		</tr>
					    	</table>
					    </div>
				    </div>
			    </div>
			    <?php if(!empty($_SESSION["admin"])){ ?>
			    <div class="ud">
					<a href="update.php?id=<?php echo $id; ?>" class="updateButton">Update</a>
					<a href="delete.php?id=<?php echo $id; ?>" class="deleteButton">Delete</a>
				</div>
				<?php } ?>
		    </div>
		</div>
		<?php include "include/footer.php" ?>
	</body>
</html>
