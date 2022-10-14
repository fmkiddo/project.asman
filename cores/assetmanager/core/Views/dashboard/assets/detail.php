<?php include __DIR__ . '/../header.php'; 
$images	= $pagedata['images']; 
?>
				<style>
				.tabs-below {
					border-bottom-width: 0px;
					border-top: 1px solid #dee2e6;
				}

				.tabs-below .nav-link {
					border: 1px solid transparent;
					border-top-left-radius: 0px;
					border-top-right-radius: 0px;
					border-bottom-left-radius: .25rem;
					border-bottom-right-radius: .25rem;
				}

				.tabs-below .nav-item {
					margin-bottom: 0px;
					margin-top: -1px;
				}

				.tabs-below .nav-item.show .nav-link, .tabs-below .nav-link.active {
					border-color: #fff #dee2e6 #dee2e6  #dee2e6;
				}
				
				.consistent-height .tab-content {
					display: flex;
				}
				
				.consistent-height .tab-content > .tab-pane {
					display: block;
					visibility: hidden;
					margin-right: -100%;
					width: 100%;
				}
				
				.consistent-height .tab-content > .active {
					visibility: visible;
				}
				</style>
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header d-flex justify-content-between">
								<h4 class="card-title"><span data-smarty="{0}"></span> <?php echo $pagedata['details']['Nama']?></h4>
								<a class="btn btn-primary" onclick="window.location.href='asset-service?service-form=true'">
									<i class="fas fa-wrench fa-fw"></i> <span data-smarty="{6}"></span>
								</a>
							</div>
							<hr />
							<div class="card-body">
								<div class="row">
									<div class="col-md-8">
										<div class="row">
											<div class="col-md-12">
												<h4 data-smarty="{0}"></h4>
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
										</div>
										
								
										<div class="row">
											<div class="col">
												<h4 data-smarty="{5}"></h4>
												<div class="card-nav-tabs card-plain">
													<div class="consistent-height">
														<div class="nav-tabs-navigation">
															<div class="nav-tabs-wrapper">
																<ul class="nav nav-tabs" data-toggle="tabs">
<?php $i=0;
foreach ($pagedata['locations'] as $olct): ?>
																	<li class="nav-item">
																		<a class="nav-link<?php echo $i == 0 ? ' active' : ''; ?>" href="#L<?php echo $olct->code; ?>" data-toggle="tab">
																			<i class="fas fa-building fa-fw"></i> <?php echo $olct->code . ' - ' . $olct->name; ?>
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
									
									<div class="col-md-4 consistent-height">
										<div class="tab-content" id="assetTabContent">
											<div class="tab-pane fade show active" id="attribute" role="tabpanel" aria-labelledby="attribute-tab">
												<h4 data-smarty="{1}"></h4>
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
											<div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
												<div class="d-flex justify-content-between">
													<h4 data-smarty="{2}"></h4>
													<button type="button" name="add-more-images" class="btn btn-primary" data-smarty="{4}">
														<i class="fa fa-plus-circle fa-fw"></i>
														<span data-smarty="{3}"></span>
													</button>
												</div>
												<div class="d-block">
													<div class="image-display">
														<div class="image-container" <?php echo (count ($images) > 0) ? 'style="background-image: none;"' : ''; ?>>
<?php
if (count ($images) > 0) { ?>

															<div id="asset-image-carousel" class="carousel slide" data-ride="carousel">
																<ol class="carousel-indicators">
<?php 
$imageCount = count ($images);
for ($i = 0; $i < $imageCount; $i++) { ?>
																	<li <?php echo ($i == 0) ? 'class="active"' : ''; ?> data-target="#asset-image-carousel" data-slide-to="<?php echo $i;?>"></li>
<?php } ?>
																</ol>
																<div class="carousel-inner">
<?php
$index = 0;
foreach ($images as $image) { ?>
																	<div class="carousel-item <?php echo ($index == 0) ? 'active' : ''; ?>">
																		<div class="w-100 carousel-fill" style="background-image: url(data:<?php echo $image['mime']; ?>;base64,<?php echo $image['contents']; ?>);"></div>
																	</div>
<?php 
	$index++;
} ?>
																</div>
																<a class="carousel-control-prev" href="#asset-image-carousel" role="button" data-slide="prev">
																	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
																	<span class="sr-only"></span>
																</a>
																<a class="carousel-control-next" href="#asset-image-carousel" role="button" data-slide="next">
																	<span class="carousel-control-next-icon" aria-hidden="true"></span>
																	<span class="sr-only"></span>
																</a>
															</div>
<?php 
}
?>
														</div>
													</div>
												</div>
											</div>
										</div>
										<ul class="nav nav-tabs nav-fill tabs-below" id="assetTab" role="tablist">
											<li class="nav-item">
												<a class="nav-link active" id="attribute-tab" data-toggle="tab" href="#attribute" role="tab" aria-controls="attribute" aria-selected="true">Atribut</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" id="images-tab" data-toggle="tab" href="#images" role="tab" aria-controls="images" aria-selected="true">Gambar</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
<?php include __DIR__ . '/../footer.php'; ?>
	<script>
	$(document).ready (function () {
		$('#image-select-modal.modal').on ('hidden.bs.modal', function () {
			$modalBodyRow	= $(this).find ('.modal-body').find ('.row');
			$modalBodyRow.empty ();
			$('button[name="add-more-images"]').prop ('disabled', false);
		});
		
		$('body').on ('click', 'button', function ($event) {
			$name = $(this).prop ('name');
			switch ($name) {
				default:
					break;
				case 'add-more-images':
					$(this).prop ('disabled', true);
					$.ajax ({
						'url': $.base_url ($locale + '/api/get'),
						'method': 'put',
						'data': JSON.stringify ({'trigger': 'fetch-images'}),
						'dataType': 'json'
					}).done (function ($result) {
						$imageList = $result['data-imagelist'];
						$listCount = $imageList.length;
						$imageModal = $('#image-select-modal.modal');
						if ($listCount > 0) {
							$modalBody	= $imageModal.find ('div.modal-body');
							$modalRow	= $modalBody.find ('div.row');
							$.each ($imageList, function ($k, $v) {
								$col	= $('<div/>', {'class': 'col-md-4'}).appendTo ($modalRow);
								$inRow	= $('<div/>', {'class': 'row'}).appendTo ($col);
								$col1	= $('<div/>', {'class': 'col-sm-2 d-flex justify-content-center'});
								$check	= $('<input/>', {
									'name': 'imagecheck',
									'type': 'checkbox',
									'value': $v.name
								}).appendTo ($col1) ;
								$col2	= $('<div/>', {'class': 'col-sm-10 d-flex justify-content-center'});
								$image	= $('<div/>', {
									'style': 'background-image: url(data:' + $v.mime + ';base64,' + $v.content + '); height: 100%;'
								}).appendTo ($col2);
								$col1.appendTo ($inRow);
								$col2.appendTo ($inRow);
							});
						}
						$imageModal.modal ('show');
					});
					break;
			}
		});
	});
	</script>
	<div id="image-select-modal" class="modal fade" role="dialog" aria-labelledby="" aria-hidden="true" style="top: 0;">
		<div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5>Tambah Gambar</h5>
					<button type="button" class="btn btn-secondary" name="upload-image">
						<span data-smarty=""></span>
					</button>
				</div>
				<div class="modal-body" style="background-color: #fafafa;">
					<div class="row">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" name="submit-imagepicked">
					</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">
						<i class="fa fa-times fa-fw"></i>
					</button>
				</div>
			</div>
		</div>
	</div>

<?php include __DIR__ . '/../html-footer.php'; ?>
