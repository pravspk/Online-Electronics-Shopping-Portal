<!DOCTYPE>

<?php
session_start();
include("functions/functions.php");
include("includes/db.php");
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
<span style="float:right; font-size:18px; padding:5px; line-height:40px;" >Welcome to ElectroQuick!
&emsp;
<a href='cart.php' style="color:yellow;">My Cart</a></span>
</div>

<?php
//echo $ip = getIp();
?>

<form action="customer_register.php" method="post" enctype="multipart/form-data">
<table align="center" width="750">

<tr align="center">
<td colspan="5" style="padding:20px;">
<h1><b>Create an account<b></h1>
</td>
</tr>

<tr>
<td align="right">Customer Name:</td>
<td><input type="text" name="c_name" required/></td>
</tr>

<tr>
<td align="right">Customer Email:</td>
<td><input type="text" name="c_email" required/></td>
</tr>

<tr>
<td align="right">Customer Password:</td>
<td><input type="password" name="c_pass" required/></td>
</tr>

<tr>
<td align="right">Customer Image:</td>
<td><input type="file" name="c_image" required/></td>
</tr>



<tr>
<td align="right">Customer Country:</td>
<td>
<select name="c_country">
<option>Australia</option>
<option>China</option>
<option>India</option>
<option>United Arab Emirates</option>
<option>United Kingdom</option>
<option>United States</option>
</select>
</td>
</tr>

<tr>
<td align="right">Customer City:</td>
<td><input type="text" name="c_city" required/></td>
</tr>

<tr>
<td align="right">Customer Contact:</td>
<td><input type="text" name="c_contact" required/></td>
</tr>

<tr>
<td align="right">Customer Address:</td>
<td><textarea cols="20" rows="3" name="c_address" required></textarea></td>
</tr>

<tr align="center">
<td colspan="4" style="padding:20px"><input type="submit" name="register" value="Create Account" /></td>
</tr>

</table>
</form>


</div>


</div>

<div id="footer">
<h2 style="text-align:center; padding-top:30px;">&copy;2019 by Team TripleX</h2>
</div>

</div>

</body>

</html>

<?php
if(isset($_POST['register'])){
	$ip=getIp();
	$c_name=$_POST['c_name'];
	$c_email=$_POST['c_email'];
	$c_pass=$_POST['c_pass'];
	$c_image=$_FILES['c_image']['name'];
	$c_image_tmp=$_FILES['c_image']['tmp_name'];
	$c_country=$_POST['c_country'];
	$c_address=$_POST['c_address'];
	$c_city=$_POST['c_city'];
	$c_contact=$_POST['c_contact'];
	
	move_uploaded_file($c_image_tmp,"customer/customer_images/$c_image");
	
	echo $insert_c = "insert into customers(customer_ip,customer_name,customer_email,customer_pass,customer_country,customer_city,customer_contact,customer_address,customer_image) 
	values('$ip','$c_name','$c_email','$c_pass','$c_country','$c_city','$c_contact','$c_address','$c_image')";
	
	$run_c = mysqli_query($con, $insert_c);
		
	$sel_cart="select * from cart where ip_add='$ip'";
	
	$run_cart=mysqli_query($con, $sel_cart);
	
	$check_cart=mysqli_num_rows($run_cart);
	
	
	if($check_cart == 0){
		$_SESSION['customer_email']=$c_email;
		echo "<script>alert('Registration Successful!')</script>";
		echo "<script>window.open('index.php','_self')</script>";
	}
	else{
		$_SESSION['customer_email']=$c_email;
		echo "<script>alert('Registration Successful!')</script>";
		echo "<script>window.open('checkout.php','_self')</script>";
	}
		
}
?>