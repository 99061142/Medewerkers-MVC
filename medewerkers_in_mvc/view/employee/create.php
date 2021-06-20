<h1>Voeg een medewerker toe</h1>
<form name="update" method="post" action="<?= URL ?>employee/store">
	Name: <br><input class="my-3" type="text" name="name" required><br>
	Age: <br><input class="mt-3" type="number" name="age" required><br>
	<input class="mt-5" type="submit">
</form>