<?php   include 'common/auth.php'; ?>
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
 
  </form>


  <?php

  if(isset($_POST["MenuID|MenuName"])){ 
    $result = $_POST["MenuID|MenuName"];
    $result_explode = explode('|', $result);
    $MenuID = $result_explode[0];
    $MenuName = $result_explode[1];
  }
  else if(isset($_GET["MenuName"])){

    $MenuName = $_GET["MenuName"];

    $query0= "SELECT `MenuID` FROM `Menus` WHERE `MenuName` = '$MenuName' " ;
    //print $query0;
    $result= mysqli_query($cxn,$query0);
    if ($cxn->connect_error) 
      die("Connection failed: " . $cxn->connect_error);

    $res = mysqli_fetch_assoc($result);

    if(!$res){
      echo "Sorry, that menu doesn't exist yet. Please go to <a href = 'printMenu.php' > this link </a> to create it";
      die();  
    }

    $MenuID = $res['MenuID'];

  }
  else{
    echo "Sorry, you aren't supposed to be here. Please go to <a href = 'printMenu.php' > this link </a> first";
    die();
  }

  echo "To add a new Dish, click <a href='addDish.php' target='_blank'>here</a>";
  
  $MenuActive = "Menu" . $MenuID . "Active";

  
  $DishArray = array();
  foreach(getCourses($MenuID) as $row){
    $DishArray[$row['CourseName']] = array();
  }

  $query= "SELECT * FROM Dishes ORDER BY CourseCategory, DishName" ;
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

  echo "<h3> $MenuName Menu </h3>";

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

  ?> <form method="post" action="printMenu3.php" > <?php

  echo "<input type='hidden' name='MenuID'  value=$MenuID>";
  echo "<input type='hidden' name='MenuName'  value=$MenuName>";

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

        $Ingredients = ucfirst($Ingredient1);
        if($Ingredient2 != ""){
          $Ingredients .= " / " . ucfirst($Ingredient2);
        }
        if($Ingredient3 != ""){
          $Ingredients .= " / " . ucfirst($Ingredient3);
        }
        if($Ingredient4 != ""){
          $Ingredients .= " / " . ucfirst($Ingredient4);
        }
        if($Ingredient5 != ""){
          $Ingredients .= " / " . ucfirst($Ingredient5);
        }
        if($Ingredient6 != ""){
          $Ingredients .= " / " . ucfirst($Ingredient6);
        }

        // echo "Ingredients: " . $Ingredients;

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
              <td>" .strtoupper($DishName). "</td> <input type='hidden' name='DishName[".$ArrayCount."]'  value=$DishName>
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
  <input type="submit" name="save" value="Save Menu">
  </td>
  <td>
  <input type="submit" name="print" value="Print Menu">
  </td>
  </tr>
  </table>
  </form>



  </body></html>
