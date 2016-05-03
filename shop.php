<?php include_once "common/header.php"; ?>
<?php include('auth.php');?>

Welcome to the shop!<br/>

<?php 
$whois = $_GET['cid'];
//$sql = "Select CityName,StrucID fro
$sql2="select * from  stats
inner join charholdsingredient
	on charholdsingredient.CharIDHolds=stats.CharIDStats
	and  stats.CharIDStats = '$whois' group by IngNameID";
	//we do this one to figure out what we're currently holding in inventory.
	$reslt = $link->query($sql2);
	while($blah = mysqli_fetch_assoc($reslt)){
		$ingsonhand[]= $blah['IngNameID'];
		$skill1 = $blah['Skill1'];
		$skill2 = $blah['Skill2'];
		$skill3 = $blah['Skill3'];
	}
	if(empty($ingsonhand)){
		$sql2="select * from  stats where CharIDStats = '$whois'";
	//we do this one to figure out what we're currently holding in inventory.
	$reslt = $link->query($sql2);
	while($blah = mysqli_fetch_assoc($reslt)){
		$skill1 = $blah['Skill1'];
		$skill2 = $blah['Skill2'];
		$skill3 = $blah['Skill3'];
	}}
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
$moneysql = "Select Coins from characters where CharID='$whois'";
	$cquery=$link->query($moneysql);
	$coin =mysqli_fetch_assoc($cquery);
	$sqlt = "Select * from ingredient";
	$ingres = $link->query($sqlt);
	echo "
<div id='shop'><form id='purchaser' name='purchaser' method='post' class='purchaser' action='purchase.php?cid=".$coin['Coins']."&pid=".$whois."'> <table><tr><td cellspan='3'>
Available for purchase</td></tr><tr><td>Ingredient</td><td>Type</td><td>Cost</td></tr>";
	while($inglist=mysqli_fetch_assoc($ingres)){
		$checkboxv = $inglist['IngName'].','.$inglist['CoinCost'];
		echo "<tr><td><input name='checkbox[]' onclick='KeepCount()' type='checkbox' id=".$checkboxv."	value=".$checkboxv."></td><td>".$inglist['IngName']."</td><td>".$inglist['IngType']."</td><td>".$inglist['CoinCost']."</td></tr>";
	}
	echo "<tr><td>
	</td><td>Cost</td><td>Left to spend</td></tr><tr><td>
<input id='submit' type='submit' class='button' value='Purchase' name='submit'>
</td><td id='coincost'></td><td id='leftmoney'></td></tr></table></form>";
	$moneysql = "Select Coins from characters where CharID='$whois'";
	$cquery=$link->query($moneysql);
	$coin =mysqli_fetch_assoc($cquery);
?>


<div id='buystuffsdiv' class='buystuffsdiv' >
<table class='buystuffs'><tr><td>
	You currently have in inventory:<?php if(!empty($ingsonhand)){foreach($ingsonhand as $ing) echo "<br/>".$ing;}?><br/></td></tr>
	<tr><td>With your skills you can build:<?php if (!empty($recipeallowed)){foreach($recipeallowed as $rec) echo "<br/>".$rec;}?><br/></td></tr>
	<tr><td>You have <?php echo $coin['Coins'];?> coins to spend.</td></tr><tr><td><a href="craft.php?cid=<?php echo $whois;?>">Crafting</a></td></tr></table>
</div>
<script type="text/javascript">
var canpurchase=true;
function KeepCount() {
 var sum = 0;
    $(":checkbox:checked").each(function(){
		var vars = $(this).val();
		vals = vars.split(',');
		sum += parseInt(vals[1]);
    });
	$('#coincost').text(sum);
	$('#leftmoney').text(<?=$coin['Coins']?>-sum);
	if(sum > <?php echo $coin['Coins'];?>){
		$('#coincost').css("color","red");
		$('#coincost').css("font-weight","bold");
		canpurchase=false;
		return false;
	}
	else{
		$('#coincost').css("color","black");
		$('#coincost').css("font-weight","normal");
		canpurchase=true;
		return true;
	}
} 

		var frm = $('#purchaser');
		frm.submit(function (ev) {
			if(canpurchase){
			$.ajax({
				type: frm.attr('method'),
				url: frm.attr('action'),
				data: frm.serialize(),
				success: function(data) {
					// Do something with data that came back. 
					console.log('not ded');
					location.href = "shop.php?cid="+<?=$whois?>;
				},
				complete: function(response) {
					console.log(response);
				},
				error: function(data) {
				   console.log('ded');  
			   }
			   
			});}
			else{
				alert("you don't have the funds");
			}
			ev.preventDefault();
			
})
	


</script>
<?php include_once "common/sidebar.php"; ?>
<?php include_once "common/footer.php"; ?> 