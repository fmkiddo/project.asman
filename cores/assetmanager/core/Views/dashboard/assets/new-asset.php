<?php include __DIR__ . '/../header.php'; 
if (isset ($pagedata)):
	$categories	= $pagedata['data-categories'];
	$locations	= $pagedata['data-locations'];
else:
	$categories = '';
	$locations = '';
endif;
?>
				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">
									<i class="fas fa-edit fa-fw"></i>
									<span data-smarty="{0}"></span>
								</h4>
							</div>
							<hr />
							<div class="card-body">
								<form role="form" method="post" action="">
									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="border-right: 0.1rem solid #eeeddd;">
											<input type="hidden" name="asset" value="" />
											<div class="form-group">
												<label for="asset-barcode">
													<span data-smarty="{1}"></span>:
												</label>
												<div class="input-group">
													<input type="text" name="asset-barcode" class="form-control" required />
												</div>
											</div>
											<div class="form-group">
												<label for="asset-dscript">
													<span data-smarty="{2}"></span>:
												</label>
												<div class="input-group">
													<input type="text" name="asset-dscript" class="form-control" required />
												</div>
											</div>
											<div class="form-group">
												<label for="asset-category">
													<span data-smarty="{3}"></span>:
												</label>
												<div class="input-group">
													<select name="asset-category" class="form-control selectpicker" data-live-search="true" 
															data-style="btn-secondary" data-live-search-placeholder="" required>
														<option disabled="disabled" selected="selected">--- Pilih Category ---</option>
<?php 
if (is_array($categories))
	foreach ($categories as $category):
?>
														<option value="<?php echo $category->idx; ?>" data-tokens="<?php echo strtolower($category->ci_name); ?>"><?php echo $category->ci_name; ?></option>
<?php endforeach; ?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label for="asset-notes">
													<span data-smarty="{4}"></span>:
												</label>
												<div class="input-group">
													<input type="text" name="asset-notes" class="form-control" />
												</div>
											</div>
											<div class="form-group">
												<label for="asset-ponumber">
													<span data-smarty="{5}"></span>:
												</label>
												<div class="input-group">
													<input type="text" name="asset-ponumber" class="form-control" />
												</div>
											</div>
											<div class="form-group">
												<label for="asset-purchase">
													<span data-smarty="{6}"></span>:
												</label>
												<div class="input-group">
													<input type="number" name="asset-purchase" class="form-control" value="0" />
												</div>
											</div>
											<div id="asset-location-data" style="display: none; margin: 1.0rem 0;">
												<h6 data-smarty="{7}"></h5>
												<hr />
												<div class="form-group">
													<label for="asset-location">
														<span data-smarty="{8}"></span>:
													</label>
													<div class="input-group">
														<select name="asset-location" class="form-control" required>
															<option disabled="disabled" selected="selected">--- Pilih Lokasi ---</option>
<?php if (is_array($locations)): ?>
<?php foreach ($locations as $location): ?>
															<option value="<?php echo $location->idx; ?>"><?php echo $location->code . ' - ' . $location->name; ?></option>
<?php endforeach; ?>
<?php endif; ?>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label for="asset-sublocation">
														<span data-smarty="{9}"></span>:
													</label>
													<div class="input-group">
														<select name="asset-sublocation" class="form-control" required>
															<option disabled="disabled" selected="selected">--- Pilih Sublokasi ---</option>
														</select>
													</div>
												</div>
											</div>
											<div class="text-right">
												<button class="btn btn-primary" type="button" id="add-location" data-smarty="{10}">
													<i class="fas fa-plus-circle fa-fw"></i> <i class="fas fa-landmark fa-fw"></i>
													<span data-smarty="{11}"></span>
												</button>
												<button class="btn btn-primary" type="button" id="add-attributes" data-smarty="{12}">
													<i class="fas fa-plus-circle fa-fw"></i> <i class="fas fa-stream fa-fw"></i>
													<span data-smarty="{13}"></span>
												</button>
												<button class="btn btn-primary" type="submit" data-smarty="{14}">
													<i class="fas fa-plus-circle fa-fw"></i> <i class="fas fa-paper-plane fa-fw"></i>
													<span data-smarty="{15}"></span>
												</button>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4" style="display: none;">
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>

<?php include __DIR__ . '/../footer.php'; ?>

	<script type="text/javascript">
	$(document).ready (function () {
		$('select.selectpicker').selectpicker ();

		$('body').on ('click', 'button', function ($evt) {
			$id = $(this).prop ('id');
			switch ($id) {
				default:
					break;
				case 'add-location':
					$('div#asset-location-data').slideDown ();
					break;
				case 'add-attributes':
					var $divParent = $(this).parents ('div.col-sm-12');
					$divParent.removeClass ('col-lg-12 col-xl-12').addClass ('col-lg-8 col-xl-8');
					$divParent.next ().fadeIn ();
					break;
			}
		});

		$('body').on ('change', 'select', function ($evt) {
			if ($(this).is ('select')) {
				$name = $(this).prop ('name');
				switch ($name) {
					default:
						break;
					case 'asset-category':
						var $assetCategory = $(this),
						$data = {
							'trigger': $(this).prop ('name'),
							'category': $(this).val ()
						};
						$.ajax ({
							'url': $.base_url ('ajax-request/frontend'),
							'method': 'put',
							'data': JSON.stringify ($data),
							'dataType': 'json',
							'contentType': 'application/json'
						}).done (function ($result) {
							if ($result !== undefined) {
								$divParent = $assetCategory.parents ('div.col-sm-12');
								$divParent.siblings ().empty ();
								$.each ($result['data-form'], function () {
									$element = $(this)[0];
									$formGroup = $('<div />', {
										'class': 'form-group'
									});
									$('<label />', {
										'for': $element.name,
										'text': $element.label
									}).appendTo ($formGroup);
									$inputGroup = $('<div />', {
										'class': 'input-group'
									}).appendTo ($formGroup);
									$input = '';
									switch ($element.type) {
										default:
											$input = $('<input />', {
												'type': 'text',
												'name': $element.name,
												'class': 'form-control',
												'required': true
											});
											break;
										case 'date':
											$input = '';
											break;
										case 'list':
											$input = '';
											break;
										case 'prepopulated-list':
											$input = '';
											break;
									}
									$input.appendTo ($inputGroup);
									$formGroup.appendTo ($divParent.siblings ()[0]);
								});
							}
						});
						break;
					case 'asset-location':
						var $data = {
							'trigger': $(this).prop ('name'),
							'location': $(this).val ()
						},
						$sublocationopt = $('[name="asset-sublocation"]');
						$sublocationopt.find ('option:first').prop ('selected', true);
						$sublocationopt.find ('option').not (':first').remove ();
						$.ajax ({
							'url': $.base_url ('ajax-request/frontend'),
							'method': 'put',
							'data': JSON.stringify ($data),
							'dataType': 'json',
							'contentType': 'application/json'
						}).done (function (result) {
							var $sublocations = result.sublocations;
	
							if ($sublocations.length > 0) 
								$.each ($sublocations, function () {
									$sublocation = $(this)[0];
									$('<option />', {
										'value': $sublocation.idx,
										'text': $sublocation.code + ' - ' + $sublocation.name
									}).appendTo ($sublocationopt);
								});
						});
						break;
				}
			}
		});
	});
	</script>

<?php include __DIR__ . '/../html-footer.php'; ?>
