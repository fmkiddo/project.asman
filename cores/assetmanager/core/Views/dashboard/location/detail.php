<?php include __DIR__ . '/../header.php'; 
if (isset ($pagedata)):
	$location = $pagedata['location'];
	$sublocations = $pagedata['sublocations'];
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
									<i class="fas fa-landmark fa-fw"></i> <span data-smarty="{0}"></span><span><?php echo ucwords(strtolower($location->name)); ?></span>
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
														<i class="fas fa-user fa-fw"></i> <span data-smarty="{1}"></span>
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" href="#sublocation" data-toggle="tab">
														<i class="fas fa-briefcase fa-fw"></i> <span data-smarty="{13}"></span>
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" href="#assetdata" data-toggle="tab">
														<i class="fas fa-database fa-fw"></i> <span data-smarty="{21}"></span>
													</a>
												</li>
											</ul>
										</div>
									</div>
									<div class="tab-content" style="padding: 1rem 0;">
										<div class="tab-pane fade show active" id="detail">
											<div class="d-flex align-items-center justify-content-between">
												<h6 data-smarty="{2}"></h6>
												<button type="button" class="btn btn-primary" id="edit-info">
													<i class="fas fa-edit fa-fw"></i>
													<span data-smarty="{12}"></span>
												</button>
											</div>
											<div style="width: 100%;">
												<table class="table table-striped table-hover">
													<tbody style="font-weight: bold;">
<?php 
$idx = 0;
foreach ($location->toArray () as $key => $value): 
	if ($key !== 'idx'):
?>
														<tr>
															<td data-smarty="<?php echo $locationheader[$idx]; ?>"></td><td>:<td><?php echo $value; ?></td>
														</tr>										
<?php 
		$idx++;
	endif;
endforeach; ?>
														<tr>
															<td data-smarty="{10}"></td><td>:</td><td><?php echo $pagedata['totalassets']; ?></td>
														</tr>
													</tbody>
												</table>
											</div>
											<div class="d-block text-right">
												<form role="form" method="post" id="edit-location" action="form-location">
													<input type="hidden" name="location" value="<?php echo $location->idx; ?>">
													<input type="hidden" name="before" value="location-detail?location=<?php echo $location->idx; ?>" />
													<button type="submit" class="btn btn-primary" data-smarty="{11}">
														<i class="fas fa-edit fa-fw"></i>
														<span data-smarty="{12}"></span>
													</button>
												</form>
											</div>
										</div>
										<div class="tab-pane fade" id="sublocation">
											<div class="row">
												<div class="col-md-12">
													<div class="d-flex justify-content-between align-items-center">
														<h6><span data-smarty="{14}"></span><?php echo $location->name; ?></h6>
														<a class="btn btn-primary" href="form-sublocation?location-code=<?php echo $location->code; ?>&sublocation-code=new">
															<i class="fas fa-plus-circle fa-fw"></i> <span data-smarty="{15}"></span>
														</a>
													</div>
												</div>
											</div>
											<div class="">
												<table id="dataTable-sublocation" class="dataTable table table-striped table-hover table-centered-header">
													<thead>
														<tr>
															<th data-smarty="{16}"></th>
															<th data-smarty="{17}"></th>
															<th data-smarty="{18}"></th>
														</tr>
													</thead>
													<tbody>
<?php foreach ($sublocations as $sublocation): ?>
														<tr id="sublocation-<?php echo $sublocation->idx; ?>">
															<td><?php echo $sublocation->code; ?></td>
															<td><?php echo $sublocation->name; ?></td>
															<td class="text-center">
																<div class="dropdown">
																	<form role="form" method="post" action="form-sublocation">
																		<input type="hidden" name="location" value="<?php echo $location->idx; ?>" />
																		<input type="hidden" name="sublocation" value="<?php echo $sublocation->idx; ?>" />
																	</form>
																	<a class="btn btn-primary dropdown-toggle" role="button" id="dropdownSblActionMenu<?php echo $sublocation->idx; ?>" data-toggle="dropdown">
																		<i class="fas fa-tasks fa-fw"></i>
																	</a>
																	<div class="dropdown-menu" aria-labelledby="dropdownSblActionMenu<?php echo $sublocation->idx; ?>">
																		<a class="dropdown-item" data-click="edit" onclick="window.location.href='<?php echo base_url ($locale . '/dashboard/form-sublocation?location-code=' . $location->code . '&sublocation-code=' . $sublocation->code);?>'">
																			<i class="fas fa-edit fa-fw"></i> <span data-smarty="{19}"></span>
																		</a>
																		<a class="dropdown-item" onclick="alert('Unsupported Yet!')">
																			<i class="fas fa-times fa-fw"></i> <span data-smarty="{20}"></span>
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
											<div class="row">
												<div class="col-md-12">
													<div class="d-flex align-items-center justify-content-between">
														<h6><span data-smarty="{22}"></span><?php echo $location->name; ?></h6>
														<a class="btn btn-primary" onclick="window.location.href='new-asset'">
															<i class="fas fa-plus-circle fa-fw"></i><span data-smarty="{23}"></span>
														</a>
													</div>
												</div>
											</div>
											<div>
												<table id="dataTable-assetList" class="dataTable">
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
	$(document).ready (function () {
		$('body').on ('click', 'button, td', function ($evt) {
			if ($(this).is ('button')) {
				$id = $(this).prop ('id');
				switch ($id) {
					default:
						break;
					case 'edit-info':
						$('form#edit-location').find ('button:submit').trigger ('click');
						break;
				}
			} else if ($(this).is ('td')) {
				$table = $(this).parents ('table');
				$tableId = $table.prop ('id');
				switch ($tableId) {
					default:
						break;
					case 'dataTable-sublocation':
						if (!$(this).is (':last-child')) $(this).parents ('tr').find ('a[data-click="edit"]').trigger ('click');
						break;
				}
			}
		});
	});
	</script>
<?php include __DIR__ . '/../html-footer.php'; ?>