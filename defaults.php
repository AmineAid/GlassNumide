<?php
session_start();
?>
 <html><head>
        <link href="css/style2.css" type="text/css" rel="stylesheet"/>
        <style type="text/css">
        #settingstable input{
            font-weight: bold;
            font-size:20px;
            width:100px;
        }
        </style>
        <script type="text/javascript">
        function onlynumbers(evt) {
  var theEvent = evt || window.event;
  var key = theEvent.keyCode || theEvent.which;
  if ((key < 48 || key > 57) && !(key == 8 || key == 9 || key == 13 || key == 37 || key == 46) ){
    theEvent.returnValue = false;
    if (theEvent.preventDefault) theEvent.preventDefault();
  }}
  function uploadform(){
    if (document.getElementById('npassword').value != document.getElementById('password').value){
        alert('Les champs "Nouveau Mot de passe" et "Confirmation Mot de passe" ne correspondent pas!');
    }else{
        document.default.submit()
    }
  }
  </script>
        </head><body>
        <div align="center">
<?php
if (isset($_SESSION['lg']) AND $_SESSION['lg']==2){
    include_once ('database_connection.php');
    if(isset($_POST['argon'])){

$oldpassword=$_POST["oldpassword"];
$oldpassword = mysqli_real_escape_string($dbc, $oldpassword);
$password=$_POST["password"];
$password = mysqli_real_escape_string($dbc, $password);
$cuisson=$_POST["cuisson"];
$cuisson = mysqli_real_escape_string($dbc, $cuisson);
$argon=$_POST["argon"];
$argon = mysqli_real_escape_string($dbc, $argon);
$poncage=$_POST["poncage"];
$poncage = mysqli_real_escape_string($dbc, $poncage);
$ajustement=$_POST["ajustement"];

//$ajustement = mysqli_real_escape_string($dbc, $ajustement);
//$ajustementinf=$_POST["ajustementinf"];
$ajustementinf=0;
//$ajustementinf = mysqli_real_escape_string($dbc, $ajustementinf);
//$seuilajustement=$_POST["seuilajustement"];
$seuilajustement=0;
//$seuilajustement = mysqli_real_escape_string($dbc, $seuilajustement);

$query1="select value from defaults WHERE name='password'";
    $result1 = mysqli_query($dbc,$query1);
                $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);
$realpassword=$row1['value'];
                    if($oldpassword != null AND $oldpassword == $realpassword){

if (!mysqli_query($dbc,"UPDATE defaults SET value='$password' WHERE name='password' ")){
    echo "<div id='error' align='center'>Une erreur s&#39;est produite 0x01<br></div>", mysqli_error($dbc); die; }

}elseif($oldpassword != null AND $oldpassword != $realpassword){
echo'<script type="text/javascript">alert("Mot de passe incorrect!");</script>';
die;
}

if (!mysqli_query($dbc,"UPDATE defaults SET value='$cuisson' WHERE name='cuisson' ")){
echo "<div id='error' align='center'>Une erreur s&#39;est produite 0x02<br></div>", mysqli_error($dbc); die; }
if (!mysqli_query($dbc,"UPDATE defaults SET value='$argon' WHERE name='argon' ")){
echo "<div id='error' align='center'>Une erreur s&#39;est produite 0x03<br></div>", mysqli_error($dbc); die; }
if (!mysqli_query($dbc,"UPDATE defaults SET value='$poncage' WHERE name='poncage' ")){
echo "<div id='error' align='center'>Une erreur s&#39;est produite 0x04<br></div>", mysqli_error($dbc); die; }
if (!mysqli_query($dbc,"UPDATE defaults SET value='$ajustement' WHERE name='ajustement' ")){
echo "<div id='error' align='center'>Une erreur s&#39;est produite 0x05<br></div>", mysqli_error($dbc); die; }
if (!mysqli_query($dbc,"UPDATE defaults SET value='$ajustementinf' WHERE name='ajustementinf' ")){
echo "<div id='error' align='center'>Une erreur s&#39;est produite 0x06<br></div>", mysqli_error($dbc); die; }
if (!mysqli_query($dbc,"UPDATE defaults SET value='$seuilajustement' WHERE name='seuilajustement' ")){
echo "<div id='error' align='center'>Une erreur s&#39;est produite  0x07 <br></div>", mysqli_error($dbc); die; }

 echo '<div id="added" align="center">Param&egrave;tres modifi&eacute;s! <br><br></div>';

    }





$query3="select * from defaults";
    $result3 = mysqli_query($dbc,$query3);
                while ($row3 = mysqli_fetch_array($result3,MYSQLI_ASSOC)){
                    $defaultname=$row3['name'];
$default["$defaultname"] = $row3['value'];
}

            echo "<div align='center'> <form name='default' method='POST'> 
            <table id='settingstable'>
            <tr><td><h3>Argon</h3></td><td><input name='argon' value='" . $default['argon']. "'> Da</td></tr>
            <tr><td><h3>Trempe</h3></td><td><input name='cuisson' value='" . $default['cuisson']. "'> Da</td></tr>
            <tr><td><h3>Pon&ccedil;age</h3></td><td><input name='poncage' value='" . $default['poncage']. "'> Da</td></tr>
            <tr><td><h3>Ajustement du Prix</h3></td><td><input name='ajustement' value='" . $default['ajustement']. "'> Da</td></tr>
            <tr><td><h3>Ancient Mot de passe</h3></td><td><input type='password' id='oldpassword' name='oldpassword' ></td></tr>
            <tr><td><h3>Nouveau Mot de passe</h3></td><td><input type='password' id='npassword' name='npassword' ></td></tr>
            <tr><td><h3>Confirmation Mot de passe</h3></td><td><input type='password' id='password' name='password' ></td></tr>
            <tr><td colspan='2' align='center'><a href='#' onclick='uploadform()'> 
            <img src='img/validate.png' width='70'></a></td></tr></table></form>";

}




?>

</div>
        </body>
       </html>