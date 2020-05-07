<?php
include_once ('database_connection.php');
if(isset($_GET['id'])){
$orderid=$_GET['id'];
$link=$_GET['link'];
if(is_dir("$link") and fopen("$link/test.d", "w")){
mysqli_query($dbc,"UPDATE defaults SET value='$link' WHERE name='destinationxls'");
unlink("$link/test.d");


$query1="select * from orders WHERE id='$orderid'";
	$result1 = mysqli_query($dbc,$query1);
	if($result1){
		if(mysqli_affected_rows($dbc)!=0){
			$row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);
		    		$id_contact=$row1['id_contact'];
		    		$time=$row1['time'];
		    		$status=$row1['status'];
		    		$last_modified=$row1['last_modified'];
		    		$argon=$row1['argon'];
		    		$poncage=$row1['poncage'];
		    		$cuisson=$row1['cuisson'];
					$pnc="";
		    		$toaddv1=0;
		    		$toaddv2=0;
		    		if($argon=='Oui'){
		    			$gaz="GAZ";
		    		}else{
		    			$gaz="";
		    		}
					
		    		if($poncage!='Non'){
		    			if($poncage=='Vitre 1'){$toaddv1 = 0.2 ; $pnc="Ponçage Vitre 1";}
		    			if($poncage=='Vitre 2'){$toaddv2 = 0.2 ; $pnc="Ponçage Vitre 2"; }
		    			if($poncage=='Tout'){$toaddv1 = 0.2 ;$pnc="Ponçage"; $toaddv2 = 0.2 ;}
		    		}
		    		if($cuisson=='Tout'){
		    			$trmp="Trempe: Tout";
		    		}elseif($cuisson=='Vitre 1'){
		    			$trmp="Trempe: Vitre 1";
		    		}elseif($cuisson=='Vitre 2'){
		    			$trmp="Trempe: Vitre 1";
		    		}else{
		    			$trmp="";
		    		}
		    		$versement=$row1['versements'];
		    		$query2="select * from contacts WHERE id='$id_contact'";
					$result2 = mysqli_query($dbc,$query2);
					if($result2){
		    		if(mysqli_affected_rows($dbc)!=0){
		    			$row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
		    			$contactid=$row2['id'];
		    			$contactname=$row2['name'];
		    			$contact=$row2['contact'];
		    			$contactcom=$row2['com'];
		    			}}}


error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/ext/PHP/Classes/PHPExcel.php';

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties=
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("PHPExcel Test Document")
							 ->setSubject("PHPExcel Test Document")
							 ->setDescription("Test document for PHPExcel, generated using PHP classes.")
							 ->setKeywords("office PHPExcel php")
							 ->setCategory("Test result file");


// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Piece Number')
            ->setCellValue('B1', 'X DIM')
            ->setCellValue('C1', 'Y DIM')
            ->setCellValue('D1', 'Customer')
            ->setCellValue('E1', 'Order')
            ->setCellValue('F1', 'MATERIAL CODE')
            ->setCellValue('G1', 'NOTE')
            ->setCellValue('H1', 'RACK')
            ->setCellValue('I1', 'Priority');






$query4="select * from products";
					$result4 = mysqli_query($dbc,$query4);
					if($result4){
		    		if(mysqli_affected_rows($dbc)!=0){
$j=1;
		    	while($row4 = mysqli_fetch_array($result4,MYSQLI_ASSOC)){
		    		$i=$row4['id'];
		    		$idaray[$i]=$j;
		    		$designationproduct[$j]=$row4['designation'];
		    		$referenceproduct[$j]=$row4['reference'];
		    		$j++;
		    	}}}
$query5="select * from articles WHERE order_id='$orderid'";
					$result5 = mysqli_query($dbc,$query5);
					$totalorder=0;
					if($result5){
		    		if(mysqli_affected_rows($dbc)!=0){
		    				# code...
		    			
$i=2;
		    	while($row5 = mysqli_fetch_array($result5,MYSQLI_ASSOC)){
		    		$sens=$row5["sens"];
		    		$idvitre1=$row5["vitre1"];
		    		$idvitre2=$row5["vitre2"];
		    		$idvitre1a=$idaray[$idvitre1];
		    		$filename="$link/$orderid-$contactname-$referenceproduct[$idvitre1a].xls";
		    		if($idvitre1==$idvitre2 AND $poncage!='Vitre 1' AND $poncage!='Vitre 2'){
		    			$same=1;
		    		$q=2*$row5['q'];
		    	}else{
		    		if($idvitre1==$idvitre2){ 
		    		$filename="$link/$orderid-$contactname-$referenceproduct[$idvitre1a]-V1.xls";
		    	}
		    		
		    		$q=$row5['q'];
		    	}
		    		$dimension1=$row5['dimension1'];
		    		$dimension1+=$toaddv1;
		    		$dimension2=$row5['dimension2'];
		    		$dimension2+=$toaddv1;
		    		

$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A'.$i.'', $q)
->setCellValue('B'.$i.'', $dimension1)
->setCellValue('C'.$i.'', $dimension2)
->setCellValue('D'.$i.'', $contactname)
->setCellValue('E'.$i.'', ' '.$orderid.'')
->setCellValue('F'.$i.'', $referenceproduct[$idvitre1a])
->setCellValue('G'.$i.'', $sens)
->setCellValue('H'.$i.'', "$gaz $pnc $trmp");
		$i++;
}}
}








$objPHPExcel->getActiveSheet()->setTitle('Table Numerique');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Save Excel 95 file
$callStartTime = microtime(true);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');


$objWriter->save("$filename");
















if(!isset($same)){
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties=
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("PHPExcel Test Document")
							 ->setSubject("PHPExcel Test Document")
							 ->setDescription("Test document for PHPExcel, generated using PHP classes.")
							 ->setKeywords("office PHPExcel php")
							 ->setCategory("Test result file");


// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Piece Number')
            ->setCellValue('B1', 'X DIM')
            ->setCellValue('C1', 'Y DIM')
            ->setCellValue('D1', 'Customer')
            ->setCellValue('E1', 'Order')
            ->setCellValue('F1', 'MATERIAL CODE')
            ->setCellValue('G1', 'NOTE')
            ->setCellValue('H1', 'RACK')
            ->setCellValue('I1', 'Priority');






$query4="select * from products";
					$result4 = mysqli_query($dbc,$query4);
					if($result4){
		    		if(mysqli_affected_rows($dbc)!=0){
$j=0;
		    	while($row4 = mysqli_fetch_array($result4,MYSQLI_ASSOC)){
		    		$i=$row4['id'];
		    		$idaray[$i]=$j;
		    		$designationproduct[$j]=$row4['designation'];
		    		$referenceproduct[$j]=$row4['reference'];
		    		$j++;
		    	}}}
$query5="select * from articles WHERE order_id='$orderid'";
					$result5 = mysqli_query($dbc,$query5);
					$totalorder=0;
					if($result5){
		    		if(mysqli_affected_rows($dbc)!=0){
		    				# code...
		    			
$i=2;
		    	while($row5 = mysqli_fetch_array($result5,MYSQLI_ASSOC)){
		    		$sens=$row5["sens"];
		    		$idvitre1=$row5["vitre2"];
		    		$q=$row5['q'];
		    		$dimension1=$row5['dimension1'];
		    		$dimension1+=$toaddv2;
		    		$dimension2=$row5['dimension2'];
		    		$dimension2+=$toaddv2;
		    		$idvitre1=$idaray[$idvitre1];

$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A'.$i.'', $q)
->setCellValue('B'.$i.'', $dimension1)
->setCellValue('C'.$i.'', $dimension2)
->setCellValue('D'.$i.'', $contactname)
->setCellValue('E'.$i.'', ' '.$orderid.'')
->setCellValue('F'.$i.'', $referenceproduct[$idvitre1])
->setCellValue('G'.$i.'', $sens)
->setCellValue('H'.$i.'', "$gaz $pnc $trmp");
		$i++;
}}
}








$objPHPExcel->getActiveSheet()->setTitle('Table Numerique');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Save Excel 95 file
$callStartTime = microtime(true);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$filename="$link/$orderid-$contactname-$referenceproduct[$idvitre1].xls";
$objWriter->save("$filename");


echo '<SCRIPT LANGUAGE="JavaScript">
document.location.href="orderinfos.php?id='.$orderid.'";
</SCRIPT>';

}else{
echo '<SCRIPT LANGUAGE="JavaScript">
document.location.href="orderinfos.php?id='.$orderid.'";
</SCRIPT>';

}
}else{
echo '<SCRIPT LANGUAGE="JavaScript">
alert("Destination erronée ou inaccessible!");
document.location.href="orderinfos.php?id='.$orderid.'";
</SCRIPT>';

}}} ?>

