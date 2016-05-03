<?php include_once "common/header.php"; ?>
<?php include('auth.php');?>

<?php 
$charnum = $_GET['charnum'];
//$sql = "Select CityName,StrucID from `structures` where CharIDOwns in (Select CharID from `characters` where CharName='$charname')";
$sql2 = "SELECT CityName,StrucID,CharName from structures inner join characters on characters.CharID = structures.CharIDOwns where structures.CharIDOwns in (Select CharID from characters
where CharID='$charnum')";
$result=$link->query($sql2);
if($result){
	$res= mysqli_fetch_row($result);
	$city= $res[0];
	$housenum= $res[1];
	$charn = $res[2];
}
else{
	
	throw new Exception(mysqli_error($link)."[ $result]");
}
?>

<?php echo $charn;?>'s character profile<br/>
<a href="house.php?cid=<?=$housenum?>&rid=0"> visit your house </a> <br/>
<a href="city.php?cid=<?=$city?>"> visit your city </a>

<?php include_once "common/sidebar.php"; ?>
<?php include_once "common/footer.php"; ?> 