<?php include __DIR__ . '/../header.php'; 
$locations			= $pagedata['data-locations'];
$summaries			= $pagedata['mvin-summary'];
$moveintableheader	= $pagedata['mvin-th'];
$moveinList			= $pagedata['mvin-lists'];
$moveinDetails		= $pagedata['mvin-details'];
?>
				<style>
				#amvis-modal table.table.dataTable th, 
				#amvis-modal table.table.dataTable td {
					text-align: center;
				}
				</style>
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header d-flex justify-content-between">
								<h4 class="card-title">
									<i class="fas fa-hands fa-fw"></i>
									<span data-smarty="{0}"></span>
								</h4>
							</div>
							
							<div class="card-body">
								<div class="row">
									<div class="col-md-12">
										<div class="card-nav-tabs card-plain">
											<div class="nav-tabs-navigation">
												<div class="nav-tabs-wrapper">
													<ul class="nav nav-tabs nav-fill" data-toggle="tabs">
														<li class="nav-item">
															<a class="nav-link active" href="#incoming" data-toggle="tab">
																<i class="fas fa-truck-loading fa-fw"></i> <span data-smarty="{1}"></span>
															</a>
														</li>
														<li class="nav-item">
															<a class="nav-link" href="#distribute" data-toggle="tab">
																<i class="fas fa-people-arrows fa-fw"></i> <span data-smarty="{2}"></span>
															</a>
														</li>
													</ul>
												</div>
											</div>
											<div class="tab-content">
<?php include 'movein-tabs/document-list.php'; ?>
<?php include 'movein-tabs/distribution-page.php'; ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

<?php include __DIR__ . '/../footer.php'; ?>
<?php include 'movein-tabs/javascript-portion.php'; ?>
	
	<div id="amvis-modal" class="modal fade" role="dialog" aria-labelledby="" aria-hidden="true" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog modal-xl modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"></h5>
				</div>
				
				<div class="modal-body">
				</div>
				
				<div class="modal-footer">
				</div>
			</div>
		</div>
	</div>
<?php include __DIR__ . '/../html-footer.php'; ?>
