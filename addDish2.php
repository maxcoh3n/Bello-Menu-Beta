<html>
<head>
<title>Add a Dish 2</title>
</head>
<body>


<?php  include 'common/bellodentrostarter.php';

echo "<h3>Menu Item Entry</h3>";


$CourseCategory = $_POST["CourseCategory"];
$DishName = ucwords($_POST["DishName"]);
$Ingredient1 = $_POST["Ingredient1"];
$Ingredient2 = $_POST["Ingredient2"];
$Ingredient3 = $_POST["Ingredient3"];
$Ingredient4 = $_POST["Ingredient4"];
$Ingredient5 = $_POST["Ingredient5"];
$Ingredient6 = $_POST["Ingredient6"];
$Price = $_POST["Price"];

$GlutenFree = (isset($_POST["GlutenFree"]))? 1: 0;
$Vegan = (isset($_POST["Vegan"]))? 1: 0;
// $Active = (isset($_POST["Active"]))? 1: 0;
$Raw = (isset($_POST["Raw"]))? 1: 0;
$Spicy = (isset($_POST["Spicy"]))? 1: 0;

$MenuIDArray = $_POST['MenuIDArray'];
$ActiveArray = $_POST['ActiveArray'];

$MenuActiveCols = "";
$MenuActiveVals = "";

for($ct = 0; $ct < count($MenuIDArray); $ct++){
	$MenuActiveCols .= "`Menu" . $MenuIDArray[$ct] . "Active`, ";
	if(array_key_exists($ct,$ActiveArray)){
		$MenuActiveVals .= "1, ";
	}else{
		$MenuActiveVals .= "0, ";	
	}
}

//remove last commas
$MenuActiveCols = substr($MenuActiveCols, 0, -2);
$MenuActiveVals = substr($MenuActiveVals, 0, -2);

$query1 = "INSERT INTO `Dishes` (CourseCategory,DishName,Ingredient1,Ingredient2,Ingredient3,Ingredient4,Ingredient5,Ingredient6,Price,GlutenFree,Vegan,$MenuActiveCols, Raw)

VALUES
	(
		'$CourseCategory',
		'$DishName',
		'$Ingredient1',
		'$Ingredient2',
		'$Ingredient3',
		'$Ingredient4',
		'$Ingredient5',
		'$Ingredient6',
		$Price,
		$GlutenFree,
		$Vegan,
		$MenuActiveVals,
		$Raw
	)
";

echo $query1 . "<br>";
$result1= mysqli_query($cxn,$query1)
			or die ("Database Query1 to insert data did not work, please contact I.T.");
			echo "$DishName added to database\n";

?>
</body>
</html>
