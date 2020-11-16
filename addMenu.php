<?php   include 'common/auth.php'; ?>

<html>
<head>
<title>Add Menu</title>
</head>
<body>


<?php  

include 'common/bellodentrostarter.php'; ?>

<h3>Menu Creation</h3>


<form method="post" action="addMenu2.php">

<?php

$query= "SELECT DISTINCT TopText, BottomText, BackText FROM Menus ORDER BY MenuID" ;
    //print $query;
    $result= mysqli_query($cxn,$query);
    if ($cxn->connect_error) {
      die("Connection failed: " . $cxn->connect_error);
    }
    
    $TextArray = array();

      $row = mysqli_fetch_assoc($result);
        $TextArray = array(
			'TopText' => $row['TopText'],
			'BottomText' => $row['BottomText'],
            'BackText' => $row['BackText']
        );


	echo        
	"<table>
	<tr>
	</tr>

	<tr>
	<td>Menu Name</td>
	<td><input type='text' name='MenuName' id='MenuName' required='required' ></td>
	</tr>

	<tr>
	<td>Top Text (Below Logo)</td>
	<td><textarea type='text' name='TopText' id='TopText' required='required' cols = 30>".$TextArray['TopText']."</textarea></td>
	</tr>

	<tr>
	<td>Bottom Text</td>
	<td><textarea type='text' name='BottomText' id='TopText' required='required' rows = 3 cols = 30>".$TextArray['BottomText']."</textarea></td>
	</tr>

	<tr>
	<td></td>
	<td>Please surround bolded Text with \"*\"s</td>
	</tr>

	<tr>
	<td>Back Text</td>
	<td><textarea type='text' name='BackText' id='TopText' required='required' rows = 10 cols = 30>".$TextArray['BackText']."</textarea></td>
	</tr>

	";
	//* GET ALL COURSES FROM DB, AND THEN allow user to select which courses they want on this menu
	$query= "SELECT `CourseName`, `CourseID` FROM Courses ORDER BY `CourseID`" ;
    //print $query;
    $result= mysqli_query($cxn,$query);
    if ($cxn->connect_error) {
      die("Connection failed: " . $cxn->connect_error);
    }
    
    $CourseArray = array();

	while($row = mysqli_fetch_assoc($result))
	{
	  array_push($CourseArray, array(
		'CourseName'        =>$row['CourseName'],
		'CourseID'        =>$row['CourseID']
	  ));
	}

	if(count($CourseArray) >0){
		echo "<tr>
			<th> Course </th> 
			<th> Course Order (1 to n, leave as 0 if not on this menu)</th>
			</tr>
		";
	}

	for($ct = 0; $ct < count($CourseArray); $ct ++){
		echo "<tr>
			<td>". $CourseArray[$ct]['CourseName'] ."</td> 
			<td><input type='number' name=CourseIDArray[".$ct."]' ></td>
			<input type='hidden' name='CourseOrderArray[".$ct."]' value =".$CourseArray[$ct]['CourseID'] .">
			</tr>
		";
	}


	?>

  <!-- <td>To add a new Course, click <a href="addCourse.php" target='_blank'>here</a></td> -->


	<tr>
	<td><input type='submit' value='Submit' name='submit'/></td>
	</tr>
	


</form>




</body>
</html>
