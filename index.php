<?php

	include "include/session.php";
	include "include/header.php";
	include "database.php";

	$database = database::connect();
	$query = "SELECT * FROM product";

	if(!empty($_GET)){
		$search = "%".$_GET['search']."%";
	} else {
		$search = "%";
	}
	$query .= " WHERE title LIKE :search ORDER BY id DESC";


	$prepare = $database->prepare($query);
	$prepare->bindParam(":search", $search);
	$prepare->execute();

?>


<!DOCTYPE html>
<html>
		<div class="content">
			<div class="search">
				<form class="innerSearch" method="get">
					<input type="text" name="search" class="search" placeholder="Find action figure" value="<?php echo !empty($_GET['search'])?$_GET['search']:"" ?>"></input>
					<input type="submit" value="Find"></input>
				</form>
			</div>
		    <div class='featured' id="products">
		    <h2>Weeaboo Products</h2>
		    <?php
		    	foreach ($prepare as $data) {
		    		include "preview.php";
		    	}

		    ?>
		</div>
		    <div class="contactus" id="contact">
		    	 <div class="innerContact">
		    	 	<div class="superInnerContact">
		    	 		<h2>Contact Us</h2>
		    	 		<div class="medSoc">
		    		 		<div class="facebook">
		    	 				<a href="#"><img src="img/facebook.svg" class="facebookInner"></a>
		    	 			</div>
		    	 			<div class="twitter">
		    	 				<a href="#"><img src="img/twitter.svg" class="twitterInner"></a>
		    	 			</div>
		    	 			<div class="email">
		    	 				<a href="mailto:rifqi416@gmail.com"><img src="img/email.svg" class="emailInner"></a>
		    	 			</div>
		    	 		</div>
		    	 	</div>
		    	 </div>
		    </div>
		</div>
		<?php include "include/footer.php" ?>
	</body>
</html>
