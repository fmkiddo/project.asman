<?php include __DIR__ . '/../../header.php'; ?>

				<div class="row">
					<div class="col-md-12">
						<form id="formgroups" role="form" method="post">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title"></h4>
								</div>
								<hr />
								<div class="card-body">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="groupcode">Kode Grup:</label>
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="fas fa-barcode fa-fw"></i>
														</span>
													</div>
													<input type="text" class="form-control" name="groupcode" required />
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="groupname">Nama Grup:</label>
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="fas fa-edit fa-fw"></i>
														</span>
													</div>
													<input type="text" class="form-control" name="groupname" required />
												</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-4">
											<h6>Opsi Group</h6>
											<div class="form-group checkbox">
												<input type="checkbox" class="form-check-input" id="is-groupadmin" />
												<label class="form-check-label" for="is-groupadmin">Penanggung Jawab</label>
											</div>
											<div class="form-group checkbox">
												<input type="checkbox" class="form-check-input" id="is-dispatcher" />
												<label class="form-check-label" for="is-dispatcher">Pengiriman</label>
											</div>
										</div>
										<div class="col-md-8">
											<h6>Opsi Hak Akses</h6>
										</div>
									</div>
								</div>
								<hr />
								<div class="card-footer text-right">
									<button type="submit" class="btn btn-primary">
										<i class="fas fa-paper-plane fa-fw"></i> <span>Kirim</span>
									</button>
									<button type="reset" class="btn btn-secondary">
										<i class="fas fa-undo fa-fw"></i> <span>Reset</span>
									</button>
									<button type="button" class="btn btn-outline-danger" aria-event="cancel">
										<i class="fas fa-ban fa-fw"></i> <span>Batal</span>
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>

<?php include __DIR__ . '/../../footer.php'; ?>

<?php include __DIR__ . '/../../html-footer.php'; ?>