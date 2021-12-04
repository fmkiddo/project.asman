<?php include __DIR__ . '/../header.php';
$dataUsername		= $pagedata['dataTransmit']['data-username'];
$dataUserLocation	= $pagedata['dataTransmit']['data-userlocation'];
$dataLocations		= $pagedata['dataTransmit']['data-locations'];
$dataRequestDocs	= $pagedata['dataTransmit']['data-requests'];
$dataAssets			= $pagedata['dataTransmit']['data-assets'];
?>
				<style>
				#amvrs-modal table.table.dataTable th,
				#amvrs-modal table.table.dataTable td {
					text-align: center;
				}
				</style>
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header d-flex justify-content-between">
								<h4 class="card-title">
									<i class="fas fa-box fa-fw"></i>
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
															<a class="nav-link active" href="#summary" data-toggle="tab">
																<i class="fas fa-database fa-fw"></i> <span data-smarty="{1}"></span>
															</a>
														</li>
														<li class="nav-item">
															<a class="nav-link" href="#request-new" data-toggle="tab">
																 <i class="fas fa-boxes fa-fw"></i> <span data-smarty="{2}"></span>
															</a>
														</li>
														<li class="nav-item">
															<a class="nav-link" href="#request-move" data-toggle="tab">
																<i class="fas fa-file-signature fa-fw"></i> <span data-smarty="{3}"></span>
															</a>
														</li>
														<li class="nav-item">
															<a class="nav-link" href="#request-destroy" data-toggle="tab">
																<i class="fas fa-trash fa-fw"></i> <span data-smarty="{4}"></span>
															</a>
														</li>
													</ul>
												</div>
											</div>
											<div class="tab-content">
<?php include 'request-tabs/summaries.php'; ?>
<?php include 'request-tabs/request-new.php'; ?>
<?php include 'request-tabs/request-move.php'; ?>
<?php include 'request-tabs/request-destroy.php'; ?>
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
		$moveReqTable = 'movereq-tablelist';

		$(function () {
			$filter = parseInt ($('input#data-filter').val ());
			if ($filter > 0) {
				$locationSelect = $('select#user-location');
				$locationSelect.val ($filter);
				$locationSelect.trigger ('change');
				$locationSelect.prop ('disabled', true);
			}
		});
		
		$.searchAssets = function ($fromLocation, $input) {
			$amvrsModal = $('div#amvrs-modal');
			if ($input === null || $input.length === 0 || $input === "") {
				$type = 'pertable';
				$('section#see-partial').addClass ('d-none');
			} else {
				$type = 'perlocation';
				$('section#see-all').addClass ('d-none');
			}

			$barcode = $input;
			$.ajax ({
				'url': $.base_url ($locale + '/api/sent'),
				'method': 'put',
				'data': JSON.stringify ({
							'trigger': 'asset-list',
							'type': $type,
							'barcode': $barcode,
							'from': $fromLocation
						}),
				'dataType': 'json',
				'contentType': 'json'
			}).done (function ($result) {
				if (!$result.good) ;
				else {
					if ($type === 'pertable') 
						$.each ($result.sublocs, function ($key, $data) {
							$('<option/>', {
								'data-target': '#ID' + $data.code,
								'value': $data.idx,
								'text': $data.name
							}).appendTo ('select#opt-sublocation');
	
							$('<li/>', {
								'class': 'nav-item',
								'html': $('<a/>', {
									'class': 'nav-link',
									'href': '#ID' + $data.code,
									'data-toggle': 'tab'
								}).prop ('outerHTML')
							}).appendTo ('ul#subloc-tabs');
	
							$tabpane = $('<div/>', {
								'class': 'tab-pane fade',
								'id': 'ID' + $data.code,
								'data-sblid': $data.idx,
								'html': $('<h6/>', {
										'text': $data.name
									}).prop ('outerHTML') + 
									$('<div/>', {
										'style': 'overflow-x: auto'
									}).prop ('outerHTML')
							});
							$('<table/>', {
								'id': 'dataTable-' + $data.code,
								'class': 'dataTable table table-striped table-hover table-pointer',
								'html': $('<thead/>', {
										'html': $('<tr/>').prop ('outerHTML')
									}).prop ('outerHTML') + $('<tbody/>').prop ('outerHTML')
							}).appendTo ($tabpane.find ('div'));
	
							$.each ($result.tabpanehead, function ($idx, $head) {
								$('<th/>', {
									'html': $head
								}).appendTo ($tabpane.find ('table thead tr'));
							});
							$tabpane.appendTo ('div#subloc-tabcontent');
							$dataTable = $tabpane.find ('table.dataTable').DataTable ();
	
							$.each ($result.assetitems, function ($idx, $assetitem) {
								if ($assetitem.osbl_idx == $data.idx) {
									$newRow = [
										$('<input/>', {
											'type': 'checkbox',
											'name': 'movecheck-' + $assetitem.idx,
											'id': 'asset-item',
											'value': $assetitem.idx,
											'class': 'form-control'
										}).prop ('outerHTML'),
										$assetitem.code,
										$assetitem.name,
										$('select#opt-sublocation').find ('option[value="' + $assetitem.osbl_idx + '"]').text (),
										$assetitem.qty,
										$('<input/>', {
											'type': 'number',
											'name': 'movenum-' + $assetitem.idx,
											'id': 'move-qty',
											'max': $assetitem.qty
										}).prop ('outerHTML')
									];
									$dataTable.row.add ($newRow).draw (false)
								}
							});
							$dataTable = $tabpane.find ('table.dataTable').DataTable ();
						}); 
					else {
						$divpane = $('<div/>', {
							'style': 'overflow-x: auto'
						}).appendTo ('section#see-partial div.row div.col');
						$tableList = $('<table/>', {
							'id': 'dataTable-' + $barcode,
							'class': 'dataTable table table-hover table-striped table-pointer',
							'html': $('<thead/>', {
								'html': $('<tr/>').prop ('outerHTML')
							}).prop ('outerHTML') + $('<tbody/>').prop ('outerHTML')
						});
						$.each ($result.tabpanehead, function ($idx, $head) {
							$('<th/>', {'html': $head}).appendTo ($tableList.find ('thead tr'));
						});
						$tableList.appendTo ($divpane);
						$assetListTable = $tableList.DataTable ();
						$.each ($result.assetitems, function ($idx, $item) {
							$newRow = [
								$('<input/>', {
									'type': 'checkbox',
									'name': 'movecheck-' + $item.idx,
									'id': 'asset-item',
									'value': $item.idx,
									'class': 'form-control'
								}).prop ('outerHTML'),
								$item.code,
								$item.name,
								$item.sublocname,
								$item.qty,
								$('<input/>', {
									'type': 'number',
									'name': 'movenum-' + $item.idx,
									'id': 'move-qty',
									'max': $item.qty
								}).prop ('outerHTML')
							];
							$assetListTable.row.add ($newRow).draw (false);
						});
					}
					$amvrsModal.attr ('aria-labelledby', 'moveout-request');
					$amvrsModal.modal ('show');
				}
			});
		};

		$('body').on ('keyup', 'input', function ($evt) {
			$input = $(this);
			$id = $input.prop ('id');
			switch ($id) {
				default:
					break;
				case 'search-assets':
					if ($evt.which == 13) $('button#add-asset').click ();
					break;
				case 'search-asset-filter':
					$filter = $(this).val ().toLowerCase ();
					$('table#dataTable-masterAssets tbody tr').filter (function () {
						$(this).toggle ($(this).text ().toLowerCase ().indexOf ($filter) > -1);
					});
					break;
				case 'input-reqextqty':
					switch ($evt.which) {
						default:
							break;
						case 13:
							$(this).trigger ('focusout');
							break;
						case 27:
							$oldQty = parseInt ($(this).next ().text ());
							$(this).val ($oldQty)
							$(this).trigger ('focusout');
							break;
					}
					break;
			}
		});

		$('body').on ('click', '[data-click]', function ($evt) {
			$dataClick = $(this).attr ('data-click');
			switch ($dataClick) {
				default:
					break;
				case 'do-searchasset':
					$('button#add-asset').click ();
					break;
			}
		});

		$('body').on ('click', 'button, td', function ($evt) {
			if ($(this).is ('button')) {
				$button = $(this);
				$id = $button.prop ('id');
				switch ($id) {
					default:
						break;
					case 'cancel-item':
						$moveReqDT = $.searchDataTable ('movereq-tablelist');
						$moveReqDT.row ($(this).parents ('tr')).remove ().draw (true);
						break;
					case 'cancel-asset':
						$row = $(this).parents ('tr');
						$reqExistDT = $.searchDataTable ('dataTable-masterRequest');
						$reqExistDT.row ($row).remove ().draw (true);
						break;
					case 'delete-row':
						$row = $(this).parents ('tr');
						$removeDT = $.searchDataTable ('dataTable-assetListDestroy');
						$removeDT.row ($row).remove ().draw (false);
						break;
					case 'add-asset-items':
						$tables = $('#amvrs-modal').find ('table.dataTable');
						$assetRows = [];
						$.each ($tables, function ($key, $table) {
							$dataTable = $($table).DataTable ();
							$dataTable.$('input:checkbox:checked').each (function () {
								$assetRows.push ($(this).parents ('tr'));
							});
						});
	
						if ($assetRows.length == 0) ;
						else {
							$moveReqDT = $.searchDataTable ('movereq-tablelist');
							$rowCount = $moveReqDT.rows ().count ();
							$lineId = 0;
							if ($rowCount == 0) $lineId = 1;
							else {
								$lastRowData	= $moveReqDT.row (':last').data ();
								$lastLineId		= $($lastRowData[0]);
								$lastLineVal	= parseInt ($($lastLineId).text ());
								$lineId 		= $lastLineVal + 1;
							}
							
							$.each ($assetRows, function ($key, $value) {
								$doAdd = false;
								$rowFound = null;
								if ($rowCount == 0) $doAdd = true;
								else {
									$found = false;
									$itemId = $value.find ('input:checkbox');
									$moveReqDT.$('input#item-id').each (function () {
										$rowId = $(this).val ();
										if ($rowId == $itemId.val ()) {
											$rowFound = $(this).parents ('tr');
											$found = true;
											return false;
										}
									});
	
									if (!$found) $doAdd = true;
								}
								
								$checkedInput = $value.find ('input:checkbox');
								$moveQty = $value.find ('input#move-qty');
								
								if ($doAdd) {
									$reqLine = [
										$('<input/>', {
											'type': 'hidden',
											'id': 'item-id',
											'name': 'item-id-' + $checkedInput.val (),
											'value': $checkedInput.val ()
										}).prop ('outerHTML') + 
										$('<span/>', {
											'id': 'line-id',
											'text': $lineId
										}).prop ('outerHTML'),
										$value.find ('td:eq(1)').text (),
										$value.find ('td:eq(2)').text (),
										$value.find ('td:eq(3)').text (),
										$('<input/>', {
											'type': 'hidden',
											'name': 'itemmove-qty-' + $checkedInput.val (),
											'id': 'itemmove-qty',
											'value': $moveQty.val () == '' ? 1 : $moveQty.val (),
											'max': $moveQty.prop ('max')
										}).prop ('outerHTML') +
										$('<span/>', {
											'id': 'qty-text',
											'text': $moveQty.val () == '' ? 1 : $moveQty.val ()
										}).prop ('outerHTML'),
										$('<button/>', {
											'type': 'button',
											'class': 'btn btn-primary btn-block',
											'id': 'cancel-item',
											'html': $('<i/>', {
												'class': 'fas fa-times-circle fa-fw'
											}).prop ('outerHTML')
										}).prop ('outerHTML')
									];
									$moveReqDT.row.add ($reqLine).draw (false);
								} else {
									$listedQtyInput	= $rowFound.find ('input#itemmove-qty');
									$listedQtyText	= $rowFound.find ('span#qty-text');
									$listedQty		= parseInt ($listedQtyInput.val ());
									$listedMax		= parseInt ($listedQtyInput.prop ('max'));
									$inputMoveQty	= parseInt ($moveQty.val ());
									$newInput		= $listedQty + $inputMoveQty;
									console.log ($newInput);
									if ($newInput > $listedMax) {
										$listedQtyInput.val ($listedMax);
										$listedQtyText.text ($listedMax);
									} else {
										$listedQtyInput.val ($newInput);
										$listedQtyText.text ($newInput);
									}
								}
								$lineId++;
							});
							$('select#location-opt[name="moveout-fromlocation"]').prop ('disabled', true);
							$('#amvrs-modal').modal ('hide');
						}
						break;
					case 'add-asset':
						$moveFromLocation = $('input[name="moveout-fromlocation-hidden"]');
						$optLocation = $moveFromLocation.val ();
						if ($optLocation === "" || $optLocation === null) ;
						else {
							$input = $('input#search-assets').val ();
							$('input#search-assets').val ('');
							$.searchAssets ($optLocation, $input);
						}
						break;
					case 'submit-request':
						$moveReqDT = $.searchDataTable ('movereq-tablelist');
						if ($moveReqDT.rows ().count () > 0) {
							$moveReqForm = $('form#request-displacement-asset');
							$data = {
								'trigger': 'asset-requestin',
								'form-data': $moveReqForm.serializeArray ()
							};
							$.ajax ({
								'url': $.base_url ($locale + '/api/sent'),
								'method': 'put',
								'data': JSON.stringify ($data),
								'dataType': 'json'
							}).done (function ($result) {
								if (!$result.good) window.location.reload ();
								else {
								}
							}); 
						}
						break;
					case 'addimages-requestnew':
						$('input#images-input').click ();
						break;
					case 'clear-images':
						$('div#asset-images').children ('div.carousel-inner').empty ();
						$('div#asset-images-container').addClass ('d-none');
						$('input#images-input').val ('');
						break;
					case 'save-requestnew':
						$formRequestNew = $(this).parents ('form');
						$formRequestNew.addClass ('was-validated');
						if (!$formRequestNew.validateForm ()) ;
						else {
							$formRequestNew.attr ('action', $.base_url ($locale + '/api/process'));
							$formRequestNew.attr ('method', 'post');
							$formRequestNew.submit ();
						}
						break;
					case 'reset-requestnew':
						$('button#clear-images').trigger ('click');
						break;
					case 'save-requestexisting':
						$reqExistDT = $.searchDataTable ('dataTable-masterRequest');
						$reqDTEmpty = ($reqExistDT.rows ().count () == 0);

						if ($reqDTEmpty) ;
						else {
							$formReqExist = $('form#form-requestexisting');
							$data = {
								'trigger': 'assetreq-existing',
								'form-data': $formReqExist.serializeArray ()
							};
							$.ajax ({
								'url': $.base_url ($locale + '/api/sent'),
								'method': 'put',
								'data': JSON.stringify ($data),
								'dataType': 'json',
								'contentType': 'json'
							}).done (function ($result) {
								if (!$result.good) ;
								else window.location.reload (false);
							}).fail (function () {
							});
						}
						break;
					case 'reset-requestexisting':
						$requestExistDT = $.searchDataTable ('dataTable-masterRequest');
						$requestExistDT.clear ().draw (false);
						break;
					case 'reset-request':
						$('input#moveout-locations').val ('');
						if ($('select#location-opt[name="moveout-fromlocation"]').prop ('disabled')) 
							$('select#location-opt[name="moveout-fromlocation"]').prop ('disabled', false)
						$listDataTable = $.searchDataTable ($moveReqTable);
						$.searchDataTable ($moveReqTable).clear ().draw (false);
						break;
					case 'destroy-submit':
						$removalDT = $.searchDataTable ('dataTable-assetListDestroy');
						$form = $(this).parents ('form');
						if ($removalDT.rows ().count () > 0) {
							$('<input/>', {'type':'hidden', 'name':'trigger','value':'destroy-request'}).appendTo ($form);
							$form.prop ({'method': 'post', 'action': $.base_url ($locale + '/api/process')});
							$from.submit ();
						}
						break;
					case 'reset-destroy':
						$removalDT = $.searchDataTable ('dataTable-assetListDestroy');
						$removalDT.clear ().draw (false);
						$('select#user-location').prop ('disabled', false);
						break;
				}
			} else if ($(this).is ('td')) {
				$tableId = $(this).parents ('table').prop ('id');
				switch ($tableId) {
					default:
						$modal = $(this).parents ('div.modal');
						if ($modal.is ('div.modal#amvrs-modal')) {
							$assetItem = $(this).parents ('tr').find ('input#asset-item');
							$assetItem.prop ('checked', !$assetItem.prop ('checked'));
						}
						break;
					case 'movereq-tablelist': 
						$td = $(this);
						$clickedRow = $td.parents ('tr');
						if ($clickedRow.children ('td:eq(4)').is ($td)) {
							$input = $td.children ('input#itemmove-qty').prop ('type', 'number');
							$input.focus ();
							$span = $td.children ('span#qty-text').addClass ('d-none');
						}
						break;
					case 'dataTable-masterAssets':
						$requestExistDT = $.searchDataTable ('dataTable-masterRequest');
						$rowCount = $requestExistDT.rows ().count ();
						$td = $(this);
						$clickedRow = $td.parents ('tr');
						$code = $clickedRow.children (':eq(0)').text ();
						$name = $clickedRow.children (':eq(1)').text ();
						$doAdd = false;
						$rowFound = null;
						if ($rowCount == 0) $doAdd = true;
						else {
							$doAdd = true;
							$nodes = $requestExistDT.rows ().nodes ();
							$.each ($nodes, function ($index, $node) {
								$row = $($node);
								$rowCode = $row.children (':eq(0)').text ();
								if ($rowCode === $code) {
									$rowFound = $row;
									$doAdd = false;
									return false;
								}
							});
						}

						if ($doAdd) {
							$newRow = [
								$('<input/>', {'type': 'hidden', 'id': 'sample-code', 'name': 'sample-code-' + ($rowCount+1), 'value': $code}).prop ('outerHTML') + $code,
								$name,
								$('<input/>', {
									'type': 'hidden',
									'id': 'input-reqextqty',
									'name': 'input-reqextqty-' + ($rowCount+1),
									'value': 1
								}).prop ('outerHTML') + 
								$('<span/>', {
									'id': 'input-reqextqty-text',
									'text': 1
								}).prop ('outerHTML'),
								$('<button/>', {
									'id': 'cancel-asset',
									'class': 'btn btn-primary btn-block',
									'type': 'button',
									'html': $('<i/>', {'class': 'fas fa-times-circle fa-fw'}).prop ('outerHTML')
								}).prop ('outerHTML')
							];
							$requestExistDT.row.add ($newRow).draw (false);
						} else {
							$column = $rowFound.children (':eq(2)');
							$input = $column.children (':eq(0)');
							$text = $column.children (':eq(1)');
							$qty = $input.val ();
							$input.val (++$qty);
							$text.text ($input.val ());
						}
						break;
					case 'dataTable-masterRequest':
						$column = $(this);
						$row = $column.parents ('tr');
						if ($column.is ($row.children (':eq(2)'))) {
							$input = $column.children (':eq(0)');
							$text = $column.children (':eq(1)');
							$input.prop ('type', 'number');
							$input.focus ();
							$text.addClass ('d-none');
						}
						break;
					case 'dataTable-assetLists':
						$('select#user-location').prop ('disabled', true);
						
						$removalDT = $.searchDataTable ('dataTable-assetListDestroy');
						$clickedRow = $(this).parents ('tr');
						
						$doAdd = false; 
						$itemFound = null;
						$rowCount = $removalDT.rows ().count ();
						if ($rowCount == 0) $doAdd = true;
						else {
							$doAdd = true;
							$removalDT.$('tr').each (function () {
								$tr = $(this);
								$itemIdx = $clickedRow.find ('#asset-id').val ();
								$rowItemIdx = $tr.find ('#asset-id').val ();
								if ($itemIdx == $rowItemIdx) {
									$doAdd = false;
									$itemFound = $tr;
									return false;
								}
							});
						}

						if ($doAdd) {
							$newRow = [
								$('<input/>', {
									'type': 'hidden',
									'id': 'asset-id',
									'name': 'asset-id-' + $rowCount,
									'value': $clickedRow.find ('#asset-id').val ()
								}).prop ('outerHTML') + $clickedRow.children (':eq(0)').children (':eq(1)').prop ('outerHTML'),
								$clickedRow.children (':eq(1)').text (),
								$('<input/>', {
									'type': 'hidden',
									'id': 'subloc-id',
									'name': 'subloc-id-' + $rowCount,
									'value': $clickedRow.find ('#subloc-id').val ()
								}).prop ('outerHTML') + $clickedRow.children (':eq(2)').children (':eq(1)').prop ('outerHTML'),
								$('<input/>', {
									'type': 'hidden',
									'id': 'removal-qty',
									'name': 'removal-qty-' + $rowCount,
									'max': $clickedRow.children (':eq(3)').text (),
									'value': 1
								}).prop ('outerHTML') + 
								$('<span/>', {'id': 'removal-qty-text', 'text': 1}).prop ('outerHTML'),
								$('<button/>', {
									'type': 'button',
									'id': 'delete-row',
									'class': 'btn btn-danger btn-block',
									'html': $('<i/>', {'class': 'fas fa-times-circle fa-fw'}).prop ('outerHTML')
								}).prop ('outerHTML')
							];
							$removalDT.row.add ($newRow);
						} else {
							$removeQty	= $itemFound.find ('#removal-qty');
							$cval		= parseInt ($removeQty.val ());
							$removeQty.val ($cval + 1);
							$removeQty.trigger ('change');
						}
						$removalDT.draw (false);
						break;
					case 'dataTable-assetListDestroy':
						if ($(this).is ($(this).parents ('tr').children (':eq(3)'))) {
							$removeQty = $(this).find ('#removal-qty');
							$removeQty.prop ('type', 'number');
							$removeQty.next ().addClass ('d-none');
						}
						break;
					case 'dataTable-mutateSummaries':
						$row = $(this).parents ('tr');
						$docnum = $row.find ('td#docnum');
						$.ajax ({
							'url': '<?php echo base_url ($locale . '/api/get'); ?>',
							'method': 'put',
							'data': JSON.stringify ({'trigger': 'request-mutate', 'docnum': $docnum}),
							'dataType': 'json'
						}).done (function ($result) {
						}).fail (function () {
						});
						break;
				}
			}
		});

		$('body').on ('focusout', 'input', function ($evt) {
			$id = $(this).prop ('id');
			switch ($id) {
				default:
					break;
				case 'input-reqextqty':
				case 'itemmove-qty':
				case 'removal-qty':
					$val = $(this).val ();
					$(this).prop ('type', 'hidden');
					$text = $(this).next ();
					$text.text ($val);
					$text.removeClass ('d-none');
					break;
			}
		});

		$('body').on ('focusin', 'input', function ($evt) {
			$id = $(this).prop ('id');
			switch ($id) {
				default:
					break;
				case 'move-qty':
					$val = $(this).val ();
					if ($val.length == 0) $(this).val (1);
					$(this).parents ('tr').find ('input#asset-item').prop ('checked', true);
					break;
			}
		});

		$('body').on ('change', 'select, input', function ($evt) {
			if ($(this).is ('input')) {
				$id = $(this).prop ('id');
				switch ($id) {
					default:
						break;
					case 'images-input':
						$assetImages = $('div#asset-images');
						$assetImages.children ('div.carousel-inner').empty ();
						$(this).readPreviewImages ($assetImages.children ('div.carousel-inner'));
						$('div#asset-images-container').removeClass ('d-none');
						break;
					case 'move-qty':
						$max = parseInt ($(this).prop ('max'));
						$cvl = parseInt ($(this).val ());
						if ($cvl < 0) $(this).val (1);
						else if ($cvl > $max) $(this).val ($max);
						else $(this).val ($cvl);
						break;
					case 'itemmove-qty':
						$itemMove = $(this);
						$val = parseInt ($itemMove.val ());
						$max = parseInt ($itemMove.prop ('max'));
						if ($val > $max) {
							$val = $max;
							$itemMove.val ($max);
						} else if ($val < 1) $itemMove.parents ('tr').find ('button#cancel-item').trigger ('click');
						else $val = $val;
						$itemMove.next ().text ($val);
						$itemMove.prop ('type', 'hidden');
						$itemMove.next ().removeClass ('d-none');
						break;
					case 'removal-qty':
						$max	= parseInt ($(this).prop ('max'));
						$cval	= parseInt ($(this).val ());
						if ($cval > $max) $(this).val ($max);
						else $(this).val ($cval);
						$(this).next ().text ($(this).val ());
						break;
				}
			} else if ($(this).is ('select')) {
				$id = $(this).prop ('id');
				switch ($id) {
					default:
						break;
					case 'location-opt':
						$(this).prev ().val ($(this).val ());
						break;
					case 'opt-sublocation':
						$selected = $(this).find (':selected');
						$dataTarget = $selected.attr ('data-target');
						$('#amvrs-modal').find ('a.nav-link[href="' + $dataTarget + '"]').click ();
						break;
					case 'requestnew-type':
						$val = $(this).val ();
						$collapses = $('div#collapsed-contents').find ('div.collapse');
						$collapses.each (function () {
							if ($(this).hasClass ('show')) {
								$(this).removeClass ('show');
								$(this).slideUp ();
							}
						});
						$targetDiv = $('div.collapse#' + $val);
						$targetDiv.slideDown ();
						$targetDiv.addClass ('show');
						$.fn.dataTable.tables ({'visible': true, 'api': true}).columns.adjust ();
						break;
					case 'user-location':
						$assetListsDT = $.searchDataTable ('dataTable-assetLists');
						$assetListDDT = $.searchDataTable ('dataTable-assetListDestroy');
						$assetListsDT.clear ().draw (false);
						$assetListDDT.clear ().draw (false);
						$('input#target-location').val ($(this).val ());

						$options = {
							'trigger': 'asset-list',
							'type': 'pertable',
							'from': $(this).val ()
						};
						
						$.ajax ({
							'url': $.base_url ($locale + '/api/get'),
							'method': 'put',
							'data': JSON.stringify ($options),
							'dataType': 'json'
						}).done (function ($result) {
							if (!$result.good) ;
							else {
								$dataSublocs = $result.sublocs;
								$.each ($result.assetitems, function ($arrayId, $item) {
									$sublocid = $item.osbl_idx;
									$newRow = {
										0: $('<input/>', {
											'type': 'hidden',
											'id': 'asset-id',
											'name': 'asset-id-' + $arrayId,
											'value': $item.idx
											}).prop ('outerHTML') + 
											$('<span/>', {'text': $item.code}).prop ('outerHTML'),
										1: $item.name,
										2: $('<input/>', {
											'type': 'hidden',
											'id': 'subloc-id',
											'name': 'subloc-id-' + $arrayId,
											'value': $item.osbl_idx
											}).prop ('outerHTML'),
										3: $item.qty
									};
									$.each ($dataSublocs, function ($id, $subloc) {
										if (parseInt ($subloc.idx) == parseInt ($sublocid)) {
											$newRow[2] += $('<span/>', {'text': $subloc.name}).prop ('outerHTML');
											return false;
										}
									});
									$assetListsDT.row.add ($newRow);
								});
								$assetListsDT.draw (false);
							}
						}).fail (function () {
							
						});
						break;
				}
			}
		});

		$('div#amvrs-modal').on ('hidden.bs.modal', function ($evt) {
			$amvrsModal = $(this);
			$label = $amvrsModal.attr ('aria-labelledby');
			if ($label === 'moveout-request') {
				$amvrsModal.attr ('aria-labelledby', '');
				$('select#opt-sublocation').children ().not (':first').remove ();
				$('select#opt-sublocation').val (null);
				$('ul#subloc-tabs').empty ();
				$('#subloc-tabcontent').empty ();
				$('section#see-partial div.row div.col').empty ();
				$amvrsModal.find ('section').removeClass ('d-none');
			}
			$amvrsModal.find ('.modal-title').empty ();
		});
	});
	</script>
	
	<div id="amvrs-modal" class="modal fade" role="dialog" aria-labelledby="" aria-hidden="true" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog modal-xl modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"></h4>
				</div>
				
				<div class="modal-body">
					<section id="see-all">
						<div class="row">
							<div class="col">
								<select id="opt-sublocation" class="form-control">
									<option disabled="disabled" selected="selected"></option>
								</select>
							</div>
						</div>
						<div class="row" style="padding: 1em 0 0 0;">
							<div class="col">
								<ul class="nav nav-tabs d-none" id="subloc-tabs" data-toggle="tabs">
								</ul>
								<div class="tab-content" id="subloc-tabcontent">
								</div>
							</div>
						</div>
					</section>
					<section id="see-partial">
						<div class="row">
							<div class="col">
							</div>
						</div>
					</section>
				</div>
				
				<div class="modal-footer">
					<div class="text-right">
						<button type="button" id="add-asset-items" class="btn btn-primary">
							<i class="fas fa-plus-circle"></i> <span></span>
						</button>
						<button type="button" id="cancel-asset-items" class="btn btn-secondary" data-dismiss="modal">
							<i class="fas fa-times fa-fw"></i>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php include __DIR__ . '/../html-footer.php'; ?>