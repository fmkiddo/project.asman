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
						$moveInDocnum	= $('input[name="movein-docnum"]').val ();
						$assetMoveDT = $('table#table-moveDetails[data-document="' + $moveInDocnum + '"]');
						$assetDistDT = $.searchDataTable ('dataTable-assetDistribution');
						$rowCount = $assetDistDT.rows ().count ();
						console.log ($assetMoveDT);
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
						$moveInDocnum	= $('input[name="movein-docnum"]').val ();
						$('div.document-header[data-document="' + $moveInDocnum + '"]').trigger ('click');
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
				} else {
					$assetDistForm.trigger ('reset');
					$assetDistDT = $.searchDataTable ('dataTable-assetDistribution');
					$assetDistDT.clear ().draw ();
				}
			}
		});
		
		$('body').on ('hide.bs.collapse', function ($event) {
			$($event.target).prev ().removeClass ('clicked');
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
								$amvisModal		= $('div#amvis-modal');
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
													if ($document === null) $value = $result.statusText['nr'][$locale];
													else $value = $document;
													break;
												case 'distributed_by':
													$value = $result.dataTransmit['data-userdistribute'];
													break;
												case 'distributed_date':
													if ($document === null) $value = $result.statusText['nd'][$locale];
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
																	'text': $result.titles['doctitle'][$locale]
																}).prop ('outerHTML')
													}).appendTo ('div#document');
													break;
												case 'ref_docnum':
													$('<div/>', {
														'class': 'col-md-12',
														'html': $('<h6/>', {
																	'html': $result.titles['refdoctitle'][$locale] + ' - status: ' + 
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
																		'text': $result.labels[$key][$locale]
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
												case 'distributed_date':
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
								$('<h6/>', {'text': $result.titles['refdocdetail'][$locale]}).appendTo ('#details .col-md-12');
								$('<table/>', {
									'id': 'dataTable-moveinDetails',
									'class': 'dataTable table table-striped table-hover table-pointer',
									'html': $('<thead/>').prop ('outerHTML') + $('<tbody/>').prop ('outerHTML')
								}).appendTo ('div#details .col-md-12');
								$('<tr/>').appendTo ('table#dataTable-moveinDetails thead');
								$.each ($result.dataTransmit['data-moveinheads'][$locale], function ($key, $text) {
									$('<th/>', {'html': $text}).appendTo ('table#dataTable-moveinDetails thead tr');
								});

								$lineIdx = 1;
								$.each ($result.dataTransmit['data-moveindetail'], function ($idx, $line) {
									$dataRow = $('<tr/>');
									$.each ($line, function ($key, $value) {
										$text = '';
										switch ($key) {
											default:
												$text = $value;
												break;
											case 'oita_idx':
												$text = $lineIdx;
												break;
											case 'sublocation_src':
												if ($result.isDistributed) $text = $value;
												else $text = $value;
												break;
											case 'sublocation_dest':
												if (!$result.isDistributed) $text = ($value === "NULL") ? $result.statusText['nd'][$locale] : $value;
												else $text = $value;
												break;
										}
										$('<td/>', {
											'html': $text
										}).appendTo ($dataRow);
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
