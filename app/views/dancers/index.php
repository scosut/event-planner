<?php require APP_ROOT."/views/inc/header.php"; ?>

<section id="dashboard">
	<div class="dashboard-content">
		<h3>Dancer List</h3>

		<a href="/dancers/add"<?= count($data["dancers"]) >= 24 ? "class=\"hidden\"" : ""; ?>><i class="fas fa-user-plus" title="add"></i></a>
		
		<?php 
		$arr              = $data["dancers"];
		$records_per_page = 10;
		$page_count       = ceil(count($arr) / $records_per_page);
		for ($i=1; $i<=$page_count; $i++):
		?>
		<table id="page-<?= $i; ?>">
			<thead>
				<tr>
					<th>Name</th>
					<th>Seat</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$end = count($arr) < $records_per_page ? count($arr) : $records_per_page;
				for($j=0; $j<$end; $j++):
				$dancer = $arr[$j];
				?>
				<tr>
					<td><?= "{$dancer->first} {$dancer->last}"; ?></td>
					<td><?= !empty($dancer->table_number) && !empty($dancer->seat_number) ? "T{$dancer->table_number} S{$dancer->seat_number}" : "---"; ?></td>
					<td>
						<a href="/dancers/edit/<?= $dancer->ID; ?>"><i class="fas fa-pencil-alt" title="edit"></i></a>
						<form action="/dancers/delete/<?= $dancer->ID; ?>" method="post">
							<button type="submit">
								<i class="far fa-trash-alt" title="delete"></i>
							</button>
						</form>
					</td>
				</tr>
				<?php endfor; ?>
			</tbody>
		</table>
		<?php
			array_splice($arr, 0, $records_per_page);
		?>
		<?php endfor; ?>
		
		<?php if ($page_count > 1): ?>
		<ul class="dashboard-pages">
			<?php for($i=1; $i<=$page_count; $i++): ?>
			<li><a href="#" data-page="<?= $i; ?>"><?= $i; ?></a></li>
			<?php endfor; ?>
		</ul>
		<?php endif; ?>
	</div>
</section>

<?php if ($page_count > 1): ?>
<script src="/public/js/paging.js"></script>
<?php endif; ?>

<?php require APP_ROOT."/views/inc/footer.php"; ?>