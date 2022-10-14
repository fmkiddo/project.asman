<?php include __DIR__ . '/../header.php'; 
$alertExceed		= 'Jumlah melebih batas maksimum kuantiti';
$searchPlaceholder	= 'Cari Barcode Aset ...';
$locationManager	= $pagedata['user-location'];
$summaries			= $pagedata['mvout-summary'];
$dataLocation		= $pagedata['data-locations'];
$userid				= $pagedata['useridx'];
$username			= $pagedata['username'];
$moveoutTH			= $pagedata['mvout-th'];
$mvoutListTH		= $pagedata['omvoths'];
$moveOutList		= $pagedata['mvout-lists'];
$cancelItem			= 'Batalkan Item';
?>
				<style>
				#amvos-modal table.table.dataTable th,
				#amvos-modal table.table.dataTable td  {
					text-align: center;
				}
				</style>
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header d-flex justify-content-between">
								<h4 class="card-title">
									<i class="fas fa-truck-moving fa-fw"></i>
									<span  data-smarty="{0}"></span>
								</h4>
								<button type="button" id="createnew-moveout" class="btn btn-primary" title="<?php echo 'Buat dokumen aset keluar baru'; ?>">
									<i class="fas fa-plus-circle fa-fw"></i> <span data-smarty="{1}"></span>
								</button>
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
															<a class="nav-link" href="#moveout-form" data-toggle="tab">
																<i class="fas fa-edit fa-fw"></i> <span data-smarty="{3}"></span>
															</a>
														</li>
													</ul>
												</div>
											</div>
											<div class="tab-content">
												<div class="tab-pane fade show active" id="summary">
<?php include 'moveout-tabs/main.php'; ?>
												</div>
												<div class="tab-pane fade" id="moveout-form">
<?php include 'moveout-tabs/form.php'; ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

<?php include __DIR__ . '/../footer.php'; ?>
	<script src="<?php echo base_url ('assets/vendors/jquery-csv/jquery.csv.js'); ?>"></script>
<?php include 'moveout-tabs/scripts.php'; ?>
	<div id="amvos-modal" class="modal fade" role="dialog" aria-labelledby="" aria-hidden="true" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog modal-xl modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header d-flex align-items-center">
					<h5 class="modal-title"></h5>
					<div id="right-contents" class="d-inline">
						<div class="d-none">
							<form id="print" target="_blank" method="post" action="<?php echo base_url ($locale . '/docs/print'); ?>">
								<input type="hidden" name="target" value="print" />
								<input type="hidden" name="doc-target" value="" />
							</form>
						</div>
						<button type="button" class="btn btn-info d-none" id="data-print" data-target="">
							<i class="fas fa-print fa-fw"></i>
						</button>
						<button type="button" class="btn btn-link" data-dismiss="modal" aria-label="close">
							<i class="fas fa-times-circle fa-fw"></i><span aria-hidden="true"></span>
						</button>
					</div>
				</div>
				
				<div class="modal-body">
					<div class="row">
						<div class="col">
							<select id="sublocation" class="form-control">
								<option disabled="disabled" selected="selected">--- Pilih Sublokasi ---</option>
							</select>
						</div>
					</div>
					
					<div class="row" style="padding: 1em 0 0 0;">
						<div class="col">
							<ul class="nav nav-tabs d-none" data-toggle="tabs" id="subloctabs">
							</ul>
							<div class="tab-content" id="asset-tabcontents">
							</div>
						</div>
					</div>
				</div>
				
				<div class="modal-footer">
					<button type="button" id="add-asset-items" class="btn btn-primary" aria-label="close">
						<i class="fas fa-plus-circle"></i> <span>Tambah Item</span>
					</button>
					<button type="button" id="cancel-asset-items" class="btn btn-secondary" aria-label="close">
						<i class="fas fa-times fa-fw"></i> <span>Batalkan</span>
					</button>
				</div>
			</div>
		</div>
	</div>

<?php include __DIR__ . '/../html-footer.php'; ?>
