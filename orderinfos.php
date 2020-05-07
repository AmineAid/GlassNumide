<?php
session_start();
include_once ('database_connection.php');
if(isset($_GET['id']) AND $_GET['id']>0) {
	$orderid=$_GET['id'];
	$query1="select * from orders WHERE id='$orderid'";
	$result1 = mysqli_query($dbc,$query1);
	if($result1){
		if(mysqli_affected_rows($dbc)!=0){
			$row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);
		    		$id_contact=$row1['id_contact'];
		    		$time=$row1['time'];
		    		$status=$row1['status'];
		    		$last_modified=$row1['last_modified'];
		    		$argon=$row1['argon'];
		    		$poncage=$row1['poncage'];
		    		$cuisson=$row1['cuisson'];
		    		$urgent=$row1['urgent'];
		    		$k7=$row1['k7'];
		    		$versement=$row1['versements'];
		    		$query2="select * from contacts WHERE id='$id_contact'";
					$result2 = mysqli_query($dbc,$query2);
					if($result2){
		    		if(mysqli_affected_rows($dbc)!=0){
		    			$row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
		    			$contactid=$row2['id'];
		    			$contactname=$row2['name'];
		    			$contact=$row2['contact'];
		    			$contactcom=$row2['com'];
		    		}else{
		    			$contactname="Profil supprim&eacute;";
		    			$contact='';
		    		}}else{
		    			$contactname="Profil supprim&eacute;";
		    			$contact='';
		    		} }else{ die("Numero de commande erron&eacute;");}
		    		if($status == 0){
		    			echo "<div style='position:fixed;float:center; font-size:60px; 	margin-top:250px;margin-left:350px;color:red;'> <b>COMMANDE ANNULEE </b></div>";
		    		
		    		}
?>
<html><head>
<link href="css/style3.css" type="text/css" rel="stylesheet"/>

<script type="text/javascript">

function cancelorder(id,a){
	if(a!=2){
	var r=confirm("Voulez vous annuler cette commande ?");
	if(r){
		window.location.href ='cancelorder.php?id='+id;
	}
}if(a==2){
	var r=confirm("Voulez vous valider cette commande ?");
	if(r){
		window.location.href ='cancelorder.php?todo=v&id='+id;
	}
}
}
function showhide() {
    var x = document.getElementById('complement');
    if (x.style.display === 'none') {
        x.style.display = 'inline';
        document.getElementById('arrow').src = 'img/up.png';
    } else {
        x.style.display = 'none';
         document.getElementById('arrow').src = 'img/down.png';
    }
}

function printdiv(a)
{
		var oldstr = document.body.innerHTML;
	document.getElementById("complement").style.display = 'inline';
var headstr = "<html><head><title></title><style type='text/css'>#articlestable td,#topinfos td{border:1px black solid;font-size: 15px;padding:0px 7px;} </style></head><body>";
var footstr = "</body>";
	if(a == 'f'  || a == 'b' ||  a == 'g' ||  a == 'g1'||  a == 'g2' ||  a == 'bg' ){
if(a=="f"){
	document.getElementById("toremove1").innerHTML='';
	document.getElementById("pagebreakfiche").style='';
 var newstr =document.all.item("fiche").innerHTML;
}
if(a=="b"){
	document.getElementById("toremove2").innerHTML='';
	document.getElementById("pagebreakbonprint").style='';
 var newstr =document.all.item("bonprint").innerHTML;
 	
}
if(a=="g"){
	//document.getElementById("toremove3").innerHTML='';
	document.getElementById('toremove3').innerHTML='<h4><u>FA&Ccedil;ONNAGE DE VITRES</u></h4>';
	document.getElementById("pagebreakglassprint").style='';
 var newstr =document.all.item("glassprint").innerHTML;
 	
}if(a=="g1"){
	document.getElementById('toremove31').innerHTML='<h4><u>FA&Ccedil;ONNAGE DE LA VITRE 1</u></h4>';
	document.getElementById("pagebreakglassprint1").innerHTML='';
 var newstr =document.all.item("glassprint1").innerHTML;
 	
}if(a=="g2"){
	document.getElementById('toremove32').innerHTML='<h4><u>FA&Ccedil;ONNAGE DE LA VITRE 2</u></h4>';

 	document.getElementById("pagebreakglassprint2").innerHTML='';
 var newstr =document.all.item("glassprint2").innerHTML;
}
if(a=="bg"){
	//document.getElementById("toremove4").innerHTML='';
	document.getElementById('toremove4').innerHTML='<h4><u>BAGUETTES</u></h4>';

 var newstr =document.all.item("baguetteprint").innerHTML;
}
	}else{

if(document.getElementById("toprintf").checked){
document.getElementById("toremove1").innerHTML='';
 var f =document.all.item("fiche").innerHTML;
}else{
	var f="";
}if(document.getElementById("toprintb").checked){
	document.getElementById("toremove2").innerHTML=' ';
var b = document.all.item("bonprint").innerHTML;
}else{
	var b="";
}
<?php
if($poncage=="Non" || $poncage=="Tout"){
	?>
if(document.getElementById('toprintg').checked){
		document.getElementById('toremove3').innerHTML='<h4><u>FA&Ccedil;ONNAGE DE VITRES</u></h4>';
 var g = document.all.item('glassprint').innerHTML;
}else{
	var g="";
}
<?php
}else{
	?>
	if(document.getElementById('toprintg1').checked){
		document.getElementById('toremove31').innerHTML='<h4><u>FA&Ccedil;ONNAGE DE LA VITRE 1</u></h4>';
 var g1 = document.all.item('glassprint1').innerHTML;
}else{
	var g1="";
}
	if(document.getElementById('toprintg2').checked){
		document.getElementById('toremove32').innerHTML='<h4><u>FA&Ccedil;ONNAGE DE LA VITRE 2</u></h4>';
 var g2 = document.all.item('glassprint2').innerHTML;
}else{
	var g2="";
}


	<?php
}
?>

if(document.getElementById('toprintbg').checked){
		document.getElementById('toremove4').innerHTML='<h4><u>BAGUETTES / CADRES</u></h4>';
 var bg = document.all.item('baguetteprint').innerHTML;
}else{
	var bg="";
}
<?php
if($poncage=="Non" || $poncage=="Tout"){

echo "var newstr=f+b+g+bg;";

}else{

echo "var newstr=f+b+g1+g2+bg;";
}
?>
}
document.body.innerHTML = headstr+newstr+footstr;
window.print();
document.body.innerHTML = oldstr;
return false;
}
function xls(a,l){

    var link = prompt("Destination", l);
    if (link != null) {
        document.location.href="excel.php?id="+a+"&link="+link;
    }

}
</script>
</head><body><div align="center" id="toprint">
<div id="fiche">

	<div align="center">
		<div id='toremove1'><iframe style="width:100%; height:40px;border:0px;"src="ordercomment.php?id=<?php echo $orderid; ?>"></iframe><h3><u>FICHE COMPTABLE</u>
		<input style="margin-left:50px;zoom: 1.5;" type="checkbox" id="toprintf" value="1"  checked><a href="#" onclick="printdiv('f')"><img src='img/print.png' width='30' ></a></h3>
		</div>

	
	<table id="topinfos" border="1"><tr><td colspan="2"><?php echo 'Tizi-Ouzou Le: '. date("d-m-Y H:i",$time).''; echo " </td><td align='center' style='vertical-align:top; '>"; 
	if($urgent=="URGENT"){echo " <b style='color:red;'> $urgent </b><br><br> "; }
	if($argon=="Oui"){echo " <b style='padding:10px;'> ARGON </b> "; }
	if($poncage!="Non"){echo " <b style='padding:10px;'> PONCAGE $poncage</b> "; }
	
		if($cuisson!="Non"){echo " <b style='padding:20px;'> TREMPE $cuisson</b> "; }
	
	 echo '</td><td>';
	echo "Bon numero: $orderid</td></tr><tr><td width='200' colspan='2'>Contact: $contact</td>
	<td width='200'>Region: $contactcom</td><td width='200'>Client: <a href='contactinfos.php?id=$contactid'>$contactname </a></td></tr></table>";

	?> 
		    		<table style="margin-top:10px;"id="articlestable" ><tr id="tablemenu" align='center'>
		    			<td>N </td><td>Dim. 1 [cm]</td><td>Dim. 2[cm]</td><td>Nombe</td><td>Vitre 1</td><td>Baguette</td><td>Vitre 2</td><td>Sens</td>
		<td>Prix U</td><td>Montant</td></tr>
		    		<?php
$query4="select * from products";
					$result4 = mysqli_query($dbc,$query4);
					if($result4){
		    		if(mysqli_affected_rows($dbc)!=0){
$j=0;
		    	while($row4 = mysqli_fetch_array($result4,MYSQLI_ASSOC)){
		    		$i=$row4['id'];
		    		$idaray[$i]=$j;
		    		$designationproduct[$j]=$row4['designation'];
		    		$referenceproduct[$j]=$row4['reference'];
		    		$j++;

		    	}}}
		    		$query5="select * from articles WHERE order_id='$orderid'";
					$result5 = mysqli_query($dbc,$query5);
					$totalorder=0;
					if($result5){
		    		if(mysqli_affected_rows($dbc)!=0){
$i=1;
	
		    	while($row5 = mysqli_fetch_array($result5,MYSQLI_ASSOC)){
		    		$idvitre1=$row5['vitre1'];
		    		$idvitre2=$row5['vitre2'];
		    		$idbaguette=$row5['baguette'];
		    		$idvitre1=$idaray[$idvitre1];
		    		$idvitre2=$idaray[$idvitre2];
		    		$idbaguette=$idaray[$idbaguette];

$price=round(($row5['q']*$row5['price']*$row5['dimension1']*$row5['dimension2']*0.0001)*100)*0.01;
echo "<tr><td align='center'>". $i ."</td><td align='center'>". $row5['dimension1'] ."</td><td align='center'>". $row5['dimension2'] ."</td>
<td align='center'>". floatval($row5['q']) ."</td><td align='center'>". $referenceproduct[$idvitre1] ."</td><td align='center'>". $referenceproduct[$idbaguette] ."</td>
<td align='center'>". $referenceproduct[$idvitre2] ."</td><td align='center'>". $row5['sens'] ."</td>
		<td align='center'>". number_format($row5['price'], 2, '.', ' ') ."</td><td align='center'>". number_format($price, 2, '.', ' ') ."</td></tr>";
		$totalorder+=$price;
		$i++;



}}}
echo "<tr><td style='border:0px;'></td><td style='border:0px;'></td><td style='border:0px;'></td><td style='border:0px;'></td>
<td style='border:0px;'></td>
<td style='border:0px;'></td><td style='border:0px;'></td><td style='border:0px;'></td>

<td>Total</td><td>".number_format($totalorder, 2, '.', ' ')."</td></tr>";

//	$query6="select * from orders WHERE id_contact='$id_contact' AND status='1'";
	//	$result6 = mysqli_query($dbc,$query6);

	//	    	while($row6 = mysqli_fetch_array($result6,MYSQLI_ASSOC)){
	//	    		$orderids=$row6['id'];
$query7="select price, q from articles WHERE order_id='$orderid'";
		$result7 = mysqli_query($dbc,$query7);
		$totalq=0;
		    	while($row7 = mysqli_fetch_array($result7,MYSQLI_ASSOC)){
		    		$totalq+=$row7['q'];
		    		}
		//    	}
		    		
if($versement=="")$versement=0;
$sold=$totalorder-$versement;
echo "<tr><td style='border:0px;'></td><td colspan='2' style='border:0px;' align='right'><b>Nombre de Carreaux: </b></td><td style='border:0px;' align='center'><b>$totalq</b></td>
<td style='border:0px;'></td><td style='border:0px;'></td><td style='border:0px;'></td><td style='border:0px;'></td>
<td>Versement</td><td>".number_format($versement, 2, '.', ' ')."</td></tr>";
echo "<tr><td style='border:0px;'></td><td style='border:0px;'></td><td style='border:0px;'></td><td style='border:0px;'></td><td style='border:0px;'></td><td style='border:0px;'></td><td style='border:0px;'></td><td style='border:0px;'></td>
<td>Reste</td><td>".number_format($sold, 2, '.', ' ')."</td></tr></table></div><div id='pagebreakfiche' style='page-break-before: always;'></div></div>";


























?>
<br><div id='complement' style='display:none;'><hr><br><div id="bonprint" > <div align="center">
<div id='toremove2'><h3><u>BON CLIENT</u>
<input style="margin-left:50px;zoom: 1.5;" type="checkbox" id="toprintb" value="1"  checked><a href="#" onclick="printdiv('b')"><img src='img/print.png' width='30' ></a></h3>
		</div>
<table id="topinfos" border="1"><tr><td><img src="img/logo.png" width="60" ></td><td>Bon numero: 
	<?php echo "$orderid</td><td align='center' '>"; 
	if($argon=="Oui"){echo " <b style='padding:20px;'> ARGON </b> "; }
	if($poncage!="Non"){echo " <b style='padding:20px;'> PONCAGE $poncage</b> "; }

		if($cuisson!="Non"){echo " <b style='padding:20px;'> TREMPE $cuisson</b> "; }
	 echo '</td><td>Tizi-Ouzou Le: '. date("d-m-Y H:i",$time).''; 
	echo "</td></tr><tr><td width='200' colspan='2'>Client: <a href='contactinfos.php?id=$contactid'>$contactname </a></td>
	<td width='200'>Region: $contactcom</td><td width='200'>Contact: $contact</td></tr></table>";
	?> 
		    		<table style="margin-top:10px;" id="articlestable" ><tr id="tablemenu"><td>N </td><td>Dim. 1 [cm]</td><td>Dim. 2[cm]</td><td>Nombe</td><td>Vitre 1</td><td>Baguette</td><td>Vitre 2</td><td>Sens</td>
		<td>Prix U</td><td>Montant</td></tr>
		    		<?php
$query4="select * from products";
					$result4 = mysqli_query($dbc,$query4);
					if($result4){
		    		if(mysqli_affected_rows($dbc)!=0){
$j=0;
		    	while($row4 = mysqli_fetch_array($result4,MYSQLI_ASSOC)){
		    		$i=$row4['id'];
		    		$idaray[$i]=$j;
		    		$designationproduct[$j]=$row4['designation'];
		    		$referenceproduct[$j]=$row4['reference'];
		    		$j++;

		    	}}}
		    		$query5="select * from articles WHERE order_id='$orderid'";
					$result5 = mysqli_query($dbc,$query5);
					$totalorder=0;
					if($result5){
		    		if(mysqli_affected_rows($dbc)!=0){
$i=1;
	
		    	while($row5 = mysqli_fetch_array($result5,MYSQLI_ASSOC)){
		    		$idvitre1=$row5['vitre1'];
		    		$idvitre2=$row5['vitre2'];
		    		$idbaguette=$row5['baguette'];
		    		$idvitre1=$idaray[$idvitre1];
		    		$idvitre2=$idaray[$idvitre2];
		    		$idbaguette=$idaray[$idbaguette];

$price=round(($row5['q']*$row5['price']*$row5['dimension1']*$row5['dimension2']*0.0001)*100)*0.01;
echo "<tr  align='center'><td>". $i ."</td><td>". $row5['dimension1'] ."</td><td>". $row5['dimension2'] ."</td>
<td>". floatval($row5['q']) ."</td><td>". $designationproduct[$idvitre1] ."</td><td>". $designationproduct[$idbaguette] ."</td><td>". $designationproduct[$idvitre2] ."</td><td>". $row5['sens'] ."</td>
		<td>".number_format($row5['price'], 2, '.', ' ')."</td><td>".number_format($price, 2, '.', ' ')."</td></tr>";
		$totalorder+=$price;
		$i++;



}}}
echo "<tr><td style='border:0px;'></td><td style='border:0px;'></td><td style='border:0px;'></td><td style='border:0px;'></td>
<td style='border:0px;'></td>
<td style='border:0px;'></td><td style='border:0px;'></td><td style='border:0px;'></td>

<td>Total</td><td>".number_format($totalorder, 2, '.', ' ')."</td></tr>";

	//$query6="select * from orders WHERE id_contact='$id_contact' AND status='1'";
//		$result6 = mysqli_query($dbc,$query6);

//		    	while($row6 = mysqli_fetch_array($result6,MYSQLI_ASSOC)){
//		    		$orderids=$row6['id'];
$query7="select price, q from articles WHERE order_id='$orderid'";
		$result7 = mysqli_query($dbc,$query7);
		$totalq=0;
		    	while($row7 = mysqli_fetch_array($result7,MYSQLI_ASSOC)){
		    		$totalq+=$row7['q'];
		    		}
	//	    	}
		    		
if($versement=="")$versement=0;
$sold=$totalorder-$versement;
echo "<tr><td style='border:0px;'></td><td colspan='2' style='border:0px;' align='right'><b>Nombre de Carreaux: </b></td><td style='border:0px;' align='center'><b>$totalq</b></td>
<td style='border:0px;'></td><td style='border:0px;'></td><td style='border:0px;'></td><td style='border:0px;'></td>
<td>Versement</td><td>".number_format($versement, 2, '.', ' ')."</td></tr>";
echo "<tr><td style='border:0px;'></td><td style='border:0px;'></td><td style='border:0px;'></td><td style='border:0px;'></td><td style='border:0px;'></td><td style='border:0px;'></td><td style='border:0px;'></td><td style='border:0px;'></td>
<td>Reste</td><td>".number_format($sold, 2, '.', ' ')."</td></tr></table></div><div id='pagebreakbonprint' style='page-break-before: always;'> </div></div>";
















if($poncage=="Non" || $poncage=="Tout"){

?>
			<br><hr><br><div id="glassprint"><div align="center">
			<div id='toremove3' ><h3><u>FA&Ccedil;ONNAGE DE VITRES</u>
			<input style="margin-left:50px;zoom: 1.5;" type="checkbox" id="toprintg" value="1"  checked><a href="#" onclick="printdiv('g')"><img src='img/print.png' width='30' ></a></h3>
		</div>

			<table id="topinfos" border="1"><tr><td colspan="2">Bon numero: 
		<?php echo "$orderid</td><td align='center' style='vertical-align:top; '>"; 
		if($urgent=="URGENT"){echo " <b style='color:red;'> $urgent </b><br><br> "; }
//	echo " <b style='color:red;'> $urgent </b><br><br> ";
		
		if($argon=="Oui"){echo " <b style='padding:20px;'> ARGON </b> "; }
		if($poncage!="Non"){echo " <b style='padding:20px;'> PONCAGE $poncage</b> "; }
		if($cuisson!="Non"){echo " <b style='padding:20px;'> TREMPE $cuisson</b> "; }
		 echo '</td><td>Tizi-Ouzou Le: '. date("d-m-Y H:i",$time).''; 
		echo "</td></tr><tr><td width='200' colspan='2'>Client: <a href='contactinfos.php?id=$contactid'>$contactname </a></td>
		<td width='200'>Region: $contactcom</td><td width='200'>Contact: $contact</td></tr></table>";?> 
	<table style="margin-top:10px;" id="articlestable" ><tr id="tablemenu"><td>N </td><td>Dim. 1 [cm]</td><td>Dim. 2[cm]</td><td>Nombe</td><td>Vitre 1</td>
	<td>Baguette</td><td>Vitre 2</td><td>Sens</td></tr>
		    		<?php
$query4="select * from products";
					$result4 = mysqli_query($dbc,$query4);
					if($result4){
		    		if(mysqli_affected_rows($dbc)!=0){
$j=0;
		    	while($row4 = mysqli_fetch_array($result4,MYSQLI_ASSOC)){
		    		$i=$row4['id'];
		    		$idaray[$i]=$j;
		    		$designationproduct[$j]=$row4['designation'];
		    		$referenceproduct[$j]=$row4['reference'];
		    		$j++;
		    	}}}
		    		$query5="select * from articles WHERE order_id='$orderid'";
					$result5 = mysqli_query($dbc,$query5);
					$totalorder=0;
					if($result5){
		    		if(mysqli_affected_rows($dbc)!=0){
$i=1;
		    	while($row5 = mysqli_fetch_array($result5,MYSQLI_ASSOC)){
		    		$idvitre1=$row5['vitre1'];
		    		$idvitre2=$row5['vitre2'];
		    		$idbaguette=$row5['baguette'];
		    		$dimension1=$row5['dimension1'];
		    		$dimension2=$row5['dimension2'];
		    		if($poncage=="Tout"){
		    		$dimension1+=0.2;
		    		$dimension2+=0.2;
		    		}
		    		$idvitre1=$idaray[$idvitre1];
		    		$idvitre2=$idaray[$idvitre2];
		    		$idbaguette=$idaray[$idbaguette];
echo "<tr align='center'><td>". $i ."</td><td>". $dimension1 ."</td><td>". $dimension2 ."</td>
<td>". floatval($row5['q']) ."</td><td>". $referenceproduct[$idvitre1] ."</td><td>". $referenceproduct[$idbaguette] ."</td><td>". $referenceproduct[$idvitre2] ."</td><td>". $row5['sens'] ."</td>
		</tr>";
		
		$i++;
}}}
//	$query6="select * from orders WHERE id_contact='$id_contact' AND status='1'";
	//	$result6 = mysqli_query($dbc,$query6);
	//	    	while($row6 = mysqli_fetch_array($result6,MYSQLI_ASSOC)){
	//	    		$orderids=$row6['id'];
$query7="select q from articles WHERE order_id='$orderid'";
		$result7 = mysqli_query($dbc,$query7);
		$totalq=0;
		    	while($row7 = mysqli_fetch_array($result7,MYSQLI_ASSOC)){
		    		$totalq+=$row7['q'];
		    		}
//		    	}

echo "<tr><td style='border:0px;'></td><td colspan='2' style='border:0px;' align='right'><b>Nombre de Carreaux: </b></td><td style='border:0px;' align='center'><b>$totalq</b></td>
<td style='border:0px;'></td><td style='border:0px;'></td><td style='border:0px;'></td><td style='border:0px;'></td>
<td style='border:0px;'></td><td style='border:0px;'></td></tr></table></div><div id='pagebreakglassprint' style='page-break-before: always;'></div></div>";






}else{
	for ($jj=1; $jj < 3 ; $jj++) { 
		?>
			<br><hr><br><div id="glassprint<?php echo $jj; ?>"><div align="center">
			<div id='toremove3<?php echo $jj; ?>' ><h3><u>FA&Ccedil;ONNAGE DE LA VITRE <?php echo $jj; ?></u>
			<input style="margin-left:50px;zoom: 1.5;" type="checkbox" id="toprintg<?php echo $jj; ?>" value="1"  checked><a href="#" onclick="printdiv('g<?php echo $jj; ?>')"><img src='img/print.png' width='30' ></a></h3>
		</div>

			<table id="topinfos" border="1"><tr><td colspan="2">Bon numero: 
		<?php echo "$orderid</td><td align='center' style='vertical-align:top; '>"; 
	if($urgent=="URGENT"){echo " <b style='color:red;'> $urgent </b><br><br> "; }
		if($argon=="Oui"){echo " <b style='padding:20px;'> ARGON </b> "; }
		if($poncage!="Non"){echo " <b style='padding:20px;'> PONCAGE $poncage</b> "; }
		if($cuisson!="Non"){echo " <b style='padding:20px;'> TREMPE $cuisson</b> "; }
		 echo '</td><td>Tizi-Ouzou Le: '. date("d-m-Y H:i",$time).''; 
		echo "</td></tr><tr><td width='200' colspan='2'>Client: <a href='contactinfos.php?id=$contactid'>$contactname </a></td>
		<td width='200'>Region: $contactcom</td><td width='200'>Contact: $contact</td></tr></table>";?> 
	<table style="margin-top:10px;" id="articlestable" ><tr id="tablemenu"><td>N </td><td>Dim. 1 [cm]</td><td>Dim. 2[cm]</td><td>Nombe</td><td>Vitre 1</td>
	<td>Baguette</td><td>Vitre 2</td><td>Sens</td></tr>
		    		<?php
$query4="select * from products";
					$result4 = mysqli_query($dbc,$query4);
					if($result4){
		    		if(mysqli_affected_rows($dbc)!=0){
$j=0;
		    	while($row4 = mysqli_fetch_array($result4,MYSQLI_ASSOC)){
		    		$i=$row4['id'];
		    		$idaray[$i]=$j;
		    		$designationproduct[$j]=$row4['designation'];
		    		$referenceproduct[$j]=$row4['reference'];
		    		$j++;
		    	}}}
		    		$query5="select * from articles WHERE order_id='$orderid'";
					$result5 = mysqli_query($dbc,$query5);
					$totalorder=0;
					if($result5){
		    		if(mysqli_affected_rows($dbc)!=0){
$i=1;
		    	while($row5 = mysqli_fetch_array($result5,MYSQLI_ASSOC)){
		    		$idvitre1=$row5['vitre1'];
		    		$idvitre2=$row5['vitre2'];
		    		$idbaguette=$row5['baguette'];
		    		$dimension1=$row5['dimension1'];
		    		$dimension2=$row5['dimension2'];
		    		if($poncage=="Vitre $jj"){
		    		$dimension1+=0.2;
		    		$dimension2+=0.2;
		    		}
		    		$idvitre1=$idaray[$idvitre1];
		    		$idvitre2=$idaray[$idvitre2];
		    		$idbaguette=$idaray[$idbaguette];
echo "<tr align='center'><td>". $i ."</td><td>". $dimension1 ."</td><td>". $dimension2 ."</td>
<td>". floatval($row5['q']) ."</td><td>". $referenceproduct[$idvitre1] ."</td><td>". $referenceproduct[$idbaguette] ."</td><td>". $referenceproduct[$idvitre2] ."</td><td>". $row5['sens'] ."</td>
		</tr>";
		
		$i++;
}}}
//	$query6="select * from orders WHERE id_contact='$id_contact' AND status='1'";
//		$result6 = mysqli_query($dbc,$query6);
//		    	while($row6 = mysqli_fetch_array($result6,MYSQLI_ASSOC)){
//		    		$orderids=$row6['id'];
$query7="select q from articles WHERE order_id='$orderid'";
		$result7 = mysqli_query($dbc,$query7);
		$totalq=0;
		    	while($row7 = mysqli_fetch_array($result7,MYSQLI_ASSOC)){
		    		$totalq+=$row7['q'];
		    		}
//		    	}

echo "<tr><td style='border:0px;'></td><td colspan='2' style='border:0px;' align='right'><b>Nombre de Carreaux: </b></td><td style='border:0px;' align='center'><b>$totalq</b></td>
<td style='border:0px;'></td><td style='border:0px;'></td><td style='border:0px;'></td><td style='border:0px;'></td>
<td style='border:0px;'></td><td style='border:0px;'></td></tr></table></div><div id='pagebreakglassprint$jj' style='page-break-before: always;'></div></div>";

	}
}





















?>
			<br><hr><br><div id="baguetteprint"><div align="center">
			<div id='toremove4'><h3><u>BAGUETTES / CADRES</u>
			<input style="margin-left:50px;zoom: 1.5;" type="checkbox" id="toprintbg" value="1"  checked><a href="#" onclick="printdiv('bg')"><img src='img/print.png' width='30' ></a></h3>
		</div>
			<table id="topinfos" border="1"><tr><td colspan="2">Bon numero: 
		<?php echo "$orderid</td><td align='center' style='vertical-align:top; '>"; 
	if($urgent=="URGENT"){echo " <b style='color:red;'> $urgent </b><br><br> "; }
		if($argon=="Oui"){echo " <b style='padding:20px;'> ARGON </b> "; }
		if($poncage!="Non"){echo " <b style='padding:20px;'> PONCAGE $poncage</b> "; }
		
		if($cuisson!="Non"){echo " <b style='padding:20px;'> TREMPE $cuisson</b> "; }
		 echo '</td><td>Tizi-Ouzou Le: '. date("d-m-Y H:i",$time).''; 
		echo "</td></tr><tr><td width='200' colspan='2'>Client: <a href='contactinfos.php?id=$contactid'>$contactname </a></td>
		<td width='200'>Region: $contactcom</td><td width='200'>Contact: $contact</td></tr></table>";?> 
	<table style="margin-top:10px;" id="articlestable" ><tr id="tablemenu"><td>N </td><td>Dim. 1 [cm]</td><td>Dim. 2[cm]</td><td>Nombe</td><td>Vitre 1</td>
	<td>Baguette</td><td>Vitre 2</td><td>Sens</td></tr>
		    		<?php
$query4="select * from products";
					$result4 = mysqli_query($dbc,$query4);
					if($result4){
		    		if(mysqli_affected_rows($dbc)!=0){
$j=0;
		    	while($row4 = mysqli_fetch_array($result4,MYSQLI_ASSOC)){
		    		$i=$row4['id'];
		    		$idaray[$i]=$j;
		    		$designationproduct[$j]=$row4['designation'];
		    		$referenceproduct[$j]=$row4['reference'];
		    		$j++;
		    	}}}
		    		$query5="select * from articles WHERE order_id='$orderid'";
					$result5 = mysqli_query($dbc,$query5);
					$totalorder=0;
					if($result5){
		    		if(mysqli_affected_rows($dbc)!=0){
$i=1;
		    	while($row5 = mysqli_fetch_array($result5,MYSQLI_ASSOC)){
		    		$idvitre1=$row5['vitre1'];
		    		$idvitre2=$row5['vitre2'];
		    		$idbaguette=$row5['baguette'];
		    		$dimension1=$row5['dimension1']-$k7;
		    		$dimension2=$row5['dimension2']-$k7;
		    		$idvitre1=$idaray[$idvitre1];
		    		$idvitre2=$idaray[$idvitre2];
		    		$idbaguette=$idaray[$idbaguette];
echo "<tr><td>". $i ."</td><td>". $dimension1 ."</td><td>". $dimension2 ."</td>
<td>". floatval($row5['q']) ."</td><td>". $referenceproduct[$idvitre1] ."</td><td>". $referenceproduct[$idbaguette] ."</td><td>". $referenceproduct[$idvitre2] ."</td><td>". $row5['sens'] ."</td>
		</tr>";
		
		$i++;
}}}
//	$query6="select * from orders WHERE id_contact='$id_contact' AND status='1'";
//		$result6 = mysqli_query($dbc,$query6);
//		    	while($row6 = mysqli_fetch_array($result6,MYSQLI_ASSOC)){
//		    		$orderids=$row6['id'];
$query7="select q from articles WHERE order_id='$orderid'";
		$result7 = mysqli_query($dbc,$query7);
		$totalq=0;
		    	while($row7 = mysqli_fetch_array($result7,MYSQLI_ASSOC)){
		    		$totalq+=$row7['q'];
		    		}
//		    	}

echo "<tr align='center'><td style='border:0px;'></td><td colspan='2' style='border:0px;' align='right'><b>Nombre de Carreaux: </b></td><td style='border:0px;' align='center'><b>$totalq</b></td>
<td style='border:0px;'></td><td style='border:0px;'></td><td style='border:0px;'></td><td style='border:0px;'></td>
<td style='border:0px;'></td><td style='border:0px;'></td></tr></table></div><br><br></div></div>";













echo "<hr><a href='#' onclick='showhide();'><img src='img/down.png' id='arrow' width='20' height='20'></a><hr><br><table>";

if (isset($_SESSION['lg']) AND $_SESSION['lg']==2 AND $status==1){
echo "<tr>
<td style='padding:30px;'>";

$query2="SELECT * FROM arrangedorders WHERE order_id='$orderid'";
	$result2 = mysqli_query($dbc,$query2);
	if($result2 AND mysqli_affected_rows($dbc)!=0){
			echo "<a href='#' onclick='alert(\" D&eacute;sorganisez la commande pour pouvoir la modifier !\")'>";
		}else{
		echo "<a href='editorders.php?bonid=$orderid'>";
		}









echo "<img src='img/edit.png' width='70'></a></td>
<td style='padding:30px;'><a href='#' onclick='cancelorder($orderid)'><img src='img/cancel.png' width='70'></a></td>";
}elseif(isset($_SESSION['lg']) AND $_SESSION['lg']==2 AND $status==0){
echo "<td style='padding:30px;'><a href='#' onclick='cancelorder($orderid,2)'><img src='img/validate.png' width='70'></a></td>";
}


$query2="select * from defaults WHERE name='destinationxls'";
					$result2 = mysqli_query($dbc,$query2);
		    			$row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
		    			$link=$row2['value'];

echo "
<td style='padding:30px;'><a href='#' onclick='printdiv()'><img src='img/print.png' width='70'></a></td>
<td style='padding:30px;'><a href='#' onclick='xls(\"$orderid\",\"$link\")'><img src='img/excel.png' width='70'></a></td></tr></table>";


















































}}

?>
</div>
</body></html>