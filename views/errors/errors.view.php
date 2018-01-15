<?php if(isset($errors)) : ?>
	<?php foreach ($errors as $error) : ?>
		<?php if(!empty($error)) :?>
			<div class="alert alert-danger"><li><?= $error ?></li></div>
		<?php endif; ?>	  
	<?php endforeach; ?>   
<?php endif; ?>

<?php if(isset($_SESSION['errors'])) : ?>
	<?php foreach ($_SESSION['errors'] as $error) : ?>
		<?php if(!empty($error)) :?>
			<div class="alert alert-danger"><li><?= $error ?></li></div>
		<?php endif; ?>	  
	<?php endforeach; ?>   
<?php unset($_SESSION['errors']); endif; ?>