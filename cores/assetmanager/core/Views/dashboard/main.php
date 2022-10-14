<?php include 'header.php';
$dataInfo	= $pagedata['data-infos']; ?>

				<div class="row">
					<div class="col-md-12">
						<div class="card card-stats">
							<div class="card-body">
								<div class="row">
									<div class="col-md-3">
										<div class="statistics">
											<div class="info">
												<div class="icon icon-primary">
													<i class="fa fa-file-signature fa-2x fa-fw"></i>
												</div>
												<h3 class="info-title"><?php echo $dataInfo['assets-qty']; ?></h3>
												<h6 class="stats-title" data-smarty="{0}"></h6>
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="statistics">
											<div class="info">
												<div class="icon icon-primary">
													<i class="fas fa-database fa-2x fa-fw"></i>
												</div>
												<h3 class="info-title"><?php echo $dataInfo['assets-types']; ?></h3>
												<h6 class="stats-title" data-smarty="{1}"></h6>
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="statistics">
											<div class="info">
												<div class="icon icon-primary">
													<i class="fas fa-file-signature fa-2x fa-fw"></i>
												</div>
												<h3 class="info-title"><?php echo $dataInfo['pend-request']; ?></h3>
												<h6 class="stats-title" data-smarty="{2}"></h6>
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="statistics">
											<div class="info">
												<div class="icon icon-primary">
													<i class="fas fa-truck fa-2x fa-fw"></i>
												</div>
												<h3 class="info-title"><?php echo $dataInfo['assets-intransit']; ?></h3>
												<h6 class="stats-title" data-smarty="{3}"></h6>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="card card-primary">
							<div class="card-header">
								<div class="d-flex justify-content-between align-items-center">
									<h4 data-smarty="{4}" class="card-title"></h4>
									<button type="button" class="btn btn-primary" onclick="window.location.href='doc-assetin'">
										<i class="fas fa-dolly-flatbed fa-fw"></i> <span data-smarty="{13}"></span>
									</button>
								</div>
							</div>
							<div class="card-body">
								<table id="intransit-dataTable" class="dataTable table table-striped table-hover table-pointer table-centered-content">
									<thead>
										<tr>
											<th>#</th>
											<th data-smarty="{5}"></th>
											<th data-smarty="{6}"></th>
											<th data-smarty="{7}"></th>
											<th data-smarty="{8}"></th>
											<th data-smarty="{9}"></th>
											<th data-smarty="{10}"></th>
											<th data-smarty="{11}"></th>
											<th data-smarty="{12}"></th>
										</tr>
									</thead>
									<tbody>
<?php if ($dataInfo['pend-request'] > 0):
	$line	= 1;
	foreach ($dataInfo['intransits'] as $intransit): ?>
										<tr class="<?php $docstats->getClass ($intransit->status); ?>">
											<td><?php echo $line; ?></td>
											<td><?php echo $intransit->oita_code; ?></td>
											<td><?php echo $intransit->oita_name; ?></td>
											<td><?php echo $intransit->olct_code . ' - ' . $intransit->olct_name; ?></td>
											<td><?php echo $intransit->osbl_name; ?></td>
											<td><?php echo $intransit->qty; ?></td>
											<td><?php echo $intransit->omvo_docnum; ?></td>
											<td><?php echo $intransit->omvi_docnum; ?></td>
											<td><?php echo $docstats->getStatusText ($intransit->status, $locale); ?></td>
										</tr>
<?php 
		$line++;
	endforeach;
endif; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="card card-primary">
							<div class="card-header">
								<h4 class="card-title" data-smarty="{14}"></h4>
							</div>
							<div class="card-body">
								<table id="newreq-dataTable" class="dataTable table table-hover table-striped table-pointer table-centered-content">
									<thead>
										<tr>
											<th>#</th>
											<th data-smarty="{15}"></th>
											<th data-smarty="{16}"></th>
											<th data-smarty="{17}"></th>
										</tr>
									</thead>
									<tbody>
<?php
if (count ($dataInfo['newrequests']) > 0): 
	$line = 1;
	foreach ($dataInfo['newrequests'] as $newReq): ?>
										<tr>
											<td><?php echo $line; ?></td>
											<td><?php echo $newReq->docnum; ?></td>
											<td><?php echo $newReq->docdate; ?></td>
											<td><?php echo $doctypes->getType ($newReq->type, $locale); ?></td>
										</tr>
<?php
		$line++;
	endforeach;
endif;
?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="card card-primary">
							<div class="card-header">
								<h4 class="card-title" data-smarty="{18}"></h4>
							</div>
							<div class="card-body">
								<table id="onprog-dataTable" class="dataTable table table-hover table-striped table-pointer table-centered-content">
									<thead>
										<tr>
											<th>#</th>
											<th data-smarty="{15}"></th>
											<th data-smarty="{16}"></th>
											<th data-smarty="{17}"></th>
											<th data-smarty="{12}"></th>
										</tr>
									</thead>
									<tbody>
<?php
if (count ($dataInfo ['progressing']) > 0):
	$line = 1;
	foreach ($dataInfo['progressing'] as $result): ?>
										<tr class="<?php echo $docstats->getClass ($result->status); ?>">
											<td><?php echo $line; ?></td>
											<td><?php echo $result->docnum; ?></td>
											<td><?php echo $result->docdate; ?></td>
											<td><?php echo $doctypes->getType($result->type, $locale); ?></td>
											<td><?php echo $docstats->getStatusText ($result->status, $locale); ?></td>
										</tr>
<?php
		$line++;
	endforeach;
endif;
?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

<?php include 'footer.php'; ?>
	<script>
	</script>
<?php include 'html-footer.php'; ?>
