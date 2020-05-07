<?php
//params
	error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	date_default_timezone_set('Europe/London');
	define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
												

include_once ('database_connection.php');
if(isset($_GET['selectedOrders'])){
	$location=$_GET['location'];
	$ordersid=$_GET['selectedOrders'];
	$destination=$_GET['destination'];


	if(is_dir("$destination") and fopen("$destination/test.d", "w")){
		mysqli_query($dbc,"UPDATE defaults SET value='$destination' WHERE name='destinationxls'");

		unlink("$destination/test.d");


		$newV=0;
		for ($H=0; $H < sizeof($ordersid); $H++) {


			$currentOrderId=explode('_', $ordersid[$H])[1];
			$svDv=explode('_', $ordersid[$H])[0];
			if($svDv=="dv"){
				$database="Numid";
			}else{
				$database="Numid2";
			}
			$same=0;
			$query1="select * from $database.orders WHERE id = '$currentOrderId'";
			$result1 = mysqli_query($dbc,$query1);
			if($result1){
				if(mysqli_affected_rows($dbc)!=0){
					$row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);
	
		    		$id_contact=$row1['id_contact'];
		    		$contactname=$row1['client'];
		    		$time=$row1['time'];
		    		$status=$row1['status'];
		    		$last_modified=$row1['last_modified'];
		    		$argon=' ';
		    		
		    		if($svDv=="dv"){
		    			$argon=$row1['argon'];
		    		}
		    		
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

		    		



					$query4="select * from $database.products";
					$result4 = mysqli_query($dbc,$query4);
					if($result4){
						if(mysqli_affected_rows($dbc)!=0){
							$j=1;
							while($row4 = mysqli_fetch_array($result4,MYSQLI_ASSOC)){
								$is=$row4['id'];
								$idaray[$is]=$j;
								$designationproduct[$j]=$row4['designation'];
								$referenceproduct[$j]=$row4['reference'];
								$j++;
							}
						}
					}








				
					$vitreCurrent=1;
					while( $vitreCurrent < 3 ){
						$result5 = mysqli_query($dbc,"select * from $database.articles WHERE order_id='$currentOrderId'");

						if($result5){
							if(mysqli_affected_rows($dbc)!=0){
								while($row5 = mysqli_fetch_array($result5,MYSQLI_ASSOC)){
//									echo "here2"; die;
									$idvitre1=$row5["vitre1"];
									$idvitre2="";
									if($svDv=="dv"){
										$idvitre2=$row5["vitre2"];
									}
									$idvitre=$row5["vitre".$vitreCurrent.""];
									$q=$row5['q'];
									if($idvitre1==$idvitre2 AND $poncage!='Vitre 1' AND $poncage!='Vitre 2'){
						    			$same=1;
						    			$q=2*$row5['q'];
									}else{
										if($idvitre1==$idvitre2){
											$same=2;
										}
									}

									
									$time= date("d_m",time()); 
									if(!isset($filename[$idvitre]) ){
										
										$idvitrea=$idaray[$idvitre];
										$idsArray[$newV]=$idvitre;

										$filename[$idvitre]="$destination/$referenceproduct[$idvitrea]_$time.xls";

										require_once dirname(__FILE__) . '/ext/PHP/Classes/PHPExcel.php';
										// Create new PHPExcel object
										$objPHPExcel[$idvitre] = new PHPExcel();
										// Set document properties=
										$objPHPExcel[$idvitre]->getProperties()->setCreator("Maarten Balliauw")
																		 ->setLastModifiedBy("Maarten Balliauw")
																		 ->setTitle("PHPExcel Test Document")
																		 ->setSubject("PHPExcel Test Document")
																		 ->setDescription("Test document for PHPExcel, generated using PHP classes.")
																		 ->setKeywords("office PHPExcel php")
																		 ->setCategory("Test result file");
										// Add some data
										$objPHPExcel[$idvitre]->setActiveSheetIndex(0)
											            ->setCellValue('A1', 'Piece Number')
											            ->setCellValue('B1', 'X DIM')
											            ->setCellValue('C1', 'Y DIM')
											            ->setCellValue('D1', 'Customer')
											            ->setCellValue('E1', 'Order')
											            ->setCellValue('F1', 'MATERIAL CODE')
											            ->setCellValue('G1', 'NOTE')
											            ->setCellValue('H1', 'RACK')
											            ->setCellValue('I1', 'Priority');
										$i[$idvitre]='2';


											     
									    $newV++;		
									}


						    		$dimension1=$row5['dimension1'];
						    		$dimension2=$row5['dimension2'];

						    		$dimension1v1=$dimension1+$toaddv1;
						    		$dimension2v1=$dimension2+$toaddv1;
									$v1="v$vitreCurrent";
									if($svDv=="sv"){
										$v1="sv";	
									}
						    		if($same==1){
						    			$v1="v1,v2";
						    			if($cuisson=="Tout"){
						    				$contactname="".substr($contactname, 0,9)." Tr";
						    			}else{
						    				if($poncage=="Tout"){
						    					$contactname="".substr($contactname, 0,8)." Pnc";
						    				}
						    			}
						    		}
						    		$contactname1=$contactname;
						    		$contactname2=$contactname;
						    		if($cuisson=="Vitre $vitreCurrent" OR $cuisson=="Oui" ){
					    				$contactname1="".substr($contactname, 0,9)." Tr";
					    			}else{
					    				if($poncage=="Vitre $vitreCurrent"  OR $poncage=="Oui" ){
					    					$contactname1="".substr($contactname, 0,8)." Pnc";
					    				}
					    			}



						    		$objPHPExcel[$idvitre]->setActiveSheetIndex(0)
									->setCellValue('A'.$i[$idvitre].'', $q)
									->setCellValue('B'.$i[$idvitre].'', $dimension1v1)
									->setCellValue('C'.$i[$idvitre].'', $dimension2v1)
									->setCellValue('D'.$i[$idvitre].'', $contactname1)
									->setCellValue('E'.$i[$idvitre].'', ' '.$currentOrderId.'')
									->setCellValue('F'.$i[$idvitre].'', $referenceproduct[$idaray[$idvitre]])
									->setCellValue('G'.$i[$idvitre].'', "")
									->setCellValue('H'.$i[$idvitre].'', $v1);
									$i[$idvitre]=$i[$idvitre]+1;
									echo "V1:";echo $i[$idvitre];

									if($same==2){


										if($cuisson=="Vitre 2"){
						    				$contactname2="".substr($contactname, 0,9)." Tr";
						    			}else{
						    				if($poncage=="Vitre 2"){
						    					$contactname2="".substr($contactname, 0,8)." Pnc";
						    				}
						    			}

							    		$dimension1v2=$dimension1+$toaddv2;
							    		$dimension2v2=$dimension2+$toaddv2;

										$objPHPExcel[$idvitre]->setActiveSheetIndex(0)
										->setCellValue('A'.$i[$idvitre].'', $q)
										->setCellValue('B'.$i[$idvitre].'', $dimension1v2)
										->setCellValue('C'.$i[$idvitre].'', $dimension2v2)
										->setCellValue('D'.$i[$idvitre].'', $contactname2)
										->setCellValue('E'.$i[$idvitre].'', ' '.$currentOrderId.'')
										->setCellValue('F'.$i[$idvitre].'', $referenceproduct[$idaray[$idvitre]])
										->setCellValue('G'.$i[$idvitre].'', "")
										->setCellValue('H'.$i[$idvitre].'', "V2");
										$i[$idvitre]=$i[$idvitre]+1;

										echo "V2:";echo $i[$idvitre];
										
									}

								}
							}
						}
						$vitreCurrent++;
						if($same!=0 OR $svDv == "sv"){
							$vitreCurrent++;
						}
					}
				}
			}
		}
		

		for ($i=0; $i < sizeof($idsArray); $i++) { 

		$objPHPExcel[$idsArray[$i]]->getActiveSheet()->setTitle('Sheet1');
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel[$idsArray[$i]]->setActiveSheetIndex(0);
		$callStartTime = microtime(true);
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel[$idsArray[$i]], 'Excel5');
		$objWriter->save("".$filename[$idsArray[$i]]."");

		}



		echo '<SCRIPT LANGUAGE="JavaScript">		document.location.href="'.$location.'";		</SCRIPT>';


	}else{

		Echo "Destination error";
	}

}else{

	echo "no data";

}
/*
		
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
		}}}

*/

?>
