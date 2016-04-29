<?php include_once "common/header.php"; ?>
<?php include("auth.php"); //include auth.php file on all secure pages ?>
<?php 
$strucid = $_GET['cid'];
$sql = "SELECT * from Furniture 
inner join structures
	on furniture.InsideStrucID=structures.StrucID
	and structures.StrucID='$strucid'
inner join characters 
	on characters.CharID = structures.CharIDOwns";
$result=$link->query($sql);
if($result){
	if (mysqli_num_rows($result)==0){
		//do another mysql statement because this person has no furniture
	}
	echo $tex;
	echo "<h1>House of ".$tex['CharName']."</h1><br/>";
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