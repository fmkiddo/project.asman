<?php include __DIR__ . '/../header.php'; 
$user 		= array_key_exists('userdata', $pagedata) ? $pagedata['userdata'] : '';
if ($user !== ''):
$username	= $user->username;
$email		= $user->email;
$password	= "**********";
$ougr		= $user->ougr_idx;
else:
$username	= '';
$email		= '';
$password	= '';
$ougr		= 0;
endif;
$userid		= $pagedata['ousr-idx'];
$mgroups	= $pagedata['mgroups'];
$mlocations	= $pagedata['mlocs'];
?>
				<div class="row">
					<div class="col-md-12">
						<form id="form-masteruser" role="form" method="post">
							<input type="hidden" name="userid" value="<?php echo $userid; ?>" />
							<div class="card">
								<div class="card-header">
								</div>
								<hr />
								<div class="card-body">
									<div class="row">
										<div class="col-md-8">
											<div class="form-group">
												<label for="username">Nama User:</label>
												<div class="input-group">
													<input type="text" class="form-control" name="username" value="<?php echo $username; ?>" <?php echo ($userid > 0) ? 'readonly="readonly"' : ''; ?> required />
												</div>
											</div>
											
											<div class="form-group">
												<label for="email">Email:</label>
												<div class="input-group">
													<input type="email" class="form-control" name="email" value="<?php echo $email; ?>" required />
												</div>
											</div>
											
											<div class="form-group">
												<label for="password">Kata Sandi:</label>
												<div class="input-group">
													<input type="password" class="form-control" name="password" value="<?php echo $password; ?>" <?php echo ($password === '') ? '' : 'readonly="readonly"'; ?> required />
												</div>
											</div>
											
<?php if ($userid == 0): ?>
											<div class="form-group">
												<label for="cpassword">Konfirmasi Kata Sandi:</label>
												<div class="input-group">
													<input type="password" class="form-control" name="cpassword" value="" required />
												</div>
											</div>
<?php endif; ?>
<?php if ($userid > 0): ?>
											<div class="row">
												<input type="hidden" name="change-password" value="0" />
												<div class="col text-right">
													<button type="button" class="btn btn-primary" id="renew-password" title="Ganti Password">
														<i class="fas fa-edit fa-fw"></i> <span>Ganti Kata Sandi</span>
													</button>
												</div>
											</div>
											
											<div class="row" id="update-password" style="display: none;">
												<div class="col-md-12">
													<div class="form-group">
														<label for="npassword">Kata Sandi Baru:</label>
														<div class="input-group">
															<input type="password" class="form-control" name="npassword" />
														</div>
													</div>
													<div class="form-group">
														<label for="cnpassword">Konfirmasi Kata Sandi Baru:</label>
														<div class="input-group">
															<input type="password" class="form-control" name="cpassword" />
														</div>
													</div>
												</div>
												<div class="col-md-12 text-right">
													<button type="button" class="btn btn-secondary" id="cancel-renewpassword" title="Batal Ganti Passowrd">
														<i class="fas fa-ban fa-fw"></i> <span>Batal</span>
													</button>
												</div>
											</div>
<?php endif; ?>											
										</div>
										
										
										<div class="col-md-4">
											<div class="form-group">
												<label for="accesslevel">Level Akses:</label>
												<div class="input-group">
													<select name="accesslevel" class="form-control" required>
														<option disabled="disabled" selected>--- Pilih Level Akses ---</option>
<?php foreach ($mgroups as $grp): ?>
														<option value="<?php echo $grp->idx; ?>" <?php echo ($grp->idx == $ougr) ? 'selected' : '';?>><?php echo $grp->name; ?></option>
<?php endforeach; ?>
													</select>
												</div>
											</div>
											
											<div class="form-group" style="display: none;">
												<label for="accesslocation"></label>
												<div class="input-group">
													<input type="hidden" name="accesslocation" value="0" />
													<select id="accesslocation" class="form-control">
														<option disabled="disabled" selected>--- Pilih Lokasi Akses ---</option>
<?php foreach ($mlocations as $location): ?>
														<option value="<?php echo $location->idx; ?>"><?php echo $location->code . ' - ' . $location->name; ?></option>
<?php endforeach; ?>
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
								<hr />
								<div class="card-footer text-right">
									<button type="submit" class="btn btn-primary">
										<i class="fas fa-paper-plane fa-fw"></i> <span>Kirim</span>
									</button>
									<button type="reset" class="btn btn-secondary">
										<i class="fas fa-undo fa-fw"></i> <span>Reset</span>
									</button>
									<button type="button" class="btn btn-outline-danger" onclick="window.location.href='<?php echo 'users'; ?>'">
										<i class="fas fa-ban fa-fw"></i> <span>Batal</span>
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>

<?php include __DIR__ . '/../footer.php'; ?>
	<script>
	$(document).ready (function () {
		$('button').click (function ($evt) {
			$id = $(this).attr ('id');
			switch ($id) {
				default:
					break;
				case 'renew-password':
					$('div#update-password').slideDown ();
					$('input[name="change-password"]').val (1);
					break;
				case 'cancel-renewpassword':
					$('div#update-password').slideUp ();
					break;
			}
		});
		
		$('input').change (function ($evt) {
		});
		
		$('select').change (function ($evt) {
			$name = $(this).prop ('name');
			$id = $(this).attr ('id');
			switch ($id) {
				default:
					break;
				case 'accesslocation':
					$val = $(this).val ();
					$formgroup = $(this).parents ('.form-group');
					$('input[name="accesslocation"]').val ($val);
					break;
			}
			
			switch ($name) {
				default:
					break;
				case 'accesslevel':
					$val = $(this).val ();
					$formgroup = $(this).parents ('.form-group');
					if ($val > 1) $formgroup.next ().show ();
					else {
						$formgroup.next ().hide ();
						$('input[name="accesslocation"]').val (0);
					}
					break;
			}
		});
	});
	</script>

<?php include __DIR__ . '/../html-footer.php'; ?>
