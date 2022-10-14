
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
															<i class="fas fa-save fa-fw"></i> <span></span>
														</button>
														<button type="button" class="btn btn-secondary" id="reset-distribution">
															<i class="fas fa-undo fa-fw"></i> <span></span>
														</button>
													</div>
												</div>
