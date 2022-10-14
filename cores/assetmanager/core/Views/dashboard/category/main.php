<?php include __DIR__ . '/../header.php'; 
if (isset ($pagedata) && count ($pagedata) > 0):
$ths = $pagedata['header'];
$tds = $pagedata['categories'];
else:
$ths = '';
$tds = '';
endif;
?>
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<div class="d-flex justify-content-between">
									<h4 class="card-title">Master Kategori</h4>
									<a class="btn btn-primary" href="new-category">
										<i class="fas fa-plus-circle fa-fw"></i> New Category
									</a>
								</div>
							</div>
							
							<hr />
							
							<div class="card-body">
								<table id="dataTable-categories" class="dataTable table table-striped table-hover">
									<thead>
										<tr>
<?php 
if (is_array($ths)):
	foreach ($ths as $th):
?>
											<th><?php echo $th; ?></th>
<?php 
	endforeach;
endif;
?>
										</tr>
									</thead>
									
									<tbody>
<?php 
if (is_array($tds)):
	foreach ($tds as $td):
?>
										<tr aria-data="categoryitem=<?php echo $td->idx; ?>">
											<td><?php echo $td->ci_name; ?></td>
											<td><?php echo $td->ci_dscript; ?></td>
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
	$(document).ready (function () {
		$('body').on ('click', 'td', function ($evt) {
			$tr = $(this).parents ('tr');
			$ariaData = $tr.attr ('aria-data');
			window.location.href = 'asset-categoryitem?' + $ariaData;
		});
	});
	</script>
<?php include __DIR__ . '/../html-footer.php'; ?>