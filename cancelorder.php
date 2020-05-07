<?php
session_start();
if (isset($_SESSION['lg']) AND $_SESSION['lg']==2){
	include_once ('database_connection.php');
	if (isset($_GET['id'])){
		$id = 	trim($_GET['id']) ;
		if (!isset($_GET['todo'])){
$status=0;
		}else{
			$status=1;
		}
if(mysqli_query($dbc,"UPDATE  orders SET status='$status' WHERE id=$id ")){
echo '<SCRIPT LANGUAGE="JavaScript">
document.location.href="orderinfos.php?id='.$id.'";
</SCRIPT>';

}else{
	echo "<div id='error' align='center'>Une erreur s&#39;est produite </div>";
}}}
?>