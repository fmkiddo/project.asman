<?php include __DIR__ . '/../../header.php'; ?>
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header d-flex justify-content-between">
								<h4 class="card-title"></h4>
								<a href="usergroups-formnew">
									<button type="button" class="btn btn-primary" title="Registrasi Grup Pengguna Baru">
										<i class="fas fa-plus-circle fa-fw"></i> <span>Registrasi Baru</span>
									</button>
								</a>
							</div>
							<hr />
							<div class="card-body">
								<table id="dataTable-userGroup" class="dataTable table table-hover table-striped table-bordered table-pointer">
									<thead>
										<tr>
<?php foreach ($pagedata['mgroups-header'] as $header): ?>
											<td><?php echo $header; ?></td>
<?php endforeach; ?>
										</tr>
									</thead>
									<tbody>
<?php foreach ($pagedata['mgroups'] as $group): ?>
										<tr aria-data="<?php echo $group->idx; ?>">
											<td><?php echo $group->code; ?></td>
											<td><?php echo $group->name; ?></td>
										</tr>
<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

<?php include __DIR__ . '/../../footer.php'; ?>
	<script>
	$('table.dataTable').click (function ($evt) {
		$target = $($evt.originalEvent.target);
		if ($target.is ('td')) {
			$targetParent = $target.parents ('tr');
			$ariaData = $targetParent.attr ('aria-data');
			window.location.href = 'usergroups-editgroup?groupid=' + $ariaData;
		}
	});
	</script>

<?php include __DIR__ . '/../../html-footer.php'; ?>