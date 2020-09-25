<html>
<head>
<title>Add Menu</title>
</head>
<body>


<?php  

include 'common/bellodentrostarter.php'; ?>

<h3>Menu Creation</h3>


<form method="post" action="addMenu3.php">

<?php

$MenuName = $_POST["MenuName"];
$TopText = $cxn->real_escape_string($_POST["TopText"]);
$BottomText = $cxn->real_escape_string($_POST["BottomText"]);
$BackText = $cxn->real_escape_string($_POST["BackText"]);




$query = "INSERT INTO `Menus` (MenuName, TopText, BottomText, BackText)

VALUES
	(
		'$MenuName',
		'$TopText',
		'$BottomText',
		'$BackText'
	)
";

// echo $query;
$result1= mysqli_query($cxn,$query)
			or die ("Database query to insert new Menu did not work, please contact I.T.");
			echo "$MenuName added to database\n";

?>
</body>
</html>
