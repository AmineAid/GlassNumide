<?php
session_start();
include_once ('database_connection.php');
if(isset($_GET['id']) AND $_GET['id']>0) {
	$orderid=$_GET['id'];
	if(isset($_GET['hidenval']) AND $_GET['hidenval']>0) {
		
		$finalisee=0;
		$payee=0;
		$livree=0;
if(isset($_GET['finalisee']) AND $_GET['finalisee']=="1"){$finalisee=1;}
if(isset($_GET['payee']) AND $_GET['payee']=="1"){$payee=1;}
if(isset($_GET['livree']) AND $_GET['livree']=="1"){$livree=1;}
mysqli_query($dbc,"UPDATE ordercomment SET finalisee='$finalisee',payee='$payee',livree='$livree' WHERE orderid='$orderid'");

	}

	
	$query1="select * from ordercomment WHERE orderid='$orderid'";
	$result1 = mysqli_query($dbc,$query1);
	if($result1){
		if(mysqli_affected_rows($dbc)!=0){
			$row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);
		    		$payee=$row1['payee'];
		    		$finalisee=$row1['finalisee'];
		    		$livree=$row1['livree'];

?>
<head><script> 
   function clickAndDisable(link) {
     // disable subsequent clicks
     link.onclick = function(event) {
        event.preventDefault();
     }
   }   
</script></head>

<div align="center"><form><table><tr><input type="hidden" name="hidenval" value="1">  <input type="hidden" name="id" value="<?php echo $orderid;?>">  
<td>Finalis&eacute;e</td><td><input name="finalisee" type="checkbox" value="1" style="width:60px;" <?php if($finalisee==1){echo "checked";}?> ></td>
<td>Pay&eacute;e</td><td><input name="payee" type="checkbox" value="1" style="width:60px;" <?php if($payee==1){echo "checked";}?> ></td>
<td>Livr&eacute;e</td><td><input name="livree" type="checkbox" value="1" style="width:60px;" <?php if($livree==1){echo "checked";}?> ></td>
<td><input type="submit" value="MAJ"></td><td style="width:20px;"></td>
<td style="border:1px solid black; background:grey; width:100px;" align="center">
	<?php
	$query2="SELECT * FROM arrangedorders WHERE order_id='$orderid'";
	$result2 = mysqli_query($dbc,$query2);
	if($result2 AND mysqli_affected_rows($dbc)!=0){
			echo '<a style="text-decoration:none;" href="arrangeorders.php?id='.$orderid.'&arranged=1" onclick="clickAndDisable(this);">D&eacute;sorganiser</a>';
		}else{
		echo '<a style="text-decoration:none; color:White;"  href="arrangeorders.php?id='.$orderid.'&arranged=0" onclick="clickAndDisable(this);">Arranger</a>';
		} ?>
</td></tr></table></form></div>


<?php
}}


}

?>
</div>
</body></html>