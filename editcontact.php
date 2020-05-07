<?php
session_start();
?>
<html><head>

<link href="css/style2.css" type="text/css" rel="stylesheet"/>
<?php
if (isset($_SESSION['lg']) AND $_SESSION['lg']==2){
	include_once ('database_connection.php');
	if (isset($_POST['name'])){
		$name = 	trim($_POST['name']) ;
$name = mysqli_real_escape_string($dbc, $name);
$name = htmlentities($name);
$contact = 	trim($_POST['contact']) ;
$contact = mysqli_real_escape_string($dbc, $contact);
$contact = htmlentities($contact);
$id = 	trim($_POST['id']) ;
$region = 	trim($_POST['region']) ;
$region = mysqli_real_escape_string($dbc, $region);
$region = htmlentities($region);
if(mysqli_query($dbc,"UPDATE  contacts SET name='$name', contact='$contact',com='$region' WHERE id=$id ")){
echo '<SCRIPT LANGUAGE="JavaScript">
alert("Contact modifié");
document.location.href="contactinfos.php?id='.$id.'";
</SCRIPT>';

}else{
	echo "<div id='error' align='center'>Une erreur s&#39;est produite </div>";
}
	}elseif (isset($_GET['id'])){
		$id=$_GET['id'];
		echo'<script type="text/javascript">
		    	function isInArray(array, search){
    return array.indexOf(search) >= 0;
}
var names=[];';

		$query1="select name from contacts WHERE id!=$id";
		$result1 = mysqli_query($dbc,$query1);
		if($result1){
		    if(mysqli_affected_rows($dbc)!=0){
		    	
		    	$i=0;
		    	while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)){
		    	echo 'names['.$i.']="'. stripslashes($row1['name']) .'";';
$i++;
		    }
		    
		}}
		    
		    ?>

	

function valider() {
  if(document.addcontact.name.value != "") {
    valider2();
  }else {
    alert("Vous devez introduir un nom");
  }}


function valider2() {
var s=htmlEntities(document.addcontact.name.value);
  if(isInArray(names, s)){
  alert("Un contact portant le meme nom existe deja");
}else{
  document.addcontact.submit();}}
function htmlEntities(str) {
    
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/é/g, '&eacute;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}



</script>
</head><body>
<?php
$query2="select * from contacts WHERE id=$id";
		$result2 = mysqli_query($dbc,$query2);
		if($result2){
		    if(mysqli_affected_rows($dbc)!=0){

		  $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
$namec=$row2['name'];
$regionc=$row2['com'];
$contactc=$row2['contact'];

?>
		
<form autocomplete='off' method="post" name="addcontact">
<table id="addtable" align="center">
<tr valign="middle"><td valign="middle">Nom: </td><td valign="middle"><input type="text" name="name" value='<?php echo $namec; ?>'></td></tr>
<tr><td>Region: </td><td><input type="text" value='<?php echo $regionc; ?>'name="region"></td></tr>
<tr><td>Conact: </td><td><input type="text" value='<?php echo $contactc; ?>'name="contact">
<input type="hidden" value='<?php echo $id; ?>'name="id"></td></tr>
<tr><td colspan="2" align="center"><br><a href="#" onclick="valider()">
	<div class="menu">
		Enregistrer</div></a></td></tr></table>
</form>
</body></html>
<?php
}}
}}elseif (isset($_GET['id'])){
	$id=$_GET['id'];
		echo '<SCRIPT LANGUAGE="JavaScript">
document.location.href="access.php?page=editcontact&parameter1=id&value1='.$id.'";
</SCRIPT>';
}
?>