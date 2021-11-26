
												<div class="tab-pane fade" id="request-destroy">
													<input type="hidden" id="data-filter" value="<?php echo $dataUserLocation; ?>" />
													<div class="row row-with-padding">
														<div class="col-md-12">
															<h6></h6>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<div class="form-group">
																<label for="user-location">
																	<i class="fas fa-building fa-fw"></i>
																	<span data-smarty="{20}"></span>
																</label>
																<div class="input-group">
																	<select name="user-location" class="form-control" id="user-location">
																		<option disabled="disabled" selected="selected" data-smarty="{40}"></option>
<?php foreach ($dataLocations as $id => $name): ?>
																		<option value="<?php echo $id; ?>"><?php echo $name; ?></option>
<?php endforeach; ?>
																	</select>
																</div>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-4">
															<div class="card card-plain border">
																<div class="card-body">
																	<table id="dataTable-assetLists" class="dataTable table table-striped table-hover table-pointer" data-page-length="10">
																		<thead>
																			<tr>
																				<th data-smarty="{34}"></th>
																				<th data-smarty="{35}"></th>
																				<th data-smarty="{41}"></th>
																				<th data-smarty="{25}"></th>
																			</tr>
																		</thead>
																		<tbody>
																		</tbody>
																	</table>
																</div>
															</div>
														</div>
														
														<div class="col-md-8">
															<div class="card card-plain border">
																<div class="card-body">
																	<div class="row">
																		<div class="col-md-6">
																			<div class="form-group">
																				<label for="destroy-docdate" data-smarty="{10}"></label>
																				<div class="input-group">
																					<input type="text" class="form-control" name="destroy-docdate" value="<?php echo date ('d-M-Y'); ?>"  readonly="readonly" />
																				</div>
																			</div>
																		</div>
																		<div class="col-md-6">
																			<div class="form-group">
																				<label for="destroy-applicant" data-smarty="{13}"></label>
																				<div class="input-group">
																					<input type="text" class="form-control" name="destroy-applicant" value="<?php echo $dataUsername; ?>" readonly="readonly" />
																				</div>
																			</div>
																		</div>
																	</div>
																	<h6 class="text-muted" data-smarty="{42}"></h6>
												
																	<form role="form" id="form-destroyrequest" action="javascript:void(0)">
																		<input type="hidden" id="target-location" name="target-location" value="<?php echo $dataUserLocation == 0 ? '' : $dataUserLocation; ?>" />
																		<table id="dataTable-assetListDestroy" class="dataTable table table-striped table-hover table-pointer" data-searching="false" data-paging="false">
																			<thead>
																				<tr>
																					<th data-smarty="{34}"></th>
																					<th data-smarty="{35}"></th>
																					<th data-smarty="{41}"></th>
																					<th data-smarty="{25}"></th>
																					<th><i class="fas fa-times-circle fa-fw"></i></th>
																				</tr>
																			</thead>
																			<tbody>
																			</tbody>
																		</table>
																		<div class="text-right">
																			<button type="submit" class="btn btn-primary" id="destroy-submit" data-smarty="{43}">
																				<i class="fas fa-paper-plane fa-fw"></i>
																				<span data-smarty="{44}"></span>
																			</button>
																			<button type="button" class="btn btn-secondary" id="reset-destroy" data-smarty="{45}">
																				<i class="fas fa-undo fa-fw"></i>
																				<span data-smarty="{32}"></span>
																			</button>
																		</div>
																	</form>
																</div>
															</div>
														</div>
													</div>
												</div>