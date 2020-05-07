<?php
Session_start();
?>
<html><head>
<link href="css/style2.css" type="text/css" rel="stylesheet"/>
</head><body>

		
              
          	
			<?php 
if(isset($_GET['id'])){

	include_once ('database_connection.php');

	$id=$_GET['id'];
	$query1="select name, contact, com from contacts WHERE id='$id'";
	$result1 = mysqli_query($dbc,$query1);
	$row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);
	if($result1){
		if(mysqli_affected_rows($dbc)!=0){
			$name=$row1['name'];
			$region=$row1['com'];
			$contact=$row1['contact'];

			$query2="select * from orders WHERE id_contact='$id' AND status='1'";
			$result2 = mysqli_query($dbc,$query2);
			$numberOfOrders=mysqli_affected_rows($dbc);
			$sumArticles=0;
	    	while($row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC)){
	    		$orderids=$row2['id'];
				$query3="select * from articles WHERE order_id='$orderids'";
				$result3 = mysqli_query($dbc,$query3);
	    		while($row3 = mysqli_fetch_array($result3,MYSQLI_ASSOC)){
		    		
		    	$sumArticles+=round(($row3['q']*$row3['price']*$row3['dimension1']*$row3['dimension2']*0.0001)*100)*0.01;

}
	    	}
	    	$result4 = mysqli_query($dbc,"SELECT SUM(valeur) AS valeur_sum FROM versements WHERE id_contact='$id'"); 

			$row4 = mysqli_fetch_array($result4,MYSQLI_ASSOC); 
			$sumVersement = $row4['valeur_sum'];
			if($sumVersement=="")$sumVersement=0;
					
			$sold=$sumVersement-$sumArticles;
			echo '<table id="contactinfotable" align="center">';
			echo "<tr><td >";	
			echo "<table id='contactinfotable2'>";
			echo "<tr><td>Nom:	   </td><td> $name </td></tr>";
			echo "<tr><td>Region: </td><td> $region </td></tr>";
			echo "<tr><td>Contact: </td><td> $contact </td></tr>";
			echo "<tr><td>Nombre de commandes: </td><td align='center'> $numberOfOrders </td></tr>";
			echo "<tr><td>Total: </td><td> $sumArticles DA </td></tr>";
			echo "</table>";
			echo "</td><td valign='midle' align='center'> <a href='addorder.php?contactid=$id'>Nouvelle commande</a></td>";
			echo "<tr><td align='center'><a href='editcontact.php?id=$id'> Modifier Les Informations </td>";
			echo "<td><a href='orders.php?contactid=".$id."'>Afficher les commandes<a></td>";
			echo "<tr>";
			echo "</table>";
	
		}
	}
}
			?>
			
		
			
			
			
			
	  
</body>
</html>