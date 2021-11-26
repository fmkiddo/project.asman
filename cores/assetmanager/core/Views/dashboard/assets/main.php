<?php include __DIR__ . '/../header.php'; 
if (isset ($pagedata) && array_key_exists('assets-data', $pagedata)):
	$assetsdata = $pagedata['assets-data'];
	$colHeader = $pagedata['assets-header'];
else:
	$assetsdata = '';
	$colHeader = '';
endif;
?>
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<div class="d-flex align-items-center justify-content-between">
									<h5 class="card-title">
										<i class="fas fa-cubes fa-fw"></i> <span data-smarty="{0}"></span>
									</h5>
									<div>
										<button type="button" class="btn btn-primary" onclick="window.location.href='doc-assetreq'" title="Permintaan Aset">
											<i class="fas fa-archive fa-fw"></i> <span>Permintaan</span>
										</button>
										<button type="button" class="btn btn-primary" onclick="window.location.href='new-asset'" title="Register Aset Baru">
											<i class="fas fa-plus-circle fa-fw"></i> <span>Tambah Aset</span>
										</button>
									</div>
								</div>
							</div>
							<hr />
							<div class="card-body">
								<table id="dataTable-assets" class="dataTable table table-striped table-hover">
									<thead>
										<tr>
<?php 
foreach ($colHeader as $th):
?>
											<th><?php echo $th; ?></th>
<?php 
endforeach;
?>
										</tr>
									</thead>
									<tbody>
<?php 
if (is_array($assetsdata)):
	foreach ($assetsdata as $asset):
?>
										<tr data-target="<?php echo $asset['code']; ?>">
<?php 
		foreach ($asset as $key => $value):
?>
											<td><?php echo $value; ?></td>
<?php 
		endforeach;
?>
										</tr>
<?php 
	endforeach;
endif;
?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
<?php include __DIR__ . '/../footer.php'; ?>
	<script type="text/javascript">
	$('td').click (function () {
		$idx = $(this).parents ('tr').attr ('data-target');
		window.location.href = 'asset-details?code=' + $idx;
	});
	</script>

<?php include __DIR__ . '/../html-footer.php'; ?>