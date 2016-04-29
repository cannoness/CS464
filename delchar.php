<?php include_once "common/header.php"; ?>
<?php include("auth.php"); //include auth.php file on all secure pages ?>

<?php
$q = $_GET['charnum'];

$link->begin_transaction();
$sql = "DELETE FROM `characters` WHERE `CharID`='$q'";
$result = mysqli_query($link,$sql);

$sql2 = "delete from `charholdsingredient` where CharIDHolds='$q'";
$result2 = mysqli_query($link,$sql2);
$sql3 = "delete from `equipment` where CharIDWearing='$q'";
$result3 = mysqli_query($link,$sql3);
$sql4 = "delete from `stats` where CharIDStats='$q'";
$result4 = mysqli_query($link,$sql4);
$sql5 = "delete from `guild` where CharIDInGuild='$q'";
$result5 = mysqli_query($link,$sql5);
$sql6= "delete from `structures` where CharIDOwns='$q'";
$result6 = mysqli_query($link,$sql6);

if($result&&$result2&&$result3&&$result4&&$result5&&$result6){
	$link->commit();
}

 else{
	throw new Exception(mysqli_error($link)."[ $result]");
	$link->rollback();
 }


echo $result;
?>