<?php include_once "common/header.php"; ?>

<div id="main">

   <noscript>This site just doesn't work, period, without JavaScript</noscript>

<?php include("auth.php"); //include auth.php file on all secure pages ?>

<div class="form">

<h2>Hello <?php echo $_GET['charname']?>!</h2>

<?php 
$query = "select CharName,Coins FROM `CHARACTERS` WHERE CharName IN (SELECT FriendAccountName from `FRIENDSLISTS` where PlayerUserName='".$_GET['charname']."')";
$result = $link->query($query);

if($result!=null){
if($result->num_rows > 0){
	echo "<h4>These are your friends:</h4><table><tr>";
	$int=1;
	while($nametag = mysqli_fetch_assoc($result)){
		$name = $nametag['CharName'];
		echo "<td><b>".$name."</b> with ".$nametag['Coins']." coins.</td>";
		$int = $int+1;
		if($int == 6){
			echo "</tr><tr>";
			$int = 1;
		}
	}
	echo "</table>";
} }else
	echo "<p>You don’t have any friends yet.</p>";
?>


</div>

