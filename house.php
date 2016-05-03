<?php include_once "common/header.php"; ?>
<?php include("auth.php"); //include auth.php file on all secure pages ?>
<?php 
$housepath='img/';
$roomid = $_GET['rid'];
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
$user = $_SESSION['username'];
$strucid = $_GET['cid'];

if($roomid ==0){
	$inroom="livingroom";
}
else if ($roomid==1){
	$inroom="bedroom";
}
else if ($roomid==2){
	$inroom=="kitchen";
}

//determine if this is your house or not, we use this to see if you're allowed to decorate it.
$sqlwhose= "Select CharName from characters where CharUserName='$user'";
$charres=$link->query($sqlwhose);
while($usern = mysqli_fetch_assoc($charres))
$youchar[]=$usern['CharName'];

if(empty($youchar[1]))
	$youchar[1]='';
$sql = "SELECT * from Furniture 
inner join structures
	on furniture.InsideStrucID=structures.StrucID
	and structures.StrucID='$strucid'
inner join characters 
	on characters.CharID = structures.CharIDOwns";
$result=$link->query($sql);
if($result){
	if (mysqli_num_rows($result)==0){
		$sql2 = "select CharName,CharID from characters inner join structures where characters.CharID=structures.CharIDOwns and structures.StrucID='$strucid'";
		$result2 = $link->query($sql2);
		$tex = mysqli_fetch_assoc($result2);
		echo "<h1>House of ".$tex['CharName']."</h1><br/>";
		$whois = $tex['CharID'];
		$charhouse = $tex['CharName'];
		
		//do another mysql statement because this person has no furniture
		
$sql2="select * from  stats
inner join charholdsingredient
	on charholdsingredient.CharIDHolds=stats.CharIDStats
	and stats.CharIDStats = '$whois'";
	$reslt = $link->query($sql2);
	while($blah = mysqli_fetch_assoc($reslt)){
		$ingsonhand[]= $blah['IngNameID'];
		$skill1 = $blah['Skill1'];
		$skill2 = $blah['Skill2'];
		$skill3 = $blah['Skill3'];
	}
	

$sql3="SELECT
  OutputName
FROM
  crafting
INNER JOIN
  craftingrecipe ON crafting.Recipe = craftingrecipe.RecipeName AND(
    crafting.SkillNeeded = '$skill3' OR crafting.SkillNeeded = '$skill1' OR crafting.SkillNeeded = '$skill2'
  ) AND craftingrecipe.IngNeeded IN(
  SELECT
    IngNameID
  FROM
    stats
  INNER JOIN
    charholdsingredient ON charholdsingredient.CharIDHolds = stats.CharIDStats AND stats.CharIDStats = '$whois'
)";
	$resc=$link->query($sql3);
	if ($resc){
	while($rescc=mysqli_fetch_assoc($resc)){
		$recipeallowed[]=$rescc['OutputName'];
	}
	}else{throw new Exception(mysqli_error($link)."[ $resc]");}
	}
	else{
		$tex = mysqli_fetch_assoc($result);
		echo "<h1>House of ".$tex['CharName']."</h1><br/>";
		$whois = $tex['CharID'];
		$charhouse = $tex['CharName'];
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
			$foundinroom= $tex['InRoom'];
			$numfloors=$tex['NumOfFloors'];
			if($numfloors>0){
				$secondfloor='true';
			}
			//echo "<td>".$structype."</td><td>".$furniture."</td><td>".$inroom."</td><td>".$numfloors."</td>";
			
	}
	
$sql2="select * from  stats
inner join charholdsingredient
	on charholdsingredient.CharIDHolds=stats.CharIDStats
	and  stats.CharIDStats = '$whois'";
	//we do this one to figure out what we're currently holding in inventory.
	$reslt = $link->query($sql2);
	while($blah = mysqli_fetch_assoc($reslt)){
		$ingsonhand[]= $blah['IngNameID'];
		$skill1 = $blah['Skill1'];
		$skill2 = $blah['Skill2'];
		$skill3 = $blah['Skill3'];
	}
	
$sql6 = "SELECT EquipName from equipment where CharIDWearing='$whois' and EquippedInSlot='inventory'";
$result6=$link->query($sql6);
while($inventory =mysqli_fetch_assoc($result6)){
	$ininven[]= $inventory['EquipName'];
}


$sql3="SELECT
  OutputName
FROM
  crafting
INNER JOIN
  craftingrecipe ON crafting.Recipe = craftingrecipe.RecipeName AND(
    crafting.SkillNeeded = '$skill3' OR crafting.SkillNeeded = '$skill1' OR crafting.SkillNeeded = '$skill2'
  ) AND craftingrecipe.IngNeeded IN(
  SELECT
    IngNameID
  FROM
    stats
  INNER JOIN
    charholdsingredient ON charholdsingredient.CharIDHolds = stats.CharIDStats AND stats.CharIDStats = '$whois'
)";
	$resc=$link->query($sql3);
	if ($resc){
	while($rescc=mysqli_fetch_assoc($resc)){
		$recipeallowed[]=$rescc['OutputName'];
	}
	}else{throw new Exception(mysqli_error($link)."[ $resc]");}
}}

else{
	
	throw new Exception(mysqli_error($link)."[ $result]");
}


?>
<img src='<?=$housewalls?>' class='walls'></img>
<img src='<?=$housefloor?>' class='floor'></img>
<img src='<?=$housewindows?>' class='floor'></img>
<img src='<?=$housedoor?>' id="door" name="door" class='floor' ></img>
<img src='<?=$housebed?>' id="bed" name="bed" class='furniture' style="display:none"></img>
<img src='<?=$houserug?>' id="rug" name="rug" class='furniture' style="display:none"></img>
<img src='<?=$housetable?>' id="table" name="table" class='furniture' style="display:none"></img>
<img src='<?=$housechair?>' id="chair" name="chair" class='furniture' style="display:none"></img>
<img src='<?=$housecurtains?>' id="curtains" name="curtains" class='curtains' style="display:none"></img>
<img src='<?=$housestairs?>' id="stairs" name="stairs" class='furnitureb' style="display:none"></img>
<script>
var bed = '<?php echo $hasbed;?>';
var rug = '<?php echo $hasrug;?>';
var table = '<?php echo $hastable;?>';
var chair = '<?php echo $haschair;?>';
var curtains = '<?php echo $hascurtains;?>';
var stairs = '<?php echo $secondfloor;?>';
var inroom = '<?php echo $inroom;?>';
var foundinroom = '<?php echo $foundinroom;?>';
if (bed !='' && inroom==foundinroom){
document.getElementById("bed").style.display = "initial";}
if (rug !=''&& inroom==foundinroom){
document.getElementById("rug").style.display = "initial";}
if (table !=''&& inroom==foundinroom){
document.getElementById("table").style.display = "initial";}
if (chair !=''&& inroom==foundinroom){
document.getElementById("chair").style.display = "initial";}
if (curtains !=''&& inroom==foundinroom){
document.getElementById("curtains").style.display = "initial";}
if (stairs !=''&& inroom=="livingroom"){
document.getElementById("stairs").style.display = "initial";}
</script>

<div id='showonlyifchar' style='display:none'>
<a href='' onclick='return buystuff();'>Buy more stuff</a>
<a href='' onclick='return inventorypanel();'>Decorate</a></div>
<a href='house.php?cid=<?=$strucid?>&rid=2' id='thirdfloor-' style="display:none">Go Upstairs</a>
<a href='house.php?cid=<?=$strucid?>&rid=1' id='secondfloor+' style="display:none">Go Upstairs</a>
<a href='house.php?cid=<?=$strucid?>&rid=1' id='secondfloor-' style="display:none">Go Downstairs</a>
<a href='house.php?cid=<?=$strucid?>&rid=0' id='firstfloor-' style="display:none">Go Downstairs</a>
<div id='buystuffs' style='display:none'>
<table class='buystuffs'><tr><td>
	You currently have in inventory:<?php if(!empty($ingsonhand)){foreach($ingsonhand as $ing) echo "<br/>".$ing;}?><br/>
	<input type="button" name="ok" value="Go To Shop" onclick="location.href='shop.php?cid=<?=$whois?>'"></td></tr>
	<tr><td>With your skills you can build:<?php if(!empty($recipeallowed)){ foreach($recipeallowed as $rec) echo "<br/>".$rec;}?><br/></td></tr>
	<tr><td><input type="button" name="ok" value="Craft Stuff" onclick="location.href='craft.php?cid=<?=$whois?>'"></td></tr></td></tr>
	<tr><td><input type="button" name="ok" value="close" onclick="document.getElementById('buystuffs').style.display='none';"></td></tr></table>
	</div>
<div id='inventorypanel' style='display:none'>
<table class='buystuffs'><tr><td>
	You currently have in inventory:<?php if (!empty($ininven)){foreach($ininven as $inv) echo "<br/><a href='javascript:placeinroom(`".$inv."`);'>".$inv."</a>";}?><br/></td></tr>
	<tr><td><input type="button" name="ok" value="close" onclick="document.getElementById('inventorypanel').style.display='none';"></td></tr></table>
	</div>	
<script>
function placeinroom(working){
	if (working=="Curtains"||working=="curtains"){
		
	document.getElementById("curtains").style.display = "initial";
	}
	if (working=="bed"|| working=="Bed"){
		
	document.getElementById("bed").style.display = "initial";
	}
	if (working=="Rug"|| working=="rug"){
		
	document.getElementById("rug").style.display = "initial";
	}
	if (working=="table"|| working=="Table"){
		
	document.getElementById("table").style.display = "initial";
	
	}if (working=="Chair"|| working=="chair"){
		
	document.getElementById("chair").style.display = "initial";
	}
return false;
	}
function buystuff(){
	//display a div with your current ingredients, display a list of stuff you can make with your skills
document.getElementById("buystuffs").style.display = "initial";
return false;
}function inventorypanel(){
	//display a div with your current ingredients, display a list of stuff you can make with your skills
document.getElementById("inventorypanel").style.display = "initial";
return false;
}
var user = '<?= $youchar[0]?>';
try{
var seconduser='<?=$youchar[1]?>';}
catch(err){
	var seconduser='';
}
var charhouse ='<?= $charhouse?>';
console.log(user+','+ seconduser+','+ charhouse);
if(user==charhouse || seconduser==charhouse){
	document.getElementById("showonlyifchar").style.display = "initial";
}
else{document.getElementById("showonlyifchar").style.display = "none";}

if (stairs !=''&& inroom=="livingroom"){
	document.getElementById("secondfloor+").style.display = "initial"
}
if (inroom=="bedroom"){
	document.getElementById("firstfloor-").style.display = "initial";
	document.getElementById("door").style.display = "none";}
	</script>
<?php include_once "common/sidebar.php"; ?>