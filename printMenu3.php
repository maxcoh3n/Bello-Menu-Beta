<?php   include 'common/auth.php'; ?>

  <html>
  <head>
  <title>Print The Menu</title>
  </head>
  <body>

  <?php

  include 'common/databaseConnection.php';
  echo "<style>";
  include 'printthemenu2.css';
  echo "</style>";
  include 'common/restrictionBuilder.php';
  include 'common/courses.php';

$MenuID = $_POST['MenuID'];
$DishIDArray = $_POST['DishID'];
$ActiveArray = $_POST['Active'];
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



$DishArray = array();
foreach(getCourses($MenuID) as $row){
  $DishArray[$row['CourseName']] = array();
}


  echo "<div class = grid>";
  echo " <img src=belloLogo.png width = 150px height = 75px />";
  echo "</div>";



  $query= "SELECT * FROM Dishes WHERE $MenuActive = 1 ORDER BY CourseCategory, DishName" ;
  //print $query;
  $result= mysqli_query($cxn,$query);
  if ($cxn->connect_error) {
    die("Connection failed: " . $cxn->connect_error);
}

  while($row = mysqli_fetch_assoc($result))
  {
    array_push($DishArray[$row['CourseCategory']], array(
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
      'Active'          =>$row[$MenuActive],
      'Raw'           =>$row['Raw'],
      'Spicy'          =>$row['Spicy']
    ));
  }

  // print_r($DishArray);

  $ArrayCount = 0;
  $CourseArray = getCourses($MenuID);

  echo "<div class=center>";
    for($ct=0;$ct<count($CourseArray);$ct++) //goes through entire courseArray
    {
      $Course = $CourseArray[$ct]['CourseName'];
      $CourseExtendedName = $CourseArray[$ct]['ExtendedName'];

      echo "<span class = course> $CourseExtendedName</span><br>";
      for($ct2 = 0; $ct2 < count($DishArray[$Course]);$ct2++){

                $DishID           = $DishArray[$Course][$ct2]['DishID'];
                $DishName         = $DishArray[$Course][$ct2]['DishName'];
                $Ingredient1      = $DishArray[$Course][$ct2]['Ingredient1'];
                $Ingredient2      = $DishArray[$Course][$ct2]['Ingredient2'];
                $Ingredient3      = $DishArray[$Course][$ct2]['Ingredient3'];
                $Ingredient4      = $DishArray[$Course][$ct2]['Ingredient4'];
                $Ingredient5      = $DishArray[$Course][$ct2]['Ingredient5'];
                $Ingredient6      = $DishArray[$Course][$ct2]['Ingredient6'];

                $Ingredients = $Ingredient1;
                if($Ingredient2){
                  $Ingredients .= " / " . $Ingredient2;
                }
                if($Ingredient3){
                  $Ingredients .= " / " . $Ingredient3;
                }
                if($Ingredient4){
                  $Ingredients .= " / " . $Ingredient4;
                }
                if($Ingredient5){
                  $Ingredients .= " / " . $Ingredient5;
                }
                if($Ingredient6){
                  $Ingredients .= " / " . $Ingredient6;
                }

                $Price  = $DishArray[$Course][$ct2]['Price'];
                $GlutenFree    = (bool) $DishArray[$Course][$ct2]['GlutenFree'];
                $Vegan         = (bool) $DishArray[$Course][$ct2]['Vegan'];
                $Raw    = (bool) $DishArray[$Course][$ct2]['Raw'];
                $Spicy         = (bool) $DishArray[$Course][$ct2]['Spicy'];

                $Restrictions = restrictionBuilder($GlutenFree, $Vegan, $Raw, $Spicy);              


                echo"
                      <span class = dishName >$DishName </span><span class = ingredients >$Ingredients</span><span class = price > \$$Price</span>
                      <span class = restrictions >$Restrictions</span> <br>";
              

                $ArrayCount++;
        }
      }

      

  ?>

  </body></html>
