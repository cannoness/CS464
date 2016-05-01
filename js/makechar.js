
var gender="female";

function changehair(gender){
	var e = document.getElementById('ladyhairs');
	var hairstyle= e.options[e.selectedIndex].value;
	if (gender=="female"){
	if (hairstyle=="greekish"){
		$('#hairc').attr("src","img/greekish.png");
	}else if (hairstyle=="bald"){
		$('#hairc').attr("src","");
	}else if (hairstyle=="abbz"){
		$('#hairc').attr("src","img/abbz.png");
	}else if (hairstyle=="long"){
		$('#hairc').attr("src","img/long.png");
	}else if (hairstyle=="bob"){
		$('#hairc').attr("src","img/bob.png");
	}else if (hairstyle=="braid"){
		$('#hairc').attr("src","img/braid.png");
	}else if (hairstyle=="bun"){
		$('#hairc').attr("src","img/bun.png");
	}else if (hairstyle=="ptail"){
		$('#hairc').attr("src","img/ptail.png");
	}else if (hairstyle=="butchy"){
		$('#hairc').attr("src","img/butchy.png");
	}
	}
	
	if(gender=='male'){
	var f = document.getElementById('malehairs');
	var hairstyle= f.options[f.selectedIndex].value;
	if (hairstyle=="dreds"){
		$('#mhairc').attr("src","img/dreds.png");
	}else if (hairstyle=="bald"){
		$('#mhairc').attr("src","");
	}else if (hairstyle=="rassle"){
		$('#mhairc').attr("src","img/rassle.png");
	}else if (hairstyle=="silan"){
		$('#mhairc').attr("src","img/silan.png");
	}else if (hairstyle=="straight"){
		$('#mhairc').attr("src","img/straight.png");
	}else if (hairstyle=="wavy"){
		$('#mhairc').attr("src","img/wavy.png");
	}else if (hairstyle=="spikey"){
		$('#mhairc').attr("src","img/spikey.png");
	}else if (hairstyle=="merlhair"){
		$('#mhairc').attr("src","img/merlhair.png");
	}else if (hairstyle=="flat"){
		$('#mhairc').attr("src","img/flat.png");
	}
	}
}
function changebangs(){
	var e = document.getElementById('ladybangs');
	var hairstyle= e.options[e.selectedIndex].value;
	if (hairstyle=="none"){
		$('#bangc').attr("src","");
	}
	if (hairstyle=="flippy"){
		$('#bangc').attr("src","img/flippy.png");
	}if (hairstyle=="fullongface"){
		$('#bangc').attr("src","img/fullongface.png");
	}if (hairstyle=="paige"){
		$('#bangc').attr("src","img/paige.png");
	}
}function changebeard(){
	var e = document.getElementById('malebeards');
	var hairstyle= e.options[e.selectedIndex].value;
	if (hairstyle=="none"){
		$('#beardct').attr("src","");
		$('#beardcb').attr("src","");
	}
	if (hairstyle=="abelincoln"){
		$('#beardct').attr("src","img/abelincolntop.png");
		$('#beardcb').attr("src","img/abelincolnbottom.png");
	}if (hairstyle=="chinbeard"){
		$('#beardct').attr("src","img/chinbeard.png");
		$('#beardcb').attr("src","");
	}if (hairstyle=="chinjacket"){
		$('#beardct').attr("src","img/chinjacket.png");
		$('#beardcb').attr("src","");
	}if (hairstyle=="moostache"){
		$('#beardct').attr("src","img/moostache.png");
		$('#beardcb').attr("src","");
	}if (hairstyle=="grecco"){
		$('#beardct').attr("src","img/grecco.png");
		$('#beardcb').attr("src","");
	}if (hairstyle=="fumanchu"){
		$('#beardct').attr("src","img/fumanchu.png");
		$('#beardcb').attr("src","");
	}if (hairstyle=="leo"){
		$('#beardct').attr("src","img/leotop.png");
		$('#beardcb').attr("src","img/leobottom.png");
	}if (hairstyle=="gandalf"){
		$('#beardct').attr("src","img/gandalftop.png");
		$('#beardcb').attr("src","img/gandalfbottom.png");
	}
}

function colorchanger(where){
	var e = document.getElementById("haircolor");
	var f = document.getElementById("eyecolor");
	var g = document.getElementById("skintone");
	var haircolor = e.options[e.selectedIndex].value;
	var eyecolor = f.options[f.selectedIndex].value;
	var skintone = g.options[g.selectedIndex].value;
	if (where == "haircolor"){
	if(haircolor=="black"){
		$("#hairc").blendmode({
		//add something here to reload the image that's up
		//first get the current selected image from the img picker, maybe add a fucntion?
		//then reload that image, then apply the color
			"mode" : "multiply",
			"object" : "#333"
	});}
	 if(haircolor=="brown"){
		//add something here to reload the image that's up
		$("#hairc").blendmode({
			"mode" : "multiply",
			"object" : "#b35900"
	});}
	 if(haircolor=="blonde"){
		//add something here to reload the image that's up
		$("#hairc").blendmode({
			"mode" : "multiply",
			"object" : "#ffff80"
	});}
	 if(haircolor=="red"){
		//add something here to reload the image that's up
		$("#hairc").blendmode({
			"mode" : "multiply",
			"object" : "#ff6600"
	});}
	 if(haircolor=="grey"){
		//add something here to reload the image that's up
		$("#hairc").blendmode({
			"mode" : "multiply",
			"object" : "#fff"
	});}
	 if(haircolor=="dityblonde"){
		//add something here to reload the image that's up
		$("#hairc").blendmode({
			"mode" : "multiply",
			"object" : "#e6b800"
	});}
	}
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