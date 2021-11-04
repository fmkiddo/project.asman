<?php include __DIR__ . '/../header.php'; ?>
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title" data-smarty="{0}"></h4>
							</div>
							
							<div class="card-body">
								<div class="card-nav-tabs card-plain">
									<div class="nav-tabs-navigation">
										<div class="nav-tabs-wrapper">
											<ul class="nav nav-tabs nav-fill" data-toggle="tabs">
												<li class="nav-item">
													<a class="nav-link active" data-target="#summaries" data-toggle="tab">
														<i class="fas fa-database fa-fw"></i>
														<span data-smarty="{1}"></span>
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" data-target="#removal-form" data-toggle="tab">
														<i class="fas fa-edit fa-fw"></i>
														<span data-smarty="{2}"></span>
													</a>
												</li>
											</ul>
										</div>
									</div>
									<div class="tab-content">
<?php include 'removal-tabs/summaries.php'; ?>
<?php include 'removal-tabs/removal-form.php'; ?>
									</div>
								</div>
							</div>
							
							<div class="card-footer">
							</div>
						</div>
					</div>
				</div>
<?php include __DIR__ . '/../footer.php'; ?>

<?php include __DIR__ . '/../html-footer.php'; ?>