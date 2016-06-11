<?php
?>
<html>

<head>
  <title>Mining social media </title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <script type="text/javascript" src="js/modernizr-1.5.min.js"></script>
</head>

<body>
  <div id="main">
    <header>
      <div id="logo">
        <div id="logo_text">
          <h1><a href="index.php">Mining Social Media Data</a></h1>
        </div>
      </div>
      <nav>
        <ul class="sf-menu" id="nav">
          <li><a href="index.php">Home</a></li>
		  <li><a href="evaluate.php">Evaluation Measures</a></li>
		  <li><a href="input.php">Data Set</a></li>
      </nav>
    </header>
    <div id="site_content">
      <div class="gallery">
        <ul class="images">
          <li class="show"><img width="950" height="300" src="images/2.jpg" alt="photo_one" /></li>
          <li><img width="950" height="300" src="images/1.jpg" alt="seascape" /></li>
		  <li><img width="950" height="300" src="images/t2.gif" alt="seascape" /></li>
          <li><img width="950" height="300" src="images/3.jpg" alt="seascape" /></li>
		  <li><img width="950" height="300" src="images/t1.jpg" alt="seascape" /></li>
		  <li><img width="950" height="300" src="images/t3.jpg" alt="seascape" /></li>
		  <li><img width="950" height="300" src="images/t4.jpg" alt="seascape" /></li>
        </ul>
      </div>
	</div>
	 <div class="content">
        <h6>Social Media Data Analysis</h6>
        <p>It is a tool that will look at unstructured conversation data on social networks and will
        help answer questions posted in the English natural language. For example – The tool who
        would help in finding answers to the question how many requests for help are we getting 
        on twitter or facebook?</p>
    	</div>
	<div id="sidebar_container">
        <div class="sidebar">
			<form action = "tweet_tester.php">
				<input type = "submit" value = "Test a Tweet" class ="button"/>
			</form>        
		</div>
	<div id="sidebar_container">
        <div class="sidebar">
			<form action = "home.php">
				<input type = "submit" value = "     Report     " class ="button"/>
			</form>        
		</div>
	
    </div>
  </div>
  <p>&nbsp;</p>
  <!-- javascript at the bottom for fast page loading -->
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/jquery.easing-sooper.js"></script>
  <script type="text/javascript" src="js/jquery.sooperfish.js"></script>
  <script type="text/javascript" src="js/image_fade.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('ul.sf-menu').sooperfish();
    });
  </script>
</body>
</html>