										<div class="tab-pane fade" id="removal-form">
											<div class="row row-with-padding">
												<div class="col">
													<h6 data-smarty="{14}"></h6>
												</div>
											</div>
											<div class="row">
												<div class="col">
													<div id="asset-removal">
<?php if (count ($removalDocs) == 0): ?>
														<div class="card card-plain border bg-gray text-dark">
															<div class="card-body">
																<b><span data-smarty="{15}"></span></b>
															</div>
														</div>
<?php else: ?>
														<div class="accordion border" id="document-list-accordion">
														</div>
<?php endif; ?>
													</div>
												</div>
											</div>
										</div>