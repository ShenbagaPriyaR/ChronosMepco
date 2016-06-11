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
			table,th , td {
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
          <h2>Understanding student's issues</h2>
        </div>
      </div>
      <nav>
        <ul class="sf-menu" id="nav">
          <li class="selected"><a href="index.php">Home</a></li>
		  <li class="selected"><a href="evaluate.php">Evaluation Measures</a></li>
		  <li class="selected"><a href="input.php">Data Set</a></li>
  </div>
	  <center><h2>Input Data Set</h2></center>
	  <table>
		<thead>
		  <tr>
			<th>Category ID</th>
			<th>Tweet</th>
		  </tr>
		</thead>
		<tbody>
		<?php 

			$sql = "select * from user ";
			$result = mysqli_query($conn,$sql);
			$x = 0;
			if( mysqli_num_rows($result) > 0)	{
				while( $row = mysqli_fetch_assoc($result))  {
					echo "<tr><td>";
					echo $row["id"];
					echo "</td><td>";
					echo $row["tweet"];
					echo "</td></tr>";
				}
			}

		?>
      </tbody>
	</table>
	</main>
	</div>
	</body>
</html>
