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

$DishID = $_GET['DishID'];


$query= "SELECT * FROM Dishes WHERE DishID='$DishID'";
$result= mysqli_query($cxn,$query)
   or die ("Database Query did not work, please contact I.T.");

$ShipArray = array();

$row = mysqli_fetch_assoc($result);

$CourseArray = getCourses("Primary");
	
	$DishArray = array(
        'CourseCategory'        =>$row['CourseCategory'],
        'DishID'        =>$row['DishID'],
        'DishName'        =>$row['DishName'],
        'Ingredient1'      =>$row['Ingredient1'] ,
        'Ingredient2'      =>$row['Ingredient2'] ,
        'Ingredient3'      =>$row['Ingredient3'] ,
        'Ingredient4'      =>$row['Ingredient4'] ,
        'Ingredient5'      =>$row['Ingredient5'] ,
        'Ingredient6'      =>$row['Ingredient6'] ,
        'Price'            =>$row['Price'] ,
        'GlutenFree'      =>$row['GlutenFree'] ,
        'Vegan'           =>$row['Vegan'],
        'Raw'      =>$row['Raw'] ,
        'Spicy'      =>$row['Spicy'] ,
        'Active'          =>$row['Active']
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
</td>
</tr>



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

$checked = $DishArray[$curIngredient]? 'hecked' : '';

if($DishArray['Active']){
    echo "<tr>
    <td width=100>Active</td>
    <td> <input type='checkbox' name='Active' value='Active' Checked></td> 
    </tr>";
}
else{
    echo "<tr>
    <td width=100>Active</td>
    <td> <input type='checkbox' name='Active' value='Active'></td> 
    </tr>";
}

if($DishArray['GlutenFree']){
    echo "<tr>
    <td width=100>GlutenFree</td>
    <td> <input type='checkbox' name='GlutenFree' value='GlutenFree' Checked></td> 
    </tr>";
}
else{
    echo "<tr>
    <td width=100>GlutenFree</td>
    <td> <input type='checkbox' name='GlutenFree' value='GlutenFree'></td> 
    </tr>";
}

if($DishArray['Vegan']){
    echo "<tr>
    <td width=100>Vegan</td>
    <td> <input type='checkbox' name='Vegan' value='Vegan' Checked></td> 
    </tr>";
}
else{
    echo "<tr>
    <td width=100>Vegan</td>
    <td> <input type='checkbox' name='Vegan' value='Vegan'></td> 
    </tr>";
}

if($DishArray['Raw']){
    echo "<tr>
    <td width=100>Raw</td>
    <td> <input type='checkbox' name='Raw' value='Raw' Checked></td> 
    </tr>";
}
else{
    echo "<tr>
    <td width=100>Raw</td>
    <td> <input type='checkbox' name='Raw' value='Raw'></td> 
    </tr>";
}

if($DishArray['Spicy']){
    echo "<tr>
    <td width=100>Spicy</td>
    <td> <input type='checkbox' name='Spicy' value='Spicy' Checked></td> 
    </tr>";
}
else{
    echo "<tr>
    <td width=100>Spicy</td>
    <td> <input type='checkbox' name='Spicy' value='Spicy'></td> 
    </tr>";
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
