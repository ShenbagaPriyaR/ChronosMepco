<?php
		include 'db_connection.php';
		include 'stemer.php';
?>
<?php
	$sql_del="DROP TABLE IF EXISTS `word_count_sleep`";
	$result_del = mysqli_query($conn,$sql_del) or die(mysql_error()); 
	$sql_create="CREATE TABLE `word_count_sleep` (`word` varchar(60),`count` int(5))";
	$result_create = mysqli_query($conn,$sql_create) or die(mysql_error());
	
	$sleep_bag = array('sleep', 'hour', 'night', 'negtoken', 'bed', 'allnight', 'allnighter', 'exam', 'homework','nap','coffee', 'time', 'study', 'more', 'work', 'class','dream', 'ladyengineer','late',
        'week', 'day', 'long', 'morning', 'wake', 'awake', 'nosleep','tired');
	
	for($i = 0; $i < count($sleep_bag); $i++)
	{
		$word = PorterStemmer::Stem($sleep_bag[$i]);
		$word = strtoupper($sleep_bag[$i]);	
		$sql_ins = "insert into word_count_sleep (word,count) values ('$word',10)";
		$result_ins = mysqli_query($conn, $sql_ins);		
	}
	
	$sql = "select * from input where id = 3";
	$result = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_assoc($result))  {
		$temp = explode(' ', $row["tweet"]);
		for ($j = 0; $j < count($temp); $j++) {
			$word=$temp[$j];
			$word = strtolower($word);
			$word = PorterStemmer::Stem($word);
			$word = strtoupper($word);
			if(strlen($word) > 2)
			{
				$sql_sel="select * from word_count_sleep where word='$word'";
				$result_sel = mysqli_query($conn,$sql_sel);
				if( mysqli_num_rows($result_sel) > 0)	
				{
					$row = mysqli_fetch_assoc($result_sel);
					$e=$row["count"]+1;
					$sql_modify="update word_count_sleep set count = $e where word = '$word'";
					$result_modify = mysqli_query($conn, $sql_modify);
				}
				else
				{
					$sql_ins = "insert into word_count_sleep (word,count) values ('$word',1)";
					$result_ins = mysqli_query($conn, $sql_ins);
				}
			}
		}
	}
	
	$sql_del = "delete from word_count_sleep where count <= 2";
	$result_del = mysqli_query($conn,$sql_del);
?>