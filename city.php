<?php include_once "common/header.php"; ?>
<?php include("auth.php"); //include auth.php file on all secure pages ?>
<?php 
$cityname = $_GET['cid'];
$user = $_SESSION['username'];
$numfriends = 0;
$sql = "SELECT * from structures inner join characters where characters.CharID = structures.CharIDOwns and structures.CityName='$cityname'";
$friends = "select CharName from characters inner join friendslists where characters.CharUserName=friendslists.FriendAccountName and friendslists.PlayerUserName='$user'";
$friendres = $link->query($friends);
if($friendres){
	while ($friendr=mysqli_fetch_assoc($friendres)){
	$flist[]=$friendr['CharName'];
}
}
else{
	throw new Exception(mysqli_error($link)."[ $result]");
}
$numfriends=mysqli_num_rows($friendres);
$result=$link->query($sql);


if($result){
	echo "<h1>City of ".$cityname."</h1><br/>";
	echo "<table class='city'><tr>";
	$i = 0;
	while($res= mysqli_fetch_assoc($result)){
		$city= $res['CityName'];
		$charname = $res['CharName'];
		$housenum= $res['StrucID'];
		$structype= $res['StrucType'];
		echo "<td class='house'><a href='house.php?cid=".$housenum."&rid=0' onclick='return checkiffriend(`".$charname."`);'>";
		if ($structype=="house")
			echo "<img src='img/steeplehousesm.png' class='smhouse'>
		<img src='img/roof2.png' class='smroof'>
		<img src='img/rounded_set_W.png' class='smhouse'>
		<img src='img/steeplehousesmdirt.png' class='smhouse'><img src='img/smshadow.png' class='smhouse'>
		<img src='img/square set D.png' class='smhouse'>".$charname."'s House </img></a></td>";
		else if($structype=="shack")
			echo "<img src='img/woodhut.png' class='smhouse'><img src='img/smshadow.png' class='smhouse'>
		<img src='img/strawroofsmhut.png' class='smroof'>
		".$charname."'s House </a></td>";
		else if($structype=="EmptyPlot")
			echo "<img src='img/smshadow.png' class='smhouse'>".$charname."'s House </a></td>";
		$i++;
		if ($i == 8){
			echo "</tr>";
			$i = 0;
		}
	}
	echo "</table>";
}

else{
	
	throw new Exception(mysqli_error($link)."[ $result]");
}
?>

<script>
function checkiffriend(friendornot){
	var count = <?php echo $numfriends;?>;
	var obj = <?php echo json_encode($flist); ?>;
	var unlocked=false;
	for(var i=0; i < count;i++){
		if (obj[i]==friendornot){
			
			unlocked=true;
			return true;
		}
	}
	if(unlocked==false)
			alert("you can't enter non friends house");
		return false;
}
</script>
<?php include_once "common/sidebar.php"; ?>
<?php include_once "common/footer.php"; ?> 