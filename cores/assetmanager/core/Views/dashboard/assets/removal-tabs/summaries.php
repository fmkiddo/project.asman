										<div class="tab-pane fade show active" id="summaries">
											<div class="row row-with-padding">
												<div class="col-md-12">
													<h6 data-smarty="{3}"></h6>
													<div class="row">
<?php foreach ($summaries as $summary): ?>
														<div class="col-md-4">
															<div class="card <?php echo $summary['style']; ?>">
																<div class="card-header">
																	<h6 class="card-title" data-smarty="<?php echo $summary['title']; ?>"></h6>
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
												</div>
											</div>
											<div class="row">
												<div class="col">
													<table id="dataTable-removalLists" class="dataTable table table-striped table-hover table-pointer table-centered-content">
														<thead>
															<tr>
																<th>#</th>
																<th data-smarty="{7}"></th>
																<th data-smarty="{8}"></th>
																<th data-smarty="{9}"></th>
																<th data-smarty="{10}"></th>
																<th data-smarty="{11}"></th>
																<th data-smarty="{12}"></th>
																<th data-smarty="{13}"></th>
															</tr>
														</thead>
														<tbody>
<?php $lineid = 1;
foreach ($dataRemovals as $removal): ?>
															<tr class="<?php echo $docstat->getClass ($removal->status); ?>">
																<td><?php echo $lineid; ?></td>
																<td><?php echo $removal->docnum; ?></td>
																<td><?php echo $removal->docdate; ?></td>
																<td><?php echo $removal->username; ?></td>
																<td><?php echo $removal->location_name; ?></td>
																<td><i class="<?php echo $docstat->getIcon ($removal->status); ?>"></i></td>
																<td><?php echo $removal->approval_date === NULL ? 'N/A' : $removal->approval_date; ?></td>
																<td><?php echo $docstat->getStatusText ($removal->status, $locale); ?></td>
															</tr>
<?php $lineid++;
endforeach; ?>
														</tbody>
													</table>
												</div>
											</div>
										</div>
