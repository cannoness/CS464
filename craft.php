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
$sql3="SELECT
  OutputName,IngNeeded
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
		$recipeallowed[]=$rescc;
	}
	}else{throw new Exception(mysqli_error($link)."[ $resc]");}
	$moneysql = "Select Coins from characters where CharID='$whois'";
	$cquery=$link->query($moneysql);
	$coin =mysqli_fetch_assoc($cquery);
	$sqlt = "Select * from ingredient";
	$ingres = $link->query($sqlt);
	echo "
<div id='shop'><form id='crafter' name='crafter' method='post' class='crafter' action='docrafting.php?pid=".$whois."'> <table><tr><td cellspan='3'>
Crafting Table</td></tr><tr><td>Select one to craft</td><td>Available to craft</td><td>Ingredients required</td></tr>";
	foreach ($recipeallowed as $res){
	echo "<tr><td><input name='checkbox[]' onclick='return KeepCount();' type='checkbox' id=".$res['OutputName'].",".$res['IngNeeded']." value=".$res['OutputName'].",".$res['IngNeeded']."></td>
	<td>".$res['OutputName']."</td>
	<td>".$res['IngNeeded']." </td></tr>";
	}
	echo "<tr><td>
	</td><td cellspan=1></td><td cellspan=1></td></tr><tr><td>
<input id='submit' type='submit' class='button' value='Purchase' name='submit'>
</td><td id='coincost'></td><td id='leftmoney'></td></tr></table></form>";
	$moneysql = "Select Coins from characters where CharID='$whois'";
	$cquery=$link->query($moneysql);
	$coin =mysqli_fetch_assoc($cquery);
?>


<div id='buystuffsdiv' class='buystuffsdiv' >
<table class='buystuffs'><tr><td>
	You currently have these ingredients:<?php foreach($ingsonhand as $ing) echo "<br/>".$ing;?><br/></td></tr>
	<tr><td>With your skills you can build:<?php foreach($recipeallowed as $rec) echo "<br/>".$rec['OutputName'];?><br/></td></tr>
	<tr><td>You have <?php echo $coin['Coins'];?> coins to spend.</td></tr><tr><td> <a href='shop.php?cid=<?=$whois?>'>Buy more ingredients</a></td></tr></table>
</div>
<script type="text/javascript">
var canpurchase=true;
function validate() {
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

		var frm = $('#crafter');
		frm.submit(function (ev) {
			$.ajax({
				type: frm.attr('method'),
				url: frm.attr('action'),
				data: frm.serialize(),
				success: function(data) {
					// Do something with data that came back. 
					console.log('not ded');
					location.href = "craft.php?cid="+<?=$whois?>;
				},
				complete: function(response) {
					console.log(response);
				},
				error: function(data) {
				   console.log('ded');  
			   }
			   
			});
			ev.preventDefault();
			
})
	function KeepCount() {
var NewCount= $(":checkbox:checked").length;
if (NewCount == 2)
{
alert('Pick only one Please')
return false;
}
} 


</script>
<?php include_once "common/sidebar.php"; ?>
<?php include_once "common/footer.php"; ?> 