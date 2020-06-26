<?php include ('html_header.php'); ?>

        <div class="container">
        	<div class="container-fluid page-body-wrapper">
        		<div class="row">
        			<div class="col-xl-6 col-lg-8 col-md-10 col-sm-12 col-xs-12 mx-auto">
        				<div class="card card-login shadow">
        					<div class="card-body">
        						<div class="row">
        							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
        								<h4 class="card-title"><?php echo isset ($text) ? $text : 'Please Login'; ?></h4>
        								<form id="form-login"
        									action="<?php echo isset ($formAction) ? $formAction : ''; ?>"
        									method="post">
        									<div class="form-group">
        										<label for="input-username"><?php echo isset ($text) ? '' : 'Username'; ?>:</label>
        										<div class="input-group">
        											<div class="input-group-prepend">
        												<span class="input-group-text"> <i class="fas fa-user fa-fw"></i>
        												</span>
        											</div>
        											<input type="text" name="input-username" class="form-control"
        												placeholder="<?php echo isset ($text) ? $text : 'e.g. john.doe or john.doe@someemail.com'; ?>"
        												required="required" />
        										</div>
        									</div>
        
        									<div class="form-group">
        										<label for="input-password"><?php echo isset ($text) ? '' : 'Password'; ?>:</label>
        										<div class="input-group">
        											<div class="input-group-prepend">
        												<span class="input-group-text"> <i class="fas fa-key fa-fw"></i>
        												</span>
        											</div>
        											<input type="password" name="input-password"
        												class="form-control"
        												placeholder="<?php echo isset ($text) ? $text : 'Type Your Password'; ?>"
        												required="required" />
        										</div>
        									</div>
        
        									<div class="row button-section">
        										<div class="col">
        											<button type="submit" class="btn btn-primary btn-block">
        												<i class="fas fa-sign-in-alt fa-fw"></i> <?php echo isset ($text) ? $text : ' Sign In'; ?>
                        										
                        									</button>
        										</div>
        
        										<div class="col">
        											<button type="reset"
        												class="btn btn-outline-secondary btn-block">
        												<i class="fas fa-undo fa-fw"></i> <?php echo isset ($text) ? $text : ' Reset'; ?>
                        									
                        									</button>
        										</div>
        									</div>
        								</form>
        							</div>
        						</div>
        						<div class="card-message text-center text-muted">
                							<?php echo isset ($text) ? $text : 'Not registered? Please contact system administrators'; ?> <a
        								href="#">here</a>
        						</div>
        					</div>
        				</div>
        			</div>
        		</div>
        	</div>
        
        	<footer class="login-footer text-center text-muted">
        		<div class="row">
        			<dic class="col text-center"> <a href="#">Help</a> </dic>
        		</div>
        
        		<div class="row" style="margin-top: 5px">
        			<div class="col text-center">
        				Copyright <i class="fas fa-copyright fa-fw"></i> <?php echo date ('Y'); ?> fmkiddo. All rights reserved.
        		 			</div>
        		</div>
        	</footer>
        </div>
<?php include ('footer.php'); ?>