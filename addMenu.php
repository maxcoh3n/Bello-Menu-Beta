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
		";	

	echo "


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
	<td>Back Text</td>
	<td><textarea type='text' name='BackText' id='TopText' required='required' rows = 10 cols = 30>".$TextArray['BackText']."</textarea></td>
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
