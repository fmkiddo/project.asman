
												<div class="tab-pane fade <?php echo ($requestNew == 0) ? 'show active' : ''; ?>" id="summary">
													<div class="row row-with-padding">
<?php $partition = (12 / count ($pagedata['summaries']));
foreach ($pagedata['summaries'] as $summary): ?>
														<div class="col-md-<?php echo $partition; ?>">
															<div class="card <?php echo $summary['style']; ?>">
																<div class="card-header">
																	<h5 class="card-title" data-smarty="<?php echo $summary['title']; ?>"></h5>
																</div>
																<div class="card-body">
																	<p class="display-3"><?php echo $summary['content']; ?></p>
																</div>
																<div class="card-footer">
																	<div class="stats">
																		<a id="refresh" data-click="data-refresh-<?php echo $summary['id']; ?>" style="cursor: pointer;"><i class="fas fa-sync-alt fa-fw"></i> <span data-smarty="{9}"></span></a>
																	</div>
																</div>
															</div>
														</div>
<?php endforeach; ?>
													</div>
													<hr />
													<div class="row">
														<div class="col">
															<table id="dataTable-mutateSummaries" class="dataTable table table-striped table-hover table-pointer table-centered-content">
																<thead>
																	<tr>
																		<th>#</th>
																		<th data-smarty="{10}"></th>
																		<th data-smarty="{11}"></th>
																		<th data-smarty="{12}"></th>
																		<th data-smarty="{13}"></th>
<?php if ($dataUserLocation == 0): ?>									
																		<th data-smarty="{37}"></th>
<?php endif; ?>
																		<th data-smarty="{14}"></th>
																	</tr>
																</thead>
																<tbody>
<?php $lineId = 1;
foreach ($dataRequestDocs as $requestDoc):
	foreach ($requestDoc as $req): ?>
																	<tr class="<?php echo $docstat->getClass ($req->status); ?>">
																		<td><?php echo $lineId; ?></td>
																		<td id="docnum"><?php echo $req->docnum; ?></td>
																		<td><?php echo $req->docdate; ?></td>
																		<td><b><?php echo $doctype->getType ($req->type); ?></b></td>
																		<td><?php echo $req->username; ?></td>
<?php if ($dataUserLocation == 0): ?>									
																		<td><?php echo $req->location_name; ?></td>
<?php endif; ?>
																		<td>
																			<i class="<?php echo $docstat->getIcon ($req->status); ?>"></i>
																			<span><?php echo $docstat->getStatusText ($req->status, $locale); ?></span>
																		</td>
																	</tr>
<?php $lineId++;
	endforeach;
endforeach; ?>
																</tbody>
															</table>
														</div>
													</div>
												</div>
