<?php include __DIR__ . '/../header.php'; 
if (isset ($pagedata)):
	$locationheader = $pagedata['locationheader'];
	$location = $pagedata['location'];
	$sublocations = $pagedata['sublocations'];
	$sblheader = $pagedata['sblheader'];
	$locationassets = $pagedata['locationassets'];
	$assetheader = $pagedata['assetheader'];
else:
	$location = NULL;
	$sublocations = NULL;
	$sblheader = NULL;
endif;
?>
				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-header d-flex align-items-center justify-content-between">
								<h4 class="card-title">
									<i class="fas fa-landmark fa-fw"></i> <span>Location Detail - <?php echo ucwords(strtolower($location->name)); ?></span>
								</h4>
							</div>
							<hr />
							<div class="card-body">
								<div class="card-nav-tabs card-plain">
									<div class="nav-tabs-navigation">
										<div class="nav-tabs-wrapper">
											<ul class="nav nav-tabs" data-tabs="tabs">
												<li class="nav-item">
													<a class="nav-link active" href="#detail" data-toggle="tab">
														<i class="fas fa-user fa-fw"></i> <span>Detail</span>
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" href="#sublocation" data-toggle="tab">
														<i class="fas fa-briefcase fa-fw"></i> <span>SubLocation</span>
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" href="#assetdata" data-toggle="tab">
														<i class="fas fa-database fa-fw"></i> <span>Asset List</span>
													</a>
												</li>
											</ul>
										</div>
									</div>
									<div class="tab-content" style="padding: 1rem 0;">
										<div class="tab-pane fade show active" id="detail">
											<div class="d-block">
												<h5>Location Profile</h5>
											</div>
											<div style="width: 100%;">
												<table class="table">
													<tbody>
<?php 
$idx = 0;
foreach ($location->toArray () as $key => $value): 
	if ($key !== 'idx'):
?>
														<tr>
															<td><?php echo $locationheader[$idx]; ?></td><td><?php echo $value; ?></td>
														</tr>										
<?php 
		$idx++;
	endif;
endforeach; ?>
													</tbody>
												</table>
											</div>
											<div class="d-block text-right">
												<form role="form" method="post" action="form-location">
													<input type="hidden" name="location" value="<?php echo $location->idx; ?>">
													<input type="hidden" name="before" value="location-detail?location=<?php echo $location->idx; ?>" />
													<button type="submit" class="btn btn-primary">
														<i class="fas fa-edit fa-fw"></i>
													</button>
												</form>
											</div>
										</div>
										<div class="tab-pane fade" id="sublocation">
											<div class="row" style="margin-bottom: 2rem;">
												<div class="col-md-12">
													<div class="d-flex justify-content-between align-items-center">
														<h5>Sublocation Data</h5>
														<a class="btn btn-primary" href="form-sublocation?location=<?php echo $location->idx; ?>">
															<i class="fas fa-plus-circle fa-fw"></i> <span>Add Sublocation</span>
														</a>
													</div>
												</div>
											</div>
											<div class="">
												<table id="dataTable-sublocation" class="dataTable">
													<thead>
														<tr>
<?php foreach ($sblheader as $header): ?>
															<th><?php echo $header; ?></th>
<?php endforeach; ?>
															<th>Operations</th>
														</tr>
													</thead>
													<tbody>
<?php foreach ($sublocations as $sublocation): ?>
														<tr id="sublocation-<?php echo $sublocation->idx; ?>">
															<td><?php echo $sublocation->code; ?></td>
															<td><?php echo $sublocation->name; ?></td>
															<td>
																<div class="dropdown">
																	<form role="form" method="post" action="form-sublocation">
																		<input type="hidden" name="location" value="<?php echo $location->idx; ?>" />
																		<input type="hidden" name="sublocation" value="<?php echo $sublocation->idx; ?>" />
																	</form>
																	<a class="btn btn-primary dropdown-toggle" role="button" id="dropdownSblActionMenu<?php echo $sublocation->idx; ?>" data-toggle="dropdown">
																		<i class="fas fa-tasks fa-fw"></i>
																	</a>
																	<div class="dropdown-menu" aria-labelledby="dropdownSblActionMenu<?php echo $sublocation->idx; ?>">
																		<a class="dropdown-item">
																			<i class="fas fa-edit fa-fw"></i> <span>Edit</span>
																		</a>
																		<a class="dropdown-item">
																			<i class="fas fa-times fa-fw"></i> <span>Delete</span>
																		</a>
																	</div>
																</div>
															</td>
														</tr>
<?php endforeach; ?>
													</tbody>
												</table>
											</div>
										</div>
										<div class="tab-pane fade" id="assetdata">
											<!-- <div class="row">
												<div class="col-md-12">
													<div class="d-flex align-items-center justify-content-between">
														<h5>Asset List</h5>
													</div>
												</div>
											</div>-->
											<div>
												<table id="dataTable-sublocation" class="dataTable">
													<thead>
														<tr>
<?php foreach ($assetheader as $th): ?>
															<th><?php echo $th; ?></th>
<?php endforeach; ?>
														</tr>
													</thead>
													<tbody>
<?php foreach ($locationassets as $locationasset): ?>
														<tr>
															<td><?php echo $locationasset->code; ?></td>
															<td><?php echo $locationasset->name; ?></td>
															<td><?php echo $locationasset->sublocation; ?></td>
															<td><?php echo $locationasset->ci_name; ?></td>
															<td><?php echo $locationasset->notes; ?></td>
															<td><?php echo $locationasset->po_number; ?></td>
															<td class="text-center"><?php echo $locationasset->qty; ?></td>
														</tr>
<?php endforeach; ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
<?php include __DIR__ . '/../footer.php'; ?>
	<script type="text/javascript">
	$('td').click (function () {
		if (!$(this).is (':last-child')) {
		}
	});
	</script>
<?php include __DIR__ . '/../html-footer.php'; ?>