<?php   include 'common/auth.php'; ?>

<html>
  <head>
  <title>Delete The Menu</title>
  </head>
  <body>

  <?php 
  include 'common/auth.php';
  include 'common/bellodentrostarter.php'; 
 
  ?>

  <h2> Delete Menu Page 1</h2>


  <form method="post" action="deleteMenu2.php">


    <?php 
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

    echo "Menu: <select name = 'MenuID|MenuName' required='required' >  ";
    for($ct = 0; $ct < count($MenuArray); $ct++){
        $MenuName = $MenuArray[$ct]['MenuName'];
        $MenuID = $MenuArray[$ct]['MenuID'];
        echo "<option value= '$MenuID|$MenuName' > $MenuName </option>";
    }
    
    
    ?>

  <input type="submit" value="DELETE" style="background-color: #f44336; font-weight:bold">  
  </form>

  To add a new Menu, click <a href="addMenu.php" target='_blank'>here</a>
  <br>

  To edit an existing Menu, click <a href="editMenu.php" target='_blank'>here</a>
