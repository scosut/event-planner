<?php
	$formAction    = "add";
	$buttonCaption = "Add";
?>

<?php require APP_ROOT."/views/inc/header.php"; ?>

<section id="form">
	<div class="form-group">
		<h3>Add Dancer</h3>
		<p>Complete this form to enter a new dancer.</p>
	</div>

	<?php require "_form.php"; ?>
	<div class="flex-grow-1"></div>	
</section>

<?php require APP_ROOT."/views/inc/focus.php"; ?>

<?php require APP_ROOT."/views/inc/footer.php"; ?>