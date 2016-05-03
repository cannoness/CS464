<?php include_once "common/header.php"; ?>

<div id="main">

   <noscript>This site just doesn't work, period, without JavaScript</noscript>

<?php include("auth.php"); //include auth.php file on all secure pages ?>

<div class="form">
<table border ="1" class ="index"><tr><td colspan="2" class="tablehead"><h2>
Welcome <?php echo $_SESSION['username']; ?>!</h2><br/><a href="friendlist.php" class="button">Your Friend List</a> </p></td></tr></tr></td><tr><td width="50%">
<?php
$user = $_SESSION['username'];
$sql = "select * from  `characters` where CharUserName='$user'";
 $result = mysqli_query($link,$sql);
 if (!$result)
	 throw new Exception(mysqli_error($link)."[ $result]");
 $rows = mysqli_num_rows($result); 
 $array = mysqli_fetch_array($result);

 if ($rows==1){
	 //display char
	 echo "<a href='yourchar.php?charnum=".$array['CharID']."'>".$array['CharName']."</a>";
	 echo "<br/>Coins: ".$array['Coins'].",".$array['Gender'];?>
	 <a href='javascript:void(0)' onclick='deletes(<?php echo $array['CharID']?>)'>Delete this char</a></td>
	 
	 <td width="50%"><?php
	 echo "<a href='createchar.php?charnum=0'>Start creating a character!</a></tr></td>"; 
 }
 else if ($rows==2){
	 //display chars
	 //yourchar is I ju's link
	 echo "<a href='yourchar.php?charnum=".$array['CharID']."'>".$array['CharName']."</a>";
	 echo "<br/>Coins: ".$array['Coins'].",".$array['Gender']."<br/>";
	 echo "<a href='javascript:void(0)' onclick='deletes(".$array['CharID'].")'>Delete this char</a>";?>
	 </td>
	 <td width="50%"><?php 
	$array = mysqli_fetch_array($result);
	 	 echo "<a href='yourchar.php?charnum=".$array['CharID']."'>".$array['CharName']."</a>";
	 echo "<br/>Coins: ".$array['Coins'].",".$array['Gender']."<br/>";
	 echo "<a href='javascript:void(0)' onclick='deletes(".$array['CharID'].")'>Delete this char</a>";
 }
 else{
	 echo "<a href='createchar.php?charnum=0'>Start creating a character!</a></td><td><a href='createchar.php?charnum=0'>Start creating a character!</a>";
 }
//first check the account to see which characters they have. We have two slots, if there are two results, display both slots, if we have one result, display one. If none, ask to create
?></td></tr>
</table>
</div>

<script>
function deletes(num){
	$.ajax({
		   url: 'delchar.php?charnum='+num,
		   type: 'post',
		   data: num,
		   success: function(data) {
				// Do something with data that came back. 
				console.log('not ded');
				location.reload();
		   },complete: function(response) {
    
	console.log(response);
},
		   error: function(data) {
			   console.log('ded');
		   }
		});
}</script>
<?php include_once "common/sidebar.php"; ?>

<?php include_once "common/footer.php"; ?> 