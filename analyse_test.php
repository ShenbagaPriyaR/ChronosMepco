<?php
		include 'db_connection.php';
?>
<?php 

	$sql="select * from test";
	$result= mysqli_query($conn,$sql);
	$tweets=array();
	$ids=array();
	$x=0;
	if(mysqli_num_rows($result) > 0)	{
		while($row = mysqli_fetch_assoc($result))  {
			array_push($tweets,$row["tweet"]);
			array_push($ids,$row["id1"]);
		}
	}
		$sql_del = "DROP TABLE IF EXISTS `test_input`";
		$result_del = mysqli_query($conn,$sql_del) or die(mysql_error()); 
		$sql_create = "CREATE TABLE `test_input` (`id1` int(2),`tweet` varchar(1000),`id2` int(2) )";
		$result_create = mysqli_query($conn,$sql_create) or die(mysql_error()); 
	for($i=0; $i<count($tweets); $i++)
	{
		$id1=$ids[$i];
		$id2=0;
		$tweet = $tweets[$i];
		$tweet = strtolower($tweet);
		$tweet = removeStopWords($tweet);
		$tweet = removeHash($tweet);
		$tweet = removeNegToken($tweet);
		$tweet = removelink($tweet);
		$tweet = removeRT($tweet);
		$tweet = removeRepeat($tweet);
		$tweet = removeAt($tweet);
		$tweet = removePunc($tweet);
		$tweet = removeSpace($tweet);
		$tweet = strtoupper($tweet);
		echo $tweet. "<br>";
		$sql_insert="INSERT INTO test_input (id1,tweet,id2) VALUES ('$id1','$tweet','$id2')";
		$result_insert = mysqli_query($conn,$sql_insert);

	}
 
	function removeStopWords($tweet)
	{
	
		$stopwords = array("a", "about", "above", "above", "across", "after", "afterwards", "again", "against",  "almost", "alone", "along", "already", "also","although","am","among", "amongst", "amoungst", "amount",  "an", "and", "another", "any","anyhow","anyone","anything","anyway", "anywhere", "are", "around", "as",  "at", "back","be","became", "because","become","becomes", "becoming", "been", "before", "beforehand", "behind", "being", "below", "beside", "besides", "between", "beyond", "bill", "both", "bottom","but", "by", "call", "can", "cannot", "cant", "co", "con", "could", "couldnt", "cry", "de", "describe", "detail", "do", "done", "down", "due", "during", "each", "eg", "eight", "either", "eleven","else", "elsewhere", "empty", "enough", "etc", "even", "ever", "every", "everyone", "everything", "everywhere", "except", "few", "fifteen", "fify", "fill", "find", "fire", "first", "five", "for", "former", "formerly", "forty", "found", "four", "from", "front", "full", "further", "get", "give", "go", "had", "has", "hasnt", "have", "he", "hence", "her", "here", "hereafter", "hereby", "herein", "hereupon", "hers", "herself", "him", "himself", "his", "how", "however", "hundred", "i", "ie", "if", "in", "inc", "indeed", "interest", "into", "is", "it", "its", "itself", "keep", "last", "latter", "latterly", "least", "less", "ltd", "made", "many", "may", "me", "meanwhile", "might", "mill", "mine", "moreover", "most", "mostly", "move", "must", "my", "myself", "name", "namely", "next", "nine", "now", "nowhere", "of", "off", "often", "on", "once", "one", "onto", "or", "other", "others", "otherwise", "our", "ours", "ourselves", "out", "over", "own","part", "per", "perhaps", "please", "put", "rather", "re", "same", "see", "seem", "seemed", "seeming", "seems", "serious", "several", "she", "should", "show", "side", "since", "sincere", "six", "sixty", "so", "some", "somehow", "someone", "something", "sometime", "sometimes", "somewhere",  "such", "system", "take", "ten", "than", "that", "the", "their", "them", "themselves", "then", "thence", "there", "thereafter", "thereby", "therefore", "therein", "thereupon", "these", "they", "thickv", "thin", "third", "this", "those", "though", "three", "through", "throughout", "thru", "thus", "to", "together", "too", "top", "toward", "towards", "twelve", "twenty", "two", "un", "under", "until", "up", "upon", "us", "very", "via", "was", "we", "well", "were", "what", "whatever", "when", "whence", "whenever", "where", "whereafter", "whereas", "whereby", "wherein", "whereupon", "wherever", "whether", "which", "while", "whither", "who", "whoever", "whole", "whom", "whose", "why", "will", "with", "within", "without", "would", "yet", "you", "your", "yours", "yourself", "yourselves", "the");
	
		$stopwordcount = count($stopwords);
		for($i = 0; $i<$stopwordcount; $i++)
			$tweet=str_replace(' '.$stopwords[$i].' ',' ', $tweet);	
		return $tweet;
	}
	function removeHash($tweet)
	{
		
		$hash = array(" #engineeringproblems ","#engineeringproblems"," #engineeringproblems"," #Engineeringproblems"," #EngineeringProblems"," #engineeringProblems"," #engineeringproblem"," #Engineeringproblem"," #EngineeringProblem"," #engineeringProblem"," #collegeproblems ","#collegeproblems"," #collegeproblems"," #Collegeproblems"," #CollegeProblems"," #collegeProblems"," #collegeproblem"," #Collegeproblem"," #CollegeProblem"," #collegeProblem","#familydrama","#KindleUnlimited"," #beachread"," #indieauthor"," #reviews"," #author"," #paperback"," #book","#","#chennai","#JacquelineBuilds");
		$le=count($hash);
		for($i = 0; $i < $le; $i++)
			$tweet=str_replace($hash[$i],' ', $tweet);	
		return $tweet;
	}
	function removeNegToken($tweet)
	{
		$negtokens = array("neither", "never", "nevertheless", "no", "nobody", "none", "noone", "nor", "not", "nothing", "don't", "didn't", "'twon't","ain't", "amn't", "an't","aren't", "bettern't", "cann't", "can't", "cou'dn't", "couldn't", "daren't", "dasn't", "dassn't", "doesn't", "dursn't", "hadn't", "hasn't", "haven't", "he'sn't", "I'dn't've", "isn't", "I'ven't", "mayn't", "mightn't", "mustn't", "needn't", "oughtn't", "sha'n't", "shalln't", "shan't", "she'sn't", "shou'dn't", "shouldn't", "'tisn't", "'twasn't", "'tweren't", "'twou'dn't", "'twouldn't", "wasn't", "we'ven't", "whyn't", "wo'n't", "won't", "worn't", "wou'dn't", "wouldn't");
		for($i = 0; $i < count($negtokens); $i++)
			$tweet = str_ireplace (' '.$negtokens[$i].' ', ' negtoken ', $tweet);
		return $tweet;	
	}
	function removelink($url)
	{
		$string = preg_replace('/\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i', '', $url);
		return $string;
		
	}
	function removeRT($tweet)
	{
		if($tweet[0] == 'r' && $tweet[1] == 't')
			$tweet = str_replace($tweet[0].$tweet[1], ' ', $tweet);
		return $tweet;
	}
	function removeRepeat($tweet)
	{
		$pattern = '~([A-Za-z0-9])\1\1+~';
		return preg_replace($pattern, '\1', $tweet);
	}
	function removePunc($tweet)
	{
		$puncs = array("!", "$+$", "$<$", "[", "%", ",", " $<=$", "]", "&", "-", "$<>$", "|", "'", ".", "=", ".", "~", "(", "/", "==", "~=", ")", "/!", "$>$", "*", "//", "$>$=", "*!", "{", "?", "`", "**", "}","@", ":", ";", "^", "|=", "&=", "+=", "-=", "*=", "/=", "**=", "***", '"');
		for($i = 0; $i < count($puncs); $i++)
			$tweet = str_ireplace ($puncs[$i], ' ', $tweet);
		return $tweet;
	}
	function removeSpace($tweet)
	{
		return trim(preg_replace('/[\s\t\n\r\s]+/',' ' ,$tweet));
	}
	
	function removeAt($tweet)
	{
		return preg_replace('/@[a-z]+/i' ," " , $tweet);
	}
?>