<?php include_once "common/header.php"; ?>
<?php include('auth.php');?>

<?php 
$username= $_SESSION['username'];
$email =$_POST['email-address'];
$password = $_POST['change-pass'];
//doublecheck money again
$sql = "";
$link->begin_transaction();
if(!empty($_POST['email-address'])){
	if (!empty($_POST['change-pass'])){
		//do both
		$sql="update accounts set Email='$email', Password='$password' where UserName='$username'";
		echo $sql;
	}
	else{
		//just do email
		$sql="update accounts set Email='$email' where UserName='$username'";
	}
	$result = mysqli_query($link,$sql);
	if ($result)
		$link->commit();
	else
		throw new Exception(mysqli_error($link)."[ $result]");
	}
else if (!empty($_POST['change-pass'])){
	//just change pass
	$sql="update accounts set Password='$password' where UserName='$username'";
	$result = mysqli_query($link,$sql);
	if($result)
		$link->commit();
	else
		throw new Exception(mysqli_error($link)."[ $result]");
}
?>