										<div class="tab-pane fade" id="removal-form">
											<div class="row row-with-padding">
												<div class="col">
													<h6 data-smarty="{14}"></h6>
												</div>
											</div>
											<div class="row">
												<div class="col">
													<div id="asset-removal">
<?php if (count ($removalDocs) == 0): ?>
														<div class="card card-plain border bg-gray text-dark">
															<div class="card-body">
																<b><span data-smarty="{15}"></span></b>
															</div>
														</div>
<?php else: ?>
														<div class="accordion border" id="document-list-accordion">
<?php foreach ($removalDocs as $key => $document): ?>
															<div class="documents">
																<div class="document-header" data-toggle="collapse" data-target="#document-id-<?php echo $key; ?>" aria-expanded="false">
																	<span class="document-title"><?php echo $document['docnum']; ?></span>
																</div>
																<div id="document-id-<?php echo $key; ?>" class="document-body collapse" data-parent="#document-list-accordion">
																	<form method="post" action="<?php echo base_url ($locale . '/api/process'); ?>" enctype="application/x-www-form-urlencoded">
																		<input type="hidden" name="trigger" value="removal-action" /> 
																		<input type="hidden" name="doc-id" value="<?php echo $document['docidx']; ?>" />
																		<div class="row">
																			<div class="col-md-6">
																				<div class="form-group">
																					<label>
																						<span data-smarty="{17}"></span>:
																					</label>
																					<div class="input-group">
																						<input type="text" class="form-control" value="<?php echo $document['docnum']; ?>" readonly />
																					</div>
																				</div>
																				<div class="form-group">
																					<label>
																						<span data-smarty="{19}"></span>:
																					</label>
																					<div class="input-group">
																						<input type="text" class="form-control" value="<?php echo ($document['surname'] === '') ? $document['username'] : $document['surname']; ?>" readonly />
																					</div>
																				</div>
																				<div class="form-group">
																					<label>
																						<span data-smarty="{11}"></span>:
																					</label>
																					<div class="input-group">
																						<input type="text" class="form-control" value="<?php echo $document['approved_by']; ?>" readonly />
																					</div>
																				</div>
																			</div>
																			<div class="col-md-6">
																				<div class="form-group">
																					<label>
																						<span data-smarty="{18}">:</span>
																					</label>
																					<div class="input-group">
																						<input type="text" class="form-control" value="<?php echo $document['docdate']; ?>" readonly />
																					</div>
																				</div>
																				<div class="form-group">
																					<label
																						<span data-smarty="{20}"></span>:
																					</label>
																					<div class="input-group">
																						<input type="text" class="form-control" value="<?php echo $docstat->getStatusText ($document['status']); ?>" readonly />
																					</div>
																				</div>
																				<div class="form-group">
																					<label>
																						<span data-smarty="{12}"></span>:
																					</label>
																					<div class="input-group">
																						<input type="text" class="form-control" value="<?php echo $document['approval_date']; ?>" readonly />
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-md-12">
																				<div class="form-group">
																					<label>
																						<span data-smarty="{10}"></span>:
																					</label>
																					<div class="input-group">
																						<input type="text" class="form-control" value="<?php echo $document['location']; ?>" readonly />
																					</div>
																				</div>
																			</div>
																		</div>
																		<hr />
																		<div class="row">
																			<div class="col-md-12">
																				<table class="table table-hover table-striped table-bordered table-pointer table-centered-content">
																					<thead>
																						<tr>
																							<th>#</th>
																							<th data-smarty="{28}"></th>
																							<th data-smarty="{29}"></th>
																							<th data-smarty="{30}"></th>
																							<th data-smarty="{31}"></th>
																							<th data-smarty="{26}"></th>
																						</tr>
																					</thead>
																					<tbody>
<?php foreach ($document['details'] as $line => $detail): ?>
																						<tr>
<input type="hidden" name="detail-line-<?php echo $line; ?>" value="<?php echo $detail['arv1_idx']; ?>" />
																							<td><?php echo ($line+1); ?></td>
<?php foreach ($detail as $name => $value): 
	switch ($name) {
		default: ?>
																							<td><?php echo $value; ?></td>
<?php			break;
		case 'arv1_idx':
			break;
		case 'sublocation': ?>
																							<td><?php echo $value; ?></td>
																							<td><input name="remove-method-<?php echo $key; ?>" required /></td>
<?php			break;
		case 'remove_qty': ?>
																							<td><?php echo $value; ?><input type="hidden" name="remove-qty-<?php echo $line; ?>" value="<?php echo $value; ?>" /></td>
<?php			break;
	}
endforeach; ?>
																						</tr>
<?php endforeach; ?>
																					</tbody>
																							
																				</table>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-md-12 text-right">
																				<button type="submit" class="btn btn-primary">
																					<i class="fas fa-save fa-fw"></i> <span data-smarty="{32}"></span>
																				</button>
																			</div>
																		</div>
																	</form>
																</div>
															</div>
<?php endforeach ?>
														</div>
<?php endif; ?>
													</div>
												</div>
											</div>
										</div>
