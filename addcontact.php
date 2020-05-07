<?php
session_start();
?>
<html><head>

<link href="css/style3.css" type="text/css" rel="stylesheet"/>
<?php
	include_once ('database_connection.php');

	if (isset($_POST['name'])){
		$name = 	trim($_POST['name']) ;
$name = mysqli_real_escape_string($dbc, $name);
$name = htmlentities($name);
$contact =  trim($_POST['contact']) ;
$contact = mysqli_real_escape_string($dbc, $contact);
$contact = htmlentities($contact);
$region = 	trim($_POST['region']) ;
$region = mysqli_real_escape_string($dbc, $region);
$region = htmlentities($region);
if(mysqli_query($dbc,"INSERT INTO contacts  (name, contact,com) VALUES('$name', '$contact', '$region')")){
echo '<div id="added" align="center">Contact ajout&eacute;! </div>';
}else{
	echo "<div id='error' align='center'>Une erreur s&#39;est produite </div>";
}
	}else{
		echo'<script type="text/javascript">
		    	function isInArray(array, search){
    return array.indexOf(search) >= 0;
}
var names=[];';

		$query1="select name from contacts";
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
<form autocomplete='off' method="post" name="addcontact">
<table id="addtable" align="center">
<tr valign="middle"><td valign="middle">Nom: </td><td valign="middle"><input type="text" name="name"></td></tr>
<tr><td>Region: </td><td><input type="text" name="region"></td></tr>
<tr><td>Conact: </td><td><input type="text" name="contact"></td></tr>
<tr><td colspan="2" align="center"><br><a href="#" onclick="valider()">
	<div class="menu">
		Enregistrer</div></a></td></tr></table>
</form>
</body></html>
<?php
}

?>