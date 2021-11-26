<?php include __DIR__ . '/../header.php'; ?>
				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-header">
								<div class="d-flex align-items-center justify-content-between">
									<h4 class="card-title"><i class="fas fa-landmark fa-fw"></i> <span>Locations</span></h4>
									<a class="btn btn-primary" href="form-location">
										<i class="fas fa-plus-circle fa-fw"></i> <span>Location</span>
									</a>
								</div>
							</div>
							<hr />
							<div class="card-body">
<?php 
if (isset ($pagedata) && count($pagedata) > 0): 
	$header 	= $pagedata['header'];
	$locations	= $pagedata['locations'];
?>
								<table id="dataTable-location" class="dataTable table table-striped table-hover">
									<thead>
										<tr>
<?php foreach ($header as $th): ?>
											<th><?php echo $th; ?></th>
<?php endforeach; ?>
											<th>Operations</th>
										</tr>
									</thead>
									<tbody>
<?php foreach ($locations as $location): ?>
										<tr id="<?php echo 'location-' . $location->idx; ?>" data-target="<?php echo $location->idx; ?>">
<?php foreach ($location->toArray () as $key => $value): ?>
<?php if ($key !== 'idx'): ?>
											<td><?php echo $value; ?></td>
<?php endif; ?>
<?php endforeach; ?>
											<td class="d-flex align-items-center">
												<form method="post" action="form-location">
													<input name="location" type="hidden" value="<?php echo $location->idx; ?>" />
													<input name="before" type="hidden" value="location" />
												</form>
												<div class="dropdown">
													<a class="btn btn-primary dropdown-toggle" role="button" id="dropdownActionMenu<?php echo $location->idx; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														<i class="fas fa-tasks fa-fw"></i>
													</a>
													<div class="dropdown-menu" aria-labelledby="dropdownActionMenu<?php echo $location->idx;?>">
														<a class="dropdown-item">
															<i class="fas fa-edit fa-fw"></i> <span>Edit</span>
														</a>
														<a class="dropdown-item">
															<i class="fas fa-minus-circle fa-fw"></i> <span>Delete</span>
														</a>
													</div>
												</div>
											</td>
										</tr>
<?php endforeach; ?>
									</tbody>
								</table>
<?php else: ?>
								
<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
<?php include __DIR__ . '/../footer.php'; ?>
	<script type="text/javascript">
	$('a.dropdown-item').click (function (evt) {
		if ($(this).children ('[data-icon="edit"]').is ('svg')) 
			$(this).parents ('td').children ('form').submit ();
		else if ($(this).children ('[data-icon="minus-circle"]').is ('svg'))
			;
		else
			;
	});
	$('td').click (function () {
		if (!$(this).is (':last-child')) {
			$dataTarget = $(this).parents ('tr').children (':first-child').text ();
			window.location.href = 'location-detail?location-code=' + $dataTarget;
		}
	});
	</script>
<?php include __DIR__ . '/../html-footer.php'; ?>