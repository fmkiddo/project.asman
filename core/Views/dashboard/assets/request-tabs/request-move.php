
												<div class="tab-pane fade" id="request-move">
													<div class="row row-with-padding">
														<div class="col">
															<form role="form" id="request-displacement-asset" action="javascript:void(0)">
																<div class="row">
																	<div class="col-md-4">
																		<div class="form-group">
																			<label for="docnum" data-smarty="{10}"></label>
																			<div class="input-group">
																				<input type="text" name="docnum" class="form-control" />
																				<div class="input-group-append">
																					<span class="input-group-text" data-click="do-searchdocument">
																						<i class="fas fa-search fa-fw"></i>
																					</span>
																				</div>
																			</div>
																		</div>
																		<div class="form-group">
																			<label for="docdate" data-smarty="{11}"></label>
																			<div class="input-group">
																				<input type="text" name="docdate" class="form-control" value="<?php echo date ('d-M-Y')?>" readonly="readonly" />
																			</div>
																		</div>
																	</div>
																	
																	<div class="col-md-8">
																		<div class="form-group">
																			<label for="request-applicant" data-smarty="{13}"></label>
																			<div class="input-group">
																				<input type="text" name="request-applicant" class="form-control" value="<?php echo $dataUsername; ?>" readonly="readonly" />
																			</div>
																		</div>
																		<div class="form-group">
																			<label for="moveout-fromlocation" data-smarty="{36}"></label>
																			<div class="input-group">
																				<input type="hidden" name="moveout-fromlocation-hidden" id="moveout-locations" value="" />
																				<select name="moveout-fromlocation" class="form-control" id="location-opt">
																					<option disabled="disabled" selected="selected">--- Pilih Lokasi Asal ---</option>
<?php foreach ($dataLocations as $key => $name): ?>
																					<option value="<?php echo $key; ?>"><?php echo $name; ?></option>
<?php endforeach; ?>
																				</select>
																			</div>
																		</div>
																		<div class="form-group">
																			<label for="moveout-tolocation" data-smarty="{37}"></label>
																			<div class="input-group">
																				<input type="hidden" name="moveout-tolocation-hidden" id="moveout-locations" value="<?php echo $dataUserLocation; ?>" />
																				<select name="moveout-tolocation" class="form-control" id="location-opt" <?php echo $dataUserLocation > 0 ? 'disabled="disabled"' : ''; ?>>
																					<option disabled="disabled" <?php echo $dataUserLocation > 0 ? '' : 'selected="selected"'; ?>>--- Pilih Lokasi Tujuan ---</option>
<?php foreach ($dataLocations as $key => $name): ?>
																					<option value="<?php echo $key; ?>" <?php echo $key == $dataUserLocation ? 'selected="selected"' : ''; ?>><?php echo $name; ?></option>
<?php endforeach; ?>
																				</select>
																			</div>
																		</div>
																	</div>
																</div>
																
																<hr />
																<div class="row">
																	<div class="col text-right">
																		<button type="button" id="add-asset" class="btn btn-primary" data-smarty="{38}">
																			<i class="fas fa-plus-circle fa-fw"></i> <span data-smarty="{38}"></span>
																		</button>
																	</div>
																</div>
																<div class="row">
																	<div class="col">
																		<div class="form-group">
																			<div class="input-group">
																				<input type="text" class="form-control" id="search-assets" data-smarty="{33}" placeholder="" />
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
																		<table id="movereq-tablelist" class="dataTable table table-striped table-hover table-pointer" data-paging="false" data-searching="false">
																			<thead>
																				<tr>
																					<th>#</th>
																					<th data-smarty="{34}"></th>
																					<th data-smarty="{35}"></th>
																					<th data-smarty="{39}"></th>
																					<th data-smarty="{25}"></th>
																					<th><i class="fas fa-times-circle fa-fw"></i></th>
																				</tr>
																			</thead>
																			
																			<tbody>
																			</tbody>
																		</table>
																	</div>
																</div>
																
																<div class="row">
																	<div class="col text-right">
																		<button type="button" id="submit-request" class="btn btn-primary">
																			<i class="fas fa-paper-plane fa-fw"></i> <span></span>
																		</button>
																		<button type="reset" id="reset-request" class="btn btn-secondary">
																			<i class="fas fa-undo fa-fw"></i> <span></span>
																		</button>
																	</div>
																</div>
															</form>
														</div>
													</div>
												</div>