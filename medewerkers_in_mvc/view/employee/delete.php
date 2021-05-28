<?php
	// maak een bevestig pagina voor het verwijderen van een mededwerker
	$id = $data["id"];

	if(isset($_POST["delete"])){
		destroy($id);
	}
	else if(isset($_POST["back"])){
		header("location:" . URL);
	}
?>
	
	
<h1>Weet u zeker dat u <?= $data["name"] ?> wilt verwijderen?</h1>
<form name="update" method="post">
	<input type="submit" name="delete" value="ja">
	<input type="submit" name="back" value="nee">
</form>