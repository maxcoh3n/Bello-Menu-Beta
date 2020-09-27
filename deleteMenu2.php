<?php   include 'common/auth.php'; ?>

<html>
<head>
<title>Delete Menu 2</title>
</head>
<body>


<?php  include 'common/bellodentrostarter.php';

echo "<h3>Menu Deletion</h3>";
            

$result = $_POST["MenuID|MenuName"];
$result_explode = explode('|', $result);
$MenuID = $result_explode[0];
$MenuName = $result_explode[1];

//DELETE ACTUAL MENU----------------------------------------------------------
$query1 = "DELETE FROM `Menus` WHERE `MenuID` = $MenuID";
$result1= mysqli_query($cxn,$query1)
			or die ("Database query1 to delete menu did not work, please contact I.T.");

$MenuActive = "Menu" . $MenuID . "Active";

//DELETE COLUMN FROM DISHSE----------------------------------------------------------
$query2 = "ALTER TABLE `Dishes` DROP `$MenuActive`";
$result2= mysqli_query($cxn,$query2)
			or die ("Database query2 to delete menu from dishes did not work, please contact I.T.");

$MenuOrder = "Menu" . $MenuID . "Order";

//DELETE COLUMN FROM COURSES----------------------------------------------------------
$query3 = "ALTER TABLE `Courses` DROP `$MenuOrder`";
$result3= mysqli_query($cxn,$query3)
			or die ("Database query3 to delete menu from courses did not work, please contact I.T.");


echo $MenuName . " Successfully deleted";


?>
</body>
</html>
