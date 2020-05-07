<?php
session_start();
?>
 <html><head>
        <link href="css/style2.css" type="text/css" rel="stylesheet"/>
        </head><body>
        <div align="center">
<?php
if (isset($_SESSION['lg']) AND $_SESSION['lg']==2){
    include_once ('database_connection.php');
    if(isset($_POST['du'])){
        $du =     trim($_POST['du']) ;
        $au =     trim($_POST['au']) ;
        if($du=strtotime($du) AND $au=strtotime($au)){
            $au+=82800;

            ?>

            <form autocomplete='off' name="dataform" id="dataform" method="POST" action="data.php">
            <table id="dates">
            <tr valign="middle"><td valign="middle"><font size=6 color="black">Entre le : </td>
            <td valign="middle"><input type="text" value="<?php echo date('d-m-Y', $du)  ?>"name="du"></td><td rowspan=2 align="center"><input value="Calculer" type="submit"></td></tr>
            <tr><td><font size=6 color="black">Et le : </td><td><input type="text" name="au" value="<?php echo date('d-m-Y', $au); ?>"></td></tr>
            </table>
            </form><table>
            <?php 
            /*

            





            */
mysqli_query($dbc,"DELETE FROM tempdata WHERE 1");
$query4 = "SELECT * FROM products";
                $result4 = mysqli_query($dbc,$query4);
                if($result4){                                                          
                $result4 = mysqli_query($dbc,$query4);
                while($row4 = mysqli_fetch_array($result4,MYSQLI_ASSOC)){
                $productid=$row4['id'];
                $reference=$row4['reference'];
                $type=$row4['type'];
mysqli_query($dbc,"INSERT INTO tempdata (product_id, productref, q, d, type) VALUES  ('$productid','$reference',0,0, '$type' )");
}}



mysqli_query($dbc,"DELETE FROM tempdata2 WHERE 1");
$query4 = "SELECT * FROM contacts";
                $result4 = mysqli_query($dbc,$query4);
                if($result4){                                                          
                $result4 = mysqli_query($dbc,$query4);
                while($row4 = mysqli_fetch_array($result4,MYSQLI_ASSOC)){
                $contactid=$row4['id'];
                $name=$row4['name'];
                $region=$row4['com'];
                $contact=$row4['contact'];
mysqli_query($dbc,"INSERT INTO tempdata2 (contactid, name, region, contact,orders,q,d,ordersvalue) VALUES  ('$contactid','$name','$region','$contact',0,0,0,0)");
//echo "<div id='error' align='center'>Une erreur s&#39;est produite <br></div>", mysqli_error($dbc);
}}




            $query = "SELECT id FROM orders WHERE argon='Oui' AND time>$du AND time<$au ";
            $result = mysqli_query($dbc,$query);                                                              //Nombre de commandes Argon
            if($result){ $numberOfOrdersArgon=mysqli_affected_rows($dbc);}

            $query = "SELECT id FROM orders WHERE poncage!='Non' AND time>$du AND time<$au";                    //Nombre de commandes Poncage
            $result = mysqli_query($dbc,$query);
            if($result){ $numberOfOrdersPoncage=mysqli_affected_rows($dbc);}

            $query = "SELECT id FROM orders WHERE cuisson='Oui' AND time>$du AND time<$au";                    //Nombre de commandes Cuisson
            $result = mysqli_query($dbc,$query);
            if($result){ $numberOfOrdersCuisson=mysqli_affected_rows($dbc);}


            $query = "SELECT id FROM orders WHERE status='0' AND time>$du AND time<$au";
            $result = mysqli_query($dbc,$query);                                                                 //Nombre de commandes Annulees
            if($result){ $numberOfCanceledOrders=mysqli_affected_rows($dbc);}



                $query = "SELECT * FROM orders WHERE time>$du AND time<$au";
                $result = mysqli_query($dbc,$query);
                if($result){                                                             //Nombre de commandes 
                $numberOfOrders=mysqli_affected_rows($dbc);
                $sum_versements=0;                                       //Somme Versements
                $sum_dimensions1=0;                                      //Somme dimension1 tous les bons
                $sum_dimensions2=0;                                      //somme dimension2 tous les bons
                $sum_nombredecareaux=0;                                           //Somme nombre de careaux tous les bons
                $sum_price=0;
                $query = "SELECT * FROM orders WHERE time>$du AND time<$au AND status!=0";
                $result = mysqli_query($dbc,$query);
                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                    $dd=0;
                    $sum_nombredecareauxparbon=0; 
                    $sum_pricebon=0; 
                    $sum_versements+=$row['versements'];
                $orderid=$row['id'];
                $id_contact=$row['id_contact'];
                mysqli_query($dbc,"UPDATE tempdata2 SET orders=orders+1 WHERE contactid='$id_contact'");
                $query2 = "SELECT * FROM articles where order_id='$orderid'"; 
                $result2 = mysqli_query($dbc,$query2);

                while($row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC)){
                    $product1id=$row2['vitre1'];
                    $product2id=$row2['vitre2'];
                    $product3id=$row2['baguette'];
                $sum_dimensions1+=$row2['dimension1']*$row2['q'];                                      //Somme dimension1 tous les bons
                $sum_dimensions2+=$row2['dimension2']*$row2['q'];                                      //Somme dimension1 tous les bons
                $sum_nombredecareaux+=$row2['q'];                                      //Somme dimension1 tous les bons
                $sum_nombredecareauxparbon+=$row2['q'];                                      //Somme dimension1 tous les bons
                $q=$row2['q'];
                $d=$row2['dimension1']*$row2['dimension2']*0.0001;
                $dd+=$d;
                $sum_price+=$row2['price']*$row2['dimension1']*$row2['dimension2']*$row2['q']*0.0001;      //Somme valeur de tous les bons
                $sum_pricebon+=$row2['price']*$row2['dimension1']*$row2['dimension2']*$row2['q']*0.0001;      //Somme valeur de tous les bons
                mysqli_query($dbc,"UPDATE tempdata SET q=q+$q, d=d+$d WHERE product_id='$product1id'");
                mysqli_query($dbc,"UPDATE tempdata SET q=q+$q, d=d+$d WHERE product_id='$product2id'");
                mysqli_query($dbc,"UPDATE tempdata SET q=q+$q, d=d+$d WHERE product_id='$product3id'");

            }
            mysqli_query($dbc,"UPDATE tempdata2 SET ordersvalue=ordersvalue+$sum_pricebon WHERE contactid='$id_contact'");
            mysqli_query($dbc,"UPDATE tempdata2 SET d=d+$dd WHERE contactid='$id_contact'");
            mysqli_query($dbc,"UPDATE tempdata2 SET q=q+$sum_nombredecareauxparbon WHERE contactid='$id_contact'");


// par produit











        } }







/*

            Nombre de Commandes                                           ok
            Total des commandes                                           ok
            Somme moyenne pour un commandes                               ok

            
            Poucentages des commandes avec ARGON                            ok
            Poucentages des commandes avec PONCAGE                          ok
            Poucentages des commandes avec TREMPE                           ok
            Pourcentage moyen des verssements            ok
            
            produits les plus utilisés par nombre de carreaux               
            produits les plus utilisés par m2                               

            Moyenne des dimentions                        

            Meilleurs clients nombre de Commandes                            
            Meilleurs clients valeur des Commandes                           



            





*/





            //code here
            if($numberOfOrders!=0){
        echo"<table style='font-size:22px;'><tr><td>Nombre de commandes:</td><td style='padding:10px 20px;'>$numberOfOrders</td><td style='padding:5px 50px;'>Nombre de commandes avec option ARGON:</td><td style='padding:5px 20px;'>$numberOfOrdersArgon</td><td style='padding-left:40px;'>". round(($numberOfOrdersArgon/$numberOfOrders)*10000)*0.01 ."&#37;</td></tr>";
        echo"<tr><td>Valeurs des commandes:</td><td style='padding:10px 20px;'>". round($sum_price*100)*0.01 ." DA</td><td style='padding:5px 50px;'>Nombre de commandes avec option PONCAGE:</td><td style='padding:5px 20px;'>$numberOfOrdersPoncage</td><td style='padding-left:40px;'>". round(($numberOfOrdersPoncage/$numberOfOrders)*10000)*0.01 ."&#37;</td></tr>";
        echo"<tr><td>Valeurs Moyenne de commande:</td><td style='padding:10px 20px;'>". round(($sum_price/$numberOfOrders)*100)*0.01 ." DA</td><td style='padding:5px 50px;'>Nombre de commandes avec option TREMPE:</td><td style='padding:5px 20px;'>$numberOfOrdersCuisson</td><td style='padding-left:40px;'>". round(($numberOfOrdersCuisson/$numberOfOrders)*10000)*0.01 ."&#37;</td></tr>";
echo "</table>";
echo "<br><br><table id='topp'>
<tr><td colspan='3' align='center'>Produits les plus utilis&eacute;s</td></tr>
<tr><td align='center'>Verres (N de carreaux)</td><td align='center'>Baguettes</td><td align='center'>Verre (M&sup2;)</td></tr><tr><td valign='top'><table id='topp2'><tr><td width='200'>Reference</td><td>Quantit&eacute;</td></tr>";

$query1="select * from tempdata WHERE type=1 ORDER by q desc";
        $result1 = mysqli_query($dbc,$query1);
        if($result1){
            if(mysqli_affected_rows($dbc)!=0){
                while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)){
                    $idproduct=$row1['product_id'];
                    $ref=$row1['productref'];
                    $q=$row1['q'];
                    echo "<tr><td><a href='editproduct.php?idproduct=$idproduct'>$ref</a></td><td style='padding:10px 20px;'> $q </td></tr> ";
                   
}}}
echo "</table></td><td valign='top'><table id='topp2'><tr><td width='200'>Reference</td><td>Quantit&eacute;</td></tr>";
$query1="select * from tempdata WHERE type=2 ORDER by q desc";
        $result1 = mysqli_query($dbc,$query1);
        if($result1){
            if(mysqli_affected_rows($dbc)!=0){
                while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)){
                    $idproduct=$row1['product_id'];
                    $ref=$row1['productref'];
                    $q=$row1['q'];
                    echo "<tr><td style='padding:10px 20px;'><a href='editproduct.php?idproduct=$idproduct'>$ref</a></td><td style='padding:10px 20px;'> $q </td></tr> ";
                   
}}}
echo "</table></td><td valign='top'><table id='topp2'><tr><td width='200'>Reference</td><td>Quantit&eacute;</td></tr>";
$query1="select * from tempdata WHERE type=1 ORDER by d desc";
        $result1 = mysqli_query($dbc,$query1);
        if($result1){
            if(mysqli_affected_rows($dbc)!=0){
                while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)){
                    $idproduct=$row1['product_id'];
                    $ref=$row1['productref'];
                    $d=$row1['d'];
                    echo "<tr><td style='padding:10px 20px;'><a href='editproduct.php?idproduct=$idproduct'>$ref</a></td><td style='padding:10px 20px;'> $d </td></tr> ";
                   
}}}
echo "</table></td></tr></table>";



















echo "<br><br><table id='topp'>
<tr><td colspan='4' align='center'><font size='6'><b>Classement Clients</b></font></td></tr>
<tr><td align='center'><b>Par N De Commandes</b></td><td align='center'><b>Par Valeurs Des Commandes</b></td>
<td align='center'><b>Nombre de Carreaux</b></td>
<td align='center'><b>Surface des Carreaux (M&sup2;)</b></td></tr>
<tr><td valign='top'><table id='topp2'><tr><td width='200'><u>Client</u></td><td><u>Quantit&eacute;</u></td></tr>";

$query1="select * from tempdata2 ORDER by orders desc";
        $result1 = mysqli_query($dbc,$query1);
        if($result1){
            if(mysqli_affected_rows($dbc)!=0){
                while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)){
                    $contactid=$row1['contactid'];
                    $name=$row1['name'];
                    $region=$row1['region'];
                    $orders=$row1['orders'];
                    echo "<tr><td><a href='contactinfos.php?id=$contactid'>$name - <font size='4'><i>$region</i></font></a></td><td style='padding:10px 20px;'> $orders </td></tr> ";
                   
}}}
echo "</table></td><td valign='top'><table id='topp2'><tr><td width='200'><u>Client</u></td><td><u>Quantit&eacute;</u></td></tr>";
$query1="select * from tempdata2  ORDER by ordersvalue desc";
        $result1 = mysqli_query($dbc,$query1);
        if($result1){
            if(mysqli_affected_rows($dbc)!=0){
                while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)){
                    $contactid=$row1['contactid'];
                    $name=$row1['name'];
                    $region=$row1['region'];
                    $ordersvalue=$row1['ordersvalue'];
                    echo "<tr><td><a href='contactinfos.php?id=$contactid'>$name - <font size='4'><i>$region</i></font></a></td><td style='padding:10px 20px;'> $ordersvalue </td></tr> ";
                   
}}}
echo "</table></td><td valign='top'><table id='topp2'><tr><td width='200'><u>Client</u></td><td><u>Quantit&eacute;</u></td></tr>";
$query1="select * from tempdata2 ORDER by q desc";
        $result1 = mysqli_query($dbc,$query1);
        if($result1){
            if(mysqli_affected_rows($dbc)!=0){
                while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)){
                    $contactid=$row1['contactid'];
                    $name=$row1['name'];
                    $region=$row1['region'];
                    $orders=$row1['orders'];
                    $q=$row1['q'];
                    echo "<tr><td><a href='contactinfos.php?id=$contactid'>$name - <font size='4'><i>$region</i></font></a></td><td style='padding:10px 20px;'> $q </td></tr> ";
                   
}}}
echo "</table></td><td valign='top'><table id='topp2'><tr><td width='200'><u>Client</u></td><td><u>Quantit&eacute;</u></td></tr>";
$query1="select * from tempdata2 ORDER by d desc";
        $result1 = mysqli_query($dbc,$query1);
        if($result1){
            if(mysqli_affected_rows($dbc)!=0){
                while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)){
                    $contactid=$row1['contactid'];
                    $name=$row1['name'];
                    $region=$row1['region'];
                    $orders=$row1['orders'];
                    $d=$row1['d'];
                    echo "<tr><td><a href='contactinfos.php?id=$contactid'>$name - <font size='4'><i>$region</i></font></a></td><td style='padding:10px 20px;'> $d </td></tr> ";
                   
}}}

echo "</table></td></tr></table>";






}else{
    echo'<font size="6">Aucune commande a afficher</font><br>';
}

        }else{ // date error
            $avant=time()-2592000;
            $avant=date('d-m-Y', $avant);
            echo 'Date erron&eacute;e!';
            ?>
            <form autocomplete='off' name="dataform" id="dataform" method="POST" action="data.php">
            <table id="dates">
            <tr valign="middle"><td valign="middle"><font size=6 color="black">Entre le : </td>
            <td valign="middle"><input type="text" value="<?php echo $avant;   ?>"name="du"></td><td rowspan=2 align="center"><input value="Calculer" type="submit"></td></tr>
            <tr><td><font size=6 color="black">Et le : </td><td><input type="text" name="au" value="<?php echo date("d-m-Y"); ?>"></td></tr>
            </table>
            </form>

            <?php

        }
    }else{   //no POST
        $lastorderid=0;
        $fromid=0;
        $avant=date("d-m-Y");
        $avant=strtotime($avant);
        $avant=$avant-2592000;
        $avant=date('d-m-Y', $avant);
         $query1="select * from orders WHERE status=1 ORDER by id desc limit 0,1";
        $result1 = mysqli_query($dbc,$query1);
        if($result1){
            if(mysqli_affected_rows($dbc)!=0){
                while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)){
                    $lastorderid=$row1['id'];
                    if($lastorderid>20){
                    $fromid=$lastorderid-20;
                }
                }}}
    ?>
        <form autocomplete='off' name="dataform" id="dataform" method="POST" action="data.php">
        <table id="dates">
        <tr valign="middle"><td valign="middle"><font size=6 color="black">Entre le : </td>
            <td valign="middle"><input type="text" value="<?php echo $avant;   ?>"name="du"></td><td rowspan=2 align="center"><input value="Calculer" type="submit"></td></tr>
        <tr><td><font size=6 color="black">Et le : </td><td><input type="text" name="au" value="<?php echo date("d-m-Y"); ?>"></td></tr>
        </table>
        </form>


<br><hr><br><br><h2>Liste des commandes.</h2>
<form autocomplete='off' name="dataform2" id="dataform2" method="POST" action="data2.php">
        <table id="dates">
        <tr valign="middle"><td valign="middle"><font size=6 color="black">Entre le numero : </td>
            <td valign="middle"><input type="text" value="<?php echo $fromid;   ?>"name="du"></td><td rowspan=2 align="center"><input value="G&eacute;n&eacute;rer" type="submit"></td></tr>
        <tr><td><font size=6 color="black">Et le numero: </td><td><input type="text" name="au" value="<?php echo $lastorderid; ?>"></td></tr>
        </table>
        </form>
        <?php
    }

}else{
    echo'<script type="text/javascript">window.top.location.reload();</script>';
}
?>
</div>
        </body>
       </html>