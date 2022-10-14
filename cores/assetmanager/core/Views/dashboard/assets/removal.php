<?php include __DIR__ . '/../header.php';
$summaries		= $pagedata['data-summaries'];
$dataRemovals	= $pagedata['data-removals'];
$removalDocs	= $pagedata['data-removaldocs'];
?>
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">
									<i class="fas fa-eraser fa-fw"></i>
									<span data-smarty="{0}"></span>
								</h4>
							</div>
							
							<div class="card-body">
								<div class="card-nav-tabs card-plain">
									<div class="nav-tabs-navigation">
										<div class="nav-tabs-wrapper">
											<ul class="nav nav-tabs nav-fill" data-toggle="tabs">
												<li class="nav-item">
													<a class="nav-link active" href="#summaries" data-toggle="tab">
														<i class="fas fa-database fa-fw"></i>
														<span data-smarty="{1}"></span>
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" href="#removal-form" data-toggle="tab">
														<i class="fas fa-edit fa-fw"></i>
														<span data-smarty="{2}"></span>
													</a>
												</li>
											</ul>
										</div>
									</div>
									<div class="tab-content">
<?php include 'removal-tabs/summaries.php'; ?>
<?php include 'removal-tabs/removal-form.php'; ?>

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
		$('body').on ('click', 'button, td', function ($evt) {
			if ($(this).is ('button')) {
				$id = $(this).prop ('id');
				switch ($id) {
					default:
						break;
					case 'approve':
						$('input#action').val ('approve');
						$('button#do-submit').click ();
						break;
					case 'decline':
						$('input#action').val ('decline');
						$('button#do-submit').click ();
						break;
				}
			} else if ($(this).is ('td')) {
				$srcTable = $(this).parents ('table.dataTable');
				$id = $srcTable.prop ('id');
				$srcDT = $srcTable.DataTable ();
				switch ($id) {
					default:
						break;
					case 'dataTable-removalLists':
						$row = $(this).parent ('tr');
						if ($srcDT.rows ().rows () > 0) {
							$docnum = $row.children ().eq (1).text ();
							$data = {
								'trigger': 'clicked-docnum',
								'transmit': {
									'source': 'doc-assetremoval',
									'clicked-docnum': $docnum
								}
							};
							$.ajax ({
								'url': $.base_url ($locale + '/api/get'),
								'method': 'put',
								'data': JSON.stringify ($data),
								'dataType': 'json'
							}).done (function ($result) {
								if ($result.good) {
									$('input#docnum').val ($row.children ().eq (1).text ());
									$('input#docdate').val ($row.children ().eq (2).text ());
									$('input#applicant').val ($row.children ().eq (3).text ());
									$('input#status').val ($row.children (':last-child').text ());
									$('input#location').val ($row.children ().eq (4).text ());
									
									$transmit = $result.transmit;
									$detailDT = $('table#dataTable-removalDetail').DataTable ();
									
									$.each ($transmit.details, function ($key, $value) {
										$newRow = [
											$key + 1,
											$value.barcode,
											$value.dscript,
											$value.osbl_name,
											$value.remarks,
											$value.removal_qty
										];
										$detailDT.row.add ($newRow);
									});
									$detailDT.draw ();
									
									switch ($transmit.status) {
										default:
											break;
										case 1:
											$labels = $result.labels;
											if ($transmit.userstat)
												$('<form/>', {
													'id': 'form-actions',
													'method': 'post',
													'action': $.base_url ($locale + '/api/process'),
													'enctype': 'application/x-www-form-urlencoded',
													'html': $('<input/>', {
															'type': 'hidden',
															'name': 'trigger',
															'value': 'destroy-action'
														}).prop ('outerHTML') + 
														$('<input/>', {
															'type': 'hidden',
															'name': 'docnum',
															'value': $('input#docnum').val ()
														}).prop ('outerHTML') +
														$('<input/>', {
															'type': 'hidden',
															'name': 'action',
															'id': 'action'
														}).prop ('outerHTML') +
														$('<button/>', {'type': 'submit', 'class': 'hidden', 'id': 'do-submit'}).prop ('outerHTML') +
														$('<button/>', {
															'id': 'approve',
															'type': 'button',
															'class': 'btn btn-success',
															'html': $('<i></i>', {'class': 'fas fa-check fa-fw'}).prop ('outerHTML') + ' ' +
																$('<span/>', {'text': $labels.buttons.approve[$locale]}).prop ('outerHTML')
														}).prop ('outerHTML') + ' ' +	
														$('<button/>', {
															'id': 'decline',
															'type': 'button',
															'class': 'btn btn-danger',
															'html': $('<i></i>', {'class': 'fas fa-times fa-fw'}).prop ('outerHTML') + ' ' +
																$('<span/>', {'text': $labels.buttons.decline[$locale]}).prop ('outerHTML')
														}).prop ('outerHTML')
												}).prependTo ($('div#action-buttons'));
											break;
									}
									
									$('div#oarv-modal').modal ('show');
								}
							}).fail (function () {
							});
						}
						break;
				}
			}
		});
		
		$('#oarv-modal').on ('shown.bs.modal', function ($event) {
			$.fn.dataTable.tables ({'visible': true, 'api': true}).columns.adjust (); 
		});
		
		$('#oarv-modal').on ('hidden.bs.modal', function ($event) {
			$(this).find ('input').val ('');
			$(this).find ('table.dataTable').DataTable ().clear ().draw ();
			$(this).find ('#form-actions').remove ();
		});
	});
	</script>
	<div id="oarv-modal" class="modal fade" role="dialog" aria-labelledby="" aria-hidden="true" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog modal-xl modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header d-flex align-items-center">
					<h5 class="modal-title" data-smarty="{16}"></h5>
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
						<div class="col-md-6">
							<div class="form-group">
								<label><span data-smarty="{17}"></span>:</label>
								<div class="input-group">
									<input id="docnum" type="text" class="form-control" readonly />
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label><span data-smarty="{18}"></span>:</label>
								<div class="input-group">
									<input id="docdate" type="text" class="form-control" readonly />
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label><span data-smarty="{19}"></span>:</label>
								<div class="input-group">
									<input id="applicant" type="text" class="form-control" readonly />
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label><span data-smarty="{20}"></span>:</label>
								<div class="input-group">
									<input id="status" type="text" class="form-control" readonly />
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label><span data-smarty="{21}"></span>:</label>
								<div class="input-group">
									<input id="location" type="text" class="form-control" readonly />
								</div>
							</div>
						</div>
					</div>
					<hr />
					<div class="row row-with-padding">
						<div class="col-md-12">
							<table id="dataTable-removalDetail" class="dataTable table table-striped table-hover table-centered-content table-pointer" width="100%">
								<thead>
									<tr>
										<th>#</th>
										<th data-smarty="{22}"></th>
										<th data-smarty="{23}"></th>
										<th data-smarty="{24}"></th>
										<th data-smarty="{25}"></th>
										<th data-smarty="{26}"></th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				
				<div class="modal-footer text-right" id="action-buttons">
					<button class="btn btn-secondary" data-dismiss="modal" aria-label="close">
						<i class="fas fa-times-circle fa-fw"></i> <span data-smarty="{27}"></span>
					</button>
				</div>
			</div>
		</div>
	</div>

<?php include __DIR__ . '/../html-footer.php'; ?>
