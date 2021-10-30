
												<div class="tab-pane fade" id="request-destroy">
													<div class="row row-with-padding">
														<div class="col-md-12">
															<h6></h6>
														</div>
													</div>
													
													<form role="form" id="form-destroyrequest" action="javascript:void(0)">
														<div class="row">
															<div class="col-md-12">
																<div class="form-group">
																	<label for="user-location">
																		<i class="fas fa-building fa-fw"></i>
																		<span data-smarty="{20}"></span>
																	</label>
																	<div class="input-group">
<?php 
if ($dataUserLocation > 0):
?>
																		<input type="text" name="user-location" class="form-control" id="user-locationid" 
																				data-identification="<?php echo $dataUserLocation; ?>" readonly="readonly" 
																				value="<?php echo $dataLocations[$dataUserLocation]; ?>" />
<?php 														
else: ?>
																		<select name="user-location" class="form-control" id="user-location">
																			<option disabled="disabled" selected="selected" data-smarty="{40}"></option>
<?php foreach ($dataLocations as $id => $name): ?>
																			<option value="<?php echo $id; ?>"><?php echo $name; ?></option>
<?php endforeach; ?>
																		</select>
<?php 
endif; 
?>
																	</div>
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-md-4">
																<div class="card card-plain border">
																	<div class="card-body">
																		<table id="dataTable-assetLists" class="dataTable table table-striped table-hover table-pointer">
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
																		<h6 class="text-muted" data-smarty=""></h6>
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
																	</div>
																</div>
															</div>
														</div>
													</form>
												</div>