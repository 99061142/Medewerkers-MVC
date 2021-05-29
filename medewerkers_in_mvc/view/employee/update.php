<h1><?= $data["name"] ?> wijzigen</h1>
<p>
	Als u een vak leeg laat vult hij automatich niks in.<br>
	De naam mag niet langer dan 10 karakters zijn.<br>
</p>


<form name="update" method="post" action="<?= URL ?>employee/update">
	<input type="hidden" name="id" value="<?= $data["id"] ?>">
	Name: <br><input class="my-3" type="text" name="input1"><br>
	Age: <br><input class="mt-3" type="number" name="input2"><br>
	<input class="mt-5" type="submit" name="submit">
</form>