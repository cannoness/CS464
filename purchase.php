<?php include_once "common/header.php"; ?>
<?php include('auth.php');?>

<?php 
$username= $_SESSION['username'];
$purchase =$_POST['checkbox'];
$pid = $_GET['pid'];
$cid = $_GET['cid'];
$sum = 0;
//doublecheck money again

foreach ($purchase as $box){
	$boxes =explode(',',$box);
	$sum += $boxes[1];
}
if($sum <= $cid){
	$left = $cid-$sum;
$link->begin_transaction();
$sql="Update `characters` set Coins='$left' where CharID='$pid'";
$result = mysqli_query($link,$sql);
if ($result){
	foreach($purchase as $box){
		$boxes=explode(',',$box);
		$sql2="INSERT into `charholdsingredient` (CharIDHolds,IngNameID) Values ('$pid','$boxes[0]')";
		$result2= $link->query($sql2);
		if ($result2)
			continue;
		else 
			throw new Exception(mysqli_error($link)."[ $result]");
	}	
	$link->rollback();
}
else
	throw new Exception(mysqli_error($link)."[ $result]");
$return =1;
}
else if ($sum >= $cid)
	$return = -1;
	
?>