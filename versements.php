<html><head>
<link href="css/style2.css" type="text/css" rel="stylesheet"/>
</head><body>
<?php


include_once ('database_connection.php');
if(isset($_GET['contactid']) ){
    $contactid=$_GET['contactid'];
	$query1="select name, contact, com from contacts WHERE id='$contactid'";
	$result1 = mysqli_query($dbc,$query1);
	$row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);
	if($result1){
			if(mysqli_affected_rows($dbc)!=0){
			$name=$row1['name'];
			$region=$row1['com'];
			$contact=$row1['contact'];
if(isset($_GET['by'])){
$by=$_GET['by'];
$elementsperpage=$_GET['elementsperpage'];
$order=$_GET['order'];
}else{
    $elementsperpage=20;
    $by="id";
    $order="desc";
}
if(isset($_GET['page'])){
$page=$_GET['page'];
    $from=(($page-1)*$elementsperpage);
    
}else{
    $page="1";
    $from=0;
}
$to=$elementsperpage;
$query1 = "select id from versements WHERE id_contact='$contactid' ";
$result1 = mysqli_query($dbc,$query1);
$numberOfVersements=mysqli_affected_rows($dbc);
        $numberOfPages=$numberOfVersements/$elementsperpage;
        $numberOfPages+=1;
?>
<br><br><div align="center" style="font-size:22px;">
<?php echo $numberOfVersements;?> Versements effectu&eacute;s par 
	<?php echo "<a style='color:green'href='contactinfos.php?id=$contactid'><u><b>$name</b> $region $contact</u></a></div><br><br>"; ?>

<table align='center' id='contacttable'><tr>
	<td></td><td><a href='addversement.php?contactid=<?php echo $contactid; ?>'>Ajouter un versement</a></td><td>Lister par :</td><td>
	<form methode="get" name='order'>
		<input type="hidden" name="contactid" value="<?php echo $contactid; ?>">
	<select style="font-size:18px;" name="by"  onchange=" document.order.submit()">
	<option value="id" >Id</option>
	<option value="time" <?php if($by == "time"){echo 'selected'; }?> >Date</option>
	</select>
<select style="font-size:18px;" name="order" onchange=" document.order.submit()">
	<option value="" >- au +</option>
	<option value="desc" <?php if($order == "desc")echo 'selected'; ?>>+ au -</option>
	</select></td><td>Elements / page</td><td><select style="font-size:18px;" name="elementsperpage" onchange=" document.order.submit()">
    <option value="20" >20</option>
    <option value="50" <?php if($elementsperpage == "50")echo 'selected'; ?>>50</option>
    <option value="100" <?php if($elementsperpage == "100")echo 'selected'; ?>>100</option>
    <option value="200" <?php if($elementsperpage == "200")echo 'selected'; ?>>200</option>
    </select></form></table>
<table align="center" id='contacttable' ><tr><td>Id</td><td>Date</td><td>Somme</td></tr>


<?php


$query1 = "select * from versements WHERE id_contact='$contactid' ORDER BY $by $order limit $from, $to";
$result1 = mysqli_query($dbc,$query1);
if($result1){
    if(mysqli_affected_rows($dbc)!=0){
    	
    	while($row1=mysqli_fetch_array($result1,MYSQLI_ASSOC)){

$id=$row1['id'];
$somme=$row1['valeur'];
$time=$row1['time'];
$time= date("d-m-Y H:i",$time);
echo"<tr><td><a href='editversement.php?contactid=$contactid&id=$id'>$id</a></td><td><a href='editversement.php?contactid=$contactid&id=$id'>$time</a></td>
<td><a href='editversement.php?contactid=$contactid&id=$id'>$somme</a></td></tr>";
    }}}
   

echo'</table><br><br><div align="center">';
 $i=1;
 echo "<table id='pages'><tr><td><h2>Page:</h2></td> ";
    while($i<$numberOfPages){
    	if($i!=$page){
    	echo "<td> <a href='?contactid=$contactid&id=$id&order=$order&by=$by&page=$i&elementsperpage=$elementsperpage'> <h2>$i</h2>  </a></td>";
    }else{

    	echo "<td> <a href='?contactid=$contactid&id=$id&order=$order&by=$by&page=$i&elementsperpage=$elementsperpage'> <h3>$i</h3>  </a></td>";
    }
    	if ($i%20 == 0){
    		echo"</tr><tr>";
    	}
    	$i++;
    }

    echo '</tr></table></div>';
}}}
    ?>
</body>
</html>