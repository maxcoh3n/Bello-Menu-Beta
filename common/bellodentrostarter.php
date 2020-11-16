<html>
<h1>Bello by Sandro Nardone Internal Website</h1>

<div style="display: inline-flex;">
	<form name="form1">
		<select id="Menus">
			<option value="" disabled selected hidden>Menus</option> <!-- MAKE THIS A PLACEHOLDER NOT A LINK-->
      <option value="printMenu.php">Print Menu </option>
	  <option value="printMenu2.php?MenuName=Lunch">Lunch </option>
	  <option value="printMenu2.php?MenuName=Dinner">Dinner </option>
      <option value="deleteMenu.php">Delete Menu </option>
	  <option value="addMenu.php">Add Menu </option>
		</select>
	</form>


		<form name="form2">
		<select id="Dishes">
			<option value="" disabled selected hidden>Dishes</option> <!-- MAKE THIS A PLACEHOLDER NOT A LINK-->
			<option value="addDish.php">Add New Dish </option>
		</select>
	</form>




	<form name="form3">
		<select id="Courses">
			<option value="" disabled selected hidden>Courses</option> <!-- MAKE THIS A PLACEHOLDER NOT A LINK-->
	        <!-- <option value="CreateSKU1.php">Enter New SKU</option> -->

		</select>
	</form>


</div>






<script type="text/javascript">
let dropdowns = ['Menus', 'Dishes', "Courses"] 
dropdowns.forEach(id=>{
  var urlmenu = document.getElementById( id );
	 urlmenu.onchange = function()
	 {
	      window.open(  this.options[ this.selectedIndex ].value );
	 };
})


	

	 
</script>

<?php
ini_set('error_reporting', E_STRICT);
ini_set('display_errors',1);
  include 'databaseConnection.php';
?>


