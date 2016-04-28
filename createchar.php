<?php include_once "common/header.php"; 
include('auth.php');
?>

<script src="js/makechar.js"></script>
<script>
var gender="female";
$(function(){
  $('input[type="radio"]').click(function(){
    if ($(this).is(':checked'))
    {
      gender=$(this).val();
	  if(gender=="female"){
		  document.getElementById("ladyhairs").style.display="initial";
		  document.getElementById("malehairs").style.display="none";
		  document.getElementById("ladybangs").style.display="initial";
		  document.getElementById("malebeards").style.display="none";
	  }
	  else{
		  document.getElementById("ladyhairs").style.display="none";
		  document.getElementById("malehairs").style.display="initial";
		  document.getElementById("ladybangs").style.display="none";
		  document.getElementById("malebeards").style.display="initial";
	  }
    }
  });
});</script>
<div id="createachar">
 Hello <?php echo $_SESSION['username']?>!<br/>
 Create your first character:

 <form id="charcreate" action="" method="POST">

 Pick a Name: <input type="text" name="name"  value="John Q Character" required><br/>
 Gender: <input type="radio" name="gender"
<?php if (isset($gender) && $gender=="female") echo "checked";?>
value="female">Female
<input type="radio" name="gender"
<?php if (isset($gender) && $gender=="male") echo "checked";?>
value="male">Male<br/>
 EyeColor: <select id="eyecolor"><option name="red">red</option>
 <option name="hazel">hazel</option>
 <option name="green">green</option>
 <option name="blue">blue</option>
 <option name="black">black</option>
 <option name="brown">brown</option>
 </select><br/>
 
 HairColor: <select id="haircolor"><option name="black">black</option>
 <option name="brown">brown</option>
 <option name="blonde">blonde</option>
 <option name="red">red</option>
 <option name="grey">grey</option>
 <option name="dirtyblonde">dirtyblonde</option>
 </select><br/>
 
 SkinTone: <select id="skintone"><option name="verydark">verydark</option>
 <option name="dark">dark</option>
 <option name="tan">tan</option>
 <option name="olive">olive</option>
 <option name="pale">pale</option>
 <option name="verypale">verypale</option>
 </select><br/>
 
 HairStyle: <select id="ladyhairs"><option name="bald">bald</option>
 <option name="bob">bob</option>
<option name="abbz">abbz</option> 
<option name="braid">braid</option>
<option name="bun">bun</option>
<option name="butchy">butchy</option>
<option name="greekish">greekish</option>
<option name="long">long</option>
<option name="ptail">ptail</option><br/>
</select><select id="malehairs" style="display:none"><option name="bald">bald</option>
 <option name="dreds">dreds</option>
 <option name="flat">flat</option>
 <option name="merlhair">merlhair</option>
 <option name="rassle">rassle</option>
 <option name="silan">silan</option>
 <option name="spikey">spikey</option>
 <option name="straight">straight</option>
 <option name="wavy">wavy</option>
 </select><br/>
 Decorative Hair Style:<select id="ladybangs"><option name="none">none</option> 
 <option name="flippy">flippy</option>
 <option name="fullongface">fullongface</option>
 <option name="paige">paige</option>
 </select>

<select id="malebeards" style="display:none"><option name="none">none</option>
<option name="abelincoln">abelincoln</option>
<option name="chinbeard">chinbeard</option>
<option name="chinjacket">chinjacket</option>
<option name="fumanchu">fumanchu</option>
<option name="gandalf">gandalf</option>
<option name="grecco">grecco</option>
<option name="leo">leo</option>
<option name="moostache">moostache</option>
</select>
 <br/>
 
  <input type="button" name="Next" onclick="$('#createachar2').show(); $('#charcreate').hide()" value="Next">
 </div>
 <div id="createachar2" style="display:none">
 Step 2:<br/>
 Choose 3 Skills:	
 "gathering","cooking","woodworking","blacksmithing","leatherworking","alchemy","architecture"<br/>
  <input type="button" name="back" onclick="$('#charcreate').show(); $('#createachar2').hide()" value="Go Back">  
  <input type="button" name="Next" onclick="$('#createachar3').show(); $('#createachar2').hide()" value="Next">
 </div>
 
 <div id="createachar3" style="display:none">
 Step 3:<br/>
 Choose a Hometown:
 "Grecca", "Valle", "Scilla", "Crescent", "Pandora"<br/>

 
  <input type="button" onclick="$('#createachar2').show(); $('#createachar3').hide()" name="back" value="Go Back">
  <input type="button" onclick="" name="submit" value="Create!">
  </div>
 </form>
 </div>
