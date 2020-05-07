<?php
session_start();
if (isset($_SESSION['lg']) AND $_SESSION['lg']==2){
	include_once ('database_connection.php');
	if (isset($_GET['id'])){
		$id = 	trim($_GET['id']) ;

if(mysqli_query($dbc,"UPDATE products SET type=0 WHERE id=$id ")){
echo '<SCRIPT LANGUAGE="JavaScript">
document.location.href="settings.php";
</SCRIPT>';

}else{
	echo "<div id='error' align='center'>Une erreur s&#39;est produite </div>";
}}}
?>