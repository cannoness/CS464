<?php include_once "common/header.php"; ?>
<?php include("auth.php"); //include auth.php file on all secure pages ?>
<?php 
$housepath='img/';
$housewalls=$housepath.'SmallHouseStucco.png';
$housefloor=$housepath.'smhouserockfloor.png';
$housewindows=$housepath.'smhouseroundwindows.png';
$housedoor=$housepath.'smhousesquaredoors.png';
$housestairs=$housepath.'staircase.png';
$housebed=$housepath.'woodbed.png';
$housetable=$housepath.'rocktable.png';
$housecurtains=$housepath.'curtains.png';
$housechair=$housepath.'woodstool.png';
$houserug=$housepath.'small_rug.png';
$secondfloor='';
$hasbed='';
$hasrug='';
$haschair='';
$hascurtains='';
$hastable='';
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
		$sql2 = "select CharName from characters inner join structures where characters.CharID=structures.CharIDOwns and structures.StrucID='$strucid'";
		$result2 = $link->query($sql2);
		$tex = mysqli_fetch_assoc($result2);
		echo "<h1>House of ".$tex['CharName']."</h1><br/>";
		//do another mysql statement because this person has no furniture
	}
	else{
		$tex = mysqli_fetch_assoc($result);
		echo "<h1>House of ".$tex['CharName']."</h1><br/>";
		echo "<table><tr>";
		$i = 0;
		for($i=0;$i<mysqli_num_rows($result);$i++){
			$furniture= $tex['FurType'];
			if($furniture=="bed"){
				$hasbed='true';
			}if($furniture=="rug"){
				$hasrug='true';
			}if($furniture=="chair"){
				$haschair='true';
			}if($furniture=="table"){
				$hastable='true';
			}if($furniture=="curtains"){
				$hascurtains='true';
			}
			$structype= $tex['StrucType'];
			$inroom= $tex['InRoom'];
			$numfloors=$tex['NumOfFloors'];
			if($numfloors>0){
				$secondfloor='true';
			}
			echo "<td>".$structype."</td><td>".$furniture."</td><td>".$inroom."</td><td>".$numfloors."</td>";
			$i++;
			if ($i == 8){
				echo "</tr>";
				$i = 0;
			}
	}
	echo "</table>";}
}

else{
	
	throw new Exception(mysqli_error($link)."[ $result]");
}
?>
<img src='<?=$housewalls?>' class='walls'></img>
<img src='<?=$housefloor?>' class='floor'></img>
<img src='<?=$housewindows?>' class='floor'></img>
<img src='<?=$housedoor?>' id="door" name="door" class='floor'></img>
<img src='<?=$housebed?>' id="bed" name="bed" class='furniture' style="display:none"></img>
<img src='<?=$houserug?>' id="rug" name="rug" class='furniture' style="display:none"></img>
<img src='<?=$housetable?>' id="table" name="table" class='furniture' style="display:none"></img>
<img src='<?=$housechair?>' id="chair" name="chair" class='furniture' style="display:none"></img>
<img src='<?=$housecurtains?>' id="curtains" name="curtains" class='furniture' style="display:none"></img>
<img src='<?=$housestairs?>' id="stairs" name="stairs" class='furniture' style="display:none"></img>
<script>
var bed = '<?php echo $hasbed;?>';
var rug = '<?php echo $hasrug;?>';
var table = '<?php echo $hastable;?>';
var chair = '<?php echo $haschair;?>';
var curtains = '<?php echo $hascurtains;?>';
var stairs = '<?php echo $secondfloor;?>';
if (bed !=''){
document.getElementById("bed").style.display = "initial";}
if (rug !=''){
document.getElementById("rug").style.display = "initial";}
if (table !=''){
document.getElementById("table").style.display = "initial";}
if (chair !=''){
document.getElementById("chair").style.display = "initial";}
if (curtains !=''){
document.getElementById("curtains").style.display = "initial";}
if (stairs !=''){
document.getElementById("stairs").style.display = "initial";}</script>

<?php include_once "common/sidebar.php"; ?>