<h1><?= $data["name"] ?> wijzigen</h1>
<form name="update" method="post" action="<?= URL ?>employee/update">
	<input type="hidden" name="id" value="<?= $data["id"] ?>">
	Name: <br><input class="my-3" type="text" name="name"><br>
	Age: <br><input class="mt-3" type="number" name="age"><br>
	<input class="mt-5" type="submit">
</form>