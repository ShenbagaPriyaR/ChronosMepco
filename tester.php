<?php
		include 'db_connection.php';
		include 'stemer.php';
?>
<?php
	
	ini_set('max_execution_time', 2000);
	
	$sql = "select * from test_input";
	$result = mysqli_query($conn,$sql);
	$tweets = array();
	$ids = array();
	$x = 0;
	if(mysqli_num_rows($result) > 0)	{
		while($row = mysqli_fetch_assoc($result))  {
			array_push($tweets,$row["tweet"]);
			array_push($ids,$row["id1"]);
		}
	}
	
	
	$threshold = array(0.1, 0.2, 0.3, 0.4, 0.5, 0.6, 0.7, 0.8, 0.9);
	
	$sql_del = "DROP TABLE IF EXISTS `test_output`";
	$result_del = mysqli_query($conn,$sql_del) or die(mysql_error()); 
	$sql_create = "CREATE TABLE `test_output` (`id1` int(2),`tweet` varchar(1000),`id2` int(2), `threshold` decimal(3,2))";
	$result_create = mysqli_query($conn,$sql_create) or die(mysql_error()); 
	for($j=0; $j<count($tweets);$j++)
	{
		$tweet = $tweets[$j];
		$words = explode(' ', $tweet);
		for ($k = 0; $k < count($words); $k++) {
			$word = $words[$k];
			$word = strtolower($word);
			$word = PorterStemmer::Stem($word);
			$word = strtoupper($word);
			$words[$k] = $word;
		}
		
		$id1=$ids[$j];
		$count_hsd =array();
		for($i = 0; $i < count($words); $i++)
		{
			$sql_sel = "select * from word_count_hsd where word='$words[$i]'";
			$result_sel = mysqli_query($conn, $sql_sel);
			if( mysqli_num_rows($result_sel) > 0)	
			{
				$row = mysqli_fetch_assoc($result_sel);
				$count_hsd[$i] = $row["count"];
			}
			else
				$count_hsd[$i] = 0;
		}
        
        $count_good_book =array();
		for($i = 0; $i < count($words); $i++)
		{
			$sql_sel = "select * from word_count_good_book where word='$words[$i]'";
			$result_sel = mysqli_query($conn, $sql_sel);
			if( mysqli_num_rows($result_sel) > 0)	
			{
				$row = mysqli_fetch_assoc($result_sel);
				$count_good_book[$i] = $row["count"];
			}
			else
				$count_good_book[$i] = 0;
		}
		
        $count_bad_book =array();
		for($i = 0; $i < count($words); $i++)
		{
			$sql_sel = "select * from word_count_bad_book where word='$words[$i]'";
			$result_sel = mysqli_query($conn, $sql_sel);
			if( mysqli_num_rows($result_sel) > 0)	
			{
				$row = mysqli_fetch_assoc($result_sel);
				$count_bad_book[$i] = $row["count"];
			}
			else
				$count_bad_book[$i] = 0;
		}
		
        
        $count_disaster =array();
		for($i = 0; $i < count($words); $i++)
		{
			$sql_sel = "select * from word_count_disaster where word='$words[$i]'";
			$result_sel = mysqli_query($conn, $sql_sel);
			if( mysqli_num_rows($result_sel) > 0)	
			{
				$row = mysqli_fetch_assoc($result_sel);
				$count_disaster[$i] = $row["count"];
			}
			else
				$count_disaster[$i] = 0;
		}
		
		
		$count_sleep = array();
		for($i = 0; $i < count($words); $i++)
		{
			$sql_sel = "select * from word_count_sleep where word='$words[$i]'";
			$result_sel = mysqli_query($conn, $sql_sel);
			if( mysqli_num_rows($result_sel) > 0)	
			{
				$row = mysqli_fetch_assoc($result_sel);
				$count_sleep[$i] = $row["count"];
			}
			else
				$count_sleep[$i] = 0;	
		}
			
		$count_div = array();
		for($i = 0; $i < count($words); $i++)
		{
			$sql_sel = "select * from word_count_div where word='$words[$i]'";
			$result_sel = mysqli_query($conn, $sql_sel);
			if( mysqli_num_rows($result_sel) > 0)	
			{
				$row = mysqli_fetch_assoc($result_sel);
				$count_div[$i] = $row["count"];
			}
			else
				$count_div[$i] = 0;
		}
		$count_money = array();
		for($i = 0; $i < count($words); $i++)
		{
			$sql_sel = "select * from word_count_money where word='$words[$i]'";
			$result_sel = mysqli_query($conn, $sql_sel);
			if( mysqli_num_rows($result_sel) > 0)	
			{
				$row = mysqli_fetch_assoc($result_sel);
				$count_money[$i] = $row["count"];
			}
			else
				$count_money[$i] = 0;	
		}
		
		$count_social = array();
		for($i = 0; $i < count($words); $i++)
		{
			$sql_sel = "select * from word_count_social where word='$words[$i]'";
			$result_sel = mysqli_query($conn, $sql_sel);
			if( mysqli_num_rows($result_sel) > 0)	
			{
				$row = mysqli_fetch_assoc($result_sel);
				$count_social[$i] = $row["count"];
			}
			else
				$count_social[$i] = 0;	
		}
		
		$count_neg = array();
		for($i = 0; $i < count($words); $i++)
		{
			$sql_sel = "select * from word_count_neg where word='$words[$i]'";
			$result_sel = mysqli_query($conn, $sql_sel);
			if( mysqli_num_rows($result_sel) > 0)	
			{
				$row = mysqli_fetch_assoc($result_sel);
				$count_neg[$i] = $row["count"];
			}
			else
				$count_neg[$i] = 0;
		}
		
        $count_politics =array();
		for($i = 0; $i < count($words); $i++)
		{
			$sql_sel = "select * from word_count_politics where word='$words[$i]'";
			$result_sel = mysqli_query($conn, $sql_sel);
			if( mysqli_num_rows($result_sel) > 0)	
			{
				$row = mysqli_fetch_assoc($result_sel);
				$count_politics[$i] = $row["count"];
			}
			else
				$count_politics[$i] = 0;
		}
        $count_terrorism =array();
		for($i = 0; $i < count($words); $i++)
		{
			$sql_sel = "select * from word_count_terrorism where word='$words[$i]'";
			$result_sel = mysqli_query($conn, $sql_sel);
			if( mysqli_num_rows($result_sel) > 0)	
			{
				$row = mysqli_fetch_assoc($result_sel);
				$count_terrorism[$i] = $row["count"];
			}
			else
				$count_terrorism[$i] = 0;
		}
        $count_food =array();
		for($i = 0; $i < count($words); $i++)
		{
			$sql_sel = "select * from word_count_food where word='$words[$i]'";
			$result_sel = mysqli_query($conn, $sql_sel);
			if( mysqli_num_rows($result_sel) > 0)	
			{
				$row = mysqli_fetch_assoc($result_sel);
				$count_food[$i] = $row["count"];
			}
			else
				$count_food[$i] = 0;
		}
        $count_science =array();
		for($i = 0; $i < count($words); $i++)
		{
			$sql_sel = "select * from word_count_science where word='$words[$i]'";
			$result_sel = mysqli_query($conn, $sql_sel);
			if( mysqli_num_rows($result_sel) > 0)	
			{
				$row = mysqli_fetch_assoc($result_sel);
				$count_science[$i] = $row["count"];
			}
			else
				$count_science[$i] = 0;
		}
        $count_technology =array();
		for($i = 0; $i < count($words); $i++)
		{
			$sql_sel = "select * from word_count_technology where word='$words[$i]'";
			$result_sel = mysqli_query($conn, $sql_sel);
			if( mysqli_num_rows($result_sel) > 0)	
			{
				$row = mysqli_fetch_assoc($result_sel);
				$count_technology[$i] = $row["count"];
			}
			else
				$count_technology[$i] = 0;
		}
        $count_health =array();
		for($i = 0; $i < count($words); $i++)
		{
			$sql_sel = "select * from word_count_health where word='$words[$i]'";
			$result_sel = mysqli_query($conn, $sql_sel);
			if( mysqli_num_rows($result_sel) > 0)	
			{
				$row = mysqli_fetch_assoc($result_sel);
				$count_health[$i] = $row["count"];
			}
			else
				$count_health[$i] = 0;
		}
        $count_pollution =array();
		for($i = 0; $i < count($words); $i++)
		{
			$sql_sel = "select * from word_count_pollution where word='$words[$i]'";
			$result_sel = mysqli_query($conn, $sql_sel);
			if( mysqli_num_rows($result_sel) > 0)	
			{
				$row = mysqli_fetch_assoc($result_sel);
				$count_pollution[$i] = $row["count"];
			}
			else
				$count_pollution[$i] = 0;
		}        
        $count_business =array();
		for($i = 0; $i < count($words); $i++)
		{
			$sql_sel = "select * from word_count_business where word='$words[$i]'";
			$result_sel = mysqli_query($conn, $sql_sel);
			if( mysqli_num_rows($result_sel) > 0)	
			{
				$row = mysqli_fetch_assoc($result_sel);
				$count_business[$i] = $row["count"];
			}
			else
				$count_business[$i] = 0;
		}               
        
		$prob_hsd = array();
		$prob_sleep = array();
		$prob_social = array();
		$prob_div = array();
		$prob_money = array();
		$prob_neg = array();
        $prob_good_book = array();
        $prob_bad_book = array();
        $prob_disaster = array();
        $prob_politics = array();
        $prob_terrorism = array();
        $prob_food = array();
        $prob_science = array();
        $prob_technology = array();
        $prob_health = array();
        $prob_pollution = array();
        $prob_business = array();
			
		$sql_hsd = "select * from input where id = 1";
		$sql_social = "select * from input where id = 2";
		$sql_sleep = "select * from input where id = 3";
		$sql_div = "select * from input where id = 4";
		$sql_money = "select * from input where id = 5";
		$sql_neg = "select * from input where id = 6";
        $sql_good_book = "select * from input where id = 7";
        $sql_bad_book = "select * from input where id = 8";
        $sql_disaster = "select * from input where id = 9";
        $sql_politics = "select * from input where id = 10";
        $sql_terrorism = "select * from input where id = 11";
        $sql_food = "select * from input where id = 12";
        $sql_science = "select * from input where id = 13";
        $sql_technology = "select * from input where id = 14";
        $sql_health = "select * from input where id = 15";
        $sql_pollution = "select * from input where id = 16";
        $sql_business = "select * from input where id = 17";
		$sql_total = "select * from input";
		
		$result_hsd = mysqli_query($conn, $sql_hsd);
		$twtCount_hsd = mysqli_num_rows($result_hsd); 
		$result_social = mysqli_query($conn, $sql_social);
		$twtCount_social = mysqli_num_rows($result_social); 
		$result_sleep = mysqli_query($conn, $sql_sleep);
		$twtCount_sleep = mysqli_num_rows($result_sleep); 
		$result_div = mysqli_query($conn, $sql_div);
		$twtCount_div = mysqli_num_rows($result_div); 
		$result_money = mysqli_query($conn, $sql_money);
		$twtCount_money = mysqli_num_rows($result_money); 
		$result_neg = mysqli_query($conn, $sql_neg);
		$twtCount_neg = mysqli_num_rows($result_neg);
        $result_good_book = mysqli_query($conn, $sql_good_book);
		$twtCount_good_book = mysqli_num_rows($result_good_book); 
        $result_bad_book = mysqli_query($conn, $sql_bad_book);
		$twtCount_bad_book = mysqli_num_rows($result_bad_book); 
        $result_disaster = mysqli_query($conn, $sql_disaster);
		$twtCount_disaster = mysqli_num_rows($result_disaster); 
        
        $result_politics = mysqli_query($conn, $sql_politics);
		$twtCount_politics = mysqli_num_rows($result_politics); 
        $result_terrorism = mysqli_query($conn, $sql_terrorism);
		$twtCount_terrorism = mysqli_num_rows($result_terrorism); 
        $result_food = mysqli_query($conn, $sql_food);
		$twtCount_food = mysqli_num_rows($result_food); 
        $result_science = mysqli_query($conn, $sql_science);
		$twtCount_science = mysqli_num_rows($result_science); 
        $result_technology = mysqli_query($conn, $sql_technology);
		$twtCount_technology = mysqli_num_rows($result_technology); 
        $result_health = mysqli_query($conn, $sql_health);
		$twtCount_health = mysqli_num_rows($result_health); 
        $result_pollution = mysqli_query($conn, $sql_pollution);
		$twtCount_pollution = mysqli_num_rows($result_pollution); 
        $result_business = mysqli_query($conn, $sql_business);
		$twtCount_business = mysqli_num_rows($result_business); 
      
		$result_total = mysqli_query($conn, $sql_total);
		$twtCount_total = mysqli_num_rows($result_total);	
		
		$prob_cat_hsd = $twtCount_hsd / $twtCount_total;
		$prob_cat_social = $twtCount_social / $twtCount_total;
		$prob_cat_sleep = $twtCount_sleep / $twtCount_total;
		$prob_cat_div = $twtCount_div / $twtCount_total;
		$prob_cat_money = $twtCount_money / $twtCount_total;
		$prob_cat_neg = $twtCount_neg / $twtCount_total;
		$prob_cat_good_book = $twtCount_good_book / $twtCount_total;
        $prob_cat_bad_book = $twtCount_bad_book / $twtCount_total;
        $prob_cat_disaster = $twtCount_disaster / $twtCount_total;
        
        $prob_cat_politics = $twtCount_politics / $twtCount_total;
        $prob_cat_terrorism = $twtCount_terrorism / $twtCount_total;
        $prob_cat_food = $twtCount_food / $twtCount_total;
        $prob_cat_science = $twtCount_science / $twtCount_total;
        $prob_cat_technology = $twtCount_technology / $twtCount_total;
        $prob_cat_health = $twtCount_health / $twtCount_total;
        $prob_cat_pollution = $twtCount_pollution / $twtCount_total;
        $prob_cat_business = $twtCount_business / $twtCount_total;
        
		$sql_hsdtab = "select * from word_count_hsd";
		$sql_socialtab = "select * from word_count_social";
		$sql_sleeptab = "select * from word_count_sleep";
		$sql_divtab = "select * from word_count_div";
		$sql_moneytab = "select * from word_count_money";
		$sql_negtab = "select * from word_count_neg";
        $sql_goodbooktab = "select * from word_count_good_book";
        $sql_badbooktab = "select * from word_count_bad_book";
        $sql_disastertab = "select * from word_count_disaster";
        
        $sql_politicstab = "select * from word_count_politics";
        $sql_terrorismtab = "select * from word_count_terrorism";
        $sql_foodtab = "select * from word_count_food";
        $sql_sciencetab = "select * from word_count_science";
        $sql_technologytab = "select * from word_count_technology";
        $sql_healthtab = "select * from word_count_health";
        $sql_pollutiontab = "select * from word_count_pollution";
        $sql_businesstab = "select * from word_count_business";
        
		
		$result_hsdtab = mysqli_query($conn,$sql_hsdtab);
		$result_socialtab = mysqli_query($conn,$sql_socialtab);
		$result_sleeptab = mysqli_query($conn,$sql_sleeptab);
		$result_divtab = mysqli_query($conn,$sql_divtab);
		$result_moneytab = mysqli_query($conn,$sql_moneytab);
		$result_negtab = mysqli_query($conn,$sql_negtab);
        $result_goodbooktab = mysqli_query($conn,$sql_goodbooktab);
        $result_badbooktab = mysqli_query($conn,$sql_badbooktab);
        $result_disastertab = mysqli_query($conn,$sql_disastertab);
        
        $result_politicstab = mysqli_query($conn,$sql_politicstab);
        $result_terrorismtab = mysqli_query($conn,$sql_terrorismtab);
        $result_foodtab = mysqli_query($conn,$sql_foodtab);
        $result_sciencetab = mysqli_query($conn,$sql_sciencetab);
        $result_technologytab = mysqli_query($conn,$sql_technologytab);
        $result_healthtab = mysqli_query($conn,$sql_healthtab);
        $result_pollutiontab = mysqli_query($conn,$sql_pollutiontab);
        $result_businesstab = mysqli_query($conn,$sql_businesstab);
        
		
		$hsd_total_count = 0;
		$social_total_count = 0;
		$sleep_total_count = 0;
		$div_total_count = 0;
		$money_total_count = 0;
		$neg_total_count = 0;
        $good_book_total_count = 0;
        $bad_book_total_count = 0;
		$disaster_total_count = 0;
        
        $politics_total_count = 0;
        $terrorism_total_count = 0;
        $food_total_count = 0;
        $science_total_count = 0;
        $technology_total_count = 0;
        $health_total_count = 0;
        $pollution_total_count = 0;
        $business_total_count = 0;
        
		
		while($row = mysqli_fetch_assoc($result_hsdtab))  {
			$hsd_total_count += $row["count"];
		}
		while($row = mysqli_fetch_assoc($result_socialtab))  {
			$social_total_count += $row["count"];
		}
		while($row = mysqli_fetch_assoc($result_sleeptab))  {
			$sleep_total_count += $row["count"];
		}
		while($row = mysqli_fetch_assoc($result_divtab))  {
			$div_total_count += $row["count"];
		}
		while($row = mysqli_fetch_assoc($result_moneytab))  {
			$money_total_count += $row["count"];
		}
		while($row = mysqli_fetch_assoc($result_negtab))  {
			$neg_total_count += $row["count"];
		}
        while($row = mysqli_fetch_assoc($result_goodbooktab))  {
			$good_book_total_count += $row["count"];
		}
        while($row = mysqli_fetch_assoc($result_badbooktab))  {
			$bad_book_total_count += $row["count"];
		}
        while($row = mysqli_fetch_assoc($result_disastertab))  {
			$disaster_total_count += $row["count"];
		}
        
        while($row = mysqli_fetch_assoc($result_politicstab))  {
			$politics_total_count += $row["count"];
		}
        while($row = mysqli_fetch_assoc($result_terrorismtab))  {
			$terrorism_total_count += $row["count"];
		}
        while($row = mysqli_fetch_assoc($result_foodtab))  {
			$food_total_count += $row["count"];
		}
        while($row = mysqli_fetch_assoc($result_sciencetab))  {
			$science_total_count += $row["count"];
		}
        while($row = mysqli_fetch_assoc($result_technologytab))  {
			$technology_total_count += $row["count"];
		}
        while($row = mysqli_fetch_assoc($result_healthtab))  {
			$health_total_count += $row["count"];
		}
        while($row = mysqli_fetch_assoc($result_pollutiontab))  {
			$pollution_total_count += $row["count"];
		}
        while($row = mysqli_fetch_assoc($result_businesstab))  {
			$business_total_count += $row["count"];
		}
        
		
		for($i = 0; $i < count($words); $i++)
		{
			if(array_sum($count_hsd) != 0)
			$prob_hsd[$i] = $count_hsd[$i] / $hsd_total_count;
			else $prob_hsd[$i] =0;
	
			if(array_sum($count_social) != 0)
			$prob_social[$i] = $count_social[$i] / $social_total_count;
			else $prob_social[$i] = 0;
			
			if(array_sum($count_sleep) != 0)
			$prob_sleep[$i] = $count_sleep[$i] / $sleep_total_count;
			else $prob_sleep[$i] = 0;
			
			if(array_sum($count_div) != 0)
			$prob_div[$i] = $count_div[$i] / $div_total_count;
			else $prob_div[$i] = 0;
			
			if(array_sum($count_money) != 0)
			$prob_money[$i] = $count_money[$i] / $money_total_count;
			else $prob_money[$i] = 0;
			
			if(array_sum($count_neg) != 0)
			$prob_neg[$i] = $count_neg[$i] / $neg_total_count;
			else $prob_neg[$i] = 0;
            
            if(array_sum($count_good_book) != 0)
			$prob_good_book[$i] = $count_good_book[$i] / $good_book_total_count;
			else $prob_good_book[$i] =0;
            
            if(array_sum($count_bad_book) != 0)
			$prob_bad_book[$i] = $count_bad_book[$i] / $bad_book_total_count;
			else $prob_bad_book[$i] =0;
            
            if(array_sum($count_disaster) != 0)
			$prob_disaster[$i] = $count_disaster[$i] / $disaster_total_count;
			else $prob_disaster[$i] =0;
            
            if(array_sum($count_politics) != 0)
			$prob_politics[$i] = $count_politics[$i] / $politics_total_count;
			else $prob_politics[$i] =0;
            if(array_sum($count_terrorism) != 0)
			$prob_terrorism[$i] = $count_terrorism[$i] / $terrorism_total_count;
			else $prob_terrorism[$i] =0;
            if(array_sum($count_food) != 0)
			$prob_food[$i] = $count_food[$i] / $food_total_count;
			else $prob_food[$i] =0;
            if(array_sum($count_science) != 0)
			$prob_science[$i] = $count_science[$i] / $science_total_count;
			else $prob_science[$i] =0;
            if(array_sum($count_technology) != 0)
			$prob_technology[$i] = $count_technology[$i] / $technology_total_count;
			else $prob_technology[$i] =0;
            if(array_sum($count_health) != 0)
			$prob_health[$i] = $count_health[$i] / $health_total_count;
			else $prob_health[$i] =0;
            if(array_sum($count_pollution) != 0)
			$prob_pollution[$i] = $count_pollution[$i] / $pollution_total_count;
			else $prob_pollution[$i] =0;
            if(array_sum($count_business) != 0)
			$prob_business[$i] = $count_business[$i] / $business_total_count;
			else $prob_business[$i] =0;
            

		}
		
		for($i = 0; $i < count($words); $i++)
		{
			$prob_hsd[$i] = $prob_hsd[$i] * $prob_cat_hsd;
			$prob_social[$i] = $prob_social[$i] * $prob_cat_social;
			$prob_sleep[$i] = $prob_sleep[$i] * $prob_cat_sleep;
			$prob_div[$i] = $prob_div[$i] * $prob_cat_div;
			$prob_money[$i] = $prob_money[$i] * $prob_cat_money;
			$prob_neg[$i] = $prob_neg[$i] * $prob_cat_neg;
            $prob_good_book[$i] = $prob_good_book[$i] * $prob_cat_good_book;
            $prob_bad_book[$i] = $prob_bad_book[$i] * $prob_cat_bad_book;
            $prob_disaster[$i] = $prob_disaster[$i] * $prob_cat_disaster;
            
            $prob_politics[$i] = $prob_politics[$i] * $prob_cat_politics;
            $prob_terrorism[$i] = $prob_terrorism[$i] * $prob_cat_terrorism;
            $prob_food[$i] = $prob_food[$i] * $prob_cat_food;
            $prob_science[$i] = $prob_science[$i] * $prob_cat_science;
            $prob_technology[$i] = $prob_technology[$i] * $prob_cat_technology;
            $prob_health[$i] = $prob_health[$i] * $prob_cat_health;
            $prob_pollution[$i] = $prob_pollution[$i] * $prob_cat_pollution;
            $prob_business[$i] = $prob_business[$i] * $prob_cat_business;
		}
		
		$fin_hsd = 0;
		$fin_social = 0;
		$fin_sleep = 0;
		$fin_div = 0;
		$fin_money = 0;
		$fin_neg = 0;
        $fin_good_book = 0;
        $fin_bad_book = 0;
        $fin_disaster = 0;
		
        $fin_politics = 0;
        $fin_terrorism = 0;
        $fin_food = 0;
        $fin_science = 0;
        $fin_technology = 0;
        $fin_health = 0;
        $fin_pollution = 0;
        $fin_business = 0;
        
		if(array_sum($prob_hsd) * 100 > 1 || array_sum($prob_social) * 100 > 1 || array_sum($prob_sleep) * 100 > 1 || array_sum($prob_div) * 100 > 1 || array_sum($prob_money) * 100 > 1 || array_sum($prob_neg) * 100 > 1 ||
array_sum($prob_good_book) * 100 > 1 || array_sum($prob_bad_book) * 100 > 1 || array_sum($prob_disaster) * 100 > 1
||array_sum($prob_politics) * 100 > 1 ||array_sum($prob_terrorism) * 100 > 1 ||array_sum($prob_food) * 100 > 1 ||array_sum($prob_science) * 100 > 1 ||array_sum($prob_technology) * 100 > 1 ||array_sum($prob_health) * 100 > 1 ||array_sum($prob_pollution) * 100 > 1 ||array_sum($prob_business) * 100 > 1 )
		{
			$fin_hsd = array_sum($prob_hsd) * 10;
			$fin_social = array_sum($prob_social) * 10;
			$fin_sleep = array_sum($prob_sleep) * 10;
			$fin_div = array_sum($prob_div) * 10;
			$fin_money =  array_sum($prob_money) * 10;
			$fin_neg =  array_sum($prob_neg) * 10;
            $fin_good_book =  array_sum($prob_good_book) * 10;
            $fin_bad_book =  array_sum($prob_bad_book) * 10;
            $fin_disaster =  array_sum($prob_disaster) * 10;
            
            $fin_politics = array_sum($prob_politics) * 10;
            $fin_terrorism = array_sum($prob_terrorism) * 10;
            $fin_food = array_sum($prob_food) * 10;
            $fin_science = array_sum($prob_science) * 10;
            $fin_technology = array_sum($prob_technology) * 10;
            $fin_health = array_sum($prob_health) * 10;
            $fin_pollution = array_sum($prob_pollution) * 10;
            $fin_business = array_sum($prob_business) * 10;
		}
			
		else 
		{
			$fin_hsd = array_sum($prob_hsd) * 100;
			$fin_social = array_sum($prob_social) * 100;
			$fin_sleep = array_sum($prob_sleep) * 100;
			$fin_div =  array_sum($prob_div) * 100;
			$fin_money = array_sum($prob_money) * 100;
			$fin_neg =  array_sum($prob_neg) * 100;
            $fin_good_book =  array_sum($prob_good_book) * 100;
            $fin_bad_book =  array_sum($prob_bad_book) * 100;
            $fin_disaster =  array_sum($prob_disaster) * 100;
            
            $fin_politics = array_sum($prob_politics) * 100;
            $fin_terrorism = array_sum($prob_terrorism) * 100;
            $fin_food = array_sum($prob_food) * 100;
            $fin_science = array_sum($prob_science) * 100;
            $fin_technology = array_sum($prob_technology) * 100;
            $fin_health = array_sum($prob_health) * 100;
            $fin_pollution = array_sum($prob_pollution) * 100;
            $fin_business = array_sum($prob_business) * 100;
		}	
		
		$t1 = 0;
		$cat = 0;
		
		if( $fin_hsd > $fin_social )
		{
			$t1 = $fin_hsd;
			$cat = 1;
		}
		else
		{
			$t1 = $fin_social;
			$cat = 2;
		}
		if( $t1 < $fin_sleep)
		{
			$t1 = $fin_sleep;
			$cat = 3;
		}
		if( $t1 < $fin_div)
		{
			$t1 = $fin_div;
			$cat = 4;
		}
		if( $t1 < $fin_money)
		{
			$t1 = $fin_money;
			$cat = 5;
		}
		if( $t1 < $fin_neg)
		{
			$t1 = $fin_neg;
			$cat = 6;
		}
        if( $t1 < $fin_good_book)
		{
			$t1 = $fin_good_book;
			$cat = 7;
		}
        if( $t1 < $fin_bad_book)
		{
			$t1 = $fin_bad_book;
			$cat = 8;
		}
        if( $t1 < $fin_disaster)
		{
			$t1 = $fin_disaster;
			$cat = 9;
		}
        
        
        if( $t1 < $fin_politics)
		{
			$t1 = $fin_politics;
			$cat = 10;
		}
        if( $t1 < $fin_terrorism)
		{
			$t1 = $fin_terrorism;
			$cat = 11;
		}
        if( $t1 < $fin_food)
		{
			$t1 = $fin_food;
			$cat = 12;
		}
        if( $t1 < $fin_science)
		{
			$t1 = $fin_science;
			$cat = 13;
		}
        if( $t1 < $fin_technology)
		{
			$t1 = $fin_technology;
			$cat = 14;
		}
        if( $t1 < $fin_health)
		{
			$t1 = $fin_health;
			$cat = 15;
		}
        if( $t1 < $fin_pollution)
		{
			$t1 = $fin_pollution;
			$cat = 16;
		}
        if( $t1 < $fin_business)
		{
			$t1 = $fin_business;
			$cat = 17;
		}
		
		for($k = 0; $k < count($threshold); $k++)
		{
			if( $t1 < $threshold[$k] )
				$cat = 10;		
			$id2 = $cat;
			$sql_insert = "INSERT INTO test_output (id1,tweet,id2,threshold) VALUES ('$id1','$tweet','$id2',
							'$threshold[$k]')";
			$result_insert = mysqli_query($conn, $sql_insert);
		}
	}
?>