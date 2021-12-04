<?php include 'header.php'; 
$displayType	= $pagedata['data-type'];
$location		= $pagedata['data-pages']['data-location'];
$sublocation	= $pagedata['data-pages']['data-sublocation'];
?>
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<div class="d-flex justify-content-between">
									<h5 class="card-title"><span data-smarty="{0}"></span> <span><?php echo ucwords(strtolower($location->name)); ?></span></h5>
									<a role="button" class="btn btn-primary" onclick="window.location.href='<?php echo $referal; ?>'">
										<i class="fas fa-arrow-left fa-fw"></i>
									</a>
								</div>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-md-6">
										<form id="sublocation-update" role="form" method="post" action="<?php echo base_url ($locale . '/api/process'); ?>">
											<input type="hidden" name="location-code" value="<?php echo $location->code; ?>" />
											<div class="card card-plain border">
												<div class="card-header">
													<h6 class="card-title" data-smarty="{1}"></h6>
												</div>
												<div class="card-body">
													<div class="form-group">
														<label for="code" data-smarty="{2}"></label>
														<div class="input-group">
															<input type="text" class="form-control" name="code" value="<?php echo ($sublocation === NULL) ? '' : $sublocation->code; ?>" <?php echo $sublocation === NULL ? '' : 'readonly="readonly"'; ?> required />
														</div>
													</div>
													<div class="form-group">
														<label for="dscript" data-smarty="{3}"></label>
														<div class="input-group">
															<input type="text" class="form-control" name="dscript" value="<?php echo ($sublocation === NULL) ? '' : $sublocation->name; ?>" required />
														</div>
													</div>
													<hr />
													<div class="d-flex justify-content-end">
														<button type="submit" id="sublocation-submit" class="btn btn-primary" data-smarty="{4}">
															<i class="fas fa-paper-plane fa-fw"></i>
															<span data-smarty="{5}"></span>
														</button>
														<button type="reset" class="btn btn-secondary" data-smarty="{6}">
															<i class="fas fa-undo fa-fw"></i>
															<span data-smarty="{7}"></span>
														</button>
													</div>
												</div>
											</div>
										</form>
									</div>
									<div class="col-md-6">
										<div class="card card-plain border">
											<div class="card-header">
												<h6 class="card-title" data-smarty="{8}"></h6>
											</div>
											<div class="card-body">
												<div class="form-group">
													<label data-smarty="{9}"></label>
													<div class="input-group">
														<input type="text" class="form-control" value="<?php echo $location->code; ?>" readonly="readonly" />
													</div>
												</div>
												<div class="form-group">
													<label data-smarty="{10}"></label>
													<div class="input-group">
														<input type="text" class="form-control" value="<?php echo $location->name; ?>" readonly="readonly" />
													</div>
												</div>
												<div class="form-group">
													<label data-smarty="{11}"></label>
													<div class="input-group">
														<textarea rows="2" class="form-control" readonly="readonly"><?php echo $location->address; ?></textarea>
													</div>
												</div>
												<div class="form-group">
													<label data-smarty="{12}"></label>
													<div class="input-group">
														<input type="text" class="form-control" value="<?php echo $location->contact_person; ?>" readonly />
													</div>
												</div>
											</div>
										</div>	
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>


<?php include 'footer.php'; ?>
	<script>
	$(document).ready (function () {
		$('body').on ('click', 'button', function ($evt) {
			if ($(this).is ('button')) {
				$id = $(this).prop ('id');
				switch ($id) {
					default:
						break;
					case 'sublocation-submit':
						$form = $(this).parents ('form');
						if ($form.validateForm ()) {
							$evt.preventDefault ();
							$('<input/>', {
								'type': 'hidden',
								'name': 'trigger',
								'value': $form.prop ('id')
							}).appendTo ($form);
							$form.submit ();
						}
						break;
				}
			}
		});
	});
	</script>

<?php include 'html-footer.php'; ?>