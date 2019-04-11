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
<ul id="cats" style='padding:10px;' >
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
<a href='index.php' style="color:yellow;">Back to Shop</a>

<?php
if(!isset($_SESSION['customer_email'])){
	echo "<a href='checkout.php' style='color:green'>Login</a>";
}
else{
	echo "<a href='logout.php' style='color:red'>Logout</a>";
}
?>

</span>
</div>



<?php
//echo $ip = getIp();
?>

<div id="products_box">

<form action="" method="post" enctype="multipart/form-data">
<table align="center" width="700" bgcolor="skyblue">

<tr align="center">
<br>
<th><b>Remove<b></th>
<th><b>Product<b></th>
<th><b>Quantity<b></th>
<th><b>Price<b></th>
</tr>

<?php 
$total = 0;
global $con; 
$ip = getIp(); 
$sel_price = "select * from cart where ip_add='$ip'";
$run_price = mysqli_query($con, $sel_price); 
while($p_price=mysqli_fetch_array($run_price)){
	$pro_id = $p_price['p_id']; 
	$pro_price = "select * from products where product_id='$pro_id'";
	$run_pro_price = mysqli_query($con,$pro_price); 
	while ($pp_price = mysqli_fetch_array($run_pro_price)){
		$product_price = array($pp_price['product_price']);
		$product_title = $pp_price['product_title'];
		$product_image = $pp_price['product_image']; 
		$single_price = $pp_price['product_price'];
	    $values = array_sum($product_price);
		$total+= $values;
?>

<?php
if(isset($_POST['update_cart'])){
	$qty = $_POST['qty'];
	$update_qty = "update cart set qty='$qty'";
    $run_qty = mysqli_query($con, $update_qty);
	$_SESSION['qty'] = $qty;
	$total = $total * $qty;
}
	
?>

<tr align="center">

<td><br><input type="checkbox" name="remove[]" value="<?php echo $pro_id;?>"  /></td>
<td><?php echo $product_title;?><br>
<img src="admin_area/product_images/<?php echo $product_image;?>" width="60" height="60" />
</td>
<td><input type="text" size="4" name="qty" value="<?php echo $_SESSION['qty'];?>"/></td>


<td><br><?php echo 'Rs.'.$single_price;?></td>
</tr>




<?php } } ?>

<tr align="right">
<td colspan="5"><b>Total:<b>
&thinsp;
<b><?php echo 'Rs.'.$total; ?><b></td>
</tr>

<tr align="center">
<td><input type="submit" name="update_cart" value="Update Cart" /></td>
<td><input type="submit" name="continue" value="Continue Shopping" /></td>
<td><input type="submit" name="checkout" value="Checkout"/></td>
</tr>

<!--Addition-->
<?php
if(isset($_POST['checkout'])){
	$qty = $_POST['qty'];
	$sel_pro = "select * from products where product_id='$pro_id'";
    $run_pro = mysqli_query($con, $sel_pro); 
	$product_q = mysqli_fetch_array($run_pro);
	$pro_q = $product_q['product_qty'];
	$pro_qty = $pro_q - $qty;
	if($pro_qty >= 0){
		$update_qty = "update products set product_qty='$pro_qty' where product_id='$pro_id'";
        $run_qty = mysqli_query($con, $update_qty);
	}
	else{
		echo "<script>alert('Requested Quantity Not In Stock!')</script>";
	}
}

?>

<!--Addition over-->

</table>

</form>

<?php 
function updatecart(){
global $con;
$ip = getIp();
if(isset($_POST['update_cart'])){
	foreach($_POST['remove'] as $remove_id){
		$delete_product = "delete from cart where p_id='$remove_id' and ip_add='$ip'";
		$run_delete = mysqli_query($con, $delete_product);
		if($run_delete){
			echo "<script>window.open('cart.php','_self')</script>";
		}
	}
	
}
if(isset($_POST['continue'])){
	echo "<script>window.open('index.php','_self')</script>";
}
}
echo @$up_cart=updatecart();

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