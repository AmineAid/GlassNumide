<html><head>
<link href="css/style2.css" type="text/css" rel="stylesheet"/>
<script>

function selectAll(a) {
	if(a==1){
		for(var i = 1; i < document.getElementById("numberOfOrders").value; i++){  

		document.getElementById("selectedOrder_"+[i]).checked=true;
	}
		document.getElementById("selectAll").innerHTML="<button onclick='selectAll(0)'>Tous</button>"
		
	}else{
		
		for(var i = 1; i < document.getElementById("numberOfOrders").value; i++){

		document.getElementById("selectedOrder_"+[i]).checked=false;
	}
		document.getElementById("selectAll").innerHTML="<button onclick='selectAll(1)'>Tous</button>"
		
	}

	}


	function xls(l){

    var link = prompt("Destination", l);
    if (link != null) {

    	document.getElementById("destination").value=link;
    	document.getElementById("location").value=window.location.href;
        document.ordersSelect.submit();
    }
}




</script>
</head><body>
<?php


include_once ('database_connection.php');

if(isset($_GET['by'])){
$by=$_GET['by'];
$elementsperpage=$_GET['elementsperpage'];
$order=$_GET['order'];

}else{
	$elementsperpage=30;
	$by="time";
	$order="desc";
}

$to=$elementsperpage;


$query1 = "select id from orders WHERE 1 limit 0,$elementsperpage UNION ALL select id from orders WHERE 1 limit 0,$elementsperpage";
//$query1 = "select id from orders WHERE 1 limit 0,$elementsperpage ";
$result1 = mysqli_query($dbc,$query1);
$numberOf=mysqli_affected_rows($dbc);
        $numberOfPages=$numberOf/$elementsperpage;
        $numberOfPages+=1;



        $query2="select * from defaults WHERE name='destinationxls'";
					$result2 = mysqli_query($dbc,$query2);
		    			$row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
		    			$link=$row2['value'];


?>

<table align='right' id='contacttable'>
	<tr>	
		<td><form methode="get" name='order'>
		<input type="hidden" name="contactid" value="<?php echo $contactid; ?>">
		<select style="font-size:18px;" name="by"  onchange=" document.order.submit()">
			<option value="time">Date</option>
		
			<option value="poncage" <?php if($by == "poncage"){echo 'selected'; }?> >Pon&ccedil;age</option>
			<option value="cuisson" <?php if($by == "cuisson"){echo 'selected'; }?> >Trempe</option>
		</select>
		<select style="font-size:18px;" name="order" onchange=" document.order.submit()">
			<option value="desc" >+ au -</option>
			<option value="" <?php if($order == "")echo 'selected'; ?>>- au +</option>
			</select></td><td>Elements</td><td><select style="font-size:18px;" name="elementsperpage" onchange=" document.order.submit()">
			<option value="30" >30</option>
			<option value="50" <?php if($elementsperpage == "50")echo 'selected'; ?>>50</option>
			<option value="100" <?php if($elementsperpage == "100")echo 'selected'; ?>>100</option>
			<option value="200" <?php if($elementsperpage == "200")echo 'selected'; ?>>200</option>
		</select></td><td width="50%"><div align='right'><?php echo "<a href='#' onclick='xls(\"$link\")'>"; ?><img src='img/excel.png' width='70'></a><div></td></form></table>
	<form name='ordersSelect' action='multipleXls.php'>
<table align="center" id='contacttable' class='contacttable2' style="font-size:19px;">
	<tr>
		<td><div id="selectAll"><button onclick='selectAll(1)'>Tous</button><div></td>
		<td>Id</td>
		<td>Client</td>
		<td>Date</td>
		<td>V1</td>
		<td>V2</td>
		<td>N.A</td>
		<td>N.P</td>
		<td>Argon</td>
		<td>PNC</td>
		<td>TRMP</td>
		<td>Valeur</td>
	</tr>


<?php
$query1="(select id,client,argon,poncage,cuisson,time from Numid.orders WHERE status=1 ORDER BY time desc limit 0, $to)
 UNION ALL
  (select id,client, ' ' as argon,poncage,cuisson,time from Numid2.orders WHERE status=1 ORDER BY time desc limit 0, $to) ORDER by $by $order,time desc Limit 0,$to ";
	$result1 = mysqli_query($dbc,$query1);
	if($result1){
		if(mysqli_affected_rows($dbc)!=0){
			$numberOfOrders=1;
		    	while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)){
		    $client=$row1['client'];
		    $time=$row1['time'];
		    $time= date("d-M",$time);
		    $argon=$row1['argon'];
		    $poncage=$row1['poncage'];
		    $cuisson=$row1['cuisson'];
		    if($poncage=="Non"){$poncage="";}
		    if($cuisson=="Non"){$cuisson="";}
		    if($argon=="Non"){$argon="";}
		    $sumArticles=0;
		    $sumCareaux=0;

		    		$orderids=$row1['id'];

		    		if($argon==' '){
		    			$query2="select * from Numid2.articles WHERE order_id='$orderids'";
		    		}else{
						$query2="select * from Numid.articles WHERE order_id='$orderids'";
					}
		$result2 = mysqli_query($dbc,$query2);
		$numberOfArticles=mysqli_affected_rows($dbc);
		    	while($row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC)){
		    		$sumArticles+=round(($row2['q']*$row2['price']*$row2['dimension1']*$row2['dimension2']*0.0001)*100)*0.01;
		    		$sumCareaux+=$row2['q'];
		    		$vitre1=$row2['vitre1'];
		    		$vitre2="";
		    		if(isset($row2['vitre2'])){
		    			$vitre2=$row2['vitre2'];
		    		}
		    	}
		    	


		    	
		    	if($vitre2!=""){
		    		$row3 = mysqli_fetch_array(mysqli_query($dbc,"select reference from Numid.products WHERE id='$vitre1'"),MYSQLI_ASSOC);
		    	$vitre1=$row3['reference'];
		    		$row3 = mysqli_fetch_array(mysqli_query($dbc,"select reference from Numid.products WHERE id='$vitre2'"),MYSQLI_ASSOC);
		    		$vitre2=$row3['reference'];
		    		$link='../Numid';
		    		$checkboxid="dv_$orderids";
		    	}else{
		    		$row3 = mysqli_fetch_array(mysqli_query($dbc,"select reference from Numid2.products WHERE id='$vitre1'"),MYSQLI_ASSOC);
		    	$vitre1=$row3['reference'];
		    	$link='../Numid2';
		    	$checkboxid="sv_$orderids";
		    	}

		    	echo"<tr><td align='center'><input type='checkbox' id='selectedOrder_$numberOfOrders' name='selectedOrders[]' value='$checkboxid'></td>
		    	<td><a href='#' onclick=\"top.window.location.href='$link/?page=orderinfos.php?id=$orderids'\">$orderids</a></td>
		    	<td><a href='#' onclick=\"top.window.location.href='$link/?page=orderinfos.php?id=$orderids'\">$client</a></td>
		    	<td><a href='#' onclick=\"top.window.location.href='$link/?page=orderinfos.php?id=$orderids'\">$time</a></td>
		    	<td><a href='#' onclick=\"top.window.location.href='$link/?page=orderinfos.php?id=$orderids'\">$vitre1</a></td>
		    	<td><a href='#' onclick=\"top.window.location.href='$link/?page=orderinfos.php?id=$orderids'\">$vitre2</a></td>
		    	<td align='center'><a href='#' onclick=\"top.window.location.href='$link/?page=orderinfos.php?id=$orderids'\">$numberOfArticles</a></td>
		    	<td align='center'><a href='#' onclick=\"top.window.location.href='$link/?page=orderinfos.php?id=$orderids'\">$sumCareaux</a></td>
		    	
		    	<td><a href='#' onclick=\"top.window.location.href='$link/?page=orderinfos.php?id=$orderids'\">$argon</a></td>
		    	<td><a href='#' onclick=\"top.window.location.href='$link/?page=orderinfos.php?id=$orderids'\">$poncage</a></td>
		    	<td><a href='#' onclick=\"top.window.location.href='$link/?page=orderinfos.php?id=$orderids'\">$cuisson</a></td>
		    	<td><a href='#' onclick=\"top.window.location.href='$link/?page=orderinfos.php?id=$orderids'\">$sumArticles</a></td></tr>";
		    	$numberOfOrders++;
		    	}

echo"</table><input type='hidden' id='numberOfOrders' value='$numberOfOrders'><input type='hidden' name='destination' id='destination' value='' >
<input type='hidden' name='location' id='location' value='' ></form>";
echo "<br>";




echo "<div align='center'><a href='#' onclick='xls(\"$link\")'><img src='img/excel.png' width='70'></a><div><br><br>";

} }
    ?>
</body>
</html>