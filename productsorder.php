<?php
session_start();
?>
 <html><head>
        <link href="css/style2.css" type="text/css" rel="stylesheet"/>
        <script type="text/javascript">
        function onlynumbers(evt) {
  var theEvent = evt || window.event;
  var key = theEvent.keyCode || theEvent.which;
  if ((key < 48 || key > 57) && !(key == 8 || key == 9 || key == 13 || key == 37 || key == 46) ){
    theEvent.returnValue = false;
    if (theEvent.preventDefault) theEvent.preventDefault();
  }}
  </script>
        </head><body>
        <div align="center">
<?php
if (isset($_SESSION['lg']) AND $_SESSION['lg']==2){
    include_once ('database_connection.php');
    if(isset($_POST['maxi1']) OR isset($_POST['maxi2'])){
    if(isset($_POST['maxi1'])){
$pr=1;
}else{
    $pr=2;
}
$maxi=$_POST["maxi$pr"];
$i=1;
while ($i <= $maxi) {
    $id=$_POST["id$pr$i"];
    $listing=$_POST["listing$pr$i"];
if(!mysqli_query($dbc,"UPDATE products SET listing='$listing' WHERE id='$id'")){$e=1;}
$i++;
}
if(isset($e)){
echo '<div align="center"><font color=red size=5>Une erreur s&#39;est produite </font></div>';
        }else{
            echo '<div id="added" align="center">Listing modifi&eacute;! <br><br></div>';
        }

    }





            $query4 = "SELECT * FROM products WHERE type=1 ORDER BY listing";
                $result4 = mysqli_query($dbc,$query4);
                if($result4){                
                if(mysqli_affected_rows($dbc)!=0){
                $maxi=mysqli_affected_rows($dbc);            
                $i=1;

            echo "<div align='center'> <form name='products1' method='POST'> <table id='settingstable'><tr><td colspan='5' align='center'>Verre</td></tr>
            <tr><td align='center'>Reference</td><td align='center'>D&eacute;signation</td><td align='center'>Prix</td><td align='center'>Ordre</td>
            <td rowspan='$maxi' align='center'><a href='#' onclick='document.products1.submit()'> <img src='img/validate.png' width='70'></a></td></tr>";

                while($row4 = mysqli_fetch_array($result4,MYSQLI_ASSOC)){
                $productid=$row4['id'];
                $designation=$row4['designation'];
                $reference=$row4['reference'];
                $price=$row4['price'];
                $listing=$row4['listing'];
                echo"<tr>
                <td><input name='id1".$i."' value='$productid' type='hidden'><a href='editproduct.php?idproduct=$productid'>$reference</a></td>
                <td><a href='editproduct.php?idproduct=$productid'>$designation</a></td>
                <td><a href='editproduct.php?idproduct=$productid'>$price</a></td>
                <td><input name='listing1".$i."' style='width:50px;' onkeypress='onlynumbers(event)'value='$listing'></td>";
$i++;
}}}

echo "<input name='maxi1' value='$maxi' type='hidden'></table></form>";







$query4 = "SELECT * FROM products WHERE type=2 ORDER BY listing";
                $result4 = mysqli_query($dbc,$query4);
                if($result4){                
                if(mysqli_affected_rows($dbc)!=0){
                $maxi=mysqli_affected_rows($dbc);            
                $i=1;

            echo "<form name='products2' method='POST'> <table id='settingstable'><tr><td colspan='5' align='center'>Baguettes</td></tr>
            <tr><td align='center'>Reference</td><td align='center'>D&eacute;signation</td><td align='center'>Prix</td><td align='center'>Ordre</td>
            <td rowspan='$maxi' align='center'><a href='#' onclick='document.products2.submit()'> <img src='img/validate.png' width='70'></a></td></tr>";

                while($row4 = mysqli_fetch_array($result4,MYSQLI_ASSOC)){
                $productid=$row4['id'];
                $designation=$row4['designation'];
                $reference=$row4['reference'];
                $price=$row4['price'];
                $listing=$row4['listing'];
                echo"<tr>
                <td><input name='id2".$i."' value='$productid' type='hidden'><a href='editproduct.php?idproduct=$productid'>$reference</a></td>
                <td><a href='editproduct.php?idproduct=$productid'>$designation</a></td>
                <td><a href='editproduct.php?idproduct=$productid'>$price</a></td>
                <td><input name='listing2".$i."' style='width:50px;' onkeypress='onlynumbers(event)'value='$listing' autocompeat='off'></td>";
$i++;
}}}

echo "<input name='maxi2' value='$maxi' type='hidden'></table></td></tr></table></form>";




}?>

</div>
        </body>
       </html>