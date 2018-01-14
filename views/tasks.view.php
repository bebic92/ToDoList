<?php require 'partials/header.view.php'; ?>

<ul>
<?php foreach($tasks as $value) : ?>
<li>
	<?= ucfirst($value->description); ?></li>	
</li>
<?php endforeach; ?>
</ul>	

<form method="POST" action="/Drugi_dio_b/addTask">
	<input name="description"></input><br /><br />
	<input name="completed"></input><br /><br />
	<button type="submit">Submit</button>
</form>

<?php require 'partials/footer.view.php';

