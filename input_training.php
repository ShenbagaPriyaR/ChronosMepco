<?php
	include 'db_connection.php';
?>
<html>
	<head>
		<style>
	table,th , td{
	border : 1px solid black;
	}
		</style>
	</head>
<body>
<div id="box">
<main id="center">
  <h1>Input Tweets</h1>
  <table>
    <thead>
      <tr>
        <th>Id</th>
        <th>Tweet</th>
      </tr>
    </thead>
    <tbody>
<?php 

    $sql="select * from input";
	$result= mysqli_query($conn,$sql);
	$x=0;
	if( mysqli_num_rows($result) > 0)	{
		while( $row = mysqli_fetch_assoc($result))  {
			echo "<tr><td>";
			echo $row["id"];
			echo "</td><td>";
			echo $row["tweet"];
			echo "</td></tr>";
			echo "</td><td>";
		}
	}

?>
      
    </tbody>
  </table>
</main>
</div>
</body>
</html>
