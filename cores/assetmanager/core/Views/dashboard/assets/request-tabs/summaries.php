
												<div class="tab-pane fade show active" id="summary">
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
															<table id="dataTable-moverequest" class="dataTable table table-striped table-hover table-pointer table-centered-content">
																<thead>
																	<tr>
																		<th>#</th>
																		<th data-smarty="{10}"></th>
																		<th data-smarty="{11}"></th>
																		<th data-smarty="{12}"></th>
																		<th data-smarty="{13}"></th>
																		<th data-smarty="{14}"></th>
																	</tr>
																</thead>
																<tbody>
<?php $lineId = 1;
foreach ($dataRequestDocs as $idx => $requestDoc): ?>
																	<tr class="<?php echo $docstat->getClass ($requestDoc->status); ?>">
																		<td><?php echo $lineId; ?></td>
																		<td><?php echo $requestDoc->docnum; ?></td>
																		<td><?php echo $requestDoc->docdate; ?></td>
																		<td><?php echo $requestDoc->username; ?></td>
																		<td>
																			<i class="<?php echo $docstat->getIcon ($requestDoc->status); ?>"></i>
																			<span><?php echo $docstat->getStatusText ($requestDoc->status); ?></span>
																		</td>
																	</tr>
<?php $lineId += $idx;
endforeach; ?>
																</tbody>
															</table>
														</div>
													</div>
												</div>