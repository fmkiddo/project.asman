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
												<div class="tab-pane fade show active" id="incoming">
													<div class="row row-with-padding">
<?php
$summariesCount = count ($summaries);
$partition = 12 / $summariesCount;
foreach ($summaries as $summary): ?>
														<div class="col-md-<?php echo $partition; ?>">
															<div class="card <?php echo $summary['style']; ?>">
																<div class="card-header">
																	<h5 class="card-title" data-smarty="<?php echo $summary['title']; ?>"></h5>
																</div>
																<div class="card-body">
																	<p class="display-3"><?php echo $summary['content']; ?></p>
																</div>
																<div class="card-footer">
																	<div class="stats">
																		<a id="refresh-" . <?php echo $summary['id']; ?>>
																			<i class="fas fa-sync-alt fa-fw"></i> <span data-smarty="{7}"></span>
																		</a>
																	</div>
																</div>
															</div>
														</div>
<?php endforeach; ?>
													</div>
													<hr />
													<div class="row">
														<div class="col-md-12">
															<table id="dataTable-moveinMaster" class="dataTable table table-striped table-hover table-pointer table-centered-content">
																<thead>
																	<tr>
																		<th>#</th>
<?php foreach ($moveintableheader as $th): ?>
																		<th data-smarty="<?php echo $th; ?>"></th>
<?php endforeach; ?>
																	</tr>
																</thead>
																<tbody>
<?php foreach ($moveinList as $id => $move_in): ?>
																	<tr class="<?php echo $docstat->getClass ($move_in->status); ?>">
																		<td><?php echo ($id + 1); ?></td>
																		<td><?php echo $move_in->docnum; ?></td>
																		<td><?php echo $move_in->docdate; ?></td>
																		<td><?php echo $locations[$move_in->omvo_olctfrom]; ?></td>
																		<td><?php echo $locations[$move_in->omvo_olctto]; ?></td>
																		<td><?php echo $move_in->username; ?></td>
																		<td>
																			<i class="<?php echo $docstat->getIcon ($move_in->status); ?>"></i>
																			<span><?php echo $docstat->getStatusText ($move_in->status); ?></span>
																		</td>
																	</tr>
<?php endforeach; ?>
																</tbody>
															</table>
														</div>
													</div>
												</div>
												<div class="tab-pane fade" id="distribute">
													<div class="row row-with-padding">
														<div class="col-md-12">
															<h6 data-smarty="{14}"></h6>
														</div>
													</div>
													<div class="row">
														<div class="col-md-4">	
															<div class="movein-received">
<?php if ($pagedata['mvin-received'] == 0): ?>
																<div class="card shadow-none border">
																	<div class="card-body bg-gray">
																		<b><span data-smarty="{15}"></span></b>
																	</div>
																</div>
<?php else: ?>												
																<div class="accordion border" id="document-list-accordion">
<?php foreach ($moveinList as $id => $move_in): ?>
<?php if ($docstat->isReceived ($move_in->status)): ?>
																	<div class="documents">
																		<div class="document-header" data-toggle="collapse" data-target="#document-<?php echo $id; ?>" 
																				data-document="<?php echo $move_in->docnum; ?>" data-date="<?php echo $move_in->docdate; ?>"
																				data-applicant="<?php echo $move_in->username; ?>" data-to="<?php echo $move_in->omvo_olctto; ?>">
																			<span class="document-title"><?php echo $move_in->docnum; ?></span>
																		</div>
																		<div class="collapse" id="document-<?php echo $id; ?>" data-parent="#document-list-accordion">
																			<div class="document-body">
																				<div class="row">
																					<div class="col-md-6">
																						<div class="form-group">
																							<label data-smarty="{10}"></label>
																							<input type="text" class="form-control" id="from" value="<?php echo $locations[$move_in->omvo_olctfrom]; ?>" readonly="readonly" />
																						</div>
																					</div>
																					<div class="col-md-6">
																						<div class="form-group">
																							<label data-smarty="{11}"></label>
																							<input type="text" class="form-control" id="to" value="<?php echo $locations[$move_in->omvo_olctto]; ?>" readonly="readonly" />
																						</div>
																					</div>
																				</div>
																				<div class="document-details">
																					<table id="table-moveDetails" data-document="<?php echo $move_in->docnum; ?>" class="table table-hover table-striped table-pointer">
																						<thead>
																							<tr>
																								<th data-smarty="{16}"></th>
																								<th data-smarty="{17}"></th>
																								<th data-smarty="{18}"></th>
																								<th data-smarty="{20}"></th>
																							</tr>
																						</thead>
																						<tbody>
<?php foreach ($moveinDetails as $moveinDetail): 
	if ($moveinDetail['dataOmvoIdx'] === $move_in->omvo_refidx): 
		$omvoDetail = $moveinDetail['dataOmvoDetail'];
		foreach ($omvoDetail as $line_idx => $detail): ?>
																							<tr>
<?php foreach ($detail as $key => $data): 
			if (!($key === 'line_idx' || $key === 'item_idx')):
				if ($key === 'code'): ?>
																								<td>
																									<input type="hidden" id="item-id" name="item-id-<?php echo $line_idx; ?>" value="<?php echo $detail['item_idx']; ?>" />
																									<span id="item-code"><?php echo $data; ?></span>
																								</td>
<?php 			else: ?>
																								<td><?php echo $data; ?></td>
<?php			endif;
			endif;
		endforeach; ?>
																							</tr>	
<?php endforeach; 
	endif;
endforeach; ?>																					
																						</tbody>
																					</table>
																				</div>
																			</div>
																		</div>
																	</div>
<?php endif; ?>									
<?php endforeach; ?>
																</div>
<?php endif; ?>
															</div>
														</div>
														
														<div class="col-md-8">
															<form role="form" id="distribution-center">
																<input type="hidden" name="tolocation-id" value="" />
																<div class="card card-plain border" id="distribution-card">
																	<div class="card-body">
																		<div class="row">
																			<div class="col-md-6">
																				<div class="form-group">
																					<label for="movein-docnum" data-smarty="{8}"></label>
																					<input type="text" name="movein-docnum" class="form-control" readonly="readonly" />
																				</div>
																				<div class="form-group">
																					<label for="movein-docdate" data-smarty="{9}"></label>
																					<input type="text" name="movein-docdate" class="form-control" readonly="readonly" />
																				</div>
																			</div>
																			<div class="col-md-6">
																				<div class="form-group">
																					<label for="movein-applicant" data-smarty="{12}"></label>
																					<input type="text" name="movein-applicant" class="form-control" readonly="readonly" />
																				</div>
																				<div class="row">
																					<div class="col-md-6">
																						<div class="form-group">
																							<label for="movein-fromlocation" data-smarty="{10}"></label>
																							<input type="text" class="form-control" name="movein-fromlocation" readonly="readonly" />
																						</div>
																					</div>
																					<div class="col-md-6">
																						<div class="form-group">
																							<label for="movein-tolocation" data-smarty="{11}"></label>
																							<input type="text" class="form-control" name="movein-tolocation" readonly="readonly" />
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																		<table id="dataTable-assetDistribution" class="dataTable table table-striped table-hover table-pointer" data-paging="false" data-searching="false">
																			<thead>
																				<tr>
																					<th data-smarty="{16}"></th>
																					<th data-smarty="{17}"></th>
																					<th data-smarty="{18}"></th>
																					<th data-smarty="{19}"></th>
																					<th data-smarty="{20}"></th>
																					<th><i class="fas fa-times-circle fa-fw"></i></th>
																				</tr>
																			</thead>
																			<tbody>
																			</tbody>
																		</table>
																	</div>
																</div>
															</form>
														</div>
													</div>
													<div class="text-right">
														<button type="button" class="btn btn-primary" id="submit-distribution">
															<i class="fas fa-save fa-fw"></i>
														</button>
														<button type="button" class="btn btn-secondary" id="reset-distribution">
															<i class="fas fa-undo fa-fw"></i>
														</button>
													</div>
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
	<script>
	$(document).ready (function () {
		$.markDocumentAsReceived = function ($data) {
			$.ajax ({
				'method': 'put',
				'url': $.base_url ($locale + '/api/sent'),
				'data': JSON.stringify ($data),
				'dataType': 'json',
				'contentType': 'json'
			}).done (function ($result) {
				if (!$result.good) ;
				else window.location.reload (true);
			}).fail (function () {});
		};

		$('body').on ('reset', 'form', function ($evt) {
			$formId = $(this).prop ('id');
			switch ($formId) {
				default:
					break;
				case 'distribution-center':
					$.searchDataTable ('dataTable-assetDistribution').clear ().draw (false);
					break;
			}
		});
		
		$('body').on ('click', 'button, div.document-header', function ($evt) {
			if ($(this).is ('button')) {
				$id = $(this).prop ('id');
				switch ($id) {
					default:
						break;
					case 'btn-markreceivedomvi':
						$moveInTable = $('#dataTable-moveinDetails').DataTable ();
						$assetids = {};
						$isReady = true;
	
						if (!$isReady) ;
						else {
							$data = {
								'trigger': 'movein-action',
								'transmit': {
									'do': 'markreceived',
									'docnum': $('input[name="docnum"]').val ()
								}
							};
							$.markDocumentAsReceived ($data);
						}
						break;
					case 'submit-distribution':
						$assetMoveDT = $('table#table-moveDetails');
						$assetDistDT = $.searchDataTable ('dataTable-assetDistribution');
						$rowCount = $assetDistDT.rows ().count ();
						if ($rowCount == 0) ;
						else {
							$moveList = []
							$moveDocQty = 0;
							$moveDTRows = $assetMoveDT.find ('tbody').children ();
							$moveDTRows.each (function () {
								$itemInfo = {};
								$row = $(this);
								$itemId = parseInt ($row.find ('#item-id').val ());
								$itemInfo = {
									'id': $itemId,
									'added': false
								};

								$assetDistDT.$('input#item-id').each (function () {
									if ($(this).val () == $itemId) $itemInfo['added'] = true;
								});
								
								$itemMoveQty = $row.children (':eq(3)').text ();
								$moveDocQty += parseInt ($itemMoveQty);
								$moveList.push ($itemInfo);
							});

							$isAllAdded = true;
							$.each ($moveList, function ($index, $item) {
								if (!$item['added']) {
									$isAllAdded = false;
									return $isAllAdded;
								}
							});

							if (!$isAllAdded) console.log ('not all data added!');
							else {
								$addedDocQty = 0;
								$isAllSublocSpeced = true;
								$isDocQtyAdded = true;
								$assetDistDT.$('input#item-id').each (function () {
									$addedRow = $(this).parents ('tr');
									$addedSubloc = $addedRow.children (':eq(3)').children ().val ();
									if ($addedSubloc === null) $isAllSublocSpeced = false;
									$addedQty = parseInt ($addedRow.children (':eq(4)').children ().val ());
									$addedDocQty += $addedQty;
								});

								if ($addedDocQty !== $moveDocQty) console.log ('added document qty is not equal from move document');
								else if (!$isAllSublocSpeced) console.log ('all added items need to be assign to specific sublocations');
								else {
									$formAssetDist = $('form#distribution-center');
									$data = {
										'trigger': 'distribute-assets',
										'transmit': $formAssetDist.serializeArray ()
									}

									$.ajax ({
										'url': $.base_url ($locale + '/api/sent'),
										'method': 'put',
										'data': JSON.stringify ($data),
										'dataType': 'json'
									}).done (function ($result) {
										if (!$result.good) ;
										else window.location.reload (false);
									});
								}
							}
						}
						break;
					case 'reset-distribution':
						$divDistributeHead = $(this).parents ('div#distribute').find ('.documents .document-header');
						if (!$divDistributeHead.hasClass ('collapsed')) {
							$('input[name="tolocation-id"]').val ('');
							$divDistributeHead.trigger ('click');
						}
						break;
				}
			} else if ($(this).is ('div.document-header')) {
				$assetDistForm = $('form#distribution-center');
				if (!$(this).parents ('div.documents').find ('.collapse').hasClass ('show')) {
					$documents	= $(this).parents ('div.documents');
					$dataDoc	= $(this).attr ('data-document');
					$dataDate	= $(this).attr ('data-date');
					$dataApp	= $(this).attr ('data-applicant');
					$dataTo		= $(this).attr ('data-to');
					$assetDistForm.find ('[name="tolocation-id"]').val ($dataTo);
					$assetDistForm.find ('[name="movein-docnum"]').val ($dataDoc);
					$assetDistForm.find ('[name="movein-docdate"]').val ($dataDate);
					$assetDistForm.find ('[name="movein-applicant"]').val ($dataApp);
					$assetDistForm.find ('[name="movein-fromlocation"]').val ($documents.find ('input#from').val ());
					$assetDistForm.find ('[name="movein-tolocation"]').val ($documents.find ('input#to').val ());
				} else $assetDistForm.trigger ('reset');
			}
		});

		$('body').on ('keydown', function ($evt) {
			$amvisModal = $('div#amvis-modal');
			if ($amvisModal.hasClass ('show') && $evt.keyCode == 27) $('body').find ('#btn-closedetailomvi').trigger ('click');
		});
		
		$('table').on ('click', 'td', function ($evt) {
			$tableId = $(this).parents ('table').prop ('id');
			switch ($tableId) {
				default:
					break;
				case 'dataTable-moveinMaster':
					$dataTable = $.searchDataTable ($tableId);
					if ($dataTable.rows ().count () > 0) {
						$docnum = $(this).parents ('tr').find ('td:eq(1)').text ();
						$data = {
							'trigger': 'clicked-docnum',
							'transmit': {
								'source': 'doc-assetin',
								'clicked-docnum': $docnum
							}
						};

						$.ajax ({
							'method': 'put',
							'url': $.base_url ($locale + '/api/sent'),
							'data': JSON.stringify ($data),
							'dataType': 'json',
							'contentType': 'json'
						}).done (function ($result) {
							if (!$result.good) ;
							else {
								$amvisModal			= $('div#amvis-modal');
								$amvisModalTitle	= $amvisModal.find ('.modal-title');
								$amvisModalBody		= $amvisModal.find ('.modal-body');
								$amvisModalFooter	= $amvisModal.find ('.modal-footer');

								$('<form/>', {
									'id': 'movein-details',
									'role': 'form'
								}).appendTo ($amvisModalBody);
								$('<div/>', {
									'id': 'document',
									'class': 'row'
								}).appendTo ('#movein-details');

								$.each ($result.dataTransmit['data-movein'], function ($key, $document) {
									switch ($key) {
										case 'sent_by':
										case 'sent_date':
											if (!$result.isSent) break;
										default:
											$value = '';
											$size = 'col-md-6';
											switch ($key) {
												default:
													$value = $document;
													break;
												case 'username':
													$value = $document;
													$size = 'col-md-12';
													break;
												case 'sent_by':
													$value = $result.dataTransmit['data-usersent'];
													break;
												case 'received_by':
													$value = $result.dataTransmit['data-userreceived'];
													break;
												case 'received_date':
													if ($document === null) $value = $result.statusText['nr'];
													else $value = $document;
													break;
												case 'omvo_olctfrom':
													$value = $result.dataTransmit['data-locationfrom'];
													break;
												case 'omvo_olctto':
													$value = $result.dataTransmit['data-locationto'];
													break;
											}
											
											$element = $('<input/>', {
												'type': 'text',
												'class': 'form-control',
												'name': $key,
												'value': $value,
												'readonly': true
											});
											
											switch ($key) {
												default:
													break;
												case 'docnum':
													$('<div/>', {
														'class': 'col-md-12',
														'html': $('<h6/>', {
																	'text': $result.titles['doctitle']
																}).prop ('outerHTML')
													}).appendTo ('div#document');
													break;
												case 'ref_docnum':
													$('<div/>', {
														'class': 'col-md-12',
														'html': $('<h6/>', {
																	'html': $result.titles['refdoctitle'] + ' - status: ' + 
																	($result.isSent ? '<span class="text-success">Dikirim</span>' : '<span class="text-danger">Belum Dikirim</span>')
																}).prop ('outerHTML')
													}).appendTo ('div#document');
													break;
											}
											
											$('<div/>', {
												'class': $size,
												'html': $('<div/>', {
															'class': 'form-group',
															'html': $('<label/>', {
																		'for': $key,
																		'text': $result.labels[$key]
																	}).prop ('outerHTML') + 
																	$('<div/>', {
																		'class': 'input-group',
																		'html': $element.prop ('outerHTML')
																	}).prop ('outerHTML')
														}).prop ('outerHTML')
											}).appendTo ('div#document');

											switch ($key) {
												default:
													break;
												case 'received_date':
													$('<div/>', {
														'class': 'col-md-12',
														'html': $('<hr/>').prop ('outerHTML')
													}).appendTo ('div#document');
													break;
											}
											break;
										case 'idx':
										case 'omvo_refidx':
										case 'sent':
											break;
									}
								});
								$('<hr/>').appendTo ('#movein-details');
								$('<div/>', {
									'id': 'details',
									'class': 'row'
								}).appendTo ('#movein-details');
								$('<div/>', {
									'class': 'col-md-12'
								}).appendTo ('#details');
								$('<h6/>', {'text': $result.titles['refdocdetail']}).appendTo ('#details .col-md-12');
								$('<table/>', {
									'id': 'dataTable-moveinDetails',
									'class': 'dataTable table table-striped table-hover table-pointer',
									'html': $('<thead/>').prop ('outerHTML') + $('<tbody/>').prop ('outerHTML')
								}).appendTo ('div#details .col-md-12');
								$('<tr/>').appendTo ('table#dataTable-moveinDetails thead');
								$.each ($result.dataTransmit['data-moveinheads'], function ($key, $text) {
									$('<th/>', {'html': $text}).appendTo ('table#dataTable-moveinDetails thead tr');
								});

								$lineIdx = 1;
								$.each ($result.dataTransmit['data-moveindetail'], function ($idx, $line) {
									$dataRow = $('<tr/>');
									$.each ($line, function ($key, $value) {
										$text = '';
										if ($key == 'oita_idx') $text = $lineIdx;
										else $text = $value;
										$('<td/>', {
											'html': $text
										}).appendTo ($dataRow);
										if ($key === 'osbl_name' && $result.isReceived) {
											$text = ($result.dataTransmit['data-moveinrcvd'].length === 0 ? 'Belum Didistribusikan' 
														: $result.dataTransmit['data-moveinrcvd'][$line.oita_idx]);
											$('<td/>', {
												'text': $text
											}).appendTo ($dataRow);
										}
									});
									$lineIdx += 1;
									$dataRow.appendTo ('table#dataTable-moveinDetails tbody');
								});

								$('<div/>', {
									'id': 'movein-accept',
									'class': 'row'
								}).appendTo ('movein-details');
								$('<hr/>').appendTo ('#movein-details');

								$('<div/>', {
									'id': 'movein-detailbtns'
								}).appendTo ($amvisModalFooter);
								if ($result.isSent && !$result.isReceived) 
									$('<button/>', {
										'id': 'btn-markreceivedomvi',
										'class': 'btn btn-success',
										'type': 'button',
										'html': $('<i/>', {
													'class': 'fas fa-hand-holding fa-fw'
												}).prop ('outerHTML') + ' ' + $result.btnReceived
									}).appendTo ('div#movein-detailbtns');
								$('<button/>', {
									'id': 'btn-closedetailomvi',
									'class': 'btn btn-secondary',
									'type': 'button',
									'data-dismiss': 'modal',
									'html': $('<i/>', {
												'class': 'fas fa-times fa-fw'
											}).prop ('outerHTML') + ' ' + $result.btnClose
								}).appendTo ('div#movein-detailbtns');
								
								$amvisModal.attr ('aria-labelledby', 'movein-details');
								$amvisModal.modal ('show');
								$('table#dataTable-moveinDetails').DataTable ();
							}
						}).fail (function () {
						});
					}
					break;
				case 'table-moveDetails':
					$assetDistDT = $.searchDataTable ('dataTable-assetDistribution');
					$rowCount = $assetDistDT.rows ().count ();
					$clickedRow = $(this).parents ('tr');
					$firstColumn = $clickedRow.children (':eq(0)');
					$itemID = $firstColumn.find ('input#item-id').val ();
					$moveQty = parseInt ($clickedRow.children (':eq(3)').text ());
					$doAdd = false;
					$doEdit = false;
					$rowFound = [];
					$distQty = 0;
					if ($rowCount == 0) $doAdd = true;
					else {
						$doAdd = true;
						$nodes = $assetDistDT.rows ().nodes ();
						$.each ($nodes, function ($index, $node) {
							$row = $($node);
							$rowItemID = $row.children (':eq(0)').find ('input#item-id').val ();
							if ($itemID == $rowItemID) $rowFound.push ($row);
						});

						if ($rowFound.length == 0) $doAdd = true;
						else {
							$unselectSubLoc = false;
							$.each ($rowFound, function ($key, $row) {
								$distQty += parseInt ($row.find ('input#move-qty').val ());
								$unselectSubLoc = ($row.find ('select').val () === null);
							});

							console.log ($distQty);
							if ($unselectSubLoc) $doAdd = false;
							else if ($distQty == $moveQty) $doAdd = false;
							else $doAdd = true;
						}
					}

					if ($doAdd) {
						$data = {
							'trigger': 'target-sublocations',
							'transmit': {
								'tolocation-idx': $('input[name="tolocation-id"]').val ()
							}
						};
						$.ajax ({
							'url': $.base_url ($locale + '/api/get'),
							'method': 'put',
							'data': JSON.stringify ($data),
							'dataType': 'json'
						}).done (function ($result) {
							if (!$result.good) ;
							else {
								$dataSublocations = $result['data-sublocations'];
								$sublocOptions = $('<select/>', {
									'name': 'to-sublocation-' + $rowCount,
									'id': 'to-sublocation-opt',
									'required': true,
									'html': $('<option/>', {
										'disabled': 'disabled',
										'selected': 'selected',
										'text': '--- Pilih Sublokasi ---'
									}).prop ('outerHTML')
								});
								$.each ($dataSublocations, function ($key, $value) {
									$('<option/>', {
										'value': $key,
										'text': $value
									}).appendTo ($sublocOptions);
								});
								$distributionRow = [
									$('<input/>', {
										'type': 'hidden',
										'id': 'item-id',
										'name': 'item-id-' + $rowCount,
										'value': $itemID
									}).prop ('outerHTML') + 
									$('<span>', {
										'id': 'item-code',
										'text': $clickedRow.find ('span#item-code').text ()
									}).prop ('outerHTML'),
									$clickedRow.children (':eq(1)').text (),
									$clickedRow.children (':eq(2)').text (),
									$sublocOptions.prop ('outerHTML'),
									$('<input/>', {
										'type': 'number',
										'id': 'move-qty',
										'name': 'move-qty-' + $rowCount,
										'data-itemid': $itemID,
										'min': 1,
										'max': $moveQty,
										'value': $moveQty - $distQty
									}).prop ('outerHTML'),
									$('<button/>', {
										'id': 'remove-itemmove',
										'type': 'button',
										'class': 'btn btn-primary btn-block',
										'html': $('<i/>', {'class': 'fas fa-times-circle'}).prop ('outerHTML')
									}).prop ('outerHTML')
								];
								$assetDistDT.row.add ($distributionRow).draw (false);
							}
						}).fail (function () {
						});
					} 
					break;
			}
		});

		$('body').on ('click', 'button, .document-header', function ($evt) {
			if ($(this).is ('button')) {
				$id = $(this).prop ('id');
				switch ($id) {
					default:
						break;
					case 'remove-itemmove':
						$tr = $(this).parents ('tr');
						$.searchDataTable ($(this).parents ('table').prop ('id')).row ($tr).remove ().draw (false);
						break;
				}
			} else if ($(this).is ('.document-header')) {
				$('.document-header').each (function () {
					if ($(this).hasClass ('clicked')) $(this).removeClass ('clicked');
				});
				$(this).addClass ('clicked');
			}
		});

		$('body').on ('change', 'input', function ($evt) {
			if ($(this).is ('input')) {
				$id = $(this).prop ('id');
				switch ($id) {
					default:
						break;
					case 'move-qty':
						break;
				}
			} else {
			}
		});

		$('div#amvis-modal').on ('hidden.bs.modal', function ($evt) {
			$labelledBy = $(this).attr ('aria-labelledby');
			if ($labelledBy === 'movein-details') {
				$('#movein-details').remove ();
				$('div#movein-detailbtns').remove ();
			}
		});
	});
	</script>
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