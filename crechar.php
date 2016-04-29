<?php include_once "common/header.php"; ?>
<?php include("auth.php"); //include auth.php file on all secure pages ?>

<?php
$username= $_SESSION['username'];
$name = $_POST['name'];
$gender = $_POST['gender'];
$eyecolor = $_POST['eyecolor'];
$haircolor = $_POST['haircolor'];
$skintone = $_POST['skintone'];
$hairstyle = $_POST['hairstyle'];
$decohair = $_POST['dechair'];

$skills =$_POST['checkbox'];

$hometown = $_POST['city'];

$sql="INSERT into `characters` (CharUserName,CharName,Gender,EyeColor,HairColor,SkinTone,HairStyle,BeardOrBangsType) Values ('$username','$name','$gender','$eyecolor'
, '$haircolor','$skintone','$hairstyle','$decohair')";
$link->begin_transaction();
$result = mysqli_query($link,$sql);
if($result){
$newcharid= mysqli_insert_id($link);
$sql2 = "INSERT into `structures` (CharIDOwns, StrucType, NumOfFloors, CityName) Values('$newcharid','EmptyPlot','0','$hometown')";
$result2 = mysqli_query($link,$sql2);
if($result2){
$sql3 = "INSERT into `stats` (CharIDStats,Skill1,Skill2,Skill3,AttackPower,Health,Armor) values ('$newcharid','$skills[0]','$skills[1]','$skills[2]','30','100','0')";
$result3 = mysqli_query($link,$sql3);
if($result3){
$link->commit();}

 else{
	throw new Exception(mysqli_error($link)."[ $result]");
 }
}
 else{
	throw new Exception(mysqli_error($link)."[ $result]");
 }
 }
 else{
	 
 
		throw new Exception(mysqli_error($link)."[ $result]");
 }

$link->rollback();
?>