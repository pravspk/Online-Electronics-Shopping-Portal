<!DOCTYPE>
<?php
include("includes/db.php");
?>
<html>

<head>
<title>Inserting Product</title>
</head>

<body bgcolor="skyblue">

<form action="insert_product.php" method="post" enctype="multipart/form-data">
<table align="center" width="600" border="2" bgcolor="yellow">

<tr align="center">
<td colspan="8"><h2>Insert New Product Here</td>
</tr>

<tr>
<td align="center">Title:</td>
<td><input type="text" name="product_title" required/></td>
</tr>

<tr>
<td align="center">Category:</td>
<td>
<select name="product_cat" required>
<option>Select Category</option>
<?php
$get_cats = "select * from categories";
$run_cats = mysqli_query($con, $get_cats);
	
while($row_cats = mysqli_fetch_array($run_cats)){
	$cat_id = $row_cats['cat_id'];
	$cat_title = $row_cats['cat_title'];
		
echo "<option value='$cat_id'>$cat_title</option>";
}
?>
</select>
</td>
</tr>

<tr>
<td align="center">Brand:</td>
<td>
<select name="product_brand" required>
<option>Select Brand</option>
<?php
$get_brands = "select * from brands";
$run_brands = mysqli_query($con, $get_brands);
	
while($row_brands = mysqli_fetch_array($run_brands)){
	$brand_id = $row_brands['brand_id'];
	$brand_title = $row_brands['brand_title'];
		
echo "<option value='$brand_id'>$brand_title</option>";
}
?>
</select>
</td>
</tr>

<tr>
<td align="center">Image:</td>
<td><input type="file" name="product_image" required/></td>
</tr>

<tr>
<td align="center">Price:</td>
<td><input type="text" name="product_price" required/></td>
</tr>

<!--Added-->
<tr>
<td align="center">Quantity:</td>
<td><input type="text" name="product_qty" required/></td>
</tr>
<!---->

<tr>
<td align="center">Description:</td>
<td><textarea name="product_desc" rows="10" cols="60" ></textarea></td>
</tr>

<tr>
<td align="center">Keywords:</td>
<td><input type="text" name="product_keywords" /></td>
</tr>

<tr align="center">
<td colspan="8"><input type="submit" name="insert_post" value="Insert Product"/></td>
</tr>


</body>
</html>

<?php
if(isset($_POST['insert_post'])){
	
$product_title = $_POST['product_title'];	
$product_cat = $_POST['product_cat'];	
$product_brand = $_POST['product_brand'];	
$product_qty = $_POST['product_qty'];
$product_price = $_POST['product_price'];	
$product_desc = $_POST['product_desc'];
$product_keywords = $_POST['product_keywords'];	
	
$product_image = $_FILES['product_image']['name'];
$product_image_tmp = $_FILES['product_image']['tmp_name'];

move_uploaded_file($product_image_tmp,"product_images/$product_image");
$insert_product = "insert into products(product_title,product_cat,product_brand,product_qty,product_image,product_price,product_desc,product_keywords) values('$product_title','$product_cat','$product_brand','$product_qty','$product_image','$product_price','$product_desc','$product_keywords')";	
$insert_pro = mysqli_query($con, $insert_product);
if($insert_pro){
echo "<script>alert('Product inserted!')</script>";
echo "<script>window.open('insert_product.php','_self')</script>";
}

}

?>