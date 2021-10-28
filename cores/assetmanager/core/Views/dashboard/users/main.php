<?php include __DIR__ . '/../header.php'; ?>

				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header d-flex justify-content-between">
								<h4 class="card-title">Daftar Pengguna</h4>
								<a href="masteruser-newform">
									<button type="button" class="btn btn-primary" title="Registrasi Pengguna Baru">
										<i class="fas fa-plus-circle fa-fw"></i> <span>Registrasi</span>
									</button>
								</a>
							</div>
							<hr />
							
							<div class="card-body">
								<table id="dataTable-MasterUser" class="dataTable table table-hover table-striped table-pointer">
									<thead>
										<tr>
<?php foreach ($pagedata['muser-heading'] as $th): ?>
											<th><?php echo $th; ?></th>
<?php endforeach; ?>
										</tr>
									</thead>
									<tbody>
<?php foreach ($pagedata['muser-listdata'] as $usr): ?>
										<tr aria-data="<?php echo $usr[0]; ?>">
<?php 
foreach ($usr as $key => $data):
	if ($key > 0): ?>
											<td><?php echo $data; ?></td>
<?php endif;
endforeach; ?>
										</tr>
<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

<?php include __DIR__ . '/../footer.php'; ?>
	<script>
	$('table.dataTable').click (function ($evt) {
		$target = $($evt.originalEvent.target);
		if ($target.is ('td')) {
			$targetParent = $target.parents ('tr');
			$data = $targetParent.attr ('aria-data');
			window.location.href = 'masteruser-edit?userid=' + $data;
		}
	});
	</script>

<?php include __DIR__ . '/../html-footer.php'; ?>