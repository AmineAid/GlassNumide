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
$query1 = "select id from orders WHERE id_contact='$contactid' ";
$result1 = mysqli_query($dbc,$query1);
$numberOfOrders=mysqli_affected_rows($dbc);
        $numberOfPages=$numberOfOrders/$elementsperpage;
        $numberOfPages+=1;
?>
<br><br><div align="center" style="font-size:22px;">
<?php echo $numberOfOrders; ?> Commande(s) de  
	<?php echo "<a style='color:green'href='contactinfos.php?id=$contactid'><u><b>$name</b> $region $contact</u></a></div><br><br>"; ?>

<table align='center' id='contacttable'><tr>
	<td></td><td><a href='addorder.php?contactid=<?php echo $contactid; ?>'>Nouvele commande</a></td><td>Lister par :</td><td>
	<form methode="get" name='order'>
		<input type="hidden" name="contactid" value="<?php echo $contactid; ?>">
	<select style="font-size:18px;" name="by"  onchange=" document.order.submit()">
	<option value="time">Date</option>
	<option value="id" <?php if($by == "id"){echo 'selected'; }?> >Id</option>
	<option value="last_modified" <?php if($by == "last_modified"){echo 'selected'; }?> >Date de modification</option>
	<option value="status" <?php if($by == "status"){echo 'selected'; }?> >Status</option>
	<option value="argon" <?php if($by == "argon"){echo 'selected'; }?> >Argon</option>
	<option value="poncage" <?php if($by == "poncage"){echo 'selected'; }?> >Pon&ccedil;age</option>
	<option value="cuisson" <?php if($by == "cuisson"){echo 'selected'; }?> >Trempe</option>
	</select>
<select style="font-size:18px;" name="order" onchange=" document.order.submit()">
	<option value="desc" >+ au -</option>
	<option value="" <?php if($order == "")echo 'selected'; ?>>- au +</option>
	</select></td><td>Elements / page</td><td><select style="font-size:18px;" name="elementsperpage" onchange=" document.order.submit()">
	<option value="20" >20</option>
	<option value="50" <?php if($elementsperpage == "50")echo 'selected'; ?>>50</option>
	<option value="100" <?php if($elementsperpage == "100")echo 'selected'; ?>>100</option>
	<option value="200" <?php if($elementsperpage == "200")echo 'selected'; ?>>200</option>
	</select></form></table>
<table align="center" id='contacttable' class='contacttable2' ><tr><td>Id</td><td>Date</td><td>Nombre d&#39;articles</td><td>Argon</td><td>pon&ccedil;age</td><td>Trempe</td><td>Valeur</td><td>Derni&egrave;re modification</td><td>Statut</td></tr>


<?php


$query1="select * from orders WHERE id_contact='$contactid' ORDER BY $by $order limit $from, $to";
	$result1 = mysqli_query($dbc,$query1);
	if($result1){
		if(mysqli_affected_rows($dbc)!=0){
			
		    	while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)){
		    $time=$row1['time'];
		    $time= date("d-m-Y H:i",$time);
		    $status=$row1['status'];
		    $argon=$row1['argon'];
		    $poncage=$row1['poncage'];
		    $cuisson=$row1['cuisson'];
		    $last_modified=$row1['last_modified'];
		    $last_modified= date("d-m-Y H:i",$last_modified);
		    $status=$row1['status'];
		    if($status==0){
		    	$status="<font color='red'>Annul&eacute;</font>";
		    }else{
		    	$status="Valide";
		    }
		    $sumArticles=0;
		    		$orderids=$row1['id'];
$query2="select * from articles WHERE order_id='$orderids'";
		$result2 = mysqli_query($dbc,$query2);
		$numberOfArticles=mysqli_affected_rows($dbc);
		    	while($row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC)){
		    		$sumArticles+=round(($row2['q']*$row2['price']*$row2['dimension1']*$row2['dimension2']*0.0001)*100)*0.01;

		    	}

		    	echo"<tr><td><a href='orderinfos.php?id=$orderids'>$orderids</a></td><td><a href='orderinfos.php?id=$orderids'>$time</a></td>
		    	<td align='center'><a href='orderinfos.php?id=$orderids'>$numberOfArticles</a></td>
		    	<td><a href='orderinfos.php?id=$orderids'>$argon</a></td>
		    	<td><a href='orderinfos.php?id=$orderids'>$poncage</a></td>
		    	<td><a href='orderinfos.php?id=$orderids'>$cuisson</a></td>
		    	<td><a href='orderinfos.php?id=$orderids'>$sumArticles</a></td><td><a href='orderinfos.php?id=$orderids'>$last_modified</a></td>
		    	<td><a href='orderinfos.php?id=$orderids'>$status</a></td></tr>";
		    	}


   
   

echo'</table><br><br><div align="center">';
 $i=1;
 echo "<table id='pages'><tr><td><h2>Page:</h2></td> ";
    while($i<$numberOfPages){
    	if($i!=$page){
    	echo "<td> <a href='?contactid=$contactid&order=$order&by=$by&page=$i&elementsperpage=$elementsperpage'> <h2>$i</h2>  </a></td>";
    }else{

    	echo "<td> <a href='?contactid=$contactid&order=$order&by=$by&page=$i&elementsperpage=$elementsperpage' style='color:black;'> <h3>$i</h3>  </a></td>";
    }
    	if ($i%20 == 0){
    		echo"</tr><tr>";
    	}
    	$i++;
    }

    echo '</tr></table></div>';
} }}}}
    ?>
</body>
</html>