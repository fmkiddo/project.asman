
												<div class="tab-pane fade show active" id="incoming">
													<div class="row row-with-padding">
<?php
$summariesCount = count ($summaries);
$partition = 12 / $summariesCount;
foreach ($summaries as $summary): ?>
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
																		<a id="refresh-" . <?php echo $summary['id']; ?>>
																			<i class="fas fa-sync-alt fa-fw"></i> <span data-smarty="{7}"></span>
																		</a>
																	</div>
																</div>
															</div>
														</div>
<?php endforeach; ?>
													</div>
													<hr />
													<div class="row">
														<div class="col-md-12">
															<table id="dataTable-moveinMaster" class="dataTable table table-striped table-hover table-pointer table-centered-content">
																<thead>
																	<tr>
																		<th>#</th>
<?php foreach ($moveintableheader as $th): ?>
																		<th data-smarty="<?php echo $th; ?>"></th>
<?php endforeach; ?>
																	</tr>
																</thead>
																<tbody>
<?php foreach ($moveinList as $id => $move_in): ?>
																	<tr class="<?php echo $docstat->getClass ($move_in->status); ?>">
																		<td><?php echo ($id + 1); ?></td>
																		<td><?php echo $move_in->docnum; ?></td>
																		<td><?php echo $move_in->docdate; ?></td>
																		<td><?php echo $locations[$move_in->omvo_olctfrom]; ?></td>
																		<td><?php echo $locations[$move_in->omvo_olctto]; ?></td>
																		<td><?php echo $move_in->username; ?></td>
																		<td>
																			<i class="<?php echo $docstat->getIcon ($move_in->status); ?>"></i>
																			<span><?php echo $docstat->getStatusText ($move_in->status, $locale); ?></span>
																		</td>
																	</tr>
<?php endforeach; ?>
																</tbody>
															</table>
														</div>
													</div>
												</div>
