
<?php 
//session_start();
include("includes/db.php");

?>
<div>

<form method="post" action="">

<table width="500" align="center" bgcolor="skyblue">

<tr align="center">
<td align="right"><h2><b>Login or Register</b></h2></td>
</tr>

<tr>
<td><b>Email:</b></td>
<td><input type="text" name="email" placeholder="enter email" required/></td>
</tr>

<tr>
<td><b>Password:</b></td>
<td><input type="password" name="pass" placeholder="enter password" required/></td>
</tr>

<tr>
<td align="center"><a href="checkout.php?forgot_pass">Forgot Password?</a></td>

<tr>
<td align="right"><input type="submit" name="login" value="Login" /></td>
</tr>


</table>

<h3 style="float:center; padding:10px;"><a href="customer_register.php">New User? Register Here!</a></h3>

</form>

<?php
if(isset($_POST['login'])){
	$c_email=$_POST['email'];
	$c_pass=$_POST['pass'];
	
	$sel_cart="select * from customers where customer_pass='$c_pass' AND customer_email='$c_email'";
	
	$run_c=mysqli_query($con, $sel_cart);
	
	$check_customer = mysqli_num_rows($run_c);
	
	if($check_customer==0){
		echo "<script>alert('Password or email is incorrect. Please try again!')</script>";
		exit();
	}
	
	$ip=getIp();
	$sel_cart="select * from cart where ip_add='$ip'";
	
	$run_cart=mysqli_query($con, $sel_cart);
	
	$check_cart=mysqli_num_rows($run_cart);
	if($check_customer>0 AND $check_cart==0){
		$_SESSION['customer_email']=$c_email;
		echo "<script>alert('Login Successful!')</script>";
		echo "<script>window.open('index.php','_self')</script>";
	}
	else{
		$_SESSION['customer_email']=$c_email;
		echo "<script>alert('Login Successful!')</script>";
		echo "<script>window.open('checkout.php','_self')</script>";
	}
	
}
?>

</div>