<?php
	include 'db_connection.php';
?>

<?php
	
	$hsd_bag = array('hour', 'homework', 'exam', 'day', 'class', 'work', 'negtoken', 'problem', 'study', 'week',
	           'toomuch', 'all', 'lab', 'still', 'out', 'time', 'page', 'library', 'spend', 'today', 'long', 'school', 'due', 'engineer', 'already');

	$social_bag = array('negtoken', 'friday', 'homework', 'out', 'study', 'work', 'weekend', 'life', 'class',              'engineer', 'exam', 'drink', 'break', 'saturday', 'people', 'social', 'lab', 'spend', 'tonight',              'watch', 'game', 'miss', 'party', 'sunny', 'beautiful');
	
	$sleep_bag = array('sleep', 'hour', 'night', 'negtoken', 'bed', 'allnight', 'allnighter', 'exam', 'homework',             'nap', 'coffee', 'time', 'study', 'more', 'work', 'class','dream', 'ladyengineer','late', 'week','day', 'long', 'morning', 'wake', 'awake', 'nosleep');
	
	$div_bag = array('girl', 'class', 'only','negtoken',' guy', 'engineer', 'asia', 'professor', 'speak', 'english'					,'female', 'hot','kid', 'more', 'toomuch', 'walk', 'people', 'teach', 'understand', 'chick', 				 'china','foreign', 'out', 'white', 'black');
	
	$money_bag = array('dollar', '$', 'money', 'spend', 'rupee', 'broke', 'expenses', 'book', 'cost', 'costly', 			'fees', 'fee', 'pay', 'paid', 'cash', 'bill', 'loan', 'due', 'overdue', 'amount', 'sell', 'buy', 			 'bought', 'sold', 'pound', 'euro', 'earn', 'debit', 'credit', 'budget', 'saving', 'save', 'food',             'scholarship', 'debt','negtoken', 'job', 'part-time', 'parttime', 'financially', 'finance',             'economically', 'economic');
				  
	$neg_bag = array('hate', 'fuck', 'shit', 'exam', 'negtoken', 'week', 'class', 'hell', 'engineer', 'suck', 
	           'study', 'hour', 'homework', 'time', 'equate', 'FML', 'FFS', 'lab', 'sad', 'bad', 'day', 'feel', 'tired', 'damn', 'death', 'hard', 'done');
	$good_book = array('good','valueable','worth','interesting','great','loved','special','joy','award','thoughtful','knowledge','suspence','best','goodreads','loved','love','stunning','5-star','well','award','enjoy','excellent','interest','book','novel','read','selling','sell','profit','awesome','super','nice','bookworm','quote','comics','romance','bestseller','mrvel','action','chatterbook','happy','fantasy','bookclub');
    $bad_book = array('bad','hate','bore','nothing','foolish','worst','waste','stupid','colorless','book','novel','read','sell');
    $disaster= array('tragedy','loss','sadness','flood','free','death','escape','reach','volunteers','media','supply','food','suffer','pray','suggestion','rescue','donation','relief','travel','accommodation','sudden','receive','distribute','experience','displace','water','cyclone','happen','careful','record','rainfall',
'suffer','areas','help','everyone','capital','drown','contact','different','Hhelplines','belonging','move','drain','dirty',
'work','darkness','climate','threat','stuff','humanity','weather','damage');
    $politics= array('political','politics','CM','PM','minister','state','central','govt','government','law','nomination','liberty','election','votes','fund','protest','campaign','UK','US','president','parliament','democratic','parties','obama','narendra modi','india','news','vote','election');
    $terrorism= array('terrorism','terrorist','bomb','traitor','terror','murder','slave','imprisioned','violence','smuggle','struggle','war','justice','enemy','shot','dead','kidnap','gun');
    $food= array('food','gameinsight','foodie','foodporn','bts','corddemos','restaurant','yum','health','healthyfood','summers','teargasmonday','date','diet','dietitiansweek','grub','lyft','recipe','uber','wine','yummy','cake','carlopetrini','coffee','community','deals','events','fastfood','foodheaven','foodtech','glasgow','goodfood','home','lifestyle','lovefood','ramadan','ramadantips','recipes','revolution','slowfood','soyum','vegan','venezuela','wandsworth','grain','beef','beverley','coconut','curry','dairyfree','dallas','deash','dessert','donate','drink','edibleinsects','edible','veg','non-veg','foodaccelerator','foodcrime','fooddiaries','foodfetish','foodfraud','foodgasm','foodies','foodinnovation','foodish','foodpics','foodshopping','foodtion','foodtripping','noodles','nutrition','restaurants','sweet','syrup');
    $science= array('science','thoughtoftheday','knowledge','scifi','discovery','artificialintelligence','development','chemistry','biology','physics','communication','computerscience','datascience','scientist','world');
    $technology= array('technology','hiring','career','tech','news','techjobs','analytics','android','security','cloud','innovation','marketing','bigdata','biometrics','project','design','network','jquery','javascript','socialmedia','software','hardware','new','latest','apple','moto','nokia','audi','biotech','technews','resource','mobile','tablet','laptop','smartphone');
    $health= array('health','deals','fitness','diet','beauty','healthy','body','women','alergies','gym','wordsonhealth','weightloss','skintest','symtoms','fit','lifestyle','wellness','workout','excerise','beauty','tips');
    $pollution= array('pollution','airpollution','waterpollution','gas','global warming','pollutants','acid','sound','noisepollution','environment','heat','trees','danger','waste','plastic','smoke','carbondioxide','factory','nature','poison','industries','health','asthma','unclean','urban','rural','economy','eco-friendly','clean');
    $business= array('business','tips','insurance','internet','marketing','socialmedia','apps','businessclass','tender','bid','auspol','insurance','ausvotes','aviation','labor','entrepreneur','google','internetofthings','growthhacking','growth','leadership','manager','sales','seo','ceo','cognizant','hiring','interview','meeting','appointment','productivity','admin','administrator','training','work','job','jobs');
    
    
	$hsd_bag = array_map('strtoupper',$hsd_bag);
	$social_bag = array_map('strtoupper',$social_bag);
	$sleep_bag = array_map('strtoupper',$sleep_bag);
	$div_bag = array_map('strtoupper',$div_bag);
	$money_bag = array_map('strtoupper',$money_bag);
	$neg_bag = array_map('strtoupper',$neg_bag);
	$good_book = array_map('strtoupper',$good_book);	
    $bad_book = array_map('strtoupper',$bad_book);	
    $disaster = array_map('strtoupper',$disaster);
    $politics = array_map('strtoupper',$politics);
    $terrorism = array_map('strtoupper',$terrorism);
    $food = array_map('strtoupper',$food);
    $science = array_map('strtoupper',$science);
    $technology = array_map('strtoupper',$technology);
    $health = array_map('strtoupper',$health);
    $pollution = array_map('strtoupper',$pollution);
    $business = array_map('strtoupper',$business);
    
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
	$sql_del = "DROP TABLE IF EXISTS `test_output2`";
	$result_del = mysqli_query($conn,$sql_del) or die(mysql_error()); 
	$sql_create = "CREATE TABLE `test_output2` (`id1` int(2),`tweet` varchar(1000),`id2` int(2) )";
	$result_create = mysqli_query($conn,$sql_create) or die(mysql_error()); 
	for($j=0; $j<count($tweets);$j++)
	{
		$tweet = $tweets[$j];
		$words = explode(' ', $tweet);
		$id1=$ids[$j];
		$count_hsd = 0;
		$count_social = 0;
		$count_sleep = 0;
		$count_div = 0;
		$count_money = 0;
		$count_neg = 0;
        $count_good = 0;
        $count_bad = 0;
        $count_dis = 0;
        $count_politics=0;
        $count_terrorism = 0;
        $count_food = 0;
        $count_science = 0;
        $count_technology = 0;
        $count_health = 0;
        $count_pollution = 0;
        $count_business = 0;
        
		for($i = 0; $i < count($words); $i++)
		{
			if(in_array($words[$i], $hsd_bag))
				$count_hsd++;
			if(in_array($words[$i], $social_bag))
				$count_social++;
			if(in_array($words[$i], $sleep_bag))
				$count_sleep++;
			if(in_array($words[$i], $div_bag))
				$count_div++;
			if(in_array($words[$i], $money_bag))
				$count_money++;
			if(in_array($words[$i], $neg_bag))
				$count_neg++;
            if(in_array($words[$i], $good_book))
				$count_good++;
            if(in_array($words[$i], $bad_book))
				$count_bad++;
            if(in_array($words[$i], $disaster))
				$count_dis++;
            if(in_array($words[$i], $politics))
				$count_politics++;
            if(in_array($words[$i], $terrorism))
				$count_terrorism++;
            if(in_array($words[$i], $food))
				$count_food++;
            if(in_array($words[$i], $science))
				$count_science++;
            if(in_array($words[$i], $technology))
				$count_technology++;
            if(in_array($words[$i], $health))
				$count_health++;
            if(in_array($words[$i], $pollution))
				$count_pollution++;
            if(in_array($words[$i], $business))
				$count_business++;
		}
	
		$t1 = 0;
		$cat = 0;
		
		if( $count_hsd > $count_social )
		{
			$t1 = $count_hsd;
			$cat = 1;
		}
		else
		{
			$t1 = $count_social;
			$cat = 2;
		}
		if( $t1 < $count_sleep)
		{
			$t1 = $count_sleep;
			$cat = 3;
		}
		if( $t1 < $count_div)
		{
			$t1 = $count_div;
			$cat = 4;
		}
		if( $t1 < $count_money)
		{
			$t1 = $count_money;
			$cat = 5;
		}
		if( $t1 < $count_neg)
		{
			$t1 = $count_neg;
			$cat = 6;
		}
        if( $t1 < $count_good)
		{
			$t1 = $count_good;
			$cat = 7;
		}
        if( $t1 < $count_bad)
		{
			$t1 = $count_bad;
			$cat = 8;
		}
        if( $t1 < $count_dis)
		{
			$t1 = $count_dis;
			$cat = 9;
		}
        
        if( $t1 < $count_politics)
		{
			$t1 = $count_politics;
			$cat = 10;
		}
        if( $t1 < $count_terrorism)
		{
			$t1 = $count_terrorism;
			$cat = 11;
		}
        if( $t1 < $count_food)
		{
			$t1 = $count_food;
			$cat = 12;
		}
        if( $t1 < $count_science)
		{
			$t1 = $count_science;
			$cat = 13;
		}
        if( $t1 < $count_technology)
		{
			$t1 = $count_technology;
			$cat = 14;
		}
        if( $t1 < $count_health)
		{
			$t1 = $count_health;
			$cat = 15;
		}
        if( $t1 < $count_pollution)
		{
			$t1 = $count_pollution;
			$cat = 16;
		}
        if( $t1 < $count_business)
		{
			$t1 = $count_business;
			$cat = 17;
		}
        
		if( $t1 < 1 )
			$cat = 18;
		
		$id2 = $cat;
		$sql_insert = "INSERT INTO test_output2 (id1,tweet,id2) VALUES ('$id1','$tweet','$id2')";
		$result_insert = mysqli_query($conn,$sql_insert);
	}
?>