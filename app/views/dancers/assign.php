<?php require APP_ROOT."/views/inc/header.php"; ?>

<section id="dashboard">
	<div class="dashboard-content">
		<form id="list-form" action="/dancers/assign" method="post">
			<h3>Assign Seats</h3>

			<ul id="unassigned">
				<li><label><strong>Unassigned:</strong></label></li>
			</ul>
			
			<input type="hidden" id="seating" name="seating">

			<button type="submit" class="btn">Save</button>
		</form>

		<div id="tables">
			<!-- create 4 tables -->
			<?php for($i=1; $i<=4; $i++): ?>
			<div id="table-<?= $i; ?>" class="table">
				<div class="table-number">Table <?= $i; ?></div>
				<!-- create 6 chairs per table -->			
				<?php for($j=1; $j<=6; $j++): ?>
				<div class="seat-number-<?= $j; ?>"><?= $j; ?></div>				
				<div class="seat-<?= $j; ?>" title="assign">
					<span><i class="fas fa-plus-circle"></i></span>
				</div>
				<?php endfor; ?>				
			</div>
			<?php endfor; ?>
		</div>
	</div>
</section>

<script>
var json = <?= json_encode($data['dancers']); ?>;
</script>
<script src="/public/js/assign.js"></script>

<?php require APP_ROOT."/views/inc/footer.php"; ?>