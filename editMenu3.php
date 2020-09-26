<html>
  <head>
  <title>Edit Menu</title>
  </head>
  <body>

  <?php include 'common/bellodentrostarter.php'; ?>

  <h2>Edit Menu Page 3 </h2>

<?php

$MenuID = $_POST["MenuID"];
$MenuName = $_POST["MenuName"];
$TopText = $cxn->real_escape_string($_POST["TopText"]);
$BottomText = $cxn->real_escape_string($_POST["BottomText"]);
$BackText = $cxn->real_escape_string($_POST["BackText"]);
$CourseIDArray = $_POST["CourseIDArray"];
$CourseOrderArray = $_POST["CourseOrderArray"];
$DishIDArray = $_POST["DishIDArray"];
$ActiveArray = $_POST["ActiveArray"];



//UPDATE MENU INFO IN MENUS----------------------------------------------------------
$query1 = "UPDATE `Menus` SET 
	`TopText` = '$TopText',
	`BottomText` = '$BottomText',
	`BackText` = '$BackText'
	WHERE `MenuID` = $MenuID	
";
// echo $query1;
$result1= mysqli_query($cxn,$query1)
			or die ("Database query to update Menus did not work, please contact I.T.");


$MenuActive = "Menu" . $MenuID . "Active";

// FIRST, Update the database and set dishes to be active or incative
for($ct = 0; $ct < count($DishIDArray); $ct++){
    $DishID = $DishIDArray[$ct];
    $Active = array_key_exists($ct,$ActiveArray);

    $query= "UPDATE Dishes SET `$MenuActive` = '$Active' WHERE DishID = $DishID" ;
    // print $query;
    $result= mysqli_query($cxn,$query);
    if ($cxn->connect_error) {
      die("Connection failed: " . $cxn->connect_error);
    }
}

$MenuOrder = "Menu" . $MenuID . "Order";

// Update the database and set courses to be correct order or incative
for($ct = 0; $ct < count($CourseIDArray); $ct++){
    $CourseID = $CourseIDArray[$ct];
    $Order = $CourseOrderArray[$ct];

    $query= "UPDATE Courses SET `$MenuOrder` = '$Order' WHERE `CourseID` = $CourseID" ;
    // print $query;
    $result= mysqli_query($cxn,$query);
    if ($cxn->connect_error) {
      die("Connection failed: " . $cxn->connect_error);
    }
}
echo "Changes to $MenuName saved";

?>
</body>
</html>
