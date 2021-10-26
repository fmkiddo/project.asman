<?php include __DIR__ . '/../header.php';
if (isset ($pagedata) && array_key_exists('location', $pagedata)):
	$location = $pagedata['location'];
	$code = $location->code;
	$name = $location->name;
	$address = $location->address;
	$phone = $location->phone;
	$pic = $location->contact_person;
	$email = $location->email;
	$notes = $location->notes;
else:
	$code = '';
	$name = '';
	$address = '';
	$phone = '';
	$pic = '';
	$email = '';
	$notes = '';
endif;
?>
				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">
									<i class="fas fa-building fa-fw"></i> <span>Add Location</span>
								</h4>
							</div>
							<hr />
							<div class="card-body">
								<form role="form" method="post">
									<input type="hidden" name="idx" value="<?php echo $idx; ?>" />
									<div class="form-group">
										<label for="location-code">Kode Lokasi:</label>
										<div class="input-group">
											<input type="text" class="form-control" name="location-code" value="<?php echo $code; ?>" <?php echo ($idx > 0) ? 'readonly' : ''; ?> required />
										</div>
									</div>
									<div class="form-group">
										<label for="location-name">Nama Lokasi:</label>
										<div class="input-group">
											<input type="text" class="form-control" name="location-name" value="<?php echo $name; ?>" required />
										</div>
									</div>
									<div class="form-group">
										<label for="location-address">Alamat Lokasi:</label>
										<div class="input-group">
											<input type="text" class="form-control" name="location-address" value="<?php echo $address; ?>" required />
										</div>
									</div>
									<div class="form-group">
										<label for="location-phone">Telepon:</label>
										<div class="input-group">
											<input type="text" class="form-control" name="location-phone" value="<?php echo $phone; ?>" required />
										</div>
									</div>
									<div class="form-group">
										<label for="location-pic">PIC Lokasi:</label>
										<div class="input-group">
											<input type="text" class="form-control" name="location-pic" value="<?php echo $pic; ?>" required />
										</div>
									</div>
									<div class="form-group">
										<label for="location-email">Email:</label>
										<div class="input-group">
											<input type="text" class="form-control" name="location-email" value="<?php echo $email; ?>" required />
										</div>
									</div>
									<div class="form-group">
										<label for="location-notes">Catatan:</label>
										<div class="input-group">
											<textarea rows="2" class="form-control" name="location-notes"><?php echo $notes; ?></textarea>
										</div>
									</div>
									<div class="text-right" style="padding-top: 1rem;">
										<button class="btn btn-primary" type="submit">
											<i class="fas fa-paper-plane fa-fw"></i>
										</button>
										<button class="btn btn-secondary" type="reset">
											<i class="fas fa-undo fa-fw"></i>
										</button>
										<a class="btn btn-danger" href="<?php echo $before; ?>">
											<i class="fas fa-times fa-fw"></i>
										</a>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>

<?php include __DIR__ . '/../footer.php'; ?>

<?php include __DIR__ . '/../html-footer.php'; ?>