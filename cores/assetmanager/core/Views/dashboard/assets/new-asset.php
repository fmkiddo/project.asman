<?php include __DIR__ . '/../header.php'; 
if (isset ($pagedata)):
	$categories = $pagedata['data-categories'];
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
									<i class="fas fa-form fa-fw"></i>
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
												<label for="asset-barcode">Barcode:</label>
												<div class="input-group">
													<input type="text" name="asset-barcode" class="form-control" required />
												</div>
											</div>
											<div class="form-group">
												<label for="asset-dscript">Deskripsi:</label>
												<div class="input-group">
													<input type="text" name="asset-dscript" class="form-control" required />
												</div>
											</div>
											<div class="form-group">
												<label for="asset-category">Kategori:</label>
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
												<label for="asset-notes">Catatan:</label>
												<div class="input-group">
													<input type="text" name="asset-notes" class="form-control" />
												</div>
											</div>
											<div class="form-group">
												<label for="asset-ponumber">No. Purchase Order:</label>
												<div class="input-group">
													<input type="text" name="asset-ponumber" class="form-control" />
												</div>
											</div>
											<div class="form-group">
												<label for="asset-purchase">Nilai Perolehan:</label>
												<div class="input-group">
													<input type="number" name="asset-purchase" class="form-control" value="0" />
												</div>
											</div>
											<div id="asset-location-data" style="display: none; margin: 1.0rem 0;">
												<h5>Data Lokasi</h5>
												<hr />
												<div class="form-group">
													<label for="asset-location">Lokasi:</label>
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
												</div>;
												<div class="form-group">
													<label for="asset-sublocation">Sublokasi:</label>
													<div class="input-group">
														<select name="asset-sublocation" class="form-control" required>
															<option disabled="disabled" selected="selected">--- Pilih Sublokasi ---</option>
														</select>
													</div>
												</div>
											</div>
											<div class="text-right">
												<button class="btn btn-primary" type="button" name="add-location">
													<i class="fas fa-plus-circle fa-fw"></i> <i class="fas fa-landmark fa-fw"></i>
												</button>
												<button class="btn btn-primary" type="button" name="add-attributes">
													<i class="fas fa-plus-circle fa-fw"></i> <i class="fas fa-stream fa-fw"></i>
												</button>
												<button class="btn btn-primary" type="submit">
													<i class="fas fa-plus-circle fa-fw"></i> <i class="fas fa-paper-plane fa-fw"></i>
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
	$('select.selectpicker').selectpicker ();
	$('button[name="add-location"]').click (function (event) {
		$('div#asset-location-data').fadeIn ();
	});
	$('[name="asset-category"]').change (function (event) {
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
	});
	$('[name="asset-location"]').change (function (event) {
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
	});
	$('button[name="add-attributes"]').click (function (event) {
		var $divParent = $(this).parents ('div.col-sm-12');
		$divParent.removeClass ('col-lg-12 col-xl-12').addClass ('col-lg-8 col-xl-8');
		$divParent.next ().fadeIn ();
	});
	</script>

<?php include __DIR__ . '/../html-footer.php'; ?>