<html>
<head>
<title>Add a Dish</title>
</head>
<body>


<?php  

include 'common/bellodentrostarter.php'; ?>

<form method="post" action="addDish2.php">

<?php

	echo        
		"<table cellspacing='10'>
		<addadishtd colspan='30'></td></tr>
		<tr>
		</tr>
		";	

	echo 
	"<tr>
	<td>Course</td>
	<td>  
        <select name = 'CourseCategory' required='required'>        
                <option value='Antipasti'>Antipasti</option>
                <option value='Pasta'>Pasta</option>
                <option value='Secondi'>Secondi</option>
                <option value='Contorni'>Contorni</option>
        </select>
    </td>
    </tr>

	<tr>
	<td>Dish Name</td>
	<td><input type='text' name='DishName' id='DishName' required='required' placeholder='required'></td>
	</tr>

	<tr>
	<td>Ingredient 1</td>
	<td><input type='text' name='Ingredient1' id='Ingredient1' required='required' placeholder='required'></td>
	</tr>

	<tr>
	<td>Ingredient 2</td>
	<td><input type='text' name='Ingredient2' id='Ingredient2' placeholder='optional'></td>
	</tr>

	<tr>
	<td>Ingredient 3</td>
	<td><input type='text' name='Ingredient3' id='Ingredient3' placeholder='optional'></td>
	</tr>

	<tr>
	<td>Ingredient 4</td>
	<td><input type='text' name='Ingredient4' id='Ingredient4' placeholder='optional'></td>
	</tr>

	<tr>
	<td>Ingredient 5</td>
	<td><input type='text' name='Ingredient5' id='Ingredient5' placeholder='optional'></td>
	</tr>

	<tr>
	<td>Ingredient 6</td>
	<td><input type='text' name='Ingredient6' id='Ingredient6' placeholder='optional'></td>
	</tr>

	<tr>
	<td>Price</td>
	<td><input type='Number' step='0.01' name='Price' id='Price' required='required' placeholder='required'></td>
	</tr>

	<tr>
	<td>Gluten Free</td>
	<td><input type='checkbox' name='GlutenFree' id='GlutenFree'></td>
	</tr>

	<tr>
	<td>Vegan</td>
	<td><input type='checkbox' name='Vegan' id='Vegan'></td>
	</tr>

	<tr>
	<td>Raw Ingredients</td>
	<td><input type='checkbox' name='Raw' id='Raw'></td>
	</tr>

	<tr>
	<td>Spicy</td>
	<td><input type='checkbox' name='Raw' id='Raw'></td>
	</tr>

	<tr>
	<td>Active (on the Current Menu)</td>
	<td><input type='checkbox' name='Active' id='Active' checked></td>
	</tr> 

	<tr>
	<td><input type='submit' value=' Submit ' name='submit'/></td>
	</tr>
	";

echo "</table>";
echo "</form>";


?>

</body>
</html>
