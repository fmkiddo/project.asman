<?php include __DIR__ . '/../header.php';
$cititle		= $pagedata['title'];
$ciname			= $pagedata['name'];
$cidscript		= $pagedata['dscript'];
$ciattrText		= $pagedata['ciattrtext'];
$ciSelAttribs	= $pagedata['ciattribs'];
$ciattribs		= $pagedata['attribs'];
$ciattribTypes	= $pagedata['attribtypes'];
?>
				<div class="row">
					<div class="col-md-8">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title"><?php echo $cititle; ?></h4>
							</div>
							<hr />
							<div class="card-body">
								<form id="category-form" role="form" method="post">
									<input type="hidden" name="oaciidx" value="<?php echo $ci; ?>" />
									<div class="form-group">
										<label for="name">Nama Kategori : </label>
										<div class="input-group">
											<input name="name" type="text" class="form-control" value="<?php echo $ciname; ?>" required />
										</div>
									</div>
									
									<div class="form-group">
										<label for="dscript">Deskripsi : </label>
										<div class="input-group">
											<input type="text" name="dscript" class="form-control" value="<?php echo $cidscript; ?>" required />
										</div>
									</div>
									
									<div class="form-group">
										<label for="attribs">Atribut Kategori : </label>
										<div class="input-group">
											<input type="hidden" name="attribs" value="<?php echo $ciattrText['hidden']; ?>" required />
											<input type="text" name="attribs-text" class="form-control" value="<?php echo $ciattrText['texts']; ?>" readonly="readonly" required />
										</div>
									</div>
									
									<hr style="margin: 0 0;" />
															
									<div class="text-right">
										<button type="submit" class="btn btn-primary">
											<i class="fas fa-paper-plane fa-fw"></i> Simpan
										</button>
										
										<button type="reset" class="btn btn-secondary">
											<i class="fas fa-ban fa-fw"></i> Reset
										</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					
					<div class="col-md-4">
						<div class="card">
							<div class="card-header d-flex justify-content-between">
								<h4 class="card-title">Atribut Tersimpan</h4>
								<button class="btn btn-primary" type="button" name="create-new-attribute">
									<i class="fas fa-plus-circle fa-fw"></i>
								</button>
							</div>
							
							<div class="card-body">
								<div class="row" style="display: none;">
									<div class="col-md-12">
										<form role="form" id="form-new-attribute" method="post">
											<div class="row">
												<div class="col-6">
													<div class="form-group">
														<label for="new-attribute-name">Nama Atribut Baru : </label>
														<div class="input-group">
															<input type="text" class="form-control" name="new-attribute-name" required />
														</div>
													</div>
												</div>
												<div class="col-6">
													<div class="form-group">
														<label for="new-attribute-type">Tipe Atribut Baru : </label>
														<div class="input-group">
															<select name="new-attribute-type" class="form-control" required>
																<option selected="selected" disabled="disabled" >--- Tipe Atribut ---</option>
<?php foreach ($ciattribTypes as $type => $name): ?>
																<option value="<?php echo $type; ?>"><?php echo $name; ?></option>
<?php endforeach; ?>
															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="row" style="display: none;">
												<div class="col">
													<div class="form-group">
														<label for="prepopulated-list-value">Nilai Daftar Berisi : </label>
														<div class="input-group">
															<input type="text" name="prepopulated-list-value" class="form-control" value="" />
														</div>
													</div>
												</div>
											</div>
											<div class="text-right">
												<button type="submit" class="btn btn-primary">
													<i class="fas fa-paper-plane fa'fw"></i>
												</button>
												<button type="reset" class="btn btn-secondary" name="cancel-newattribute">
													<i class="fas fa-ban fa-fw"></i>
												</button>
											</div>
										</form>
									</div>
								</div>
								
								<div class="row">
									<div class="col">
										<table class="table responsive table-hover table-pointer">
											<tbody>
<?php foreach ($ciattribs as $attrib): 
	$selected = false;
	if ($ciSelAttribs !== ''):
		foreach ($ciSelAttribs as $selAttrib):
		if ($attrib->idx == $selAttrib['octa_idx']) {
			$selected = true;
			break;
		}
		endforeach;
	endif;
?>
												<tr data-name="attribute">
													<td><input type="checkbox" class="form-control" name="attribute" data-name="<?php echo $attrib->attr_name; ?>" value="<?php echo $attrib->idx; ?>" <?php echo $selected ? 'checked="checked"' : ''; ?>/></td>
													<td><?php echo ucfirst(strtolower($attrib->attr_name)); ?></td>
													<td><?php echo $attrib->attr_type; ?></td>
												</tr>										
<?php endforeach; ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
<?php include __DIR__ . '/../footer.php'; ?>

	<script>
	$(document).ready (function () {
		$('select[name="new-attribute-type"]').change (function (evt) {
			$name = $(this).val ();
			$parent = $(this).parents ('div.col-6').parent ().next ();
			if ($name !== 'prepopulated-list') {
				if ($parent.is (':visible')) {
					$parent.slideUp ();
					$('input[name="prepopulated-list-value"]').val ('');
				}
			} else if (!$parent.is (':visible')) $parent.slideDown ();
		});
		
		$('button').click (function ($evt) {
			$name = $(this).prop ('name');
			switch ($name) {
				default:
					break;
				case 'create-new-attribute':
					$formAttribute = $('form#form-new-attribute'),
					$divRow = $formAttribute.parent ().parent ();
					if (!$divRow.is(':visible')) $divRow.slideDown ();
					break;
				case 'cancel-newattribute':
					$formAttribute = $('form#form-new-attribute'),
					$divRow = $formAttribute.parent ().parent ();
					if ($divRow.is (':visible')) $divRow.slideUp ();
					break;
			}
		});

		$('td').click (function (evt) {
			$this = $(this);
			if ($this.is (':not(:first-child)')) {
				$cb = $this.parents ('tr').find (':input:checkbox');
				$cb.click ();
			}
		});

		$('input[name="attribute"]').change (function (evt) {
			$allattrcb = $('input[name="attribute"]:checked');
			if ($allattrcb.length > 0) {
				$id = '[';
				$text = '[';
				if ($allattrcb.length > 1) 
					$allattrcb.each (function () {
						$id += $(this).val () + ', ';
						$text += $(this).attr ('data-name') + ', ';
					});
				else {
					$id += $allattrcb.val ();
					$text += $allattrcb.attr ('data-name');
				}
				
				$id += ']';
				$text += ']';
				$id = $id.replace (", ]", "]");
				$text = $text.replace (", ]", "]");
			} else {
				$id = '';
				$text = '';
			}

			$('input[name="attribs"]').val ('');
			$('input[name="attribs"]').val ($id);

			$('input[name="attribs-text"]').val ('');
			$('input[name="attribs-text"]').val ($text);
		});
	});
	</script>

<?php include __DIR__ . '/../html-footer.php'; ?>

