
												<div class="tab-pane fade" id="request-new">
													<div class="row row-with-padding">
														<div class="col">
															<div class="form-group">
																<div class="input-group">
																	<select id="requestnew-type" class="form-control">
																		<option disabled="disabled" selected="selected" data-smarty="{15}"></option>
																		<option value="request-new" data-smarty="{16}"></option>
																		<option value="request-existing" data-smarty="{17}"></option>
																	</select>
																</div>
															</div>
														</div>
													</div>
													<hr />
													<div id="collapsed-contents">
														<div class="collapse" id="request-new">
															<div class="row">
																<div class="col-md-12">
																	<h6 data-smarty="{18}"></h6>
																</div>
															</div>
															<hr />
															<form role="form" id="form-requestnew" enctype="multipart/form-data" action="javascript:void(0)">
																<input type="hidden" name="trigger" value="requisition-newasset" />
																<input type="hidden" name="requisition-type" value="request-newasset" />
<?php if ($dataUserLocation == 0): ?>
																<div class="form-group">
																	<label for="requisition-location" data-smarty="{20}"></label>
																	<div class="input-group">
																		<select name="requisition-location" class="form-control" required>
																			<option disabled="disabled" selected="selected" data-smarty="{20}"></option>
<?php foreach ($dataLocations as $idx => $name): ?>
																			<option value="<?php echo $idx; ?>"><?php echo $name; ?></option>
<?php endforeach; ?>
																		</select>
																	</div>
																</div>
<?php else: ?>
																<input type="hidden" name="requisition-location" value="<?php echo $dataUserLocation; ?>" />
<?php endif; ?>
																<div class="row">
																	<div class="col-md-8">
																		<div class="card shadow-none border">
																			<div class="card-body">
																				<div class="form-group">
																					<label for="new-name" data-smarty="{21}"></label>
																					<div class="input-group">
																						<input type="text" class="form-control" name="new-name" data-smarty="{22}" placeholder="" required />
																					</div>
																				</div>
																				<div class="form-group">
																					<label for="new-description" data-smarty="{23}"></label>
																					<div class="input-group">
																						<textarea rows="2" class="form-control" name="new-description" data-smarty="{24}" placeholder="" required></textarea>
																					</div>
																				</div>
																				<div class="from-group">
																					<label for="new-requestqty" data-smarty="{25}"></label>
																					<div class="input-group">
																						<input type="number" class="form-control" name="new-requestqty" data-smarty="{26}" placeholder="" required />
																					</div>
																				</div>
																				<div class="form-group">
																					<label for="new-valueestimation" data-smarty="{27}"></label>
																					<div class="input-group">
																						<input type="number" class="form-control" name="new-valueestimation" data-smarty="{28}" placeholder="" value="0" />
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																	
																	<div class="col-md-4">
																		<div class="card text-white shadow-none border" style="background-color: lightgrey;">
																			<div class="card-header">
																				<div class="d-none">
																					<input type="file" id="images-input" name="newphotos[]" accept="image/jpeg, image/png, image/gif, image/tiff" multiple />
																				</div>
																				<button type="button" id="addimages-requestnew" class="btn btn-block btn-primary" data-smarty="{29}">
																					<i class="fas fa-upload fa-fw"></i> <span data-smarty="{29}"></span>
																				</button>
																				<button type="button" id="clear-images" class="btn btn-dark btn-block" data-smarty="{30}">
																					<i class="fas fa-undo fa-fw"></i> <span data-smarty="{30}"></span>
																				</button>
																			</div>
																			<hr />
																			<div class="card-body">
																				<div class="row">
																					<div class="col d-none" id="asset-images-container">
																						<div id="asset-images" class="carousel slide carousel-fade carousel-fill bg-secondary" data-ride="carousel" data-interval="false" data-ride="carousel" data-wrap="false">
																							<div class="carousel-inner">
																							</div>
																							<a class="carousel-control-prev" href="#asset-images" role="button" data-slide="prev">
																								<span class="carousel-control-prev-icon" aria-hidden="true"></span>
																								<span class="sr-only" data-smarty=""></span>
																							</a>
																							<a class="carousel-control-next" href="#asset-images" role="button" data-slide="next">
																								<span class="carousel-control-next-icon" aria-hidden="true"></span>
																								<span class="sr-only" data-smarty=""></span>
																							</a>
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="text-right">
																	<button type="button" id="save-requestnew" class="btn btn-primary" data-smarty="{31}">
																		<i class="fas fa-save fa-fw"></i> <span data-smarty="{31}"></span>
																	</button>
																	<button type="reset" id="reset-requestnew" class="btn btn-secondary" data-smarty="{32}">
																		<i class="fas fa-undo fa-fw"></i> <span data-smarty="{32}"></span>
																	</button>
																</div>
															</form>
														</div>
														
														<div class="collapse" id="request-existing">
															<div class="row">
																<div class="col-md-12">
																	<h6 data-smarty="{19}"></h6>
																</div>
															</div>
															<form role="form" id="form-requestexisting">
																<input type="hidden" name="requisition-type" value="request-existingasset" />
<?php if ($dataUserLocation  == 0): ?>
																<div class="form-group">
																	<label for="requisition-location" data-smarty="{20}"></label>
																	<div class="input-group">
																		<select name="requisition-location" class="form-control">
																			<option disabled="disabled" selected="selected" data-smarty="{20}"></option>
<?php foreach ($dataLocations as $idx => $name): ?>
																			<option value="<?php echo $idx; ?>"><?php echo $name; ?></option>
<?php endforeach; ?>
																		</select>
																	</div>
																</div>
<?php else: ?>
																<input type="hidden" name="requisition-location" value="<?php echo $dataUserLocation; ?>" />
<?php endif; ?>
																<div class="row">
																	<div class="col-md-4">
																		<div class="card shadow-none border">
																			<div class="card-body">
																				<div class="form-group">
																					<div class="input-group">
																						<input type="text" id="search-asset-filter" class="form-control" data-smarty="{33}" />
																						<div class="input-group-append">
																							<span class="input-group-text" data-click="do-searchasset">
																								<i class="fas fa-search fa-fw"></i>
																							</span>
																						</div>
																					</div>
																				</div>
																				<div id="asset-data" class="scroller">
																					<table id="dataTable-masterAssets" class="table table-striped table-bordered table-hover table-pointer">
																						<thead>
																							<tr>
																								<th data-smarty="{34}"></th>
																								<th data-smarty="{35}"></th>
																							</tr>
																						</thead>
																						
																						<tbody>
<?php $line = 1;
foreach ($dataAssets as $code => $name): ?>
																							<tr>
																								<td><?php echo $code; ?></td>
																								<td><?php echo $name; ?></td>
																							</tr>
<?php $line++;
endforeach; ?>
																						</tbody>
																					</table>
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="col-md-8">
																		<div class="card shadow-none border">
																			<div class="card-body">
																				<div class="row">
																					<div class="col-md-6">
																						<div class="form-group">
																							<label for="requestexisting-applicant" data-smarty="{13}"></label>
																							<div class="input-group">
																								<input type="text" name="requestexisting-applicant" class="form-control" value="<?php echo $dataUsername; ?>" readonly="readonly" />
																							</div>
																						</div>
																					</div>
																					
																					<div class="col-md-6">
																						<div class="form-group">
																							<label for="requestexisting-date" data-smarty="{11}"></label>
																							<div class="input-group">
																								<input type="text" name="requestexisting-date" class="form-control" value="<?php echo date ('d-M-Y H:i:s'); ?>" readonly="readonly" />
																							</div>
																						</div>
																					</div>
																				</div>
																				<div class="row">
																					<div class="col-md-12">
																						<table id="dataTable-masterRequest" class="dataTable table table-striped table-hover table-pointer">
																							<thead>
																								<tr>
																									<th data-smarty="{34}"></th>
																									<th data-smarty="{35}"></th>
																									<th data-smarty="{25}"></th>
																									<th><i class="fas fa-times fa-fw"></i></th>
																								</tr>
																							</thead>
																							
																							<tbody>
																							</tbody>
																						</table>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="text-right">
																	<button type="button" id="save-requestexisting" class="btn btn-primary" data-smarty="{31}">
																		<i class="fas fa-save fa-fw"></i> <span data-smarty="{31}"></span>
																	</button>
																	<button type="reset" id="reset-requestexisting" class="btn btn-secondary" data-smarty="{32}">
																		<i class="fas fa-undo fa-fw"></i> <span data-smarty="{32}"></span>
																	</button>
																</div>
															</form>
														</div>
													</div>
												</div>