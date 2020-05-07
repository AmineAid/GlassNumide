<?php
session_start();
?>
<html><head>

<link href="css/style2.css" type="text/css" rel="stylesheet"/>
<?php
if (isset($_SESSION['lg']) AND $_SESSION['lg']==2){
	include_once ('database_connection.php');

	if (isset($_POST['designation'])){
		$reference = 	trim($_POST['reference']) ;
$reference = mysqli_real_escape_string($dbc, $reference);
$reference = htmlentities($reference);
$designation = 	trim($_POST['designation']) ;
$designation = mysqli_real_escape_string($dbc, $designation);
$designation = htmlentities($designation);
$price = 	trim($_POST['price']) ;
$price = mysqli_real_escape_string($dbc, $price);
$producttype =  trim($_POST['producttype']) ;
$idp =  trim($_POST['idproduct']) ;
if(mysqli_query($dbc,"UPDATE products SET type='$producttype', reference='$reference', designation='$designation', price='$price' WHERE id=$idp")){
echo '<div id="added" align="center">Produit modifi&eacute;! </div>';
}else{
	echo "<div id='error' align='center'>Une erreur s&#39;est produite </div>";
}
	}

  if (isset($_GET['idproduct']) OR isset($_POST['idproduct'])){
    if (isset($_GET['idproduct'])){
    $idp=$_GET['idproduct'];
  }else{
    $idp=$_POST['idproduct'];
  }
		echo'<script type="text/javascript">
		    	function isInArray(array, search){
    return array.indexOf(search) >= 0;
}
var references=[];var designations=[];';

		$query1="select * from products WHERE type!=0 OR id!=$idp";
		$result1 = mysqli_query($dbc,$query1);
		if($result1){
		    if(mysqli_affected_rows($dbc)!=0){
		    	
		    	$i=0;
		    	while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)){
		    	echo 'references['.$i.']="'. stripslashes($row1['reference']) .'";';
		    	echo 'designations['.$i.']="'. stripslashes($row1['designation']) .'";';
$i++;
		    }
		    
		}}
		    
		    ?>

	

function onlynumbers(evt) {
  var theEvent = evt || window.event;
  var key = theEvent.keyCode || theEvent.which;
  if ((key < 48 || key > 57) && !(key == 8 || key == 9 || key == 13 || key == 37 || key == 46) ){
    theEvent.returnValue = false;
    if (theEvent.preventDefault) theEvent.preventDefault();
  }}
  function noquot(evt) {
  var theEvent = evt || window.event;
  var key = theEvent.keyCode || theEvent.which;
  if ((key < 48 || key > 57) && !(key == 8 || key == 9 || key == 13 || key == 37 || key == 46) ){
    theEvent.returnValue = false;
    if (theEvent.preventDefault) theEvent.preventDefault();
  }}

function valider() {
  if(document.addproduct.reference.value != "") {
    valider2();
  }else {
    alert("Vous devez introduir une reference");
  }}

function valider2() {
  if(document.addproduct.designation.value != "") {
    valider3();
  }
  else {
    alert("Vous devez introduir une designation");
  }}
function valider3() {
  if(document.addproduct.price.value != "") {
 document.addproduct.submit();
  }
  else {
    alert("Vous devez introduir un prix");
  }}

function valider4() {
var s=htmlEntities(document.addproduct.designation.value);
  if(isInArray(designations, s)){
  alert("Un produit portant la meme designation existe deja");
}else{
  valider5();}}

function valider5() {
var s=htmlEntities(document.addproduct.reference.value);
  if(isInArray(references, s)){
  alert("Un produit portant la meme reference existe deja");
}else{
  document.addproduct.submit();}}
function htmlEntities(str) {
    
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').rseplace(/é/g, '&eacute;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}


function del(id){
  var r=confirm("Voulez vous supprimer ce produit?");
  if(r){
    window.location.href ='delproduct.php?id='+id;
  }

}
</script>
</head><body>
<?php
$query2="select * from products WHERE id=$idp";
    $result2 = mysqli_query($dbc,$query2);
    if($result2){
        if(mysqli_affected_rows($dbc)!=0){

      $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
$reference=$row2['reference'];
$designation=$row2['designation'];
$producttype=$row2['type'];
$price=$row2['price'];

?>
<form autocomplete='off' method="post" name="addproduct">
<table id="addproducttable" align="center">
  <tr><td><input type="radio" name="producttype" value="1" <?php if($producttype==1)echo "checked"; ?> > Vitre
  </td><td><input type="radio" name="producttype" value="2" <?php if($producttype==2)echo "checked"; ?> > Baguette</td></tr>
<tr valign="middle"><td valign="middle">Reference: </td><td valign="middle"><input value='<?php echo $reference; ?>' type="text" name="reference"></td></tr>
<tr><td>Designation: </td><td><input type="text" name="designation" value='<?php echo $designation; ?>'></td></tr>
<tr><td>Prix(DA): </td><td><input type="text" name="price"  onkeypress='onlynumbers(event)' value='<?php echo $price; ?>'>
<input type="hidden" value='<?php echo $idp; ?>'name="idproduct"></td></tr>
<tr><td align="center"><br><a href="#" onclick="valider()">
  <div class="menu">
    Enregistrer</div></a></td><td align="center"><br><a href="#" onclick="del(<?php echo $idp; ?>)">
	<div class="menu">
		Supprimer</div></a></td></tr></table>
</form>
</body></html>
<?php
}}
}}else{
	echo'<script type="text/javascript">window.top.location.reload();</script>';
}
?>