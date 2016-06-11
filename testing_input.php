<?php

	include 'db_connection.php';
	include 'reader.php';
    $excel = new Spreadsheet_Excel_Reader();
	$sql_del = "DROP TABLE IF EXISTS `test`";
	$result_del = mysqli_query($conn,$sql_del) or die(mysql_error()); 
	$sql_create = "CREATE TABLE `test` (`id1` int(2),`tweet` varchar(1000) ,`id2` int(2))";
	$result_create = mysqli_query($conn,$sql_create) or die(mysql_error()); 
    $excel->read('tweets1.xls');    
	$x=2;
	while($x<=$excel->sheets[0]['numRows']) {
		$lan=$excel->sheets[0]['cells'][$x][3];
		if($lan == 'en'){
			$tweet = isset($excel->sheets[0]['cells'][$x][2]) ? $excel->sheets[0]['cells'][$x][2] : '';
			$id1 = isset($excel->sheets[0]['cells'][$x][1]) ? $excel->sheets[0]['cells'][$x][1] : '';
			$id2 = 0;
			$sql_insert = "INSERT INTO test (id1,tweet,id2) VALUES ('$id1','$tweet','$id2')";
			$result_insert = mysqli_query($conn,$sql_insert); 
		}
		$x++;
	}		
?>