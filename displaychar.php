<?php include_once "common/header.php"; 
include('auth.php');
?>
<script src="js/jquery-blendmode.js"></script>
<?php
	// Appearance
	$charnum=$_GET['charnum'];
	$query = "SELECT * FROM `CHARACTERS` WHERE CharID='".$_GET['charnum']."'";
	$result = mysqli_query($link,$query);
	$array = mysqli_fetch_array($result);
	$haircolor=$array['HairColor'];
	$eyecolor=$array['EyeColor'];
	$skintone=$array['SkinTone'];
	$charid = $array['CharID'];
	$charname=$array['CharName'];
	$gender=$array['Gender'];
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
<table border ="0" class ="index"><tr><td>
<?php if ($array['Gender']=="f"||$array['Gender']=="female"): ?>
<div id='fpreviewpane' class='fpreviewpane'>
 <img src='img/femeyewhites.png' class='eyewhites'></img>
 <img src='img/femfaceeyes.png' id='eyec' class='eyec'></img>
 <img src='img/femfaceshine.png'  class='eyeshine'></img>
 <img src='img/femalefaceskin.png' id='skint' name='skint'class='skint'></img>
 <img src='<?php 
 	if($array['HairStyle']!="none"):
 		echo "img/".$array['HairStyle'].".png";
 	endif;?>' id='hairc' name='fhair' class='hairc'></img>
 <img src='<?php 
 if($array['BeardOrBangsType']!="none"):
 		echo "img/".$array['BeardOrBangsType'].".png";
 	endif;
 ?>' id='bangc' name='bangs' class='bangc'></img>
 </div>
 <?php endif; ?>
 <?php if ($array['Gender']=="m"|| $array['Gender']=="male"): ?>
 <div id='mpreviewpane' class='mpreviewpane'>
 <img src='img/maleeyewhites.png' class='eyewhites'></img>
 <img src='img/malefaceeyes.png' id='eyec' class='eyec'></img>
 <img src='img/malefaceshine.png'  class='eyeshine'></img>
 <img src='img/malefaceskin.png' id='skint' class='skint'></img>
 <img src='<?php
 	if($array['HairStyle']!="none"):
 		echo "img/".$array['HairStyle'].".png";
 	endif;
 ?>' id='mhairc' name='mhair' class='hairc'></img>
 <img src='<?php 
 	if($array['BeardOrBangsType']!="none"):
 		echo "img/".$array['BeardOrBangsType'];
 		if($array['BeardOrBangsType']=="abelincoln"||"leo"||"gandalf"):
 			echo "top.png";
 		endif;
 	endif;
 ?>' id='beardcb' name='beardb' class='beardcb'></img>
 <img src='<?php 
 	if($array['BeardOrBangsType']!="none"):
 		echo "img/".$array['BeardOrBangsType'];
 		if($array['BeardOrBangsType']=="abelincoln"||"leo"||"gandalf"):
 			echo "bottom.png";
 		endif;
 	endif;
 ?>' id='beardct' name='beard' class='beardct'></img>
 </div>
 <?php endif; ?>
<div id="displaychar">
 <h2>Hello <?php echo $charname?>!</h2><br/>
 Coins: <?php echo $array['Coins']?>, Gender: <?php echo $array['Gender']?><br/>
</td></tr></table>


<table border ="1" class ="index"><tr><td>
<?php
	echo "<h4>Appearance: </h4>";
	echo "Eye Color: " .$array['EyeColor'] ."<br/>";
	echo "Hair Color: " .$array['HairColor'] ."<br/>";
	echo "Skin Tone: " .$array['SkinTone'] ."<br/>";
	echo "Hair Style: " .$array['HairStyle'] ."<br/>";
	echo "Beard Or Bangs Type: " .$array['BeardOrBangsType']."<br/>";
	
?></td>
<td><?php
	// Stats
	$query = "SELECT * FROM `STATS` WHERE CharIDStats='".$charid."'";
	$result = mysqli_query($link,$query);
	$array = mysqli_fetch_array($result);
	echo "<h4>Stats: </h4>";	
	echo "Skill1: ".$array['Skill1']."<br/>";
	echo "Skill2: ".$array['Skill2']."<br/>";
	echo "Skill3: " .$array['Skill3'] ."<br/>";
	echo "Attack Power: " .$array['AttackPower'] ."<br/>";
	echo "Health: " .$array['Health'] ."<br/>";
	echo "Armor: " .$array['Armor']."<br/>";
?></td>
<td><?php
	// Equipment
	$query = "SELECT * FROM `EQUIPMENT` WHERE CharIDWearing='".$charid."'";
	$result = mysqli_query($link,$query);
	echo "<h4>Equipment: </h4>";
	while($array = mysqli_fetch_array($result)){
	switch($array['EquippedInSlot']){
	case "helmet":
		$helmet = $array['EquipName']; 
		echo "Helmet: ".$helmet."<br/>"; break;
	case "chest":
		$chest = $array['EquipName']; 
		echo "Chest: ".$chest."<br/>"; break;
	case "arms":
		$arms = $array['EquipName']; 
		echo "Arms: " .$arms."<br/>"; break;
	case "legs":
		$legs = $array['EquipName']; 
		echo "Legs: " .$legs."<br/>"; break;
	case "shoes":
		$shoes = $array['EquipName']; 
		echo "Shoes: ".$shoes."<br/>"; break;
	default: echo "In Inventory: ".$array['EquipName']."<br/>"; break;
	}}
?></td>
</tr><tr><td colspan=3>
<a href="house.php?cid=<?=$housenum?>&rid=0"> visit your house </a> <br/>
<a href="city.php?cid=<?=$city?>"> visit your city </a></td></tr>
</table>
</div>
<script>
var haircolor="<?=$haircolor?>";
var eyecolor="<?=$eyecolor ?>";
var skintone= "<?=$skintone?>";
console.log(haircolor);
var gender= "<?=$gender?>";
function colorchanger(where){
	if (where == "haircolor"){
	if(haircolor=="black"){
		
			if (gender=="f"){
		
		$("#hairc").blendmode({
			"mode" : "multiply",
			"object" : "#333"
		});
		$("#bangc").blendmode({
			"mode" : "multiply",
			"object" : "#333"
		});}
		else{
		
		;$("#mhairc").blendmode({
			"mode" : "multiply",
			"object" : "#333"
		});
		$("#beardct").blendmode({
			"mode" : "multiply",
			"object" : "#333"
		});
		$("#beardcb").blendmode({
			"mode" : "multiply",
			"object" : "#333"
		});
		
		}}
	 if(haircolor=="brown"){
		
		if (gender=="f"){
		
		$("#hairc").blendmode({
			"mode" : "multiply",
			"object" : "#802b00"
		});
		$("#bangc").blendmode({
			"mode" : "multiply",
			"object" : "#802b00"
		});}
		else{
		;$("#mhairc").blendmode({
			"mode" : "multiply",
			"object" : "#802b00"
		});
		$("#beardct").blendmode({
			"mode" : "multiply",
			"object" : "#802b00"
		});
		$("#beardcb").blendmode({
			"mode" : "multiply",
			"object" : "#802b00"
		});
		
		}
		}
	 if(haircolor=="blonde"){
		if (gender=="f"){
		$("#hairc").blendmode({
			"mode" : "multiply",
			"object" : "#ffff66"
		});
		
		$("#bangc").blendmode({
			"mode" : "multiply",
			"object" : "#ffff66"
		});
		}else{
		;$("#mhairc").blendmode({
			"mode" : "multiply",
			"object" : "#ffff66"
		});
		$("#beardct").blendmode({
			"mode" : "multiply",
			"object" : "#ffff66"
		});
		$("#beardcb").blendmode({
			"mode" : "multiply",
			"object" : "#ffff66"
		});
		
		}
		}
	
	 if(haircolor=="red"){
		if (gender=="f"){
		$("#hairc").blendmode({
			"mode" : "multiply",
			"object" : "#ff6600"
		});
		$("#bangc").blendmode({
			"mode" : "multiply",
			"object" : "#ff6600"
		});}else{
		;$("#mhairc").blendmode({
			"mode" : "multiply",
			"object" : "#ff6600"
		});
		$("#beardct").blendmode({
			"mode" : "multiply",
			"object" : "#ff6600"
		});
		$("#beardcb").blendmode({
			"mode" : "multiply",
			"object" : "#ff6600"
		});
		
	 }}
	 if(haircolor=="grey"){
		if (gender=="f"){
		$("#hairc").blendmode({
			"mode" : "multiply",
			"object" : "#fff"
		});
		$("#bangc").blendmode({
			"mode" : "multiply",
			"object" : "#fff"
		});
		}else{
		;$("#mhairc").blendmode({
			"mode" : "multiply",
			"object" : "#fff"
		});
		$("#beardct").blendmode({
			"mode" : "multiply",
			"object" : "#fff"
		});
		$("#beardcb").blendmode({
			"mode" : "multiply",
			"object" : "#fff"
		});
		
	 }}
	 if(haircolor=="dirtyblonde"){
		
		if (gender=="f"){
		$("#hairc").blendmode({
			"mode" : "multiply",
			"object" : "#e6b800"
		});
		$("#bangc").blendmode({
			"mode" : "multiply",
			"object" : "#e6b800"
		});
		}else{
		;$("#mhairc").blendmode({
			"mode" : "multiply",
			"object" : "#e6b800"
		});
		$("#beardct").blendmode({
			"mode" : "multiply",
			"object" : "#e6b800"
		});
		$("#beardcb").blendmode({
			"mode" : "multiply",
			"object" : "#e6b800"
		});
		
		}
	}}
	else if (where=="eyecolor"){
	if(eyecolor=="red"){
		$('#eyec').attr('src', 'img/femfaceeyes.png');
		$("#eyec").blendmode({
			"mode" : "multiply",
			"object" : "#ff0000"
		});
	}if(eyecolor=="hazel"){
		$('#eyec').attr('src', 'img/femfaceeyes.png');
		$("#eyec").blendmode({
			"mode" : "multiply",
			"object" : "#ffff1a"
		});
	}if(eyecolor=="green"){
		$('#eyec').attr('src', 'img/femfaceeyes.png');
		$("#eyec").blendmode({
			"mode" : "multiply",
			"object" : "#66ff66"
		});
	}if(eyecolor=="blue"){
		$('#eyec').attr('src', 'img/femfaceeyes.png');
		$("#eyec").blendmode({
			"mode" : "multiply",
			"object" : "#4dd2ff"
		});
	}if(eyecolor=="grey"){
		$('#eyec').attr('src', 'img/femfaceeyes.png');
		$("#eyec").blendmode({
			"mode" : "multiply",
			"object" : "#fff"
		});
	}if(eyecolor=="black"){
		$('#eyec').attr('src', 'img/femfaceeyes.png');
		$("#eyec").blendmode({
			"mode" : "multiply",
			"object" : "#333"
		});
	}if(eyecolor=="brown"){
		$('#eyec').attr('src', 'img/femfaceeyes.png');
		$("#eyec").blendmode({
			"mode" : "multiply",
			"object" : "#e64d00"
		});
	}
	}
	else if (where=="skintone"){
	if(skintone=="tan"){
		$('#skint').attr('src', 'img/femalefaceskin.png');
		$("#skint").blendmode({
			"mode" : "multiply",
			"object" : "#f9ce9f"
	});}
	
		if(skintone=="dark"){
		$('#skint').attr('src', 'img/femalefaceskin.png');
		$("#skint").blendmode({
			"mode" : "multiply",
			"object" : "#a95c0a"
	});}
	 if(skintone=="verydark"){
		$('#skint').attr('src', 'img/femalefaceskin.png');
		$("#skint").blendmode({
			"mode" : "multiply",
			"object" : "#603506"
	});}
	
	 if(skintone=="olive"){
		$('#skint').attr('src', 'img/femalefaceskin.png');
		$("#skint").blendmode({
			"mode" : "multiply",
			"object" : "#fcf49c"
	});}
	
	 if(skintone=="pale"){
		$('#skint').attr('src', 'img/femalefaceskin.png');
		$("#skint").blendmode({
			"mode" : "multiply",
			"object" : "#fdeece"
	});}
	
	 if(skintone=="verypale"){
		$('#skint').attr('src', 'img/femalefaceskin.png');
		$("#skint").blendmode({
			"mode" : "multiply",
			"object" : "#fff"
	});}
	}
}
colorchanger("eyecolor");
colorchanger("haircolor");
colorchanger("skintone");

</script>