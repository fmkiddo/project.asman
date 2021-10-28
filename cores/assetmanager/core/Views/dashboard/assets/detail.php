<?php include __DIR__ . '/../header.php'; ?>
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header d-flex justify-content-between">
								<h4 class="card-title">Detail Aset <?php echo $pagedata['details']['Nama']?></h4>
							</div>
							<hr />
							<div class="card-body">
								<div class="row">
									<div class="col-md-8">
										<h4>Detil Aset</h4>
										<table class="table table-hover table-striped table-pointer">
											<tbody>
<?php foreach ($pagedata['details'] as $key => $value): ?>
												<tr>
													<td><?php echo $key;?></td><td><?php echo $value; ?></td>
												</tr>
<?php endforeach; ?>
											</tbody>
										</table>
									</div>
									
									<div class="col-md-4">
										<h4>Atribut Kategori Aset: </h4>
										<table class="table table-hover table-striped table-pointer">
											<tbody>
<?php foreach ($pagedata['attrdetail'] as $attr): ?>
												<tr>
													<td><?php echo $attr['Nama']; ?></td><td><?php echo $attr['Nilai']; ?>
												</tr>
<?php endforeach; ?>
											</tbody>
										</table>
									</div>
								</div>
								
								<div class="row">
									<div class="col">
										<h4>Detail Lokasi</h4>
										<div class="card-nav-tabs card-plain">
											<div class="nav-tabs-navigation">
												<div class="nav-tabs-wrapper">
													<ul class="nav nav-tabs" data-toggle="tabs">
<?php $i=0;
foreach ($pagedata['locations'] as $olct): ?>
														<li class="nav-item">
															<a class="nav-link<?php echo $i == 0 ? ' active' : ''; ?>" href="#L<?php echo $olct->code; ?>" data-toggle="tab">
																<i class="fas fa-building fa-fw"></i> <?php echo $olct->name; ?>
															</a>
														</li>
<?php $i++;
endforeach; ?>													
													</ul>
												</div>
											</div>
											<div class="tab-content">
<?php $i=0;
$osblhead = $pagedata['sublocations']['header'];
$osbldata = $pagedata['sublocations']['data'];
foreach ($osbldata as $key => $osbl): ?>
												<div class="tab-pane fade<?php echo $i==0 ? ' show active' : ''; ?>" id="L<?php echo $key; ?>">
													<table class="table table-striped table-hover table-bordered table-pointer">
														<thead>
															<tr>
<?php foreach ($osblhead as $head): ?>
																<th><?php echo $head; ?></th>
<?php endforeach; ?>
															</tr>
														</thead>
														<tbody>
<?php foreach ($osbl as $sbl): ?>
															<tr>
<?php foreach ($sbl as $data): ?>
																<td><?php echo $data; ?></td>
<?php endforeach; ?>
															</tr>
<?php endforeach; ?>
														</tbody>
													</table>
												</div>
<?php $i++;
endforeach; ?>												
											</div>									
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
<?php include __DIR__ . '/../footer.php'; ?>

<?php include __DIR__ . '/../html-footer.php'; ?>