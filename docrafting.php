<?php include_once "common/header.php"; ?>
<?php include('auth.php');?>

<?php 
$username= $_SESSION['username'];
$crafted =$_POST['checkbox'];
$pid = $_GET['pid'];
$sum = 0;
//doublecheck money again

$link->begin_transaction();
foreach($crafted as $box){
		$boxes=explode(',',$box);
$sql="Delete from charholdsingredient where IngNameID='$boxes[1]' and CharIDHolds='$pid'";
$result = mysqli_query($link,$sql);
if ($result){
	foreach($crafted as $box){
		$boxes=explode(',',$box);
		$sql2="INSERT into `equipment` (CharIDWearing,EquipName,EquippedInSlot) Values ('$pid','$boxes[0]','inventory')";
		$result2= $link->query($sql2);
		if ($result2)
			continue;
		else 
			throw new Exception(mysqli_error($link)."[ $result]");
	}	
	$link->commit();
}
else
	throw new Exception(mysqli_error($link)."[ $result]");
$return = 1;
}
?>