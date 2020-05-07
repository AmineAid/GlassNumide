<?php
session_start();
?>
<html><head>

<link href="css/style2.css" type="text/css" rel="stylesheet"/>
</head><body>
	<?php
include_once ('database_connection.php');
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
$query1 = "select id from contacts ";
$result1 = mysqli_query($dbc,$query1);
$numberOfContacts=mysqli_affected_rows($dbc);
        $numberOfPages=$numberOfContacts/$elementsperpage;
        $numberOfPages+=1;
echo "<div align='center' style='font-size:22px;'>Il y a <b>$numberOfContacts</b> Contacts</div><br><br>" ;
?>
<table align='center' id='contacttable'><tr><td><a href='addcontact.php' style="color:green; margin-right:200px;"><b>Ajouter un contact</b></a></td><td>Lister par :</td><td>
	<form methode="get" name='order'>
	<select name="by"  style="font-size:18px;" onchange=" document.order.submit()">
	<option value="id" >Id</option>
	<option value="name" <?php if($by == "name"){echo 'selected'; }?> >Nom</option>
	<option value="com" <?php if($by == "com"){echo 'selected';} ?> >Region</option>
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
<table align="center" id='contacttable' class="contacttable2" ><tr><td><b>Id</td><td><b>Nom</td><td><b>Region</td><td><b>contact</td></tr>


<?php

$query1 = "select * from contacts ORDER BY $by $order limit $from, $to";
$result1 = mysqli_query($dbc,$query1);
if($result1){
    if(mysqli_affected_rows($dbc)!=0){
    	
    	while($row1=mysqli_fetch_array($result1,MYSQLI_ASSOC)){

$id=$row1['id'];
$name=$row1['name'];
$region=$row1['com'];
$contact=$row1['contact'];
echo"<tr><td><a href='contactinfos.php?id=$id'>$id</a></td><td><a href='contactinfos.php?id=$id'>$name</a></td>
<td><a href='contactinfos.php?id=$id'>$region</a></td><td><a href='contactinfos.php?id=$id'>$contact</a></td></tr>";
    }}}
   

echo'</table><br><br><div align="center">';
 $i=1;
 echo "<table id='pages'><tr><td><h2>Page:</h2></td> ";
    while($i<$numberOfPages){
    	if($i!=$page){
    	echo "<td> <a href='?order=$order&by=$by&page=$i&elementsperpage=$elementsperpage'> <h2>$i</h2>  </a></td>";
    }else{

    	echo "<td> <a href='?order=$order&by=$by&page=$i&elementsperpage=$elementsperpage'> <h3>$i</h3>  </a></td>";
    }
    	if ($i%20 == 0){
    		echo"</tr><tr>";
    	}
    	$i++;
    }
    echo '</tr></table></div>';
    ?>
</body>
</html>