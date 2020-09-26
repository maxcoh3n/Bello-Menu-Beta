<html>
  <head>
  <title>Edit Dish</title>
  </head>
  <body>

  <?php include 'common/bellodentrostarter.php'; 
  include 'common/courses.php';
  ?>

  <h2>Edit Dish </h2>

<?php

$NUM_INGREDIENTS = 6;

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

$DishID = $_GET['DishID'];


$query= "SELECT * FROM Dishes WHERE DishID='$DishID'";
$result= mysqli_query($cxn,$query)
   or die ("Database Query did not work, please contact I.T.");

$ShipArray = array();

$row = mysqli_fetch_assoc($result);

$CourseArray = getCourses("Primary");

$ActiveArray = array();
for($ct = 0; $ct < count($MenuArray); $ct++){
    $MenuActive = "Menu" . $MenuArray[$ct]['MenuID'] . "Active";
    $ActiveArray[$MenuActive] = $row[$MenuActive];
}
	
	$DishArray = array(
        'CourseCategory'   =>$row['CourseCategory'],
        'DishID'           =>$row['DishID'],
        'DishName'         =>$row['DishName'],
        'Ingredient1'      =>$row['Ingredient1'] ,
        'Ingredient2'      =>$row['Ingredient2'] ,
        'Ingredient3'      =>$row['Ingredient3'] ,
        'Ingredient4'      =>$row['Ingredient4'] ,
        'Ingredient5'      =>$row['Ingredient5'] ,
        'Ingredient6'      =>$row['Ingredient6'] ,
        'Price'            =>$row['Price'] ,
        'GlutenFree'       =>$row['GlutenFree'] ,
        'Vegan'            =>$row['Vegan'],
        'Raw'              =>$row['Raw'] ,
        'Spicy'            =>$row['Spicy'] ,
        'ActiveArray'      =>$ActiveArray
		);
	

?>

<form method=post action="editDish2.php">
<table width="400" border="0" cellspacing="1" cellpadding="2">

<?php
echo "
<tr>
<td width=100>Dish Name</td>
<td><select name='CourseCategory' >";
foreach($CourseArray as $Course){
    if($DishArray['CourseCategory'] == $Course){
        echo "<option selected value=$Course> $Course</option>";
    }else{
        echo "<option value=$Course> $Course</option>";
    }
}

echo "
<tr>
<td width=100>Dish Name</td>
<td><input name='DishName' type='varchar' value=".$DishArray['DishName']."> </td>
</tr>

<input name = 'DishID' type = 'hidden' value =".$DishArray['DishID'].">";

for($ct =1; $ct <= $NUM_INGREDIENTS; $ct++){
    $curIngredient = "Ingredient" . $ct;
    echo "<tr>
    <td width=100>Ingredient".$ct."</td>
    <td><input name=$curIngredient type='varchar' value=".$DishArray[$curIngredient]." > </td>
    </tr>";
}

echo "
<tr>
<td width=100>Price</td>
<td><input name='Price' type='varchar' value=".$DishArray['Price']." > </td>
</tr>";

    $checked = $DishArray['GlutenFree']? 'checked' : '';

    echo "<tr>
    <td width=100>Gluten Free</td>
    <td> <input type='checkbox' name='GlutenFree' value='GlutenFree' $checked></td> 
    </tr>";

    $checked = $DishArray['Vegan']? 'checked' : '';

    echo "<tr>
    <td width=100>Vegan</td>
    <td> <input type='checkbox' name='Vegan' value='Vegan' $checked></td> 
    </tr>";

    $checked = $DishArray['Raw']? 'checked' : '';

    echo "<tr>
    <td width=100>Raw</td>
    <td> <input type='checkbox' name='Raw' value='Raw' $checked></td> 
    </tr>";

    $checked = $DishArray['Spicy']? 'checked' : '';

    echo "<tr>
    <td width=100>Spicy</td>
    <td> <input type='checkbox' name='Spicy' value='GlutenFree' $checked></td> 
    </tr>";

    if(count($MenuArray)>0){
		echo "<tr>
			<th> Menu </th> 
			<th> Active on This Menu</th>
			</tr>
		";
	}
	  
	 for($ct = 0; $ct < count($MenuArray); $ct++){
        $MenuActive = "Menu" . $MenuArray[$ct]['MenuID'] . "Active";
        $checked = $DishArray['ActiveArray'][$MenuActive]? 'checked' : '';

		echo 
			"<tr> 
			<td> ".$MenuArray[$ct]['MenuName'] ."</td>
			<td> <input type = 'checkbox' name = ActiveArray[$ct] $checked> </td>
			<input type = 'hidden' name =MenuIDArray[$ct] value = ".$MenuArray[$ct]['MenuID']." >
			</tr>
		";	
	 } 

?>

<td>
<input type="submit" value="Update Dish Data">
</td>
</tr>

</table>
</form>

</body>
</html>
