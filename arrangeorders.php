<?php
session_start();
include_once ('database_connection.php');
if(isset($_GET['id']) AND $_GET['id']>0) {
	$orderid=$_GET['id'];
	if(isset($_GET['arranged']) AND $_GET['arranged']=="0"){


		$query1="select * from articles WHERE order_id='$orderid'";
					$result1 = mysqli_query($dbc,$query1);
					if($result1){
		    		if(mysqli_affected_rows($dbc)!=0){

		    			while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)){

						$dimension1 = 	$row1['dimension1'] ;
						$dimension1 = mysqli_real_escape_string($dbc, $dimension1);
						$dimension1 = htmlentities($dimension1);	
						echo "<br>this is dim1 $dimension1 <br>";

						$dimension2 = 	$row1['dimension2'] ;
						$dimension2 = mysqli_real_escape_string($dbc, $dimension2);
						$dimension2 = htmlentities($dimension2);
						echo "<br>this is dim2 $dimension2 <br>";
						$vitre1 = 	trim($row1['vitre1']) ;
						$vitre1 = mysqli_real_escape_string($dbc, $vitre1);
						$vitre1 = htmlentities($vitre1);
						echo "<br>this is V1 $vitre1 <br>";
						$vitre2 = 	trim($row1['vitre2']) ;
						$vitre2 = mysqli_real_escape_string($dbc, $vitre2);
						$vitre2 = htmlentities($vitre2);
						
						$baguette = 	trim($row1['baguette']) ;
						$baguette = mysqli_real_escape_string($dbc, $baguette);
						$baguette = htmlentities($baguette);

						$number = 	trim($row1['q']) ;
						$number = mysqli_real_escape_string($dbc, $number);
						$number = htmlentities($number);

						$sens = 	trim($row1['sens']) ;
						$sens = mysqli_real_escape_string($dbc, $sens);
						$sens = htmlentities($sens);

						$price = trim($row1["price"]);
						$price = mysqli_real_escape_string($dbc, $price);
						$price = htmlentities($price);

if(mysqli_query($dbc,"INSERT INTO arrangedorders  (order_id, dimension1, dimension2, q, vitre1, vitre2, baguette, sens, price) VALUES('$orderid', $dimension1, '$dimension2', '$number', '$vitre1', '$vitre2', '$baguette', '$sens', '$price')")){


}else{

$done=0;
}
	}	}	}
	if(!isset($done)){
if(mysqli_query($dbc,"DELETE from articles WHERE order_id='$orderid' ")){}else{ $done=0;}

}


if(!isset($done)){







$query2="SELECT * FROM arrangedorders WHERE order_id='$orderid'";
echo "order id = $orderid<br>";
					$result2 = mysqli_query($dbc,$query2);
					if($result2){
		    		if(mysqli_affected_rows($dbc)!=0){
		    			$j=1;
		    			while($row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC)){


						${'dimension1'.$j} = $row2["dimension1"];
						${'dimension1'.$j} = mysqli_real_escape_string($dbc, ${'dimension1'.$j});
						${'dimension1'.$j} = htmlentities(${'dimension1'.$j});	


						${'dimension2'.$j} = $row2["dimension2"];
						${'dimension2'.$j} = mysqli_real_escape_string($dbc, ${'dimension2'.$j});
						${'dimension2'.$j} = htmlentities(${'dimension2'.$j});


						${'vitre1'.$j} = 	$row2["vitre1"] ;
						${'vitre1'.$j} = mysqli_real_escape_string($dbc, ${'vitre1'.$j});
						${'vitre1'.$j} = htmlentities(${'vitre1'.$j});
						$v1=${'vitre1'.$j};

						${'vitre2'.$j} = 	$row2['vitre2'];
						${'vitre2'.$j} = mysqli_real_escape_string($dbc, ${'vitre2'.$j});
						${'vitre2'.$j} = htmlentities(${'vitre2'.$j});
						$v2=${'vitre2'.$j};
						

						${'baguette'.$j} = $row2['baguette'];
						${'baguette'.$j} = mysqli_real_escape_string($dbc, ${'baguette'.$j});
						${'baguette'.$j} = htmlentities(${'baguette'.$j});
						$b1=${'baguette'.$j};

						${'number'.$j} = 	trim($row2["q"]) ;
						${'number'.$j} = mysqli_real_escape_string($dbc, ${'number'.$j});
						${'number'.$j} = htmlentities(${'number'.$j});

						${'sens'.$j} = 	trim($row2["sens"]) ;
						${'sens'.$j} = mysqli_real_escape_string($dbc, ${'sens'.$j});
						${'sens'.$j} = htmlentities(${'sens'.$j});
						

						${'price'.$j} = trim($row2["price"]);
						${'price'.$j} = mysqli_real_escape_string($dbc, ${'price'.$j});
						${'price'.$j} = htmlentities(${'price'.$j});
					$oid=$row2['order_id'];
						echo "ROID = $oid /  orderid $orderid / DIM1 ${'dimension1'.$j} /
						  DIM2 ${'dimension2'.$j}  / V1 $v1 /  B1 $b1 /  V2 $v2 / q ${'number'.$j} / sens ${'sens'.$j}<br>";
						$unique=1;
for ($h=1; $h < $j; $h++) {
	echo "h: $h & j: $j<br>";
	echo "dim h=$h  : \'${'dimension1'.$h}\'dim j=$j \'${'dimension1'.$j}\'   AND ${'dimension2'.$h} et ${'dimension2'.$j}<br>";
		if(${'dimension1'.$h}==${'dimension1'.$j} AND ${'dimension2'.$h}==${'dimension2'.$j}){
		echo "Same J an H $j  and $h";
		$number=${'number'.$j};
		$dimension1=${'dimension1'.$j};
		$dimension2=${'dimension2'.$j};
		$idequal=${'id'.$h};

mysqli_query($dbc,"UPDATE articles SET q=q+$number WHERE id='$idequal'");
echo "id equal = $idequal<br>";
$unique=0;

$h=$j;
}else{$unique=1;}
}
if($unique==1){
$dimension1=${'dimension1'.$j};
$dimension2=${'dimension2'.$j};
$number=${'number'.$j};
$vitre1=${'vitre1'.$j};
$vitre2=${'vitre2'.$j};
$baguette=${'baguette'.$j};
$sens=${'sens'.$j};
$price=${'price'.$j};
mysqli_query($dbc,"INSERT INTO articles  (order_id, dimension1, dimension2, q, vitre1, vitre2, baguette, sens, price) VALUES('$orderid', '$dimension1', '$dimension2', '$number', '$vitre1', '$vitre2', '$baguette', '$sens', '$price')");
${'id'.$j}=mysqli_insert_id($dbc);
$j++;


}

}}}

//echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="ordercomment.php?id='.$orderid.'";</SCRIPT>';
echo'<script type="text/javascript">parent.location.reload();</script>';




}
	}elseif(isset($_GET['arranged']) AND $_GET['arranged']=="1"){


mysqli_query($dbc,"DELETE from articles WHERE order_id='$orderid' ");
$query1="select * from arrangedorders WHERE order_id='$orderid'";
					$result1 = mysqli_query($dbc,$query1);
					if($result1){
		    		if(mysqli_affected_rows($dbc)!=0){
		    			while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)){

						$dimension1 = 	trim($row1["dimension1"]) ;
						$dimension1 = mysqli_real_escape_string($dbc, $dimension1);
						$dimension1 = htmlentities($dimension1);	

						$dimension2 = 	trim($row1["dimension2"]) ;
						$dimension2 = mysqli_real_escape_string($dbc, $dimension2);
						$dimension2 = htmlentities($dimension2);

						$vitre1 = 	trim($row1["vitre1"]) ;
						$vitre1 = mysqli_real_escape_string($dbc, $vitre1);
						$vitre1 = htmlentities($vitre1);

						$vitre2 = 	trim($row1["vitre2"]) ;
						$vitre2 = mysqli_real_escape_string($dbc, $vitre2);
						$vitre2 = htmlentities($vitre2);

						$baguette = 	trim($row1["baguette"]) ;
						$baguette = mysqli_real_escape_string($dbc, $baguette);
						$baguette = htmlentities($baguette);

						$number = 	trim($row1["q"]) ;
						$number = mysqli_real_escape_string($dbc, $number);
						$number = htmlentities($number);

						$sens = 	trim($row1["sens"]) ;
						$sens = mysqli_real_escape_string($dbc, $sens);
						$sens = htmlentities($sens);

						$price = trim($row1["price"]);
						$price = mysqli_real_escape_string($dbc, $price);
						$price = htmlentities($price);

if(mysqli_query($dbc,"INSERT INTO articles  (order_id, dimension1, dimension2, q, vitre1, vitre2, baguette, sens, price) VALUES('$orderid', '$dimension1', '$dimension2', '$number', '$vitre1', '$vitre2', '$baguette', '$sens', '$price')")){

}else{ 
$done=0;
}
mysqli_query($dbc,"DELETE from arrangedorders WHERE order_id='$orderid' ");
	}	}	}
echo'<script type="text/javascript">parent.location.reload();</script>';




	}


		    			}
