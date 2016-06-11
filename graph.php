<?php
		include 'db_connection.php';
		include 'reader.php';
?>
<?php // content="text/plain; charset=utf-8"
	require_once ('src/jpgraph.php');
	require_once ('src/jpgraph_pie.php');

	$sql = "select * from test_output where id2=1";
	$result = mysqli_query($conn,$sql);
	$num_hsd=mysqli_num_rows($result);
    
	$sql1 = "select * from test_output where id2=2";
	$result1 = mysqli_query($conn,$sql1);
	$num_social=mysqli_num_rows($result1);
	
    $sql2 = "select * from test_output where id2=3";
	$result2 = mysqli_query($conn,$sql2);
	$num_sleep = mysqli_num_rows($result2);
	
    $sql3 = "select * from test_output where id2=4";
	$result3 = mysqli_query($conn,$sql3);
	$num_div = mysqli_num_rows($result3);
	
    $sql4 = "select * from test_output where id2=5";
	$result4 = mysqli_query($conn,$sql4);
	$num_money = mysqli_num_rows($result4);
	
    $sql5 = "select * from test_output where id2=6";
	$result5 = mysqli_query($conn,$sql5);
	$num_neg = mysqli_num_rows($result5);
	
    $sql6 = "select * from test_output where id2=7";
	$result6 = mysqli_query($conn,$sql6);
	$num_good = mysqli_num_rows($result6);
    
    $sql7 = "select * from test_output where id2=8";
	$result7 = mysqli_query($conn,$sql7);
	$num_bad = mysqli_num_rows($result7);
    
    $sql8 = "select * from test_output where id2=9";
	$result8 = mysqli_query($conn,$sql8);
	$num_disaster = mysqli_num_rows($result8);
    
    $sql9 = "select * from test_output where id2=10";
	$result9 = mysqli_query($conn,$sql9);
	$num_politics = mysqli_num_rows($result9);
    
    $sql10 = "select * from test_output where id2=11";
	$result10 = mysqli_query($conn,$sql10);
	$num_terrorism=mysqli_num_rows($result10);
    
    $sql11 = "select * from test_output where id2=12";
	$result11 = mysqli_query($conn,$sql11);
	$num_food=mysqli_num_rows($result11);
    
    $sql12 = "select * from test_output where id2=13";
	$result12 = mysqli_query($conn,$sql12);
	$num_science=mysqli_num_rows($result12);
    
    $sql13 = "select * from test_output where id2=14";
	$result13 = mysqli_query($conn,$sql13);
	$num_technology=mysqli_num_rows($result13);
    
    $sql14 = "select * from test_output where id2=15";
	$result14 = mysqli_query($conn,$sql14);
	$num_health=mysqli_num_rows($result14);
    
    $sql15 = "select * from test_output where id2=16";
	$result15 = mysqli_query($conn,$sql15);
	$num_pollution=mysqli_num_rows($result15);
    
    $sql16 = "select * from test_output where id2=17";
	$result16 = mysqli_query($conn,$sql16);
	$num_business=mysqli_num_rows($result16);
    
    $sql17 = "select * from test_output where id2=18";
	$result17 = mysqli_query($conn,$sql17);
	$num_others=mysqli_num_rows($result17);
    
	if ($num_div < 3)
		$num_div = 3;
	if ($num_money <10)
		$num_money = 10;
	if ($num_neg <10)
		$num_neg=5;
	$data = array($num_hsd,$num_social,$num_sleep,$num_div,$num_money,$num_neg,$num_good,$num_bad,$num_disaster,$num_politics,$num_terrorism,$num_food,$num_science,$num_technology,$num_health,$num_pollution,$num_business,$num_others);
	//$data= array(10,20,30,40,50,60,7);
	$graph = new PieGraph(800,800);
	$graph->SetShadow();
 
	$p1 = new PiePlot($data);
	$p1->SetLegends(array("Heavy Study Load","Lack of Social Engagement","Sleep Problem","Diversity Issues","Money Problem","Negative Emotion","good_book","bad_book","disaster","politics","terrorism","food","science","technology","health","pollution","business"));
	$graph->Add($p1);
	$graph->Stroke();
 
?>
