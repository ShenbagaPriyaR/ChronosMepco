<?php
		include 'db_connection.php';
		include 'stemer.php';
?>
<?php
	$e=0;
	$count_hsd = array();
	$word_hsd  = array();
	$sql_del = "DROP TABLE IF EXISTS `word_count_terrorism`";
	$result_del = mysqli_query($conn,$sql_del) or die(mysql_error()); 
	$sql_create = "CREATE TABLE `word_count_terrorism` (`word` varchar(60),`count` int(5))";
	$result_create = mysqli_query($conn,$sql_create) or die(mysql_error());
	
	$neg_bag = array('terrorism','terrorist','bomb','traitor','terror','murder','slave','imprisioned','violence','smuggle','struggle','war','justice','enemy','shot','dead','kidnap','gun');
			   
	for($i = 0; $i < count($neg_bag); $i++)
	{
		$word = PorterStemmer::Stem($neg_bag[$i]);
		$word = strtoupper($neg_bag[$i]);
		$sql_ins = "insert into word_count_terrorism (word,count) values ('$word',30)";
		$result_ins = mysqli_query($conn, $sql_ins);		
	}
	
	$sql = "select * from input where id = 11";
	$result = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_assoc($result))  {
		$temp = explode(' ', $row["tweet"]);
		for ($j = 0; $j < count($temp); $j++) {
			$word = $temp[$j];
			$word = strtolower($word);
			$word = PorterStemmer::Stem($word);
			$word = strtoupper($word);
			if(strlen($word) > 2)
			{
				$sql_sel = "select * from word_count_terrorism where word='$word'";
				$result_sel = mysqli_query($conn,$sql_sel);
				if( mysqli_num_rows($result_sel) > 0)	
				{
					$row = mysqli_fetch_assoc($result_sel);
					$e = $row["count"]+1;
					$sql_modify = "update word_count_terrorism set count = $e where word = '$word'";
					$result_modify = mysqli_query($conn, $sql_modify);
				}
				else
				if($word != '\n' || $word != NULL || $word != ' ')
				{
					$sql_ins = "insert into word_count_terrorism (word,count) values ('$word',1)";
					$result_ins = mysqli_query($conn, $sql_ins);
				}
			}
		}
	}
	
	$sql_del = "delete from word_count_terrorism where count <= 2";
	$result_del = mysqli_query($conn,$sql_del);

?>