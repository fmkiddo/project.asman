<?php include __DIR__ . '/../header.php'; ?>
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<div class="d-flex align-item-center justify-content-between">
									<h4 class="card-title">
										<i class="fas fa-shopping-cart fa-fw"></i>
										<span data-smarty="{0}"></span>
									</h4>
									<div class="">
										<button type="button" class="btn btn-primary" onclick="window.location.href='<?php echo base_url ($locale . '/dashboard/doc-assetreq?requisition=true'); ?>'">
											<i class="fas fa-plus-circle fa-fw"></i>
											<span data-smarty="{1}"></span>
										</button>
									</div>
								</div>
							</div>
							
							<div class="card-body">
								<div class="row">
									<div class="col-md-12">
										<div class="card-nav-tabs card-plain">
											<div class="nav-tabs-navigation">
												<div class="nav-tabs-wrapper">
													<ul class="nav nav-tabs nav-fill" data-toggle="tabs">
														<li class="nav-item">
															<a class="nav-link active" href="#summary" data-toggle="tab">
																<i class="fas fa-database fa-fw"></i> <span data-smarty="{2}"></span>
															</a>
														</li>
														<li class="nav-item">
															<a class="nav-link" href="#procure" data-toggle="tab">
																<i class="fas fa-file-alt fa-fw"></i> <span data-smarty="{3}"></span>
															</a>
														</li>
													</ul>
												</div>
											</div>
											<div class="tab-content">
<?php 
include __DIR__ . '/../assets/procurement-tabs/summaries.php';
include __DIR__ . '/../assets/procurement-tabs/form-procurement.php';
?>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="card-footer">
							</div>
						</div>
					</div>
				</div>

<?php include __DIR__ . '/../footer.php'; ?>
	<script>
	$(document).ready (function () {
		$('body').on ('click', 'td', function ($event) {
			if ($(this).is ('td')) {
				$srcTable = $(this).parents ('table.dataTable').DataTable ();
				$tableName = $(this).parents ('table').prop ('id');
				switch ($tableName) {
					default:
						break;
					case 'dataTable-requisition':
						if ($srcTable.data ().count () > 0) {
							$docnum = $(this).parent ().children ().eq (1).text ();
							$data = {
								'trigger': 'clicked-docnum',
								'transmit': {
									'source': 'doc-assetproc',
									'clicked-docnum': $docnum
								}
							};
							$.ajax ({
								'url': $.base_url ($locale + '/api/get'),
								'method': 'put',
								'data': JSON.stringify ($data),
								'dataType': 'json'
							}).done (function ($result) {
								console.log ($result);
							}).fail (function () {
							});
						}
						break;
				}
			}
		});
	});
	</script>
<?php include __DIR__ . '/../html-footer.php'; ?>
