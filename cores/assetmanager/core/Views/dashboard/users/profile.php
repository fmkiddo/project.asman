<?php include __DIR__ . '/../header.php';
$profile = $pagedata['profile'];
?>
				<div class="row">
					<div class="col">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title" data-smarty="{0}"></h4>
							</div>
							<div class="card-body">
								<form role="form" id="form-profile" method="post" enctype="multipart/form-data" action="javascript:void(0)" data-action="<?php echo base_url ($locale . '/api/process'); ?>">
									<input type="hidden" name="trigger" value="" />
									<div class="row">
										<div class="col-md-4">
											<div class="card card-plain border">
												<div class="card-body">
													<div class="d-none">
														<input type="file" name="profile-photo" class="form-control" accept="image/jpeg, image/jpg, image/png, image/gif, image/tiff" />
													</div>
													<div class="d-flex">
														<button type="button" class="btn btn-primary btn-block" id="upload-image" data-smarty="{13}">
															<i class="fas fa-upload fa-fw"></i> <span data-smarty="{12}"></span>
														</button>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-8">
											<div class="card card-plain border">
												<div class="card-body">
													<div class="row">
														<div class="col-md-4">
															<div class="form-group">
																<label for="first-name" data-smarty="{1}"></label>
																<div class="input-group">
																	<input type="text" class="form-control" name="first-name" value="<?php echo $profile->fname; ?>" required />
																</div>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="middle-name" data-smarty="{2}"></label>
																<div class="input-group">
																	<input type="text" class="form-control" name="middle-name" value="<?php echo $profile->mname; ?>" />
																</div>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="last-name" data-smarty="{3}"></label>
																<div class="input-group">
																	<input type="text" class="form-control" name="last-name" value="<?php echo $profile->lname; ?>" />
																</div>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label for="phone" data-smarty="{4}"></label>
																<div class="input-group">
																	<input type="text" name="phone" class="form-control" value="<?php echo $profile->phone; ?>" />
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label for="email" data-smarty="{5}"></label>
																<div class="input-group">
																	<input type="email" name="email" class="form-control" value="<?php echo $profile->email; ?>" readonly="readonly" />
																</div>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label for="address-a" data-smarty="{6}"></label>
																<div class="input-group">
																	<textarea rows="2" name="address-a" class="form-control"><?php echo $profile->address1; ?></textarea>
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label for="address-b" data-smarty="{7}"></label>
																<div class="input-group">
																	<textarea rows="2" name="address-b" class="form-control"><?php echo $profile->address2; ?></textarea>
																</div>
															</div>
														</div>
													</div>
													<hr class="mx-0" />
													<div class="d-flex justify-content-end">
														<button type="submit" class="btn btn-primary" id="submit-profile" data-smarty="{9}">
															<i class="fas fa-save fa-fw"></i> <span data-smarty="{8}"></span>
														</button>
														<button type="reset" class="btn btn-secondary" id="reset-form" data-smarty="{11}">
															<i class="fas fa-save fa-fw"></i> <span data-smarty="{10}"></span>
														</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				
<?php include __DIR__ . '/../footer.php'; ?>
	<script>
	$(document).ready (function () {
		$('body').on ('click', 'button', function ($evt) {
			$id = $(this).prop ('id');
			switch ($id) {
				default:
					break;
				case 'submit-profile':
					$form = $(this).parents ('form');
					$isValid = $form.validateForm ();
					if ($isValid) {
						$form.prop ('action', $form.attr ('data-action'));
						$form.find ('input:hidden').val ($form.prop ('id'));
						$form.submit ();
					}
					break;
				case 'upload-image':
					$('input[name="profile-photo"]').click (); 
					break;
			}
		});
	});
	</script>

<?php include __DIR__ . '/../html-footer.php'; ?>