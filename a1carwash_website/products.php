<?php
	session_start();
	include("config.php");
?>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="keywords" content="">
<meta name="description" content="">
<title>A1 Car Wash </title> 
<link rel="stylesheet" type="text/css" href="css/style.css"> 
<link rel="stylesheet" type="text/css" href="css/main.css"> 
<link rel="shortcut icon" href="img/favicon.ico"/>
<script type="text/javascript" src="js/modernizr-1.5.min.js"></script> 
</head>

<body>

	<header>
		<a href="index.html"><img src="img/A1Logo.png" alt="A1 CarWash Logo" height="200"></a>
		<div class = "title">
			<h1>A1 Car Wash </h1> 
			<p>You've Tried The Rest, Now Try the Best </p>
		</div>
		
		<div id = "log_in">
			<p><a href="login.php">Login</a></p>
			<p><a href="register.php">Register</a></p> 
		</div>
		
	</header>

	 <nav id="nav_menu">
		<ul>
			<li><a href="index.html">Home</a></li>
			<li><a href="location.html">Locations</a></li>
			<li><a class="current" href="products.php">Products</a></li>
			<li><a href="services.html">Services</a></li>
			<li><a href="about.html">About Us</a></li>
		</ul>
	</nav> 

	
	<div id = "content_area">
		<div id="products_content">
			<div id ="product_headline">
				<h2>Howdy, Try Out the Best CarWash Products in New Mexico!</h2> 
			</div>
			<div id ="center_products"> 
			<div class="left"> 
			
			</div><!--end of left clas div--> 
			<div class ="right">
			
			</div><!--end of right class div--> 
		</div><!--end of center_products div--> 

		</div><!--end of div for products_content--> 
		</div><!--end of div for content_area-->
	
 

	<footer>
		<div class = "copyright">
			<p> 
				<script>
					var today = new Date();
					document.write("&copy;&nbsp;");
					document.write(today.getFullYear());
					document.write(", A1 CarWash ") 
				</script>
			</p>
		</div>
	</footer> 

</body> 
</html>