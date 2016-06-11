<html>
  <head> 
  <title>Save Excel file details to the database</title>
  </head>
  <body>
	<?php
		include 'db_connection.php';
		include 'reader.php';
    	$excel = new Spreadsheet_Excel_Reader();
	?>
	    <table border="1">
		<?php
        $sql_del = "DROP TABLE IF EXISTS `user`";
	$result_del = mysqli_query($conn,$sql_del) or die(mysql_error()); 
	$sql_create = "CREATE TABLE `user` (`id` int(2),`tweet` varchar(1000) )";
	$result_create = mysqli_query($conn,$sql_create) or die(mysql_error());   
          
            $excel->read('tweets1.xls');    
			$x=2;
			echo $excel->sheets[0]['numRows'];
			while($x<=$excel->sheets[0]['numRows']) {
			//	$lan=$excel->sheets[0]['cells'][$x][4];
				//if($lan == 'en'){
                $id = $excel->sheets[0]['cells'][$x][1];
				$tweet = $excel->sheets[0]['cells'][$x][2] ;
				echo $tweet;
				echo "<br>";
				// Save details
				$sql_insert="INSERT INTO user (id,tweet) VALUES ('$id','$tweet')";
				$result_insert = mysqli_query($conn,$sql_insert); 
				 //}
			  $x++;
			}
        ?>    
    </table>

  </body>
</html>
