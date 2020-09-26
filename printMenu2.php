  <html>
  <head>
  <title>Print The Menu</title>
  </head>
  <body>

  <?php 
  include 'common/auth.php';
  include 'common/bellodentrostarter.php'; 
  include 'common/courses.php';
  include 'common/restrictionBuilder.php';
  ?>

  <h2> Menu Printer Page 2 </h2>


  To add a new Dish, click <a href="addDish.php" target='_blank'>here</a>
 
  </form>



  <?php

  $MenuID = $_POST['MenuID'];
  $MenuActive = "Menu" . $MenuID . "Active";

  
  $DishArray = array();
  foreach(getCourses($MenuID) as $row){
    $DishArray[$row['CourseName']] = array();
  }

  $query= "SELECT * FROM Dishes ORDER BY CourseCategory, Price" ;
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
      'Raw'          =>$row['Raw'],
      'Spicy'          =>$row['Spicy']
    ));
  }



  echo "<table cellspacing='9'>\n";
      echo "<tr><td colspan='30'><hr/></td></tr>
          <th>Course</th>
          <th>Dish Name</th>
          <th> Ingredients </th>
          <th> Price </th>
          <th> Dietary Restrictions </th>
          <th> Active on Current Menu</th>
          <th> Edit Item </th>
          <th> Delete Item </th>
          ";


  // echo "<pre>";
  // print_r($DishArray);
  // echo "</pre>";

  ?> <form method="post" action="printMenu3.php" target="_blank"> <?php

  echo "<input type='hidden' name='MenuID'  value=$MenuID>";

  $ArrayCount = 0;
  $CourseArray = getCourses($MenuID);

    for($ct=0;$ct<count($CourseArray);$ct++) //goes through entire courseArray
    {
      $Course = $CourseArray[$ct]['CourseName'];
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
                if($Ingredient2 != 0){
                  $Ingredients .= " / " . $Ingredient2;
                }
                if($Ingredient3 != 0){
                  $Ingredients .= " / " . $Ingredient3;
                }
                if($Ingredient4 != 0){
                  $Ingredients .= " / " . $Ingredient4;
                }
                if($Ingredient5 != 0){
                  $Ingredients .= " / " . $Ingredient5;
                }
                if($Ingredient6 != 0){
                  $Ingredients .= " / " . $Ingredient6;
                }

                $Price  = $DishArray[$Course][$ct2]['Price'];
                $GlutenFree    = (bool) $DishArray[$Course][$ct2]['GlutenFree'];
                $Vegan         = (bool) $DishArray[$Course][$ct2]['Vegan'];
                $Raw    = (bool) $DishArray[$Course][$ct2]['Raw'];
                $Spicy         = (bool) $DishArray[$Course][$ct2]['Spicy'];

                $Restrictions = restrictionBuilder($GlutenFree, $Vegan, $Raw, $Spicy);

                $Active  = (bool) $DishArray[$Course][$ct2]['Active'];

                $EditLink = "editDish.php?DishID=" . $DishID;
                $DeleteLink       = "deleteDish.php?DishID=" . $DishID;


                echo"<tr>
                      <input type='hidden' name='DishID[".$ArrayCount."]'  value=$DishID>
                      <td>" .$Course. "</td> <input type='hidden' name='Course[".$ArrayCount."]'  value=$Course>
                      <td>" .$DishName. "</td> <input type='hidden' name='DishName[".$ArrayCount."]'  value=$DishName>
                      <td> $Ingredients  </td> <input type='hidden' name='Ingredients[".$ArrayCount."]'  value=$Ingredients>
                      <td> $Price  </td> <input type='hidden' name='Price[".$ArrayCount."]'  value=$Price>
                      <td> $Restrictions  </td> <input type='hidden' name='Restrictions[".$ArrayCount."]'  value=$Restrictions>";
                      if($Active){
                        echo "<td> <input type='checkbox' name='Active[".$ArrayCount."]' value='Active' Checked></td> ";
                      }
                      else{
                        echo "<td> <input type='checkbox' name='Active[".$ArrayCount."]' value='Active'></td>";
                      }
                      echo "
                      <td><a href=" . $EditLink . " target='_blank'>  Edit   </a></td>  
                      <td><a href=" . $DeleteLink . " target='_blank'>  Delete   </a></td></tr>  ";

                $ArrayCount++;
        }
      }

  ?>
  <tr><td colspan='30'><hr /></td></tr>

  <tr>
  <td>
  <input type="submit" value="Print Menu">
  </td>
  </tr>
  </table>
  </form>



  </body></html>
