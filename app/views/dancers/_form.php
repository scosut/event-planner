<?php require APP_ROOT."/views/inc/errors.php"; ?>

<form action=""	method="post">
	<div class="form-group">
		<label for="first">First Name:</label>
		<input type="text" id="first" name="first" value="<?= $data->first->value; ?>">
	</div>

	<div class="form-group">
		<label for="last">Last Name:</label>
		<input type="text" id="last" name="last" value="<?= $data->last->value; ?>">
	</div>

	<div class="form-group">
		<button type="submit" class="btn"><?= $buttonCaption; ?></button>
	</div>
</form>