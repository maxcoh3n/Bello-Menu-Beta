<?php   include 'common/auth.php'; ?>

<html>
<head>
<title>Add Menu</title>
</head>
<body>


<?php  

include 'common/bellodentrostarter.php'; ?>

<h3>Menu Creation</h3>

<?php

$MenuName = $_POST["MenuName"];
$TopText = $cxn->real_escape_string($_POST["TopText"]);
$BottomText = $cxn->real_escape_string($_POST["BottomText"]);
$BackText = $cxn->real_escape_string($_POST["BackText"]);
$CourseIDArray = $_POST["CourseIDArray"];
$CourseOrderArray = $_POST["CourseOrderArray"];


//INSERT NEW MENU INTO MENUS----------------------------------------------------------
$query1 = "INSERT INTO `Menus` (MenuName, TopText, BottomText, BackText) VALUES
	(
		'$MenuName',
		'$TopText',
		'$BottomText',
		'$BackText'
	)
";
// echo $query1;
$result1= mysqli_query($cxn,$query1)
			or die ("Database query to insert new Menu did not work, please contact I.T.");
			echo "$MenuName added to database\n";


//GET ID OF LAST MENU CREATED----------------------------------------------------------
$query2 = "SELECT LAST_INSERT_ID()";
// echo $query;
$result2= mysqli_query($cxn,$query2)
or die ("Database query2 to insert new column into Dishes did not work, please contact I.T.");

$row = mysqli_fetch_assoc($result2);
$MenuID = $row['LAST_INSERT_ID()'];
$MenuActive = "Menu" . $MenuID . "Active";

//ADD NEW COL TO DISHES FOR ACTIVITY ON NEW MENU----------------------------------------------------------
$query3 = "ALTER TABLE `Dishes` ADD `$MenuActive` BOOLEAN NOT NULL DEFAULT FALSE";
// echo $query;
$result3= mysqli_query($cxn,$query3)
or die ("Database query2 to insert new column into Dishes did not work, please contact I.T.");

$MenuOrder = "Menu" . $MenuID . "Order";

//ADD NEW COL TO COURSES FOR ORDER ON NEW MENU----------------------------------------------------------
$query4 = "ALTER TABLE `Courses` ADD `$MenuOrder` INT(3) NOT NULL";
// echo $query;
$result4= mysqli_query($cxn,$query4)
or die ("Database query4 to insert new column into Courses did not work, please contact I.T.");



for($ct = 0; $ct < count($CourseOrderArray);$ct++){
	if($CourseOrderArray[$ct]!= NULL && $CourseOrderArray[$ct]!= 0){
		$CourseOrder = $CourseOrderArray[$ct];
		$CourseID = $CourseIDArray[$ct];

		//UPDATE NEW COL IN COURSES FOR ORDER ON NEW MENU----------------------------------------------------------
		$query5 = "UPDATE `Courses` SET `$MenuOrder` = $CourseOrder WHERE `CourseID` = $CourseID";
		// echo $query;
		$result5= mysqli_query($cxn,$query5)
		or die ("Database query5 update order of course did not work, please contact I.T.");
	}
}

?>


</body>
</html>
