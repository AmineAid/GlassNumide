<?php
session_start();
?>
 <html><head>
        <link href="css/style2.css" type="text/css" rel="stylesheet"/>
        <script type="text/javascript">
       
  </script>
        </head><body>
        
<?php
if (isset($_SESSION['lg']) AND $_SESSION['lg']==2){
echo "<table><tr>
<td ><iframe src='productsorder.php' style='width: 60vw;height: 100vh;position: relative;''></iframe></td>
<td><iframe src='defaults.php' style='width: 38vw;height: 100vh;position: relative;''></iframe></td>
<td>dd</td></tr></table>";
}else{
    echo'<script type="text/javascript">window.top.location.reload();</script>';
}
    ?>

        </body>
       </html>