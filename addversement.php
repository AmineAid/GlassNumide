<?php
session_start();

	include_once ('database_connection.php');

	if (isset($_POST['contactid'])){
$contactid =  trim($_POST['contactid']) ;
$contactid = mysqli_real_escape_string($dbc, $contactid);
$contactid = htmlentities($contactid);
$time = 	trim($_POST['time']) ;
$time=strtotime($time);
$versement = trim($_POST['versement']) ;
if(mysqli_query($dbc,"INSERT INTO versements  (id_contact, time, valeur) VALUES('$contactid', '$time','$versement')")){
echo '<SCRIPT LANGUAGE="JavaScript">
alert("Versement ajouté");
document.location.href="contactinfos.php?id='.$contactid.'";
</SCRIPT>';
}else{
	echo "<div id='error' align='center'>Une erreur s&#39;est produite </div>";
}
	}elseif(isset($_GET['contactid'])){
		$contactid=$_GET['contactid'];
	$query1="select name, contact, com from contacts WHERE id='$contactid'";
	$result1 = mysqli_query($dbc,$query1);
	$row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);
	if($result1){
		if(mysqli_affected_rows($dbc)!=0){
			$name=$row1['name'];
			$region=$row1['com'];
			$contact=$row1['contact'];
		?>
		<html><head>

<link href="css/style2.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript">
function onlynumbers(evt) {
  var theEvent = evt || window.event;
  var key = theEvent.keyCode || theEvent.which;
  if ((key < 48 || key > 57) && !(key == 8 || key == 9 || key == 13 || key == 37 || key == 46) ){
    theEvent.returnValue = false;
    if (theEvent.preventDefault) theEvent.preventDefault();
  }}
  function valider() {
  if(document.addversement.time.value != "") {
 valider2();
  }
  else {
    alert("Vous devez introduir une date");
  }}
  function valider2() {
  if(document.addversement.versement.value != "" && document.addversement.versement.value>0) {
  document.addversement.submit();
  }
  else {
    alert("Vous devez introduir une somme");
  }}
</script>
</head><body style='font-size:22px;'>

<?php
echo "<br><br><div align='center'>Ajouter un Versement au profit de <a style='color:green'href='contactinfos.php?id=$contactid'><u><b>$name</b> $region $contact</u></a></div><br><br>";
?>
<form autocomplete='off' method="post" name="addversement">
<table style='font-size:25px;' id="addtable" align="center">
<tr valign="middle"><td valign="middle">Date: </td><td valign="middle"><input style='font-size:22px;' value="<?php echo date("d-m-Y H:i",time()); ?>" name="time"></td></tr>
<tr><td>Somme: </td><td><input  name="versement" style='font-size:22px;' onkeypress='onlynumbers(event)' ><input  type="hidden" name="contactid" value='<?php echo $contactid;?>' ></td></tr>
<tr><td colspan="2" align="center"><br><a href="#" onclick="valider()">
	<div class="menu">
		Enregistrer</div></a></td></tr></table>
</form>
</body></html>
<?php
}}}

?>