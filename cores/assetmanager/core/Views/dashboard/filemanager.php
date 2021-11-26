<?php include __DIR__ . '/header.php'; 
$images = [];
?>
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<div class="d-flex justify-content-between">
									<h5 class="card-title" data-smarty="{0}"></h4>
								</div>
							</div>
							
							<div class="card-body">
								<div class="card-nav-tabs card-plain">
									<div class="nav-tabs-navigation">
										<div class="nav-tabs-wrapper">
											<ul class="nav nav-tabs nav-fill" data-toggle="tabs">
												<li class="nav-item">
													<a class="nav-link active" href="#file-list" data-toggle="tab">
														<i class="fas fa-list fa-fw"></i>
														<span data-smarty="{1}"></span>
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" href="#file-upload" data-toggle="tab">
														<i class="fab fa-wpforms fa-fw"></i>
														<span data-smarty="{7}"></span>
													</a>
												</li>
											</ul>
										</div>
									</div>
									<div class="tab-content">
										<div class="tab-pane fade show active" id="file-list">
											<div class="row row-with-padding">
												<div class="col-md-12">
													<div class="d-flex justify-content-between">
														<h6 data-smarty="{35}"></h6>
														<span>
															<button type="button" class="btn btn-primary" id="upload-files">
																<i class="fas fa-upload fa-fw"></i>
																<span data-smarty="{14}"></span>
															</button>
															<button type="button" class="btn btn-primary" id="delete-files">
																<i class="fas fa-times fa-fw"></i>
																<span data-smarty="{36}"></span>
															</button>
														</span>
													</div>
													<table id="dataTable-imageList" class="dataTable table table-hover table-striped table-pointer" data-page-length="50">
														<thead>
															<tr>
																<th><input type="checkbox" id="check-allimages" /></th>
																<th data-smarty="{2}"></th>
																<th data-smarty="{3}"></th>
																<th data-smarty="{4}"></th>
																<th data-smarty="{5}"></th>
																<th data-smarty="{6}"></th>
															</tr>
														</thead>
														<tbody>
														</tbody>
													</table>
												</div>
											</div>
										</div>
										
										<div class="tab-pane fade" id="file-upload">
											<div class="row row-with-padding">
												<div class="col-md-4">
													<div class="card card-plain border">
														<div class="card-header">
															<h6 class="card-title" data-smarty="{8}"></h6>
														</div>
														<div class="card-body">
															<form id="upload-images" method="post" action="<?php echo base_url($locale . '/api/process'); ?>" enctype="multipart/form-data">
																<div class="d-none">
																	<input type="hidden" class="form-control" name="trigger" value="images-upload" readonly="readonly" required />
																	<input type="file" id="images" class="form-control" name="images" accept="image/jpeg, image/jpg, image/png, image/tiff" multiple required />
																</div>
																<div class="d-block">
																	<div class="image-display">
																		<div class="image-container">
																			<div id="image-carousel" class="carousel slide" data-ride="carousel" data-interval="false" data-wrap="false">
																				<div class="carousel-inner carousel-fill">
																				</div>
																				<a class="carousel-control-prev" href="#image-carousel" role="button" data-slide="prev">
																					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
																					<span class="sr-only">Previous</span>
																				</a>
																				<a class="carousel-control-next" href="#image-carousel" role="button" data-slide="next">
																					<span class="carousel-control-next-icon" aria-hidden="true"></span>
																					<span class="sr-only">Next</span>
																				</a>
																			</div>
																		</div>
																		<span class="display-overlay"></span>
																	</div>
																	<div class="d-flex align-items-center">
																		<button type="button" id="pick-images" class="btn btn-primary btn-block" data-smarty="{9}">
																			<i class="fas fa-hand-spock fa-fw"></i>
																			<span data-smarty="{10}"></span>
																		</button>
																	</div>
																</div>
																<div class="d-flex justify-content-between">
																	<button type="submit" id="submit-images" class="btn btn-primary" data-smarty="{13}">
																		<span id="submit-message" class="hidden" data-smarty="{37}"></span>
																		<i class="fas fa-upload fa-fw"></i>
																		<span data-smarty="{14}"></span>
																	</button>
																	<button type="reset" id="reset-images" class="btn btn-secondary" data-smarty="{11}">
																		<i class="fas fa-undo fa-fw"></i>
																		<span data-smarty="{12}"></span>
																	</button>
																</div>
															</form>
														</div>
													</div>
												</div>
												
												<div class="col-md-8">
													<div class="card card-plain border">
														<div class="card-header">
															<h6 class="card-title" data-smarty="{15}"></h6>
														</div>
														<div class="card-body">
															<form role="form" id="formuploadmasterdata" method="post" enctype="multipart/form-data" action="<?php echo base_url ($locale . '/api/process'); ?>">
																<input type="hidden" id="trigger" name="trigger" value="" />
																<div class="form-group">
																	<label><span data-smarty="{23}"></span>:</label>
																	<select id="upload-type" class="form-control" required>
																		<option disabled="disabled" selected="selected" data-smarty="{16}"></option>
																		<option value="md-locations" data-smarty="{17}"></option>
																		<option value="md-sublocations" data-smarty="{18}"></option>
																		<option value="md-catattributes" data-smarty="{19}"></option>
																		<option value="md-categories" data-smarty="{20}"></option>
																		<option value="md-assetitems" data-smarty="{21}"></option>
																		<option value="md-assetitemdetails" data-smarty="{22}"></option>
																	</select>
																</div>
																<input type="file" name="uploaded-file" class="form-control" accept="text/csv, text/txt" required />
																<div class="text-right">
																	<button type="submit" class="btn btn-primary" id="submit-file" data-smarty="{25}">
																		<i class="fas fa-upload fa-fw"></i>
																		<span data-smarty="{14}"></span>
																	</button>
																</div>
															</form>
														</div>
													</div>
													<div class="card card-plain border">
														<div class="card-header">
															<h6 class="card-title" data-smarty="{26}"></h6>
														</div>
														<div class="card-body bg-light">
															<ol class="glow-point">
																<li data-smarty="{27}"></li>
																<li data-smarty="{28}"></li>
																<li data-smarty="{29}"></li>
																<li data-smarty="{30}"></li>
																<li data-smarty="{31}"></li>
																<li data-smarty="{32}"></li>
																<li data-smarty="{33}"></li>
																<li data-smarty="{34}"></li>
															</ol>
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
				</div>

<?php include __DIR__ . '/footer.php'; ?>

	<script>
	$(document).ready (function () {
		$('body').on ('change', 'input, select', function ($evt) {
			if ($(this).is ('select')) {
				$id = $(this).prop ('id');
				switch ($id) {
					default:
						break;
					case 'upload-type':
						$type = $(this).val ();
						$('input#trigger').val ('upload-' + $type);
						break;
				}
			} else if ($(this).is ('input')) {
				$id = $(this).prop ('id');
				switch ($id) {
					default:
						break;
					case 'check-allimages':
						console.log ($(this).prop ('checked'));
						break;
					case 'images':
						$imageUpload = $('div#image-carousel');
						$imageUpload.children ('.carousel-inner').empty ();
						$('input#images').showPreviewCarousel ($imageUpload);
						$('span.display-overlay').addClass ('d-none');
						break;
				}
			}
		});
		
		$('body').on ('click', 'button, div, span', function ($evt) {
			if ($(this).is ('button')) {
				$id = $(this).prop ('id');
				switch ($id) {
					default:
						break;
					case 'upload-files': 
						$('a[href="#file-upload"]').trigger ('click');
						break;
					case 'pick-images':
						$('input[name="images"]').trigger ('click');
						break;
					case 'delete-files':
						$fileSelects = $('input#file-select');
						if ($fileSelects.length == 0) alert ('no file selected');
						break;
					case 'submit-images':
						if ($('input#images').prop ('files').length == 0) alert ($(this).find ('span#submit-message').text ());
						break;
					case 'reset-images':
						$('div#image-carousel').children ('.carousel-inner').empty ();
						$('span.display-overlay').removeClass ('d-none');
						break;
				}
			} else if ($(this).is ('span')) {
				if ($(this).hasClass ('display-overlay')) $('button#pick-images').trigger ('click');
			}
		});
	});
	</script>

<?php include __DIR__ . '/html-footer.php'; ?>