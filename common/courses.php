<?php


/* this function returns the courses, in order, associated with the given menu. 
the array returned has CourseName for reference and ExtendedName for printing the menu
*/
function getCourses($MenuID){
  include 'databaseConnection.php';

  if($MenuID != ""){

    $MenuOrder = "Menu" . $MenuID . "Order";

    $query= "SELECT CourseName, ExtendedName FROM Courses WHERE '$MenuOrder' IS NOT NULL ORDER BY '$MenuOrder'" ;
    $result= mysqli_query($cxn,$query) or die ("Database query to get Courses didn't work. Please contact IT.");;
    if ($cxn->connect_error) {
      die("Connection failed: " . $cxn->connect_error);
    }

  }else{
    $query= "SELECT CourseName, ExtendedName FROM Courses" ;
    $result= mysqli_query($cxn,$query) or die ("Database query to get Courses didn't work. Please contact IT.");;
    if ($cxn->connect_error) {
      die("Connection failed: " . $cxn->connect_error);
    }  
  }

    $CourseArray = array();

    while($row = mysqli_fetch_assoc($result))
    {
        array_push($CourseArray, array(
            "CourseName" => $row['CourseName'],
            "ExtendedName" => $row['ExtendedName']
        ));
    }


  return $CourseArray;
}



?>