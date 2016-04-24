<?php
		$id = $data['id'];
		$title = $data['title'];
		$price = $data['price'];
		$image = $data['image'];
		$description = $data['description'];
		$lessDescription = substr($description, 0, 163). "...";
		    		
?>
<div class='imageContainer'>
	<div class="head">
	<a href="product.php?id=<?php echo $id; ?>"><img src="<?php echo $image; ?>" ></a>
	<!-- 	<img src="img/anime-1.jpg"> -->
	</div>
	<div class="productDesc">
	<h3><a href="product.php?id=<?php echo $id; ?>" ><?php echo $title ?></a></h3>
	<!--<h3>Yowamushi Pedal | Obito</h3> -->
	
	<p><?php echo $lessDescription; ?></p>
	<!--	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sit amet est vitae tellus elementum scelerisque. Vivamus sit amet maximus nibh, eget tristique velit.</p> -->

	</div>
	<a href="product.php?id=<?php echo $id; ?>" class="priceButton">Rp <?php echo $price; ?></a>
</div>