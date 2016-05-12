
<head>
	<title>Weaboo Geek Collection</title>
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/slider.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="icon" type="image/x-icon" href="img/logo-animesell.png">
	<meta name="viewport" content="width=device-width, initial-scale=1">


</head>
<body>
	<div class='header'>
		<div class="wrapper">
			<div class='logo'>
				<a href="/"><img src="img/logo.svg" class="logoInner"></a>
			</div>
			<div class='navigation'>
				<div class='menu' onclick="openMenu()">
					<a href="#" class="navBut">Menu</a>
				</div>
				<div class="innerNav" id="toogleNav">
					<a href="index.php">Home</a>

					<?php if($_SERVER['SCRIPT_NAME'] == "/index.php"){ ?>
						<a href="#products" class="animate">Products</a>
						<a href="#contact" class="animate">Contact us</a>
					<?php } if(!empty($_SESSION["admin"])){ ?>
						<a href="createproduct.php">Add item</a>
						<a href="dataproduk.php">Products Chart</a>
					<?php } else { ?>
						<a href="login.php">Admin</a>
					<?php } ?>
					<?php
					if(!empty($_SESSION['admin'])) {
					 	echo '<a href="include/logout.php">Logout</a>';
					 }
					 ?>
				</div>
			</div>
		</div>
	</div>