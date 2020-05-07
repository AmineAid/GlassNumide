<?php
  include_once ('database_connection.php');
 $query1="select id from orders";
    $result1 = mysqli_query($dbc,$query1);
    if($result1){
        if(mysqli_affected_rows($dbc)!=0){
           while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)){
            $id=$row1['id'];
if (!mysqli_query($dbc,"INSERT INTO ordercomment  (orderid, payee, finalisee, livree) VALUES('$id' ,0 ,0 ,0)")){
    echo "<div id='error' align='center'>Une erreur s&#39;est produite <br></div>", mysqli_error($dbc);
            echo "$id <br>";
           }
}}}
/* 
creat ordercomment table

execute update.php

add 
        <iframe style="width:100%; height:40px;border:0px;"src="ordercomment.php?id=<?php echo $orderid; ?>"></iframe>

    to orderinfo.php toremove1 section

*/
?>
