<!DOCTYPE>

<?php
session_start();
include("functions/functions.php");
?>
<html>

<head>
<title>My Online Shop</title>
<link rel="stylesheet" href="styles/style.css" media="all" />
</head>

<body>


<div class = "main_wrapper">

<div class = "header_wrapper">
<a href="index.php"><img id="logo" src="images/logo.png" /></a>
<img id="banner" src="images/ad_banner.png" />
</div>

<div class="menubar">

<ul id="menu">
<li><a href="index.php">Home</a></li>
<li><a href="all_products.php">Products</a></li>
<li><a href="cart.php">Shopping</a></li>
<li><a href="customer_register.php">Sign Up</a></li>

</ul>
<div id="form">
<form method="get" action="results.php" enctype="multipart/form-data" />
<input type="text" name="user_query" placeholder="Search a component" />
<input type="submit" name="search" value="Search" />
</form>
</div>

</div>

<div class="content_wrapper">

<div id="sidebar">
<div id="sidebar_title">Categories</div>
<ul id="cats" style='padding:10px;'>
<?php getCats();   ?>
</ul>
<div id="sidebar_title">Brands</div>
<ul id="cats" style='padding:10px;'>
<?php getBrands(); ?>
</ul>
</div>

<div id="content_area">

<?php
cart();
?>

<div id="shopping_cart">
<span style="float:right; font-size:18px; padding:5px; line-height:40px;" >
<?php
if(isset($_SESSION['customer_email'])){
	echo "Welcome " . $_SESSION['customer_email'] . "!";
}
else{
	echo "Welcome Guest!";
}
?>
&emsp;
<a href='cart.php' style="color:yellow;">My Cart</a></span>
</div>

<?php
//echo $ip = getIp();
?>

<div id="products_box">
<?php
if(!isset($_SESSION['customer_email'])){
	include("customer_login.php");
}
else{
	include("payment.php");
}
?>
</div>
</div>

</div>

<div id="footer">
<h2 style="text-align:center; padding-top:30px;">&copy;2019 by Team TripleX</h2>
</div>

</div>

</body>

</html>