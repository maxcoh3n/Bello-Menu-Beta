<?php   include 'common/auth.php'; ?>

<html>
  <head>
  <title>Edit Menu</title>
  </head>
  <body>

  <?php include 'common/bellodentrostarter.php'; ?>

  <h2>Edit Menu Page 2 </h2>



<?php

$result = $_POST["MenuID|MenuName"];
$result_explode = explode('|', $result);
$MenuID = $result_explode[0];
$MenuName = $result_explode[1];

echo "

	<h4> Editing $MenuName</h4>
	<form method=post action=editMenu3.php>
	<table width=400 border=0 cellspacing=1 cellpadding=2>
	<input type='hidden' name='MenuID' value =$MenuID>
	<input type='hidden' name='MenuName' value =$MenuName>

";

$query= "SELECT * FROM `Menus` WHERE `MenuID` = $MenuID" ;
    //print $query;
    $result= mysqli_query($cxn,$query);
    if ($cxn->connect_error) {
      die("Connection failed: " . $cxn->connect_error);
    }
    
    $TextArray = array();

      $row = mysqli_fetch_assoc($result);
        $TextArray = array(
			'TopText' => $row['TopText'],
			'BottomText' => $row['BottomText'],
            'BackText' => $row['BackText']
        );


	echo        
	"<table>

	<tr>
	<td>Top Text (Below Logo)</td>
	<td><textarea type='text' name='TopText' id='TopText' required='required' cols = 30>".$TextArray['TopText']."</textarea></td>
	</tr>

	<tr>
	<td>Bottom Text</td>
	<td><textarea type='text' name='BottomText' id='TopText' required='required' rows = 3 cols = 30>".$TextArray['BottomText']."</textarea></td>
	</tr>

	<tr>
	<td>Back Text</td>
	<td><textarea type='text' name='BackText' id='TopText' required='required' rows = 10 cols = 30>".$TextArray['BackText']."</textarea></td>
	</tr>

	";

	$MenuOrder = "Menu" . $MenuID . "Order";

	//* GET ALL COURSES FROM DB, AND THEN allow user to select which courses they want on this menu
	$query= "SELECT `CourseName`, `CourseID`, `$MenuOrder` FROM `Courses` ORDER BY `$MenuOrder`" ;
    // print $query;
    $result= mysqli_query($cxn,$query);
    if ($cxn->connect_error) {
      die("Connection failed: " . $cxn->connect_error);
    }
    
    $CourseArray = array();

	while($row = mysqli_fetch_assoc($result))
	{
	  array_push($CourseArray, array(
		'CourseName'        =>$row['CourseName'],
		'CourseID'        =>$row['CourseID'],
		'MenuOrder'       => $row[$MenuOrder]
	  ));
	}

	if(count($CourseArray) >0){
		echo "<tr>
			<th> Course </th> 
			<th> Course Order (1 to n, leave blank if not on this menu)</th>
			</tr>
		";
	}

	for($ct = 0; $ct < count($CourseArray); $ct ++){
		echo "<tr>
			<td>". $CourseArray[$ct]['CourseName'] ."</td> 
			<td><input type='number' name=CourseOrderArray[$ct] value = ".$CourseArray[$ct]['MenuOrder'] ." ></td>
			<input type='hidden' name=CourseIDArray[$ct] value =".$CourseArray[$ct]['CourseID'] .">
			</tr>
		";
	}

	$MenuActive = "Menu" . $MenuID . "Active";

	//* GET ALL DISHES FROM DB, AND THEN allow user to select which Dishes are Active
	$query= "SELECT  `DishName`, `DishID`, `$MenuActive`  FROM Dishes ORDER BY CourseCategory, Price" ;
  //print $query;
  $result= mysqli_query($cxn,$query);
  if ($cxn->connect_error) {
    die("Connection failed: " . $cxn->connect_error);
}

	$DishArray = array();

  while($row = mysqli_fetch_assoc($result))
  {
    array_push($DishArray, array(
      'DishID'        =>$row['DishID'],
      'DishName'        =>$row['DishName'],
      'Active'          =>$row[$MenuActive],
    ));
  }

  if(count($DishArray) >0){
	echo "<tr>
		<th> Dish </th> 
		<th> Active on Menu</th>
		</tr>
	";
}

for($ct = 0; $ct < count($DishArray); $ct ++){
	$checked = $DishArray[$ct]['Active']? "checked" : "";
	echo "<tr>
		<td>". $DishArray[$ct]['DishName'] ."</td> 
		<td><input type='checkbox' name=ActiveArray[$ct] value = 1 $checked></td>
		<input type='hidden' name=DishIDArray[$ct] value =".$DishArray[$ct]['DishID'] .">
		</tr>
	";
}

	?>

<td>
<input type="submit" value="Update Menu Data">
</td>

</body>
</html>
