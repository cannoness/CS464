<?php include_once "common/header.php"; ?>

<div id="main">

   <noscript>This site just doesn't work, period, without JavaScript</noscript>

<?php include("auth.php"); //include auth.php file on all secure pages ?>

<div class="account">
<h1><?php echo $_SESSION['username']?>'s User Control Panel</h1><br/>
<?php 
$email = "";
$validated= false;
$query = "select Email from `accounts` where UserName='".$_SESSION['username']."'";
$result = $link->query($query);
if($result){
$emailtag = mysqli_fetch_assoc($result);
$email = $emailtag['Email'];}
else
	throw new Exception(mysqli_error($link)."[ $result]");

function test_input($data) {
     $data = stripslashes($data);
     return $data;
}
?>
<p>
</p>

<form id="account" type="text" method="post" action=''>
Update Email Address<br/>
&emsp;&emsp;<input id="email-address" name="email-address" type ="text" value=<?=$email?>><br/><br/>


<p> Change Password</p>

&emsp;&emsp;<input id="change-pass" name="change-pass" type ="password" value=""><br/><br/>

<p> Confirm Password Change </p>

&emsp;&emsp;<input id="confirm-pass" name="confirm-pass" type ="password" value=""><br/><br/>
<p>
<a href='feedback.php'>Leave Feedback for Admins</a><br/><br/>

<input value="submit" name="submit" class="button" type = "submit">
<br/><br/></form>
</div>

<?php if(isset($_POST['submit'])){
		$cpasswordErr='';
		$passwordErr='';
		if ($_POST['email-address'] != $email){
			//update the email address
			echo "email changed";
		}
		if(!empty($_POST["change-pass"]) && ($_POST["change-pass"] == $_POST["confirm-pass"])) {
			$password = test_input($_POST["change-pass"]);
			$cpassword = test_input($_POST["confirm-pass"]);
			if (strlen($_POST["change-pass"]) <= '7') {
				$passwordErr = "Your Password Must Contain At Least 8 Characters!";
				echo $cpasswordErr." ".$passwordErr;
			}
			elseif(!preg_match("#[0-9]+#",$password)) {
				$passwordErr = "Your Password Must Contain At Least 1 Number!";
				echo $cpasswordErr." ".$passwordErr;
			}
			elseif(!preg_match("#[A-Z]+#",$password)) {
				$passwordErr = "Your Password Must Contain At Least 1 Capital Letter!";
				echo $cpasswordErr." ".$passwordErr;
			}
			elseif(!preg_match("#[a-z]+#",$password)) {
				$passwordErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
				echo $cpasswordErr." ".$passwordErr;
		}}
		elseif (!empty($_POST['change-pass']) && !($_POST["change-pass"] == $_POST["confirm-pass"])){
			echo "Passwords do not match";
}}
?>
<?php include_once "common/sidebar.php"; ?>
<?php include_once "common/footer.php"; ?> 