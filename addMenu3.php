<html>
<head>
<title>Add Menu 3</title>
</head>
<body>


<?php  include 'common/bellodentrostarter.php';

echo "<h3>Menu Creation 3</h3>";


$GlutenFree = 0;
$Vegan = 0;
$Active = 0;
$Raw = 0;

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
$Active = (isset($_POST["Active"]))? 1: 0;
$Raw = (isset($_POST["Raw"]))? 1: 0;
$Spicy = (isset($_POST["Spicy"]))? 1: 0;



$Query1 = "INSERT INTO `Dishes` (CourseCategory,DishName,Ingredient1,Ingredient2,Ingredient3,Ingredient4,Ingredient5,Ingredient6,Price,GlutenFree,Vegan,Active, Raw)

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
		$Active,
		$Raw
	)
";


$result1= mysqli_query($cxn,$Query1)
			or die ("Database Query1 to insert data did not work, please contact I.T.");
			echo "$DishName added to database\n";

?>
</body>
</html>
