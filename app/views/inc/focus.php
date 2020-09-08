<?php 
	$field = Validate::getFirstError($data);
?>
<?php if ($field): ?>
<script>
	var field = document.getElementById("<?= $field; ?>");

	if (field) {
		field.focus();
	}
</script>
<?php endif; ?>