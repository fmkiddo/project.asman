<?php include ('html_header.php'); ?>

<div class="container">
	<div class="container-fluid page-body-wrapper">
		<div class="row">
			<div class="col-xl-8 col-lg-10 col-md-10 col-sm-12 col-xs-12">
				<div class="card shadow">
					<div class="card-body">
						<h5 class="card-title text-muted">asdasd</h5>
						<ul class="nav nav-tabs nav-justified">
							<li class="nav-item"><a class="nav-link active" data-toggle="tab"
								href="#form"><?php echo isset ($text) ? $text : 'Tambah Baru'; ?></a>
							</li>
							<li class="nav-item"><a class="nav-link" data-toggle="tab"
								href="#list-client"><?php echo isset ($text) ? $text : 'Table'; ?></a>
							</li>
						</ul>
						<div class="tab-content form">
							<div class="tab-pane container active" id="form">
								<form role="form" id="form-client" method="post" action="">
									<div class="form-group">
										<label for="input-new-clientname"><?php echo isset ($text) ? $text : 'Client Name'; ?>:</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text"> <i class="fas fa-user fa-fw"></i>
												</span>
											</div>
											<input type="text" name="input-new-clientname"
												class="form-control"
												placeholder="<?php echo isset ($text) ? $text : 'e.g. Maju Sejahtera'; ?>"
												required="required" />
										</div>
									</div>

									<div class="form-group">
										<label for="input-new-clientid"><?php echo isset ($text) ? $text : 'Client ID'?>:</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text"> <i
													class="fas fa-barcode fa-fw"></i>
												</span>
											</div>
											<input type="text" name="input-new-clientid"
												class="form-control" required="required" readonly="readonly" />
											<div class="input-group-append">
												<button type="button" class="btn btn-outline-primary"
													data-name="button-generate-clientid"
													title="<?php echo isset ($text) ? $text : ''; ?>">
													<i class="fas fa-plus-circle fa-fw"></i>
												</button>
												<button type="button" class="btn btn-outline-secondary"
													data-name="button-clear"
													title="<?php echo isset ($text) ? $text : ''; ?>">
													<i class="fas fa-undo fa-fw"></i>
												</button>
											</div>
										</div>
									</div>

									<div class="form-group">
										<label for="input-new-clientkey"><?php echo isset ($text) ? $text : 'Client Key'; ?>:</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text"> <i class="fas fa-key fa-fw"></i>
												</span>
											</div>
											<input type="text" class="form-control"
												name="input-new-clientkey" required="required"
												readonly="readonly" />
											<div class="input-group-append">
												<button type="button" class="btn btn-outline-primary"
													data-name="button-generate-clientkey"
													title="<?php echo isset ($text) ? $text : ''; ?>">
													<i class="fas fa-plus-circle fa-fw"></i>
												</button>
												<button type="button" class="btn btn-outline-secondary"
													data-name="button-clear"
													title="<?php echo isset ($text) ? $text : ''; ?>">
													<i class="fas fa-undo fa-fw"></i>
												</button>
											</div>
										</div>
									</div>

									<div class="row button-section">
										<div class="col">
											<button type="submit" class="btn btn-primary btn-block">
												<i class="fas fa-check fa-fw"></i>
											</button>
										</div>

										<div class="col">
											<button type="reset"
												class="btn btn-outline-secondary btn-block">
												<i class="fas fa-undo fa-fw"></i>
											</button>
										</div>
									</div>
								</form>
							</div>

							<div class="tab-pane container fade" id="list-client"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include ('footer.php'); ?>
