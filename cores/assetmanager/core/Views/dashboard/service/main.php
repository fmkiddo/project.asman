<?php include __DIR__ . '/../header.php'; ?>
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<div class="d-flex align-items-center justify-content-between">
									<h5 class="card-title" data-smarty="{0}"></h5>
									<button type="button" class="btn btn-primary" onclick="window.location.href='asset-service?service-form=true'" data-smarty="{25}">
										<i class="fas fa-plus-circle fa-fw"></i> <span data-smarty="{24}"></span>
									</button>
								</div>
							</div>
							<div class="card-body">
								<ul class="nav nav-pills nav-justified">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="pill" href="#list" data-smarty="{1}"></a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="pill" href="#list-rspgiven" data-smarty="{2}"></a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="pill" href="#recurring" data-smarty="{3}"></a>
									</li>
								</ul>
								<div class="tab-content">
<?php 
include 'tabs/list-pending.php';
include 'tabs/list-responsegiven.php';
include 'tabs/recurring.php';
?>
								</div>
							</div>
						</div>
					</div>
				</div>
<?php include __DIR__ . '/../footer.php'; ?>

<?php include __DIR__ . '/../html-footer.php'; ?>
