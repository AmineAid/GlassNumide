<?php
session_start();
?>
 <html><head>
        <link href="css/style2.css" type="text/css" rel="stylesheet"/>
        <script type="text/javascript">
        function printdiv(){
//
var headstr = "<html><head><title></title></head><body>";
var footstr = "</body>";
var newstr = document.all.item("toprint").innerHTML;
var oldstr = document.body.innerHTML;
document.body.innerHTML = headstr+newstr+footstr;
window.print();
document.body.innerHTML = oldstr;
return false;
}

</script>
        </head><body>
        <div align="center">
<?php
if (isset($_SESSION['lg']) AND $_SESSION['lg']==2){
    include_once ('database_connection.php');
    if(isset($_POST['du'])){
        $du =     trim($_POST['du']) ;
        $au =     trim($_POST['au']) ;
        if($du<=$au){
            ?>
            <form autocomplete='off' name="dataform2" id="dataform2" method="POST" action="data2.php">
        <table id="dates">
        <tr valign="middle"><td valign="middle"><font size=6 color="black">Entre le numero : </td>
            <td valign="middle"><input type="text" value="<?php echo $du;   ?>"name="du"></td><td rowspan=2 align="center"><input value="G&eacute;n&eacute;rer" type="submit"></td></tr>
        <tr><td><font size=6 color="black">Et le numero: </td><td><input type="text" name="au" value="<?php echo $au; ?>"></td></tr>
        </table>
        </form>
        <br><br><br><div id='toprint'><table align='center' id="topinfos">
        <tr><td  style='width:70px;'>Numero</td><td>Client</td><td>Options</td><td style='width:100px;'>Appel</td><td>R&eacute;cup&eacute;r&eacute;e le </td><td>Observation</td></tr>
<?php
            $query1="select * FROM orders WHERE status=1 AND id>=$du AND id<=$au ORDER by id";
        $result1 = mysqli_query($dbc,$query1);
        if($result1){
            if(mysqli_affected_rows($dbc)!=0){
                while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)){
echo"<tr><td style='width:100px;'>".$row1['id']."</td><td>".$row1['client']."</td><td>";
if($row1['argon']=="Oui"){echo " Argon ";}
if($row1['poncage']!="Non"){echo " Pon&ccedil;age ";}
if($row1['cuisson']=="Oui"){echo " Trempe ";}

echo "</td><td  style='width:100px;'></td><td></td><td></td></tr>";
                }


    }

}
?>
</table></div><br><br><br><a href='#' onclick='printdiv()'><img src='img/print.png' width='70'></a>
        <?php
        }else{
echo '<SCRIPT LANGUAGE="JavaScript">
alert("Numéro de commande erroné")
document.location.href="data.php";
</SCRIPT>';
}
}}else{
    echo'<script type="text/javascript">window.top.location.reload();</script>';
}
?>
</div>
        </body>
       </html>