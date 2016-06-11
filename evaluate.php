<?php
		include 'db_connection.php';
?>
<html>

<head>
  <title>Issues Classification</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <!-- modernizr enables HTML5 elements and feature detects -->
  <script type="text/javascript" src="js/modernizr-1.5.min.js"></script>
    <style>
			table ,th , td {
			border : 1px solid black;
		}
	</style>
</head>

<body>
  <div id="main">
    <header>
      <div id="logo">
        <div id="logo_text">
          <!-- class="logo_colour", allows you to change the colour of the text -->
          <h1><a href="index.php">Mining Social Media Data</a></h1>
          <h2>Understanding issues</h2>
        </div>
      </div>
      <nav>
        <ul class="sf-menu" id="nav">
          <li class="selected"><a href="index.php">Home</a></li>
		  <li class="selected"><a href="evaluate.php">Evaluation Measures</a></li>
		  <li class="selected"><a href="input.php">Data Set</a></li>
  </div>
  <center><h2> Evaluation Measures </h2><br><h2>Identification of Threshold value </h2></center>
  <center>
  	  <table>
		<thead>
		  <tr>
			<th>Threshold</th>
			<th>Percentage of rightly classified Tweets</th>
		  </tr>
		</thead>
		<tbody>	
<?php
	$arr_tp = array();
	$arr_tn = array();
	$arr_fn = array();
	$arr_fp = array();
	$arr = array();
	$arr_accuracy = array();
	$arr_precision = array();
	$arr_recall = array();
	$arr_f1 = array();
	$sql = $result = "";
	$threshold = array(0.1, 0.2, 0.3, 0.4, 0.5, 0.6, 0.7, 0.8, 0.9);
	for( $j = 0 ; $j< 9; $j++)
	{
		$sql="select * from test_output where id1 = id2  and threshold = '$threshold[$j]'";
		$result = mysqli_query($conn,$sql);
		$percent[$j] = mysqli_num_rows($result);
	}
	
	for( $j = 0 ; $j< 9; $j++)
	{
		echo "<tr><td><center>";
		echo $threshold[$j];
		echo "</center></td><td><center>";
		echo (ceil (($percent[$j] / 327) * 100)) . "%" . "<br>";
		echo "</center></td></tr>";
	}
	echo "</tbody></table></center>";
	echo "<center><h2> Label Based evaluation </h2>
		 <table>
		  <thead>
		  <tr>
			<th>Category</th>
			<th>Accuracy</th>
			<th>Precision</th>
			<th>Recall</th>
			<th>F1</th>
		  </tr>
		</thead>
		<tbody>";
	for($i = 1; $i < 18; $i++)
	{
		$sql = "select * from test_output where id1 = '$i' and id2 = '$i' and threshold = 0.4";
		$result = mysqli_query($conn,$sql);
		$arr_tp[$i-1] = mysqli_num_rows($result);
		$sql = "select * from test_output where id1 <> '$i' and id2 <> '$i' and threshold = 0.4";
		$result = mysqli_query($conn,$sql);
		$arr_tn[$i-1] = mysqli_num_rows($result);
		$sql = "select * from test_output where id1 = '$i' and id2 <> '$i' and threshold = 0.4";
		$result = mysqli_query($conn,$sql);
		$arr_fp[$i-1] = mysqli_num_rows($result);
		$sql = "select * from test_output where id1 <> '$i' and id2 = '$i' and threshold = 0.4";
		$result = mysqli_query($conn,$sql);
		$arr_fn[$i-1] = mysqli_num_rows($result);
	}
	
	for($i = 1; $i < 18; $i++)
	{
		if($arr_tp[$i-1] == 0 ) $arr_tp[$i-1] = 0.01;
		if($arr_fp[$i-1] == 0 ) $arr_tp[$i-1] = 0.01;
		if($arr_tn[$i-1] == 0 ) $arr_tp[$i-1] = 0.01;
		if($arr_fn[$i-1] == 0 ) $arr_tp[$i-1] = 0.01;
		
		$sum = ($arr_tp[$i-1]+$arr_tn[$i-1]+$arr_fn[$i-1]+$arr_fp[$i-1]);
		$arr_accuracy[$i-1] = ($arr_tp[$i-1] + $arr_tn[$i-1]) / $sum;
		$arr_precision[$i-1] = $arr_tp[$i-1] / ($arr_tp[$i-1] + $arr_fp[$i-1]);
		$arr_recall[$i-1] = $arr_tp[$i-1] / ($arr_tp[$i-1] + $arr_fn[$i-1]);
		$arr_f1[$i-1] = (2 * $arr_precision[$i-1] * $arr_recall[$i-1]) / ($arr_precision[$i-1] + $arr_recall[$i-1] );
	}
	$cat = array("Heavy Study Load","Lack of Social Engagement","Sleep Problems","Diversity Issues","Money Problem",
				"Negative Emotions","good_book","bad_book","disaster","politics","terrorism","food","science","technology","health","pollution","business");
	for ($i = 0; $i < 17 ; $i++)
	{
		echo "<tr><td>";
		echo $cat[$i];
		echo "</td><td>";
		echo $arr_accuracy[$i] ;
		echo "</td><td>";
		echo $arr_precision[$i];
		echo "</td><td>";
		echo $arr_recall[$i];
		echo "</td><td>";
		echo $arr_f1[$i]; 
		echo "</td></tr>";
	}
	echo "</tbody></table></center>";
?>
	</body>
</html>