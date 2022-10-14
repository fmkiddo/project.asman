<?php include __DIR__ . '/../header.php'; 
$locations	= $pagedata['datalist-locations']; ?>

				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<div class="d-flex align-items-center justify-content-between">
									<h5 class="card-title" data-smarty="{15}"></h5>
									<button type="button" class="btn btn-primary" onclick="window.location.href='asset-service?service-form=0'" data-smarty="{27}">
										<i class="fas fa-arrow-left fa-fw"></i> <span data-smarty="{26}"></span>
									</button>
								</div>
							</div>
							<div class="card-body">
								<form method="post" action="<?php echo base_url ($locale . '/dashboard/asset-service?service-form=true&form-submitted=true'); ?>" enctype="application/x-www-form-urlencoded">
									<div class="row">
										<div class="col">
											<div class="form-group">
												<label for="maintenance-doccode"><span data-smarty="{16}"></span> :</label>
												<div class="input-group">
													<input type="text" class="form-control" name="maintenance-doccode" id="doccode" readonly="readonly" />
												</div>
											</div>
											<div class="form-group">
												<label for="maintenance-location" data-smarty="{17}"></label>
												<div class="input-group">
													<select name="maintenance-location" class="form-control" id="location" required>
														<option disabled="disabled" selected data-smarty="{18}"></option>
<?php 
if (count ($locations) == 1):
else:
foreach ($locations as $location): ?>
														<option value="<?php echo $location['code'] . ' - ' . $location['name'] ?>" data-locid="<?php echo $location['id']; ?>"><?php echo $location['code'] . ' - ' . $location['name']; ?></option>
<?php 
endforeach; 
endif; ?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label for="maintenance-sublocation" data-smarty="{19}"></label>
												<div class="input-group">
													<select name="maintenance-sublocation" class="form-control selectpicker" data-live-search="true" data-style="btn-secondary" data-none-selected-text="<?php echo $pagedata['noneselected'][$locale]; ?>" id="sublocation" required>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label for="maintenance-item" data-smarty="{20}"></label>
												<div class="input-group">
													<select name="maintenance-item" class="form-control selectpicker" data-live-search="true" data-style="btn-secondary" data-none-selected-text="<?php echo $pagedata['noneselected'][$locale]; ?>" id="asset-lists" required>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label data-smarty="{21}"></label>
												<div class="input-group">
													<div class="form-check form-check-radio form-check-inline">
														<label class="form-check-label">
															<span data-smarty="{22}"></span>
															<input class="form-check-input" type="radio" name="maintenance-type" id="ondemand" value="ondemand" required />
															<span class="form-check-sign"></span>
														</label>
													</div>
													<div class="form-check form-check-radio form-check-inline">
														<label class="form-check-label">
															<span data-smarty="{23}"></span>
															<input class="form-check-input" type="radio" name="maintenance-type" id="routine" value="routine" required />
															<span class="form-check-sign"></span>
														</label>
													</div>
												</div>
											</div>
											<div id="accordion" role="tablist" aria-multiselectable="true" class="card-collapse">
												<div class="card card-plain">
													<div id="" class="collapse show" role="tabpanel" aria-labelledby="">
														<div class="card-body">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col text-right">
											<button class="btn btn-primary" type="submit" data-smarty="{29}">
												<i class="fas fa-save fa-fw"></i> <span data-smarty="{28}"></span>
											</button>
											<button class="btn btn-secondary" type="reset" data-smarty="{31}">
												<i class="fas fa-undo fa-fw"></i> <span data-smarty="{30}"></span>
											</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>

<?php include __DIR__ . '/../footer.php'; ?>

<?php include 'form-scripts.php'; ?>

<?php include __DIR__ . '/../html-footer.php'; ?>
