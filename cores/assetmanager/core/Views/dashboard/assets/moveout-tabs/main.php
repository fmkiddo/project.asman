													
													<div class="row row-with-padding">
<?php
$summariesCount = count ($summaries);
$partition = 12 / $summariesCount;
foreach ($summaries as $summary): ?>
														<div class="col-md-<?php echo $partition; ?>">
															<div class="card <?php echo $summary['style']; ?>">
																<div class="card-header">
																	<h5 class="card-title" data-smarty='<?php echo $summary['title']; ?>'></h5>
																</div>
																<div class="card-body">
																	<p class="display-3"><?php echo $summary['content']; ?></p>
																</div>
																<div class="card-footer">
																	<div class="stats">
																		<a id="refresh-" . <?php echo $summary['id']; ?>><i class="fas fa-sync-alt fa-fw"></i> <span data-smarty="{7}"></span></a>
																	</div>
																</div>
															</div>
														</div>
<?php endforeach; ?>
													</div>
													<hr />
													<div class="row row-with-padding">
														<div class="col">
															<table id="dataTable-moveoutMaster" class="dataTable table table-striped table-hover table-pointer table-centered-content">
																<thead>
																	<tr>
<?php foreach ($mvoutListTH as $th): ?>
																		<th data-smarty="<?php echo $th; ?>"></th>
<?php endforeach; ?>
																	</tr>
																</thead>
																<tbody>
<?php $lineId = 1;
foreach ($moveOutList as $list): ?>
																	<tr class="<?php echo $docstat->getClass ($list->status); ?>">
																		<td><?php echo $lineId; ?></td>
																		<td><?php echo $list->docnum; ?></td>
																		<td><?php echo $list->docdate; ?></td>
<?php if (count ($mvoutListTH) > 6): ?>
																		<td><?php echo $list->username; ?></td>
<?php endif; ?>
																		<td><i class="<?php echo $docstat->getIcon ($list->status); ?>"></i></td>
																		<td><?php echo $list->approval_date === NULL ? 'N/A' : $list->approval_date; ?></td>
																		<td><span><?php echo $docstat->getStatusText ($list->status, $locale); ?></span></td>
																	</tr>
<?php $lineId++; 
endforeach; ?>
																</tbody>
															</table>
														</div>
													</div>
