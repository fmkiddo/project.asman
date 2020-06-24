<?php include ('html_header.php'); ?>

		<div class="container">
			<div class="container-fluid page-body-wrapper">
				<div class="row">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
        				<div class="card shadow">
        					<div class="card-body">
        						<h3 class="card-title text-center"><?php echo isset ($text) ? $text : 'Your Title Here'; ?></h3>
        						<div class="row">
        							<div class="col-xl-4 col-lg-4 col-md-4 form-left-side">
        							</div>
        							
        							<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
        								<form role="form" id="form-setup" method="post" action="<?php echo isset ($formAction) ? $formAction : ''; ?>">
        									<div class="form-group">
        										<label for="input-new-username">
        											<?php echo isset ($text) ? $text : 'New Username'; ?>:
        										</label>
        										<div class="input-group">
        											<div class="input-group-prepend">
        												<span class="input-group-text">
        													<i class="fas fa-user fa-fw"></i>
        												</span>
        											</div>
        											<input type="text" name="input-new-username" class="form-control" placeholder="<?php echo isset ($text) ? $text : 'e.g. johndoe123'; ?>" required="required" />
        										</div>
        									</div>
        									
        									<div class="form-group">
        										<label for="input-new-email">
        											<?php echo isset ($text) ? $text : 'Email'; ?>:
        										</label>
        										<div class="input-group">
        											<div class="input-group-prepend">
        												<span class="input-group-text">
        													<i class="fas fa-envelope fa-fw"></i>
        												</span>
        											</div>
        											<input type="email" name="input-new-email" class="form-control" placeholder="<?php echo isset ($text) ? $text : 'jhon.doe@someemail.com'?>" required="required" />
        										</div>
        									</div>
        									
        									<div class="form-group">
        										<label for="input-new-password">
        											<?php echo isset ($text) ? $text : 'Password'; ?>:
        										</label>
        										<div class="input-group">
        											<div class="input-group-prepend">
        												<span class="input-group-text">
        													<i class="fas fa-key fa-fw"></i>
        												</span>
        											</div>
        											<input type="password" name="input-new-password" class="form-control" placeholder="<?php echo isset ($text) ? $text : 'Type Your Password'; ?>" required="required" />
        										</div>
        									</div>
        									
        									<div class="form-group">
        										<label for="input-confirm-password">
        											<?php echo isset ($text) ? $text : 'Confirm Password'; ?>:
        										</label>
        										<div class="input-group">
        											<div class="input-group-prepend">
        												<span class="input-group-text">
        													<i class="fas fa-redo fa-fw"></i>
        												</span>
        											</div>
        											<input type="password" name="input-confirm-password" class="form-control" placeholder="<?php echo isset ($text) ? $text : 'Re-type Your Password'; ?>" required="required" />
        										</div>
        									</div>
        									
        									<div class="row button-section">
        										<div class="col">
        											<button type="submit" class="btn btn-primary btn-block" title="<?php echo isset ($text) ? $text : 'Submit Your Data'; ?>">
        												<i class="fas fa-check fa-fw"></i> <?php echo isset ($text) ? $text : 'Submit'; ?>
        											
        											</button>
        										</div>
        										
        										<div class="col">
        											<button type="reset" class="btn btn-outline-secondary btn-block" title="<?php echo isset ($text) ? $text : 'Reset Form'; ?>">
        												<i class="fas fa-redo fa-fw"></i> <?php echo isset ($text) ? $text : 'Reset'; ?>
        											
        											</button>
        										</div>
        									</div>
        								</form>
        							</div>
        						</div>
        						<div class="card-message text-center text-muted">
        							<?php echo isset ($text) ? $text : 'Do you have troubles? please contact administrators'; ?> <a href="#">here</a>
        						</div>
        					</div>
        				</div>
					</div>
				</div>
			</div>
			
		 	<footer class="login-footer text-center text-muted">
		 		<div class="row">
		 			<dic class="col text-center">
		 				<a href="#">Help</a>
		 			</dic>
		 		</div>
		 		
		 		<div class="row" style="margin-top: 5px">
		 			<div class="col text-center">
						Copyright <i class="fas fa-copyright fa-fw"></i> <?php echo date ('Y'); ?> fmkiddo. All rights reserved.
		 			</div>
		 		</div>
			</footer>
		</div>

<?php include ('footer.php'); ?>
