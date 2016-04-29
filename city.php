<?php include_once "common/header.php"; ?>
<?php include("auth.php"); //include auth.php file on all secure pages ?>
<?php 
$cityname = $_GET['cid'];
$sql = "SELECT * from structures inner join characters where characters.CharID = structures.CharIDOwns and structures.CityName='$cityname' ORDER BY XPosition ASC, YPosition ASC";
$result=$link->query($sql);
if($result){
	echo "<h1>City of ".$cityname."</h1><br/>";
	echo "<table><tr>";
	$i = 0;
	while($res= mysqli_fetch_assoc($result)){
		$city= $res['CityName'];
		$charname = $res['CharName'];
		$housenum= $res['StrucID'];
		$structype= $res['StrucType'];
		echo "<td><a href='house.php?cid=".$housenum."'> ".$charname."'s House </a></td>";
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
<?php include_once "common/sidebar.php"; ?>
<?php include_once "common/footer.php"; ?> 