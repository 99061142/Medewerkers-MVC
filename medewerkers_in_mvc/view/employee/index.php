<h1>Overzicht van personen</h1>
<ul>
	<?php foreach($data as $employee){ ?>
		<li>
			<span><?= $employee["name"] ?> is <?= $employee["age"] ?> jaar oud</span>
			<a href="employee/edit/<?= $employee["id"] ?>">Wijzigen</a> 
			<a href="employee/delete/<?= $employee["id"] ?>">Verwijderen</a>
		</li>
	<?php } ?>
</ul>