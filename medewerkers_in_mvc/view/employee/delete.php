<h1>Weet u zeker dat u <?= $data["name"] ?> wilt verwijderen?</h1>
<ul>
	<li class="list-unstyled">
		<a href="<?= URL ?>employee/destroy/<?= $data["id"] ?>" class="btn btn-primary">Ja</a>
		<a href="<?= URL ?>" class="btn btn-primary">Nee</a>
	</li>
</ul>