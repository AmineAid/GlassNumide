<?php
$j=date("d-M-Y-H");
$filename="saves/s-$j.sql";
if (!file_exists($filename)){
function dumpmysqli($serveur, $login, $password, $base, $mode)
{
$j=date("d-M-Y-H");
$filename="saves/s-$j.sql";
  include_once ('database_connection.php');
 
    $entete = "-- ----------------------\n";
    $entete .= "-- dump de la base ".$base." au ".date("d-M-Y")."\n";
    $entete .= "-- ----------------------\n\n\n";
    $creations = "";
    $insertions = "\n\n";
 
    $listeTables = mysqli_query($dbc,"show tables");
    while($table = mysqli_fetch_array($listeTables))
    {
        // si l'utilisateur a demandé la structure ou la totale
        if($mode == 1 || $mode == 3)
        {
            $creations .= "-- -----------------------------\n";
            $creations .= "-- creation de la table ".$table[0]."\n";
            $creations .= "-- -----------------------------\n";
            $listeCreationsTables = mysqli_query($dbc,"show create table ".$table[0]);
            while($creationTable = mysqli_fetch_array($listeCreationsTables))
            {
              $creations .= $creationTable[1].";\n\n";
            }
        }
        // si l'utilisateur a demandé les données ou la totale
        if($mode > 1)
        {
            $donnees = mysqli_query($dbc,"SELECT * FROM ".$table[0]);
            $insertions .= "-- -----------------------------\n";
            $insertions .= "-- insertions dans la table ".$table[0]."\n";
            $insertions .= "-- -----------------------------\n";
            while($nuplet = mysqli_fetch_array($donnees))
            {
                $insertions .= "INSERT INTO ".$table[0]." VALUES(";
                for($i=0; $i < mysqli_num_fields($donnees); $i++)
                {
                  if($i != 0)
                     $insertions .=  ", ";
                     $insertions .=  "'";
                  $insertions .= addslashes($nuplet[$i]);
                  
                    $insertions .=  "'";
                }
                $insertions .=  ");\n";
            }
            $insertions .= "\n";
        }
    }
 
   
 
    $fichierDump = fopen("$filename", "wb");
    fwrite($fichierDump, $entete);
    fwrite($fichierDump, $creations);
    fwrite($fichierDump, $insertions);
    fclose($fichierDump);   
    $disks= array('d','e','f','g','h','i');
    for ($h=0; $h <6 ; $h++) { 

$filetest=$disks[$h].":/AMA.save";
if (file_exists($filetest)){
    copy($filename, $disks[$h].":/saves/s-$j.sql");
    $h=8;
    }
}


}
dumpmysqli("localhost", "root", "root", "Numid", 3);
}
?>