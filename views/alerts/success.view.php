
<?php if(isset($_SESSION['message_success'])) :?>
	<div class="alert alert-success">
		<strong>Cestitamo! </strong><?php echo $_SESSION['message_success']; unset($_SESSION['message_success']); ?> 
	</div>   
<?php endif ; ?>

<?php if(isset($_SESSION['message_danger'])) :?>
	<div class="alert alert-danger">
		<strong>Pozor! </strong><?php echo $_SESSION['message_danger']; unset($_SESSION['message_danger']); ?> 
	</div>   
<?php endif ; ?>

