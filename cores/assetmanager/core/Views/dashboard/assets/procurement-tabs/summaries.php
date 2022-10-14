												<div class="tab-pane fade show active" id="summary">
													<div class="row row-with-padding">
<?php
$summaries	= $pagedata['req-summaries'];
$list		= $pagedata['req-list'];
$sumstyles	= $pagedata['req-summstyle'];
$titlecodes	= $pagedata['req-titlecode'];
if (count ($summaries) > 0):
$partition = 12 / count ($summaries);
foreach ($summaries as $key => $value): ?>
														<div class="col-md-<?php echo $partition; ?>">
															<div class="card <?php echo $sumstyles[$key]; ?>">
																<div class="card-header">
																	<h5 data-smarty="<?php echo $titlecodes[$key]; ?>"></h5>
																</div>
																<div class="card-body">
																	<p class="display-3"><?php echo $value; ?></p>
																</div>
																<div class="card-footer">
																	<div class="stats">
																		<a id="refresh-<?php echo $key; ?>"><i class="fas fa-sync-alt fa-fw"></i> <span data-smarty="{7}"></span></a>
																	</div>
																</div>
															</div>
														</div>
<?php 
endforeach;
endif;
?>
													</div>
													<div class="row">
														<div class="col-md-12">
															<table id="dataTable-requisition" class="table table-striped table-hover table-centered-content dataTable">
																<thead>
																	<tr>
																		<th data-smarty="{8}"></th>
																		<th data-smarty="{9}"></th>
																		<th data-smarty="{10}"></th>
																		<th data-smarty="{11}"></th>
																		<th data-smarty="{12}"></th>
																		<th data-smarty="{13}"></th>
																	</tr>
																</thead>
																<tbody>
<?php $line = 1;
foreach ($list as $request): ?>
																	<tr>
																		<td><?php echo $line; ?></td>
<?php foreach ($request as $rqn): ?>
																		<td><?php echo $rqn; ?></td>
<?php endforeach; ?>
																	</tr>
<?php $line++;
endforeach; ?>
																</tbody>
															</table>
														</div>
													</div>
												</div>
