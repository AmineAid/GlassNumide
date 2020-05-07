<?php 
Session_start();
include_once("save.php");
?>
<html>
<head>
<title>Glass Numide</title>
<link href="css/style1.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript" src="js/jquery-1.3.2.js"></script>
<script type="text/javascript" src="js/jquery.watermark.js"></script>
<script>
function load(a) {
     document.getElementById("mainfield").innerHTML='<iframe width="100%" height="100%" style="border:none;"src="'+a+'" ></iframe>';
}




      $(document).ready(function() {

$("#faq_search_input").keyup(function()
{
var faq_search_input = $(this).val();
var dataString = 'keyword='+ faq_search_input;
if(faq_search_input.length>0)
{	
	document.getElementById("searchresultdata").style ="display:block";
$.ajax({
type: "GET",
url: "ajax-search.php",
data: dataString,

success: function(server_response)
{

$('#searchresultdata').html(server_response).show();


}
});
}else{
	document.getElementById("searchresultdata").innerHTML=" ";
	document.getElementById("searchresultdata").style ="display:none";
}
});
});
function order(id){
     document.getElementById("mainfield").innerHTML='<iframe width="100%" height="100%" style="border:none;"src="orderinfos.php?id='+id+'" ></iframe>';
document.getElementById("searchresultdata").innerHTML=" ";
	document.getElementById("searchresultdata").style ="display:none";
}




</script>
</head>
<body>
	<a href="#" onclick="load('access.php')">
		<img src="img/<?php if (isset($_SESSION['lg']) AND $_SESSION['lg']==2) echo "padunlocked.png"	; else echo 'padlock.png'; ?>" id="padlock"></a>
		<div style="float:left;">
		<a href	="../Numid2/index.php">	<div class="menu" Style=" width:50px;Height:35px;padding:0px;">SV</div><br>
		<a href	="#" onclick="load('../Numid/allOrders.php')">	<div class="menu" Style=" width:50px;Height:35px;padding:0px;"><img src="img/excel.png" Style=" width:30px;Height:35px;"></div></a></div>
	<table align="center" id="toptable">
<tr class="top">
	<?php
	if (isset($_SESSION['lg']) AND $_SESSION['lg']==2){
	?>
<td><a href="#" onclick="load('addproduct.php');"><div class="menu" >Ajouter un produit</div></a></td>
<td><a href="#" onclick="load('addorder.php');"><div class="menu">Nouvelle commande</div></a></td>
<td><div id="search"><input autocomplete='off' name="query" type="text" id="faq_search_input" placeholder="Rechercher une commande" /> </div></td>
<td valign="middle"><a href="#" onclick="load('contacts.php');"><div class="menu">Contacts</div></a></td>
<td><a href="#" onclick="load('data.php');"><div class="menu">Data</div></a></td>
<td><a href="#" onclick="load('settings.php');"><img src="img/setting.png" width="70"></a></td>

<?php 
}else{
	?>
<td id="menudisabled"></td>
<td><a href="#" onclick="load('addorder.php');"><div class="menu">Nouvelle commande</div></a></td>
<td><div id="search"><input autocomplete='off' name="query" type="text" id="faq_search_input" placeholder="Rechercher une commande" /> </div></td>
<td valign="middle"><a href="#" onclick="load('contacts.php');"><div class="menu">Contacts</div></a></td>
<td id="menudisabled"></td>
<td id="menudisabled"></td>
	<?php
}
?>
</tr>	</table>
	<div id="searchresultdata" class="faq-articles" align="center"></div>

	<div class="mainfield" id="mainfield" align="center">

<?php 
if (isset($_GET['page'])){
	echo "<iframe width='100%' height='100%' style='border:none;' src='".$_GET['page']."' ></iframe>";
}

?></div>
</body>
</html>