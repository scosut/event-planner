<?php require APP_ROOT."/views/inc/header.php"; ?>

<section id="dashboard">
	<div class="dashboard-content">
		<form id="list-form" action="/materials/print" method="post" target="_blank">
			<h3>Print Materials</h3>

			<ul>
				<li><label><strong>Materials:</strong></label></li>
				<?php 
				$count = 1;
				foreach($data["materials"] as $key => $value):
				?>
				<li><input type="radio" id="<?= $key; ?>" name="materials" value="<?= $key; ?>"<?= $count == 1 ? " checked" : ""; ?>><label for="<?= $key; ?>"><?= $value; ?></label></li>
				<?php
				$count++;
				endforeach;
				?>
			</ul>
			
			<button type="submit" class="btn">Print</button>
		</form>
	</div>
</section>

<?php require APP_ROOT."/views/inc/footer.php"; ?>