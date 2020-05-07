<?php
	include_once ('database_connection.php');

$query3="select * from defaults";
	$result3 = mysqli_query($dbc,$query3);
		    	while ($row3 = mysqli_fetch_array($result3,MYSQLI_ASSOC)){
		    		$defaultname=$row3['name'];
$default["$defaultname"] = $row3['value'];
}


if(isset($_POST['activefield'])){
	$activefield=$_POST['activefield'];
	$activefield = explode(":", $activefield);
	$numberoffields = $activefield[0];
	$activefields = explode("_", $activefield['1']);
if (isset($_POST['contactname'])){
$contactname = 	trim($_POST['contactname']) ;
$contactname = mysqli_real_escape_string($dbc, $contactname);
$contactname = htmlentities($contactname);
$contact = 	trim($_POST['contact']) ;
$contact = mysqli_real_escape_string($dbc, $contact);
$contact = htmlentities($contact);
$region = 	trim($_POST['region']) ;
$region = mysqli_real_escape_string($dbc, $region);
$region = htmlentities($region);
if(!mysqli_query($dbc,"INSERT INTO contacts  (name, contact, com) VALUES('$contactname', '$contact', '$region')")){
	echo "<div id='error' align='center'>Une erreur s&#39;est produite <br></div>", mysqli_error($dbc);
die;
}
$contactid=mysqli_insert_id($dbc);
}else{
$contactid = trim($_POST['client']) ;
$query3="select name from contacts WHERE id='$contactid'";
				$result3 = mysqli_query($dbc,$query3);
		    	$row3 = mysqli_fetch_array($result3,MYSQLI_ASSOC);
$contactname = $row3['name'];
}
$time = 	trim($_POST['time']) ;
$time=strtotime($time);
$argon = trim($_POST['argon']) ;
$poncage = trim($_POST['poncage']);
$cuisson = trim($_POST['cuisson']);
$urgent = trim($_POST['urgent']);
$versement = trim($_POST['versement']) ;
$k7=2;
if (isset($_POST['k7']))$k7=2.5;

if (!mysqli_query($dbc,"INSERT INTO orders  (id_contact, client, time, status, last_modified, argon, poncage, cuisson,urgent, k7, versements) VALUES('$contactid','$contactname', '$time',1,'$time', '$argon', '$poncage', '$cuisson','$urgent', '$k7', '$versement')")){
	echo "<div id='error' align='center'>Une erreur s&#39;est produite <br></div>", mysqli_error($dbc);
die;
}
$orderid=mysqli_insert_id($dbc);
mysqli_query($dbc,"INSERT INTO ordercomment  (orderid, payee, finalisee, livree) VALUES('$orderid' ,0 ,0 ,0)");

	for($i=0; $i<$numberoffields;$i++){

		$n=$activefields[$i];
$dimension1 = 	trim($_POST["dimension1$n"]) ;
$dimension1 = mysqli_real_escape_string($dbc, $dimension1);
$dimension1 = htmlentities($dimension1);	

$dimension2 = 	trim($_POST["dimension2$n"]) ;
$dimension2 = mysqli_real_escape_string($dbc, $dimension2);
$dimension2 = htmlentities($dimension2);

$vitre1 = 	trim($_POST["vitre1"]) ;
$vitre1 = mysqli_real_escape_string($dbc, $vitre1);
$vitre1 = explode("_", $vitre1);
$vitre1 = htmlentities($vitre1[0]);


$vitre2 = 	trim($_POST["vitre2"]) ;
$vitre2 = mysqli_real_escape_string($dbc, $vitre2);
$vitre2 = explode("_", $vitre2);
$vitre2 = htmlentities($vitre2[0]);

$baguette = 	trim($_POST["baguette"]) ;
$baguette = mysqli_real_escape_string($dbc, $baguette);
$baguette = explode("_", $baguette);
$baguette = htmlentities($baguette[0]);

$number = 	trim($_POST["number$n"]) ;
$number = mysqli_real_escape_string($dbc, $number);
$number = htmlentities($number);

$sens = 	trim($_POST["sens"]) ;
$sens = mysqli_real_escape_string($dbc, $sens);
$sens = htmlentities($sens);

$price = trim($_POST["uprice$n"]);
$price = mysqli_real_escape_string($dbc, $price);
$price = htmlentities($price);

if(mysqli_query($dbc,"INSERT INTO articles  (order_id, dimension1, dimension2, q, vitre1, vitre2, baguette, sens, price) VALUES('$orderid', '$dimension1', '$dimension2', '$number', '$vitre1', '$vitre2', '$baguette', '$sens', '$price')")){
$done=1;
}}
if(isset($done)){

 
echo '<SCRIPT LANGUAGE="JavaScript">
document.location.href="orderinfos.php?id='.$orderid.'";
</SCRIPT>';
}else{
	echo "<div id='error' align='center'>Une erreur s&#39;est produite </div>"; 
}

}else{














	//php

	?><html><head>
<link href="css/style3.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript">


function doc_keyUp(e) {
var activform=document.activeElement.id

if( activform.indexOf('dimension1') >= 0 || activform.indexOf('dimension2') >= 0 || activform.indexOf('number') >= 0 ){

	var activefields = document.getElementById('activefield').value ;
 	var array = activefields.split(":");
 	var array2 = array[1].split("_");
 	var i=array2.length;
 	i--;
 	lastfield=array2[i];
 	if( activform.indexOf('dimension1') >= 0 ){
 	var linenumber = activform.replace(/dimension1/g,'');
 }if(activform.indexOf('dimension2') >= 0 ){
 	var linenumber = activform.replace(/dimension2/g,'');
 }
 if(activform.indexOf('number') >= 0 ){
 	var linenumber = activform.replace(/number/g,'');
 }

    if (e.keyCode == 13 && document.getElementById("dimension1"+lastfield).value != "" && document.getElementById("dimension2"+lastfield).value != "" && document.getElementById("number"+lastfield).value != "" || activform.indexOf('dimension1') >= 0 && e.keyCode == 13) {
    	var next=parseInt(document.getElementById('nextfield').value);
        plus(next);
    }
    else if (e.keyCode == 13 && document.getElementById("dimension1"+lastfield).value != "" && document.getElementById("dimension2"+lastfield).value == "" && activform.indexOf('dimension2') >= 0 && activform.indexOf("dimension2"+lastfield)) {
    	var next = +linenumber+1;
    	document.getElementById('dimension2'+next).focus();
		document.getElementById('dimension2'+next).select();
    } else if (e.keyCode == 13 && document.getElementById("dimension1"+lastfield).value != "" && document.getElementById("number"+lastfield).value == "" && activform.indexOf('number') >= 0 && activform.indexOf("number"+lastfield)) {
    	var next = +linenumber+1;
    	document.getElementById('number'+next).focus();
		document.getElementById('number'+next).select();
    }else if(e.keyCode == 37 && activform.indexOf('number') >= 0 ){
    	document.getElementById('dimension2'+linenumber).focus();
		document.getElementById('dimension2'+linenumber).select();
    }else if(e.keyCode == 37 && activform.indexOf('dimension2') >= 0 ){
    	document.getElementById('dimension1'+linenumber).focus();
		document.getElementById('dimension1'+linenumber).select();
    }else if(e.keyCode == 39 && activform.indexOf('dimension1') >= 0 ){
    	document.getElementById('dimension2'+linenumber).focus();
		document.getElementById('dimension2'+linenumber).select();
    }else if(e.keyCode == 39 && activform.indexOf('dimension2') >= 0 ){
    	document.getElementById('number'+linenumber).focus();
		document.getElementById('number'+linenumber).select();
    }else if(e.keyCode == 38 && linenumber != "1" ){
    	if(linenumber < 10){var row = activform.slice(0, -1);}else{var row = activform.slice(0, -2);}
    	next= +linenumber-1;
    	document.getElementById(row+next).focus();
		document.getElementById(row+next).select();
    }else if(e.keyCode == 40 && linenumber != lastfield ){
    	if(linenumber < 10){var row = activform.slice(0, -1);}else{var row = activform.slice(0, -2);}
    	var next = +linenumber+1;
    	document.getElementById(row+next).focus();
		document.getElementById(row+next).select();
    }else if(e.keyCode == 40 && linenumber == lastfield && activform.indexOf('dimension1') >= 0){
    	document.getElementById("dimension21").focus();
		document.getElementById("dimension21").select();
    }else if(e.keyCode == 40 && linenumber == lastfield && activform.indexOf('dimension2') >= 0){
    	document.getElementById("number1").focus();
		document.getElementById("number1").select();
    }else if(e.keyCode == 40 && linenumber == lastfield && activform.indexOf('number') >= 0){
    	document.getElementById("dimension11").focus();
		document.getElementById("dimension11").select();
    }else if(e.keyCode == 38 && linenumber == 1 && activform.indexOf('dimension1') >= 0){
    	document.getElementById("number"+lastfield).focus();
		document.getElementById("number"+lastfield).select();
    }else if(e.keyCode == 38 && linenumber == 1 && activform.indexOf('dimension2') >= 0){
    	document.getElementById("dimension1"+lastfield).focus();
		document.getElementById("dimension1"+lastfield).select();
    }else if(e.keyCode == 38 && linenumber == 1 && activform.indexOf('number') >= 0){
    	document.getElementById("dimension2"+lastfield).focus();
		document.getElementById("dimension2"+lastfield).select();
    }


}
}
document.addEventListener('keyup', doc_keyUp, false);

function ifnewcontact() {
if(document.addorder.client.value == "neWcntct"){
     document.getElementById("newcontact").innerHTML='Nom et prenom: <input name="contactname" id="contactname"> Region: <input name="region" id="region"> Contact: <input name="contact" id="contact"> <label>neant<input id="nocontact" type="checkbox" style="width:60px;"></label>';
 }else{
 	document.getElementById("newcontact").innerHTML=' ';
 }}

 function removetr(a){
 	if(a!=1){
 	document.getElementById("tr"+a).style.display = "none";
		document.getElementById("dimension1"+a).disabled = true;
		document.getElementById("dimension2"+a).disabled = true;
		document.getElementById("number"+a).disabled = true;
		document.getElementById("uprice"+a).disabled = true;
		document.getElementById("price"+a).disabled = true;
		var activefields = document.getElementById('activefield').value ;
 		var array = activefields.split(":");
 		var numberoffields = +array[0];
 		numberoffields-=1;
 		if(numberoffields>0){
 			 		var array2 = array[1].split("_");
		activefields=numberoffields+":";
		for (var i = 0; i <= numberoffields; i++) {
			if(array2[i]!=a){
				if(i != 0){
 			activefields=activefields+"_"+array2[i];
 		}else{
 			activefields=activefields+array2[i];}
 		}
 		};
 	}else{
 		activefields="0:";
 	}
 		document.getElementById("activefield").value=activefields;
/*if(document.getElementById('firstrow').value==a){
	document.getElementById('firstrow').value=0;
	document.getElementById('appliedvitre1').value=1;
	document.getElementById('appliedvitre2').value=1;
	document.getElementById('appliedbaguette').value=1;
}*/
}else{
	alert("Vous ne pouvez pas supprimer la 1 ere ligne!");
}
}
 function plus(a){
 	document.getElementById('tr'+a).style.display = "table-row";
 	var b=a+1;
 		document.getElementById('dimension1'+a).disabled = false;
 		document.getElementById('dimension2'+a).disabled = false;
 		document.getElementById('number'+a).disabled = false;
 		document.getElementById('uprice'+a).disabled = false;
 		document.getElementById('price'+a).disabled = true;
 		
 		var activefields = document.getElementById('activefield').value ;
 		var array = activefields.split(":");
 		var numberoffields = +array[0];
 		if(numberoffields!=0){
 		numberoffields+=1;
 		var array2 = array[1].split("_");
		activefields=numberoffields+":";
 		for (var i = 0; i < array2.length; i++) {
 			activefields=activefields+array2[i]+"_";
 		};
 		activefields=activefields+a;
 	}else{ activefields="1:"+a; }
		
	if(a<50){
		document.getElementById("pluslogo").innerHTML='<input type="hidden" id="nextfield" value="'+b+'"><a href="#" onclick="plus('+b+')"><img src="img/plus.png" width="30"></a><input type="hidden" id="activefield" name="activefield" value="'+activefields+'">';
}else{
	document.getElementById("pluslogo").innerHTML='<input type="hidden" id="activefield" name="activefield" value="'+activefields+'">';
}



calculate();
document.getElementById('dimension1'+a).focus();
document.getElementById('dimension1'+a).select();
}



function onlynumbers(evt) {
  var theEvent = evt || window.event;
  var key = theEvent.keyCode || theEvent.which;
  if ((key < 48 || key > 57) && !(key == 8 || key == 9 || key == 13 || key == 37 || key == 46) ){
    theEvent.returnValue = false;
    if (theEvent.preventDefault) theEvent.preventDefault();
  }}
  function calculate(b){
  	var activefields = document.getElementById('activefield').value ;
 		var array = activefields.split(":");
 		var numberoffields = +array[0];
 		var array2 = array[1].split("_");
 		var total = 0;
 		for (var i = 0; i < numberoffields; i++){
if(document.getElementById('dimension1'+array2[i]).value != ""){
dimension1=document.getElementById('dimension1'+array2[i]).value;
}else {
dimension1=0;
}
if(document.getElementById('dimension2'+array2[i]).value != ""){
dimension1=document.getElementById('dimension2'+array2[i]).value;
}else {
dimension2=0;
}
vitre1price=document.getElementById('vitre1').value;
vitre1price=vitre1price.split("_");
vitre1id= +vitre1price[0];
vitre1price= +vitre1price[1];
vitre2price=document.getElementById('vitre2').value;
vitre2price=vitre2price.split("_");
vitre2id= +vitre2price[0];
vitre2price= +vitre2price[1];
baguetteprice=document.getElementById('baguette').value;
baguetteprice=baguetteprice.split("_");
baguetteprice= +baguetteprice[1];
dimension1=document.getElementById('dimension1'+array2[i]).value;
dimension1/=100;
number=document.getElementById('number'+array2[i]).value;
dimension2=document.getElementById('dimension2'+array2[i]).value;
dimension2/=100;
if(b!=1){
var upricecalc=baguetteprice+vitre2price+vitre1price+<?php echo $default['ajustement']; ?>;
if (document.getElementById('argon').value=="Oui"){
	upricecalc+=<?php echo $default['argon']; ?>;
}
if (document.getElementById('cuisson').value=="Tout"){
	upricecalc+=(<?php echo $default['cuisson']; ?>)*2;
	document.getElementById('poncage').value="Tout";
}else{
	if (document.getElementById('cuisson').value!="Non"){
	upricecalc+=<?php echo $default['cuisson']; ?>;
	if(document.getElementById('poncage').value!="Tout"){
	document.getElementById('poncage').value=document.getElementById('cuisson').value;}
}
}
if (document.getElementById('poncage').value=="Tout"){
	upricecalc+=(<?php echo $default['poncage']; ?>)*2;
}else{
	if (document.getElementById('poncage').value!="Non"){
	upricecalc+=<?php echo $default['poncage']; ?>;
}
}
upricecalc=Math.round(upricecalc* 100) / 100;
if(vitre2id == vitre1id && vitre2id == "1"){
	upricecalc+=100;
}
document.getElementById('uprice'+array2[i]).value=upricecalc;
}else{
	var upricecalc=document.getElementById('uprice'+array2[i]).value;
}
var price=dimension1*dimension2*number*upricecalc;
price=Math.round(price* 100) / 100;
document.getElementById('price'+array2[i]).value=price;
total+=price;
};

document.getElementById('total').value=Math.round(total*100)/100;
  }
   

<?php
echo'function isInArray(array, search){
    return array.indexOf(search) >= 0;
}
var contacts=[];';

		$query5="select * from contacts order by name";
		$result5 = mysqli_query($dbc,$query5);
		if($result5){
		    if(mysqli_affected_rows($dbc)!=0){
		    	
		    	$i=0;
		    	while($row5 = mysqli_fetch_array($result5,MYSQLI_ASSOC)){
		    	echo 'contacts['.$i.']="'. stripslashes($row5['name']) .'";';
$i++;
		    }
		    
		}}

?>


  var error=0;
function validate() {
  if(document.addorder.client.value != "0" ) {
 validate1();
  }
  else {
    alert("Vous devez selectioner un client");
  }}



















  function validate1() {
  if(document.addorder.client.value == "neWcntct" && document.addorder.contactname.value == "") {
    alert("Vous devez introduir un nom de client"); 
  }
  else {
validate2();
  }}

function validate2() {
  if(document.addorder.client.value == "neWcntct" && document.addorder.contact.value == "" && document.getElementById("nocontact").checked==false) {
    alert("Le champ contact est vide"); 
  }
  else {
validate3();
  }}

  function validate3() {
  	if(document.addorder.client.value == "neWcntct" && document.addorder.contactname.value != "") {
var s=htmlEntities(document.addorder.contactname.value);
  if(isInArray(contacts, s)){
  alert("Un contact portant le meme nom existe deja");
}else{
  validate4();}
}else{
	validate4();
}}



 
function validate4(){
	var activefields = document.getElementById('activefield').value ;
 		var array = activefields.split(":");
 		var numberoffields = +array[0];
 		var array2 = array[1].split("_");
for (var i = 0; i < numberoffields; i++) {
 			if(document.getElementById('dimension1'+array2[i]).value=="" || document.getElementById('dimension2'+array2[i]).value==""){
alert("Vous devez introduir une dimension pour le l'article N "+array2[i]);
error=1;
 			}else{
 				error=0;
 			}
 				if(document.getElementById('number'+array2[i]).value=="" || document.getElementById('number'+array2[i]).value=="0"){
alert("Le number d'articles ne peux pas etre nul pour le l'article N "+array2[i]);
error=1;
 			}else if(error != 1){error=0;}
 		};
 		if(error=="0"){
 			document.addorder.submit();
			document.getElementById('savebuttonlogo').setAttribute( "onClick", "alert('No More Clicks Please!')" );
 		}

}

function htmlEntities(str) {
    
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/é/g, '&eacute;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}
 function clickAndDisable(link) {
     // disable subsequent clicks
     link.onclick = function(event) {
        event.preventDefault();
     }
   }   

   function applyprice(){
   	for (var i = 2; i <= 50; i++) {
   		if(!document.getElementsByName('uprice'+i).length<=0){
   		document.getElementById('uprice'+i).value=document.getElementById('uprice1').value;
   	}};
   calculate(1);
}
</script>
</head><body>

<form autocomplete='off' method="POST" name="addorder" id="addorder">
	<table width="100%" id="topordertable" style="font-size:20px;"><tr><td>Client:
		<select name="client" id="client" onchange="ifnewcontact()">
		<option value='0'>- - - - - - - - - - - -</option>
		<option value='neWcntct' >Nouveau Client</option>
				<?php 

$query3="select * from contacts  order by name";
				$result3 = mysqli_query($dbc,$query3);
		if($result3){
		    if(mysqli_affected_rows($dbc)!=0){
		    	while($row3 = mysqli_fetch_array($result3,MYSQLI_ASSOC)){
		    		if(isset($_GET['contactid']) AND $row3['id']==$_GET['contactid']){
						echo "<option value='". $row3['id'] ."'' selected>". $row3['name'] ."</option>	";
		    	}else{
		    		echo "<option value='". $row3['id'] ."''>". $row3['name'] ."</option>	";
		    	}
}}} ?>
		</select> </td>
		<td ><b><u>Argon:</u></b> <select id="argon" name="argon" onchange="calculate()"><option value="Non">Non</option><option value="Oui">Oui</option></select></td>
		<td ><b><u>Pon&ccedil;age:</u></b> <select id="poncage" name="poncage" onchange="calculate()"><option value="Non">Non</option><option value="Vitre 1">Vitre 1</option><option value="Vitre 2">Vitre 2</option><option value="Tout">Tout</option></select></td>
		<td ><b><u>Trempe:</u></b> <select id="cuisson" name="cuisson" onchange="calculate()"><option value="Non">Non</option><option value="Vitre 1">Vitre 1</option><option value="Vitre 2">Vitre 2</option><option value="Tout">Tout</option></select></td>
		

		<td> <b><u>URGENT: <select id="urgent" name="urgent" ><option value=""></option><option value="URGENT">Oui</option></select> </u></b></td>
		<td style="vertical-align:middle;"><b>Cassette</b><input id="k7" name="k7" type="checkbox" value="2.5" style="width:50px;height:20px;"></td><td align="right">
		 Le: <input value="<?php echo date("d-m-Y H:i",time()); ?>" name="time"></td></tr>
	</table>
	<div id="newcontact" style="font-size:20px;"></div>
	<table width="100%" id="addordertable" style="font-size:20px;"><tr>
		<td>Dimension 1 [cm]</td><td>Dimension 2 [cm]</td><td>Nombre</td><td>Vitre 1</td><td>Baguette</td><td>Vitre 2</td><td>Sens</td>
		<td>Prix U</td><td></td><td>Montant</td><td></td></tr>
		<tr id="tr1"><td><input name="dimension11" id="dimension11" onkeyup="calculate()" onkeypress="onlynumbers(event)"></td><td><input onkeyup="calculate()" name="dimension21" id="dimension21" onkeypress="onlynumbers(event)"></td>
			<td><input name="number1" id="number1" value="" style="width:60px"onkeyup="calculate()" onkeypress="onlynumbers(event)"></td>
	
		<td><select name="vitre1" id="vitre1" onchange="calculate()">
			<?php 
$query1="select * from products WHERE type=1 ORDER by listing";
		$result1 = mysqli_query($dbc,$query1);
		if($result1){
		    if(mysqli_affected_rows($dbc)!=0){
		    	while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)){
		    		echo "<option value='". $row1['id'] ."_". $row1['price'] ."'>". $row1['reference'] ."</option>	";
		    		$priceuu=$row1['price'];
}}} ?>
			</select></td> 
		<td><select name="baguette" id="baguette" onchange="calculate()">
<?php 
$query2="select * from products WHERE type=2 ORDER by listing";
		$result2 = mysqli_query($dbc,$query2);
		if($result2){
		    if(mysqli_affected_rows($dbc)!=0){
		    	while($row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC)){
		    		echo "<option value='". $row2['id'] ."_". $row2['price'] ."'>". $row2['reference'] ."</option>	";
		    		$priceuu+=$row2['price'];
}}} ?>
		</select></td>
		<td><select name="vitre2" id="vitre2" onchange="calculate()">
		<?php 
		$result1 = mysqli_query($dbc,$query1);
		if($result1){
		    if(mysqli_affected_rows($dbc)!=0){
		    	while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)){
		    		echo "<option value='". $row1['id'] ."_". $row1['price'] ."'>". $row1['reference'] ."</option>	";
		    		$priceuu+=$row1['price'];
}}} ?>
</select></td>
		<td><select name="sens" id="sens"  onchange="calculate()"><option value=""></option><option value="INT">INT</option></select>
		</td><td><input name="uprice1" id="uprice1" value="0" onkeyup="calculate(1)"  onkeypress="onlynumbers(event)"></td>
		<td><button onclick='applyprice()' type='button'>Tous</button></td><td><input name="price1" id="price1" value="0" disabled></td><td><a href="#" onclick="removetr(1)"><img src="img/remove.png" width="25"></a></td></tr>
		<?php 

for($i=2;$i<51;$i++){
	echo '<tr id="tr'. $i .'" style="display:none"><td><input name="dimension1'. $i .'" id="dimension1'. $i .'" onkeyup="calculate()"  onkeypress="onlynumbers(event)" disabled></td><td><input name="dimension2'. $i .'" id="dimension2'. $i .'" onkeyup="calculate()"  onkeypress="onlynumbers(event)" disabled></td>
	<td><input name="number'. $i .'" id="number'. $i .'" value="" onkeyup="calculate()" style="width:60px" onkeypress="onlynumbers(event)" disabled></td>
<td></td><td></td><td></td><td></td>
		<td><input name="uprice'. $i .'" id="uprice'. $i .'" value="0" onkeyup="calculate(1)"  onkeypress="onlynumbers(event)" disabled></td>
		<td></td><td><input name="price'. $i .'" id="price'. $i .'" value="0" disabled></td>
		<td><a href="#" onclick="removetr('. $i .')"><img src="img/remove.png" width="25"></a></td></tr>';
}
		?>
</table>
		<div id="pluslogo"><input type="hidden" id="nextfield" value="2"><a href="#" onclick="plus(2)"><img src="img/plus.png" width="30"></a><input type="hidden"  name="activefield" id="activefield" value="1:1"></div>
		<table align="right" style="font-size:20px;"><tr><td>Total:</td><td><input name="total" id="total" value="<?php echo $priceuu; ?>" disabled></td></tr>
			<tr>

				

			</tr>
			<tr><td>Versement: </td><td><input name="versement" id="versement" value="0" onkeypress="onlynumbers(event)" ></td></tr>
		</table>

		<br><br><br><br><br><div align="center"><a href="#" id="savebuttonlogo" onclick="validate()"><img type="submit" src="img/save.png" width="50"></a></div>
		<!-- <tr><td>eee</td><td>eee</td><td>eee</td><td>eee</td><td>eee</td><td>eee</td><td>eee</td></tr>-->
		
</form>
</body></html>
<?php
}
?>