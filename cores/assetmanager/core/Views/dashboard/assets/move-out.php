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
									<i class="fas fa-plus-circle fa-fw"></i> <span>Buat Dokumen Baru</span>
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
																<i class="fas fa-database fa-fw"></i> <span>Ringkasan Aset Keluar</span>
															</a>
														</li>
														<li class="nav-item">
															<a class="nav-link" href="#moveout-form" data-toggle="tab" title="Membuat dokumen keluar baru">
																<i class="fas fa-edit fa-fw"></i> <span>Form Aset Keluar</span>
															</a>
														</li>
													</ul>
												</div>
											</div>
											<div class="tab-content">
												<div class="tab-pane fade show active" id="summary">
													<div class="row row-with-padding">
<?php
$summariesCount = count ($summaries);
$partition = 12 / $summariesCount;
foreach ($summaries as $summary): ?>
														<div class="col-md-<?php echo $partition; ?>">
															<div class="card <?php echo $summary['style']; ?>">
																<div class="card-header">
																	<h5 class="card-title"><?php echo $summary['title']; ?></h5>
																</div>
																<div class="card-body">
																	<p class="display-3"><?php echo $summary['content']; ?></p>
																</div>
																<div class="card-footer">
																	<div class="stats">
																		<a id="refresh-" . <?php echo $summary['id']; ?>><i class="fas fa-sync-alt fa-fw"></i> Perbarui</a>
																	</div>
																</div>
															</div>
														</div>
<?php endforeach; ?>
													</div>
													<hr />
													<div class="row row-with-padding">
														<div class="col">
															<table id="dataTable-moveoutMaster" class="dataTable table table-striped table-hover table-pointer table-centered-content">
																<thead>
																	<tr>
<?php foreach ($mvoutListTH as $th): ?>
																		<th><?php echo $th; ?></th>
<?php endforeach; ?>
																	</tr>
																</thead>
																<tbody>
<?php $lineId = 1;
foreach ($moveOutList as $list): ?>
																	<tr class="<?php echo $docstat->getClass ($list->status); ?>">
																		<td><?php echo $lineId; ?>
																		<td><?php echo $list->docnum; ?></td>
																		<td><?php echo $list->docdate; ?></td>
<?php if (in_array('Pemohon', $mvoutListTH)): ?>
																		<td><?php echo $list->username; ?></td>
<?php endif; ?>
																		<td><i class="<?php echo $docstat->getIcon ($list->status); ?>"></i></td>
																		<td><?php echo $list->approval_date === NULL ? 'N/A' : $list->approval_date; ?></td>
																		<td><span><?php echo $docstat->getStatusText ($list->status); ?></span></td>
																	</tr>
<?php $lineId++; 
endforeach; ?>
																</tbody>
															</table>
														</div>
													</div>
												</div>
												<div class="tab-pane fade" id="moveout-form">
													<div class="row row-with-padding">
														<div class="col">
															<form id="form-assetmoveout" role="form">
																<input type="hidden" name="applicant-useridx" value="<?php echo $userid; ?>">
																<div class="row">
																	<div class="col-md-4">
																		<div class="form-group">
																			<label for="moveout-docnum">No. Dokumen:</label>
																			<div class="input-group">
																				<input type="text" class="form-control" id="docnum" value="" />
																				<div class="input-group-append">
																					<span class="input-group-text input-group-pointer" data-click="do-searchdocument">
																						<i class="fas fa-search fa-fw"></i>
																					</span>
																				</div>
																			</div>
																		</div>
																		<div class="form-group">
																			<label for="moveout-doctime">Tanggal:</label>
																			<div class="input-group">
																				<input type="text" class="form-control" value="<?php echo date ('d-M-Y');?>" readonly="readonly" />
																			</div>
																		</div>
																	</div>
																	
																	<div class="col-md-8">
																		<div class="form-group">
																			<label for="moveout-applicant">Pemohon</label>
																			<div class="input-group">
																				<input type="text" class="form-control" name="moveout-applicant" value="<?php echo $username; ?>" readonly="readonly" required />
																			</div>
																		</div>
																		<div class="form-group">
																			<label for="moveout-fromlocation">Lokasi Asal:</label>
																			<div class="input-group">
																				<input type="hidden" name="moveout-fromlocation-hidden" value="<?php echo $locationManager == 0 ? '' : $locationManager; ?>" />
																				<select name="moveout-fromlocation" class="form-control" <?php echo $locationManager > 0 ? 'disabled="disabled"' : ''; ?> required>
																					<option disabled="disabled" <?php echo ($locationManager == 0) ? 'selected="selected"' : ''; ?>>--- Pilih Lokasi Asal ---</option>
<?php foreach ($dataLocation as $location): ?>
																					<option value="<?php echo $location->idx; ?>" <?php echo $location->idx == $locationManager ? 'selected="selected"' : ''; ?>><?php echo $location->name; ?></option>
<?php endforeach; ?>																			
																				</select>
																			</div>
																		</div>
																		<div class="form-group">
																			<label for="moveout-tolocation">Lokasi Tujuan:</label>
																			<div class="input-group">
																				<input type="hidden" name="moveout-tolocation-hidden" value="" />
																				<select name="moveout-tolocation" class="form-control" required>
																					<option disabled="disabled" selected="selected">--- Pilih Lokasi Tujuan ---</option>
<?php foreach ($dataLocation as $location): ?>
																					<option value="<?php echo $location->idx; ?>"><?php echo $location->name; ?></option>
<?php endforeach; ?>
																				</select>
																			</div>
																		</div>
																	</div>
																</div>
																
																<hr />
																<div class="row">
																	<div class="col text-right">
																		<button type="button" id="add-asset" class="btn btn-primary" title="Menambah aset daftar asset">
																			<i class="fas fa-plus-circle fa-fw"></i> <span>Tambah Aset</span>
																		</button>
																	</div>
																</div>
																<div class="row">
																	<div class="col">
																		<div class="form-group">
																			<div class="input-group">
																				<input type="text" class="form-control" id="assets" placeholder="<?php echo $searchPlaceholder; ?>"/>
																				<div class="input-group-append">
																					<span class="input-group-text input-group-pointer" data-click="do-searchasset">
																						<i class="fas fa-search fa-fw"></i>
																					</span>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col">
																		<table id="moveout-tablelist" class="dataTable table table-hover table-striped" data-paging="false" data-searching="false">
																			<thead>
																				<tr>
<?php foreach ($moveoutTH as $th): ?>
																					<th><?php echo $th; ?></th>
<?php endforeach; ?>
																				</tr>
																			</thead>
																			<tbody>
																			</tbody>
																		</table>
																	</div>
																</div>
																<div class="row">
																	<div class="col text-right">
																		<button type="button" id="submit-dummy" class="btn btn-primary" title="Simpan dokumen">
																			<i class="fas fa-paper-plane fa-fw"></i> <span>Kirim</span>
																		</button>
																		<button type="submit" id="submit-form" class="d-none"></button>
																		<button type="reset" class="btn btn-secondary">
																			<i class="fas fa-undo fa-fw"></i> <span>Ulangi</span>
																		</button>
																	</div>
																</div>
															</form>
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
				</div>

<?php include __DIR__ . '/../footer.php'; ?>
	<script>
	$(document).ready (function () {
		const $moveTable = $('table#moveout-tablelist').attr ('id');
		
		$('input').keydown (function ($evt) {
			if ($evt.which == 13) {
				$id = $(this).prop ('id');
				switch ($id) {
					default:
						break;
					case 'assets':
						$('[data-click="do-searchasset"]').trigger ('click');
						break;
					case 'docnum':
						$('[data-click="do-searchdocument"]').trigger ('click');
						break;
				}
			}
		});

		$('select').change (function ($evt) {
			$this = $(this);
			$name = $this.prop ('name');
			switch ($name) {
				default:
					$id = $this.prop ('id');
					switch ($id) {
						default:
							break;
						case 'sublocation':
							$optionSelected = $('option:selected', this);
							$target = $optionSelected.attr ('data-target');
							$('#amvos-modal').find ('a.nav-link[href="' + $target + '"]').click ();
							break;
					}
					break;
				case 'moveout-fromlocation':
					$('input[name="moveout-fromlocation-hidden"]').val ($(this).find ('option:selected').val ());
					break;
			}
		});

		$('[data-click]').click (function ($evt) {
			$clickName = $(this).attr ('data-click');
			switch ($clickName) {
				default:
					break;
				case 'do-searchdocument':
					console.log ('asdasdasdadasdad');
					break;
				case 'do-searchasset':
					$fromLocation = $('select[name="moveout-fromlocation"]');
					$val = $('input#assets').val ();
					$('input#assets').val ('');
					if ($val == null) ;
					else if ($val == '' || $val.length == 0) $('button#add-asset').click ();
					else {
						$from = $fromLocation.val ();
						$amvosModal = $('div#amvos-modal');
						$ajaxData = {
							'trigger': 'asset-list',
							'type': 'perlocation',
							'barcode': $val,
							'from': $from
						};
						
						$.ajax ({
							'method': 'put',
							'url': $.base_url ($locale + '/api/get'),
							'data': JSON.stringify ($ajaxData),
							'dataType': 'json',
							'contentType': 'json'
						}).done (function ($result) {
							if (!$result.good) console.log ('aidjfnbjangjinjnasdf');
							else if ($result.assetitems.length == 0) console.log ('adfasdfasdfasdfasdf');
							else {
								$('button#add-asset-items').attr ('data-click', 'perlocation');
								$tableId = 'dataTable-assetsList';
								$amvosModal = $('div#amvos-modal');
								$amvosModal.find ('div.modal-body').children ().addClass ('d-none');
								$('<div/>', {
									'id': 'asset-display',
									'class': 'row'
								}).appendTo ($amvosModal.find ('div.modal-body'));
								$('<div/>', {
									'class': 'col'
								}).appendTo ($amvosModal.find ('div.modal-body').find ('div#asset-display'));
								$('<table/>', {
									'id': $tableId,
									'class': 'dataTable table table-hover table-striped table-pointer'
								}).appendTo ($amvosModal.find ('div.modal-body').find ('div#asset-display div.col'));
								$('<thead/>').appendTo ($('table#' + $tableId));
								$('<tbody/>').appendTo ($('table#' + $tableId));
								$('<tr/>').appendTo ($('table#' + $tableId).find ('thead'));
								$.each ($result.tabpanehead, function ($id, $th) {
									$theadrow = $('table#' + $tableId).find ('thead tr');
									$('<th/>', {
										'html': $th
									}).appendTo ($theadrow);
								});

								$listDataTable = $('table#' + $tableId).DataTable ();

								$.each ($result.assetitems, function ($id, $item) {
									$tableData = $listDataTable.rows ().data ();
									$newRow = [
										$('<input/>', {
											'type': 'checkbox',
											'name': 'movecheck-' + $item.idx,
											'id': 'asset-item',
											'value': $item.idx,
											'className': 'form-control'
										}).prop ('outerHTML'),
										$item.code,
										$item.name,
										$item.sublocname,
										$item.qty,
										$('<input/>', {
											'type': 'number',
											'name': 'movenum-' + $item.idx,
											'class': 'form-control',
											'id': 'move-qty',
											'max': $item.qty
										}).prop ('outerHTML')
									];
									$listDataTable.row.add ($newRow).draw (false);
								});

								$('button#add-asset-items[data-click="perlocation"]').unbind ().click (function ($evt) {
									$checkedRows = [];
									$listDataTable.$('input:checkbox:checked').each (function () {
										$parentRow = $(this).parents ('tr');
										$checkedRows.push ($parentRow);
									});

									if ($checkedRows.length == 0) ;
									else {
										$moveOutTable = $.searchDataTable ($moveTable);
										$.each ($checkedRows, function ($id, $row) {
											$doAdd = false;
											$rowFound = null;
											if ($moveOutTable.rows ().count () == 0) $doAdd = true;
											else {
												$found = false;
												$addItemID = $row.find ('input:checkbox');
												$moveOutTable.$('input#item-id').each (function () {
													$rowItemID = $(this).val ();
													if ($addItemID.val () == $rowItemID) {
														$rowFound = $(this).parents ('tr');
														$found = true;
														return false;
													}
												});

												if (!$found) $doAdd = true;
											}

											$inputQty = $row.children (':last-child').find ('input#move-qty');
											if ($doAdd) {
												$cancelButton = $('<button/>', {
													'type': 'button',
													'class': 'btn btn-danger btn-block',
													'title': '<?php echo $cancelItem; ?>',
													'id': 'cancel-item'
												});
												$('<i/>', {
													'class': 'fas fa-times fa-fw'
												}).appendTo ($cancelButton);
												$('<span/>', {
													'text': '<?php echo $cancelItem; ?>'
												}).appendTo ($cancelButton);
												$assetItem = $row.find ('input#asset-item');
												$newRow = [
													$('<input/>', {
														'type': 'hidden',
														'name': 'item-id-' + $assetItem.val (),
														'id': 'item-id',
														'value': $assetItem.val ()
													}).prop ('outerHTML') + ($id + 1),
													$row.children ('td').eq (1).text (),
													$row.children ('td').eq (2).text (),
													$row.children ('td').eq (3).text (),
													$('<input/>', {
														'type': 'hidden',
														'name': 'itemmove-qty-' + $assetItem.val (),
														'id': 'itemmove-qty',
														'value': (($inputQty.val () == '') ? 1 : $inputQty.val ()),
														'max': $inputQty.prop ('max')
													}).prop ('outerHTML') + 
													$('<span/>', {
														'id': 'qty-text',
														'text': ($inputQty.val () == '') ? 1 : $inputQty.val ()
													}).prop ('outerHTML'),
													$cancelButton.prop ('outerHTML')
												];
												$moveOutTable.row.add ($newRow);
											} else {
												$inputMax = $inputQty.prop ('max');
												$currentQty = $rowFound.find ('td:eq(4)').text ();
												$finalQty = (parseInt ($currentQty) + parseInt (($inputQty.val () == '' ? 1 : $inputQty.val ())));
												if ($finalQty > $inputMax) alert ('<?php echo $alertExceed; ?>');
												else {
													$itemmoveQty = $rowFound.find ('input#itemmove-qty');
													$itemmoveQty.val ($finalQty);
													$itemmoveQty.change ();
												}
											}
										});
										$moveOutTable.draw (false);
										$fromLocation.attr ('disabled', true);
										$('div#amvos-modal').modal ('hide');
									}
								});
								$amvosModal.modal ('show');
							}
						}).fail (function () {
						});
					}
					break;
			}
		});

		$('form#form-assetmoveout button#submit-dummy').click (function ($evt) {
			$locFromSelect	= $('select[name="moveout-fromlocation"]');
			$locToSelect	= $('select[name="moveout-tolocation"]');
			$submitButton	= $('form#form-assetmoveout button:submit');
			if ($locFromSelect.val () == null || $locToSelect.val () == null) $submitButton.click ();
			else {
				$moveOutTableList = $.searchDataTable ($moveTable);
				if ($moveOutTableList.rows ().count () == 0);
				else {
					$form = $(this).parents ('form');
					$evt.preventDefault ();
					$data = {
						'trigger': 'moveout-sent',
						'form-data': $form.serializeArray ()
					};
					$.ajax ({
						'method': 'put',
						'url': $.base_url ($locale + '/api/sent'),
						'data': JSON.stringify ($data),
						'dataType': 'json'
					}).done (function ($result) {
						if (!$result.good) ;
						else window.location.reload (false);
					}).fail (function () {});
				}
			}
		});
		$('form#form-assetmoveout button:reset').click (function ($evt) {
			$selects		= [
				$('select[name="moveout-fromlocation"]'),
				$('select[name="moveout-tolocation"]')
			];
			$.each ($selects, function () {
				$this = $(this);
<?php if ($locationManager == 0): ?>
				if ($this[0].hasAttribute ('disabled')) $this.removeAttr ('disabled');
<?php endif; ?>
				$.searchDataTable ($moveTable).clear ().draw ();
			});
		});

		$('form#form-assetmoveout').on ('keydown', ':input:not(:submit)', function ($evt) {
			if ($evt.which == 13) {
				$evt.preventDefault ();
				$(this).change ();
			}
		});

		$.moveOutAction = function ($input) {
			$.ajax ({
				'method': 'put',
				'url': $.base_url ($locale + '/api/sent'),
				'data': JSON.stringify ($input),
				'dataType': 'json',
				'contentType': 'json'
			}).done (function ($result) {
				if (!$result.good) ;
				else 
					window.location.reload (true);
			}).fail (function () {
			});
		};

		$('body').on ('click', 'button, td, span#qty-text', function ($evt) {
			if ($(this).is ('button')) {
				$id = $(this).prop ('id');
				switch ($id) {
					default:
						break;
					case 'cancel-item':
						$moveOutDataTable = $.searchDataTable ($moveTable);
						$moveOutDataTable.row ($(this).parents ('tr')).remove ().draw (false);
						break;
					case 'add-asset-items':
						break;
					case 'btn-approveomvo':
						$data = {
							'trigger': 'moveout-action',
							'transmit': {
								'do': 'approve',
								'docnum': $('input#data-docnum').val ()
							}
						};
						$.moveOutAction ($data);
						break;
					case 'btn-declineomvo':
						$data = {
							'trigger': 'moveout-action',
							'transmit': {
								'do': 'decline',
								'docnum': $('input#data-docnum').val ()
							}
						};
						$.moveOutAction ($data);
						break;
					case 'btn-marksentomvo':
						$data = {
							'trigger': 'moveout-action',
							'transmit': {
								'do': 'marksent',
								'docnum': $('input#data-docnum').val ()
							}
						}
						$.moveOutAction ($data);
						break;
					case 'createnew-moveout':
						$('a[href="#moveout-form"]').trigger ('click');
						break;
					case 'data-print':
						$docnum = $(this).attr ('data-target');
						$('form#print').find ('input[name="doc-target"]').val ($docnum);
						$('form#print').submit ();
						break;
					case 'add-asset':
						$fromLocation	= $('select[name="moveout-fromlocation"]');
						if ($fromLocation.val () == null) ;
						else {
							$ajaxData = {
								'trigger': 'asset-list',
								'type': 'pertable',
								'from': $fromLocation.val ()
							};
							
							$.ajax ({
								'url': $.base_url ($locale + '/api/get'),
								'method': 'put',
								'data': JSON.stringify ($ajaxData),
								'dataType': 'json',
								'contentType': 'application/json'
							}).done (function ($result) {
								if (!$result.good) console.log ('asjdbnhasdbhasbd');
								else {
									$('button#add-asset-items').attr ('data-click', 'persublocation');
									$dataTables = [];
									
									$ths = $result.tabpanehead;
									$('select#sublocation').find ('option').not (':first').remove ();
									$('select#sublocation').prop ('selectedIndex', 0).change ();
									$.each ($result.sublocs, function ($idx, $subloc) {
										$('<option/>', {
											'value': $subloc.idx,
											'data-target': '#ID' + $subloc.code,
											'text': $subloc.name
										}).appendTo ($('select#sublocation'));

										$navItem = $('<li/>', {'class': 'nav-item'});
										$navItem.appendTo ('ul#subloctabs');
										$('<a/>', {
											'class': 'nav-link',
											'href': '#ID' + $subloc.code,
											'data-toggle': 'tab',
											'text': $subloc.name
										}).appendTo ($navItem);
										
										$tabpane = $('<div/>', {
											'id': 'ID' + $subloc.code,
											'class': 'tab-pane fade',
											'data-sblid': $subloc.idx
										});
										$tabpane.appendTo ('div#asset-tabcontents');

										$('<h6/>', {'text': $subloc.name}).appendTo ($tabpane);

										$divpane = $('<div/>', {
											'style': 'overflow-x: auto;'
										}).appendTo ($tabpane);

										$table = $('<table/>', {
											'id': 'dataTable-select' + $subloc.code,
											'class': 'table table-hover table-striped table-pointer'
										}).appendTo ($divpane);

										$thead = $('<thead/>').appendTo ($table);
										$hl = $('<tr/>').appendTo ($thead);
										$.each ($ths, function ($i, $text) {
											$('<th/>', {
												'html': $text
											}).appendTo ($hl);
										});
										$dataTable = $table.DataTable ();
										
										$dataTables.push ($dataTable);

										$('h5#sublocation-header').text ($subloc.name);
									});

									$items = {};
									$.each ($result.assetitems, function ($idx, $item) {
										$sblid = $item.osbl_idx;
										$newRow = [
											$('<input/>', {
												'type': 'checkbox',
												'name': 'movecheck-' + $item.idx,
												'id': 'asset-item',
												'value': $item.idx,
												'className': 'form-control'
											}).prop ('outerHTML'),
											$item.code,
											$item.name,
											$('select#sublocation').find ('option[value="' + $item.osbl_idx + '"]').text (),
											$item.qty,
											$('<input/>', {
												'type': 'number',
												'name': 'movenum-' + $item.idx,
												'id': 'move-qty',
												'max': $item.qty
											}).prop ('outerHTML')
										];
										$dataTable = $('div[data-sblid="' + $sblid + '"]').find ('table.dataTable').DataTable ();
										$dataTable.row.add ($newRow).draw (false);
									});

									$('button#add-asset-items[data-click="persublocation"]').unbind ().click (function ($evt) {
										$checkedRows = [];
										$.each ($dataTables, function ($k, $dt) {
											$dt.$('input:checkbox:checked').each (function () {
												$row = $(this).parents ('tr');
												$checkedRows.push ($row);
											});
										});

										if ($checkedRows.length == 0) ;
										else {
											$moveOutTable = $.searchDataTable ($moveTable);
											$.each ($checkedRows, function ($id, $row) {
												$doAdd = false;
												$rowFound = null;
												if ($moveOutTable.rows ().count () == 0) $doAdd = true;
												else {
													$found = false;
													$addItemID = $row.find ('input:checkbox');
													$moveOutTable.$('input#item-id').each (function () {
														$rowItemID = $(this).val ();
														if ($addItemID.val () == $rowItemID) {
															$rowFound = $(this).parents ('tr');
															$found = true;
															return false;
														}
													});

													if (!$found) $doAdd = true;
												}

												$inputQty = $row.children (':last-child').find ('input#move-qty');
												if ($doAdd) {
													$cancelButton = $('<button/>', {
														'type': 'button',
														'class': 'btn btn-danger btn-block',
														'title': '<?php echo $cancelItem; ?>',
														'id': 'cancel-item'
													});
													$('<i/>', {
														'class': 'fas fa-times fa-fw'
													}).appendTo ($cancelButton);
													$('<span/>', {
														'text': '<?php echo $cancelItem; ?>'
													}).appendTo ($cancelButton);
													$assetItem = $row.find ('input#asset-item');
													$newRow = [
														$('<input/>', {
															'type': 'hidden',
															'name': 'item-id-' + $assetItem.val (),
															'id': 'item-id',
															'value': $assetItem.val ()
														}).prop ('outerHTML') + ($id + 1),
														$row.children ('td').eq (1).text (),
														$row.children ('td').eq (2).text (),
														$row.children ('td').eq (3).text (),
														$('<input/>', {
															'type': 'hidden',
															'name': 'itemmove-qty-' + $assetItem.val (),
															'id': 'itemmove-qty',
															'value': (($inputQty.val () == '') ? 1 : $inputQty.val ()),
															'max': $inputQty.prop ('max')
														}).prop ('outerHTML') + 
														$('<span/>', {
															'id': 'qty-text',
															'text': ($inputQty.val () == '') ? 1 : $inputQty.val ()
														}).prop ('outerHTML'),
														$cancelButton.prop ('outerHTML')
													];
													$moveOutTable.row.add ($newRow);
												} else {
													$inputMax = $inputQty.prop ('max');
													$currentQty = $rowFound.find ('td:eq(4)').text ();
													$finalQty = (parseInt ($currentQty) + parseInt ($inputQty.val () == '' ? 1 : $inputQty.val ()));
													if ($finalQty > $inputMax) alert ('<?php echo $alertExceed; ?>');
													else {
														$itemmoveQty = $rowFound.find ('input#itemmove-qty');
														$itemmoveQty.val ($finalQty);
														$itemmoveQty.change ();
													}
												}
											});
											$moveOutTable.draw (false);
											$fromLocation.attr ('disabled', true);
											$('div#amvos-modal').modal ('hide');
										}
									});
									$('div#amvos-modal').modal ('show');
								}
							}).fail (function () {
							});
						}
						break;
					case 'cancel-asset-items':
						$checkedRows = [];
						$('div#amvos-modal').modal ('hide');
						break;
				}
			} else if ($(this).is ('span')) {
				$qtyInput = $(this).prev ();
				$(this).addClass ('d-none');
				$qtyInput.attr ('type', 'number');
			} else if ($(this).is ('td')) {
				$tableId = $(this).parents ('table').prop ('id');
				switch ($tableId) {
					default:
						if ($tableId.indexOf ('dataTable-select') == 0) {
							$itemCheck = $(this).parents ('tr').find ('input:checkbox');
							$itemCheck.prop ('checked', !$itemCheck.prop ('checked'));
						}
						break;
					case 'dataTable-moveoutMaster':
						$dataTable = $.searchDataTable ($tableId);
						if ($dataTable.rows ().count () > 0) {
							$docnum = $(this).parents ('tr').find ('td:eq(1)').text ();
							$data = {
								'trigger': 'clicked-docnum',
								'transmit': {
									'source': 'doc-assetout',
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
									$dataTransmit = $result.dataTransmit;
									$amvosModal = $('div#amvos-modal');
									$amvosModalTitle = $amvosModal.find ('.modal-title');

									if ($result.dataTransmit['data-moveout'].status == 2) { 
										$('button#data-print').removeClass ('d-none');
										$('button#data-print').attr ('data-target', $result.dataTransmit['data-moveout'].docnum);
									}
									
									$amvosModalTitle.text ($result.dataHead);
									$amvosModalBody = $amvosModal.find ('div.modal-body');
									$amvosModalBody.children ().each (function () {
										$(this).addClass ('d-none');
									});
									$amvosModalFooter = $amvosModal.find ('div.modal-footer');
									$amvosModalFooter.children ().each (function () {
										$(this).addClass ('d-none');
									});
									
									$amvosModal.attr ('aria-labelledby', 'moveout-details');
	
									$('<div/>', {
										'id': 'moveout-details'
									}).appendTo ($amvosModalBody);
									$('<input/>', {
										'type': 'hidden',
										'id': 'data-docnum',
										'value': $result.docnum
									}).appendTo ('div#moveout-details');
									$('<div/>', {'id': 'documents', 'class': 'row'}).appendTo ($('div#moveout-details'));
									$.each ($dataTransmit['data-moveout'], function ($key, $value) {
										switch ($key) {
											default:
												$divCol = $('<div/>', {'class': 'col-md-6'});
												$formGroup = $('<div/>', {'class': 'form-group'});
												$('<label/>', {'text': $result.dataLabels[$key]}).appendTo ($formGroup);
												$inputGroup = $('<div/>', {'class': 'input-group'});
												$('<input/>', {
													'type': 'text',
													'class': 'form-control',
													'value': $value,
													'readonly': true
												}).appendTo ($inputGroup);
												$inputGroup.appendTo ($formGroup);
												$formGroup.appendTo ($divCol);
												$divCol.appendTo ('div#documents');
												break;
											case 'status':
												$divCol = $('<div/>', {'class': 'col-md-6'});
												$formGroup = $('<div/>', {'class': 'form-group'});
												$('<label/>', {'text': $result.dataLabels[$key]}).appendTo ($formGroup);
												$inputGroup = $('<div/>', {'class': 'input-group'});
												$('<input/>', {
													'type': 'text',
													'class': 'form-control',
													'value': $result.documentStatus,
													'readonly': true
												}).appendTo ($inputGroup);
												$inputGroup.appendTo ($formGroup);
												$formGroup.appendTo ($divCol);
												$divCol.appendTo ('div#documents');
												break;
											case 'idx':
											case 'olct_from':
											case 'olct_to':
												break;
										}
									});
									$('<hr/>').appendTo ('div#moveout-details');
	
									$('<div/>', {'id': 'details', 'class': 'row'}).appendTo ('div#moveout-details');
									$('<div/>', {'class': 'col-md-12'}).appendTo ('div#moveout-details div#details');
									$('<div/>', {
										'html': $('<h6/>', {
											'text': $result.dataDetails
										}).prop ('outerHTML')
									}).appendTo ('div#details div.col-md-12');
									$('<table/>', {
										'id': 'dataTable-moveoutDetails',
										'class': 'dataTable table table-striped table-hover table-pointer'
									}).appendTo ('div#details div.col-md-12');
									$('<thead/>').appendTo ('table#dataTable-moveoutDetails');
									$('<tr/>').appendTo ('table#dataTable-moveoutDetails thead');
									$.each ($result.dataTransmit['data-moveoutheads'], function ($key, $value) {
										$('<th/>', {'text': $value}).appendTo ('table#dataTable-moveoutDetails thead tr');
									});
									$('<tbody/>').appendTo ('table#dataTable-moveoutDetails');
									$dataLineId = 1;
									$.each ($result.dataTransmit['data-moveoutdetail'], function ($key, $detail) {
										$dataRow = $('<tr/>');
										$dataRow.appendTo ('table#dataTable-moveoutDetails tbody');
										$('<td/>', {'text': $dataLineId}).appendTo ($dataRow);
										$.each ($detail, function ($objKey, $objValue) {
											switch ($objKey) {
												default:
													$('<td/>', {'text': $objValue}).appendTo ($dataRow);
													break;
												case 'oita_idx':
												case 'osbl_idx':
													break;
											}
										});
										$dataLineId++;
									});
	
									$('<div/>', {
										'id': 'moveout-detailbtns'
									}).appendTo ($amvosModalFooter);
									if ($dataTransmit['data-canapprove'] == 1 && $dataTransmit['data-moveout']['status'] == 1) {
										$buttons = [
											$('<button/>', {
												'id': 'btn-approveomvo',
												'class': 'btn btn-success',
												'type': 'button',
												'html': $('<i/>', {
													'class': 'fas fa-check fa-fw'
												}).prop ('outerHTML') + ' ' + $result.btnApprove
											}),
											$('<button/>', {
												'id': 'btn-declineomvo',
												'class': 'btn btn-danger',
												'type': 'button',
												'html': $('<i/>', {
													'class': 'fas fa-ban fa-fw'
												}).prop ('outerHTML') + ' ' + $result.btnDecline
											})
										];
										$.each ($buttons, function () {
											$(this).appendTo ('div#moveout-detailbtns');
										});
									}
	
									if ($dataTransmit['data-cansend'] == 1 && $dataTransmit['data-moveout']['status'] == 2) {
										$('<button/>', {
											'id': 'btn-marksentomvo',
											'class': 'btn btn-primary',
											'type': 'button',
											'html': $('<i/>', {
												'class': 'fas fa-paper-plane fa-fw'
											}).prop ('outerHTML') + $result.btnSent
										}).appendTo ('div#moveout-detailbtns');
									}
									
									$('<button/>', {
										'id': 'btn-closedetailomvo',
										'class': 'btn btn-secondary',
										'type': 'button',
										'data-dismiss': 'modal',
										'html': $('<i/>', {
											'class': 'fas fa-times fa-fw'
										}).prop ('outerHTML') + ' ' + $result.btnClose
									}).appendTo ('div#moveout-detailbtns');
									$('table#dataTable-moveoutDetails').DataTable ();
									
									$amvosModal.modal ('show');
								}
							}).fail (function () {
							});
						}
						break;
				}
			}
		});

		$('body').on ('focusout', 'input', function ($evt) {
			$id = $(this).prop ('id');
			switch ($id) {
				default:
					break;
				case 'itemmove-qty':
					$(this).change ();
					break;
			}
		});
		
		$('body').on ('change', 'input', function ($evt) {
			$inputid = $(this).prop ('id');
			switch ($inputid) {
				default:
					break;
				case 'move-qty':
					$max = parseInt ($($evt.target).prop ('max'));
					$cvl = parseInt ($($evt.target).val ());
					if ($cvl > $max) $(this).val ($max);
					else if ($cvl < 0) $(this).val (1);
					else $(this).val ($cvl);
					break;
				case 'itemmove-qty':
					$maxQty = $(this).prop ('max');
					$qtyText = $(this).parents ('td').find ('span#qty-text');
					$currQty = parseInt ($qtyText.text ());
					$updtQty = parseInt ($(this).val ());
					if (!$.isNumeric ($(this).val ())) 
						$(this).val ($currQty);
					else if ($updtQty > $maxQty) {
						alert ('<?php echo $alertExceed; ?>');
						$(this).val ($maxQty);
					} else if ($updtQty < 1) 
						$(this).parents ('tr').find ('button#cancel-item').click ();
					else $qtyText.text ($updtQty);
					$qtyText.removeClass ('d-none');
					$(this).attr ('type', 'hidden');
					break;
			}
		});
		
		$('div#amvos-modal').on ('hidden.bs.modal', function ($evt) {
			$labelledBy = $(this).attr ('aria-labelledby');
			if ($labelledBy === 'moveout-details') {
				$('div#moveout-details').remove ();
				$('div#moveout-detailbtns').remove ();
				$(this).attr ('aria-labelledby', '');
			}
			$(this).find ('.modal-title').empty ();
			$(this).find ('button#data-print').addClass ('d-none');
			$(this).find ('.modal-body').children ('div.row').removeClass ('d-none');
			$(this).find ('.modal-body').find ('div#asset-display').remove ();
			$(this).find ('.nav-tabs').empty ();
			$(this).find ('.tab-content').empty ();
			$('button#add-asset-items').removeAttr ('data-click');
			$selectsubloc = $(this).find ('select#sublocation');
			$selectsubloc.find ('option').not (':first').remove ();
			$selectsubloc.prop ('selectedIndex', 0).change ();
		});
	});
	</script>
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