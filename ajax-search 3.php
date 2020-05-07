<?php


include_once ('database_connection.php');

if(isset($_GET['keyword']) AND $_GET['keyword']!="@mine"){
    $keyword = 	trim($_GET['keyword']) ;
$keyword = mysqli_real_escape_string($dbc, $keyword);
setcookie("key", $keyword, time()+3600);
if ($keyword=="@all"){
$query = "select * from orders ORDER BY id desc limit 0,20 ";
}else{
$query = "select * from orders where id like '%$keyword%' or client like '%$keyword%' limit 0,20";
}
$result = mysqli_query($dbc,$query);
if($result){
    if(mysqli_affected_rows($dbc)!=0){
	echo '<table style="font-size: 20px;font-weight:bold;"><tr><td align="center" style="padding:5px;width:30px;">Id</td><td style="padding:5px;width:100px;" align="center" width="300">Date</td>
	<td align="center" style="padding:5px;width:200px;">Client</td><td align="center" style="padding:5px;width:30px;">Nombre d\'articles</td>
	<td align="center" style="padding:20px;width:30px;">Somme</td></tr>';
 $rmt=0;  
	 while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
 $orderids=$row['id'];
     echo "<tr valign='middle'><td valign='middle' align='center'><a style='color:#333333;' href='#' onclick='order(". $orderids .")'><b>$orderids</b></a></td>
     <td valign='middle' align='center'><a style='color:#333333;' href='#' onclick='order(". $orderids .")'><b>".date("d-m-Y",$row['time'])."</b></a></td>
     <td valign='middle' align='center'><a style='color:#333333;' href='#' onclick='order(". $orderids .")'><b>".$row['client']."</b></a></td>";
	 $sumArticles=0;
$query2="select * from articles WHERE order_id='$orderids'";
		$result2 = mysqli_query($dbc,$query2);
		$articlesnumber = mysqli_num_rows($result2);
		while($row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC)){
		    $sumArticles+=round(($row2['q']*$row2['price']*$row2['dimension1']*$row2['dimension2']*0.0001)*100)*0.01;

		}
		    echo"<td valign='middle' align='center'><a style='color:#333333;' href='#' onclick='order('". $orderids .")'><b>$articlesnumber</b></a></td>
		    <td valign='middle' align='center'><a style='color:#333333;' href='#' onclick='order(". $orderids .")'><b>$sumArticles</b></a></td></tr>";
	
	}
echo '</table>';
}else {
        echo 'Aucun Resultat pour :"'.$_GET['keyword'].'"';
    }
	
    

		}else {
        echo 'Aucun Resultat pour :"'.$_GET['keyword'].'"';
    }
}
  /*
}
}elseif(isset($_GET['keyword']) AND $_GET['keyword']=="@mine"){
include_once ('database_connection.php');


$query = "select * from v ORDER BY id desc";

$result = mysqli_query($dbc,$query);
if($result){
    if(mysqli_affected_rows($dbc)!=0){

	echo '<table><tr><td align="center" style="width:100px;">id</td><td align="center" >Date</td><td align="center" width="300">ref</td><td align="center" >Designation</td><td width="100" align="center">Prix U</td><td width="100" align="center">quantit&eacute;</td><td>Prix T</td></tr>';
         while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
		  echo "<tr><td>$row[id]</td><td>$row[date]</td><td>$row[ref]</td><td>$row[des]</td><td>$row[pu]</td><td>$row[q]</td><td>$row[pt]</td></tr>";
		  }
	
	
	}}}

else {
    echo 'Parameter Missing';
}



*/
?>
