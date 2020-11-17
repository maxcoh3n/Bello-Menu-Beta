<?php   include 'common/auth.php'; ?>

<html>
<head>
<title>Delete a Dish</title>
</head>
<body>

	<!-- <h2>Bello By Sandro Nardone Internal Website</h2>
	<h3>Italian Food the Way It's Served in Italy</h3> -->


<?php  include 'common/bellodentrostarter.php'; ?>

<h3>Delete Dish</h3>

<?php
// STEP 1 Get SKU Data
//--------------------------------------------------------------------------------------------------------------------------------------

if( isset($_GET['DishID']))
//if( 1==1 )
//if(isset($_GET['WineryName']))
	{

	$DishID = $_GET['DishID'];

	$query0= "SELECT DishName FROM Dishes WHERE DishID = $DishID" ;
	//print $query;
	$result= mysqli_query($cxn,$query0);
	if ($cxn->connect_error) {
		die("Connection failed: " . $cxn->connect_error);
	}

	$row = mysqli_fetch_assoc($result);
	$DishName = $row['DishName'];


	

	$query= "DELETE FROM Dishes
	WHERE DishID = $DishID " ;
	 $result= mysqli_query($cxn,$query)
	       or die ("Database Query did not work, please contact I.T.");

	echo $DishName . " has been deleted. You may close this tab. </br>";
	}
	else
		echo "sorry, there was a problem";
?>
</body>
</html>
