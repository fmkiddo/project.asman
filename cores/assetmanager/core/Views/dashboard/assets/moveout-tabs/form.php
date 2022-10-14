													
													<div class="row row-with-padding">
														<div class="col">
															<form id="form-assetmoveout" role="form">
																<input type="hidden" name="applicant-useridx" value="<?php echo $userid; ?>">
																<div class="row">
																	<div class="col-md-4">
																		<div class="form-group">
																			<label for="moveout-docnum"><span data-smarty="{9}"></span>:</label>
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
																			<label for="moveout-doctime"><span data-smarty="{15}"></span>:</label>
																			<div class="input-group">
																				<input type="text" class="form-control" value="<?php echo date ('d-M-Y');?>" readonly="readonly" />
																			</div>
																		</div>
																	</div>
																	
																	<div class="col-md-8">
																		<div class="form-group">
																			<label for="moveout-applicant"><span data-smarty="{14}"></span>:</label>
																			<div class="input-group">
																				<input type="text" class="form-control" name="moveout-applicant" value="<?php echo $username; ?>" readonly="readonly" required />
																			</div>
																		</div>
																		<div class="form-group">
																			<label for="moveout-fromlocation"><span data-smarty="{16}"></span>:</label>
																			<div class="input-group">
																				<input type="hidden" name="moveout-fromlocation-hidden" value="<?php echo $locationManager == 0 ? '' : $locationManager; ?>" />
																				<select name="moveout-fromlocation" class="form-control" <?php echo $locationManager > 0 ? 'disabled="disabled"' : ''; ?> required>
																					<option disabled="disabled" <?php echo ($locationManager == 0) ? 'selected="selected"' : ''; ?> data-smarty="{17}"></option>
<?php foreach ($dataLocation as $location): ?>
																					<option value="<?php echo $location->idx; ?>" <?php echo $location->idx == $locationManager ? 'selected="selected"' : ''; ?>><?php echo $location->code . ' - ' . $location->name; ?></option>
<?php endforeach; ?>																			
																				</select>
																			</div>
																		</div>
																		<div class="form-group">
																			<label for="moveout-tolocation"><span data-smarty="{18}"></span>:</label>
																			<div class="input-group">
																				<input type="hidden" name="moveout-tolocation-hidden" value="" />
																				<select name="moveout-tolocation" class="form-control" required>
																					<option disabled="disabled" selected="selected" data-smarty="{19}"></option>
<?php foreach ($dataLocation as $location): ?>
																					<option value="<?php echo $location->idx; ?>"><?php echo $location->code . ' - ' . $location->name; ?></option>
<?php endforeach; ?>
																				</select>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-12">
																		<label for="moveout-remarks"><span data-smarty="{20}"></span></label>
																		<div class="input-group">
																			<input type="text" class="form-control" name="moveout-remarks" />
																		</div>
																	</div>
																</div>
																
																<hr />
																<div class="row">
																	<div class="col text-right">
																		<button type="button" id="load-csv" class="btn btn-primary" data-smarty="{32}">
																			<i class="fas fa-file-csv fa-fw"></i> <span data-smarty="{31}"></span>
																		</button>
																		<button type="button" id="add-asset" class="btn btn-primary" data-smarty="{30}">
																			<i class="fas fa-plus-circle fa-fw"></i> <span data-smarty="{21}"></span>
																		</button>
																	</div>
																</div>
																<div class="row">
																	<div class="col">
																		<div class="form-group">
																			<div class="input-group">
																				<input type="text" class="form-control" id="assets" data-smarty="{22}"/>
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
																					<th data-smarty="<?php echo $th; ?>"></th>
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
																			<i class="fas fa-paper-plane fa-fw"></i> <span data-smarty="{28}"></span>
																		</button>
																		<button type="submit" id="submit-form" class="d-none"></button>
																		<button type="reset" class="btn btn-secondary">
																			<i class="fas fa-undo fa-fw"></i> <span data-smarty="{29}"></span>
																		</button>
																	</div>
																</div>
															</form>
														</div>
													</div>
