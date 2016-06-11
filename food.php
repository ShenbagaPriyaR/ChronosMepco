<?php
		include 'db_connection.php';
		include 'stemer.php';
?>
<?php
ini_set('max_execution_time', 500);
	$e=0;
	$count_hsd = array();
	$word_hsd  = array();
	$sql_del = "DROP TABLE IF EXISTS `word_count_food`";
	$result_del = mysqli_query($conn,$sql_del) or die(mysql_error()); 
	$sql_create = "CREATE TABLE `word_count_food` (`word` varchar(60),`count` int(5))";
	$result_create = mysqli_query($conn,$sql_create) or die(mysql_error());
	
	$neg_bag = array('food','gameinsight','foodie','foodporn','bts','corddemos','restaurant','yum','health','healthyfood','summers','teargasmonday','date','diet','dietitiansweek','grub','lyft','recipe','uber','wine','yummy','cake','carlopetrini','coffee','community','deals','events','fastfood','foodheaven','foodtech','glasgow','goodfood','home','lifestyle','lovefood','ramadan','ramadantips','recipes','revolution','slowfood','soyum','vegan','venezuela','wandsworth','grain','beef','beverley','coconut','curry','dairyfree','dallas','deash','dessert','donate','drink','edibleinsects','edible','veg','non-veg','foodaccelerator','foodcrime','fooddiaries','foodfetish','foodfraud','foodgasm','foodies','foodinnovation','foodish','foodpics','foodshopping','foodtion','foodtripping','noodles','nutrition','restaurants','sweet','syrup');
			   
	for($i = 0; $i < count($neg_bag); $i++)
	{
		$word = PorterStemmer::Stem($neg_bag[$i]);
		$word = strtoupper($neg_bag[$i]);
		$sql_ins = "insert into word_count_food (word,count) values ('$word',30)";
		$result_ins = mysqli_query($conn, $sql_ins);		
	}
	
	$sql = "select * from input where id = 12";
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
				$sql_sel = "select * from word_count_food where word='$word'";
				$result_sel = mysqli_query($conn,$sql_sel);
				if( mysqli_num_rows($result_sel) > 0)	
				{
					$row = mysqli_fetch_assoc($result_sel);
					$e = $row["count"]+1;
					$sql_modify = "update word_count_food set count = $e where word = '$word'";
					$result_modify = mysqli_query($conn, $sql_modify);
				}
				else
				if($word != '\n' || $word != NULL || $word != ' ')
				{
					$sql_ins = "insert into word_count_food (word,count) values ('$word',1)";
					$result_ins = mysqli_query($conn, $sql_ins);
				}
			}
		}
	}
	
	$sql_del = "delete from word_count_food where count <= 2";
	$result_del = mysqli_query($conn,$sql_del);

?>