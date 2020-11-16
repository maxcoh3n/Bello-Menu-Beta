<html>
<head>
<title>Add a Dish</title>
</head>
<body>


<?php  
include 'common/bellodentrostarter.php'; 
include 'common/courses.php'
?>

<h3> Add a Dish Page 1 </h3>

<form method="post" action="addDish2.php">




<p>Don't worry about capitalization, it is all handled for you</p>
<?php

$CourseArray = getCourses("");

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
        <select name = 'CourseCategory' required='required'>";        
		foreach($CourseArray as $Course){
			echo "<option value=".$Course['CourseName']."> ".$Course['CourseName']."</option>";
		}
		
	echo"
		</select>
		<tr>



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
	";

	$query= "SELECT `MenuName`, `MenuID` FROM Menus ORDER BY MenuID" ;
    //print $query;
    $result= mysqli_query($cxn,$query);
    if ($cxn->connect_error) {
      die("Connection failed: " . $cxn->connect_error);
    }
    
    $MenuArray = array();

      while($row = mysqli_fetch_assoc($result))
      {
        array_push($MenuArray,array(
            'MenuName' => $row['MenuName'],
            'MenuID' => $row['MenuID']
        ));
	  }

	if(count($MenuArray)>0){
		echo "<tr>
			<th> Menu </th> 
			<th> Active on This Menu</th>
			</tr>
		";
	}
	  
	 for($ct = 0; $ct < count($MenuArray); $ct++){
		echo 
			"<tr> 
			<td> ".$MenuArray[$ct]['MenuName'] ."</td>
			<td> <input type = 'checkbox' name = ActiveArray[$ct]> </td>
			<input type = 'hidden' name =MenuIDArray[$ct] value = ".$MenuArray[$ct]['MenuID']." >
			</tr>
		";	
	 } 

	?>

	<tr>
	<td><input type='submit' value=' Submit ' name='submit'/></td>
	</tr>
	

	</table>
</form>



</body>
</html>
