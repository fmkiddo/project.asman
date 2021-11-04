<?php include __DIR__ . '/../header.php'; ?>
				<div class="row">
					<div class="col">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title" data-smarty="{0}"></h4>
							</div>
							<div class="card-body">
								<form role="form" id="form-profile" action="javascript:void(0)">
									<div class="row">
										<div class="col-md-4">
											<div class="card card-plain border">
												<div class="card-body">
													<div class="profile-photos">
													</div>
													<div class="d-flex">
														<button type="button" class="btn btn-primary btn-block" id="upload-image" data-smarty="">
															<i class="fas fa-upload fa-fw"></i> <span data-smarty=""></span>
														</button>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-8">
											<div class="card card-plain border">
												<div class="card-body">
													<div class="row">
														<div class="col-md-4">
															<div class="form-group">
																<label for="first-name" data-smarty="{1}"></label>
																<div class="input-group">
																	<input type="text" class="form-control" name="first-name" required />
																</div>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="middle-name" data-smarty="{2}"></label>
																<div class="input-group">
																	<input type="text" class="form-control" name="middle-name" />
																</div>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="last-name" data-smarty="{3}"></label>
																<div class="input-group">
																	<input type="text" class="form-control" name="last-name-name" />
																</div>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label for="phone" data-smarty="{4}"></label>
																<div class="input-group">
																	<input type="text" name="phone" class="form-control" />
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label for="email" data-smarty="{5}"></label>
																<div class="input-group">
																	<input type="email" name="email" class="form-control" value="" readonly="readonly" />
																</div>
															</div>
														</div>
													</div>
													<div class="form-group">
														<label for="address-a" data-smarty="{6}"></label>
														<div class="input-group">
															<textarea rows="2" name="address-a" class="form-control"></textarea>
														</div>
													</div>
													<div class="form-group">
														<label for="address-b" data-smarty="{7}"></label>
														<div class="input-group">
															<textarea rows="2" name="address-b" class="form-control"></textarea>
														</div>
													</div>
													<hr class="mx-0" />
													<div class="d-flex justify-content-end">
														<button type="submit" class="btn btn-primary" id="submit-profile" data-smarty="{9}">
															<i class="fas fa-save fa-fw"></i> <span data-smarty="{8}"></span>
														</button>
														<button type="reset" class="btn btn-secondary" id="reset-form" data-smarty="{11}">
															<i class="fas fa-save fa-fw"></i> <span data-smarty="{10}"></span>
														</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				
<?php include __DIR__ . '/../footer.php'; ?>

<?php include __DIR__ . '/../html-footer.php'; ?>