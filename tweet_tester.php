<html>

<head>
  <title>Issues classification</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <!-- modernizr enables HTML5 elements and feature detects -->
  <script type="text/javascript" src="js/modernizr-1.5.min.js"></script>
   
<style> 
.textbox { 
    border: 1px solid #999; 
    outline:0; 
    height:50px; 
    width: 800px; 
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
          <h2>Understanding  issues</h2>
        </div>
      </div>
      <nav>
        <ul class="sf-menu" id="nav">
          <li><a href="index.php">Home</a></li>
		  <li><a href="evaluate.php">Evaluation Measures</a></li>
		  <li><a href="input.php">Data Set</a></li>
  </div>
			<center>
			<form method="post" action= "single_tester.php"><br><br><br><br><br><br><br>
				<h2>Enter a tweet</h2>
				<input class="textbox"  type = "text" name = "tweet" size = '140' style="font-size: 20pt" /><br>
				<center><input type = "submit" value = "Test" class ="button"/></center>
			</form>        
			</center>
	</body>
</html>