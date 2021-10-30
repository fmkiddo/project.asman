<?php 
$assets = isset ($pageAssets) ? $pageAssets : [];
$isAuthenticated = $authenticated;
$signinVerifier = ($isAuthenticated) ? '' : '';
?>
<!DOCTYPE html>
<html lang="<?php echo isset ($locale) ? $locale : 'id'; ?>">
<head>
	<meta charset="<?php echo isset ($charset) ? $charset : 'utf-8'; ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title></title>
	<link rel="stylesheet" href="https://demos.creative-tim.com/now-ui-dashboard/assets/demo/demo.css" />
<?php foreach ($assets->getStyles () as $asset): ?>
	<link rel="stylesheet" href="<?php $asset->print (); ?>" />
<?php endforeach; ?>
</head>
<body class="bg-light">
	<div class="container h-100">
		<div class="row h-100 justify-content-center align-items-center">
			<div class="col-md-6">
				<div class="card shadow border">
					<div class="card-header">
						<div class="d-flex justify-content-center pt-5">
							<div class="logo">
								<img src="<?php echo base_url('assets/web/css/images/logo-primary.png'); ?>" alt="Logo Jodamo" />
								<span></span>
							</div>
						</div>
					</div>
					<div class="card-body login-body mx-5">
						<div id="card-slider" class="carousel slide" data-interval="false" data-wrap="false">
							<div class="carousel-inner">
<?php if (!$isAuthenticated): ?>
								<div class="carousel-item active">
									<div class="d-flex justify-content-center">
										<h4 data-smarty="{0}"></h4>
									</div>
									<div class="d-flex justify-content-center">
										<span data-smarty="{1}"></span>
									</div>
									<div class="form-content">
										<form role="form" id="client-auth" action="javascript:void(0)">
											<div class="form-group">
												<label for="client-auth" data-smarty="{2}"></label>
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text">
															<i class="fas fa-landmark fa-fw"></i>
														</div>
													</div>
													<input type="password" id="client-auth" class="form-control" name="client-auth" required />
												</div>
											</div>
											<div class="form-group">
												<label for="client-pass" data-smarty="{19}"></label>
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text">
															<i class="fas fa-lock fa-fw"></i>
														</div>
													</div>
													<input type="password" id="client-pass" class="form-control" name="client-pass" required />
												</div>
											</div>
											<a class="forget" onclick="window.location.href='forgot-authentication'">
												<span data-smarty="{3}"></span><span>?</span>
											</a>
											<div class="text-right">
												<button type="submit" id="dosubmit-auth" class="hidden"></button>
												<button type="button" id="submit-auth" class="btn btn-primary" data-smarty="{4}">
													<i class="fas fa-paper-plane fa-fw"></i>
													<span data-smarty="{4}"></span>
												</button>
											</div>
										</form>
									</div>
								</div>
<?php endif; ?>
								<div class="carousel-item <?php echo ($isAuthenticated) ? 'active' : ''; ?>">
									<div class="d-flex justify-content-center">
										<h4 data-smarty="{5}" id="login-title"></h4>
										<h4 id="login-name" class="hidden"><span data-smarty="{18}"></span><span id="login-name"></span></h4>
									</div>
									<div class="d-flex justify-content-center">
										<span data-smarty="{6}" id="welcome-message"></span>
										<span class="hidden" id="login-message"></span>
									</div>
									<div class="form-content">
										<form role="form" id="form-login" action="javascript:void(0)">
											<input type="hidden" id="userVerifier" name="userVerifier" value="" />
											<div id="login-carousel" class="carousel slide" data-interval="false" data-wrap="false">
												<div class="carousel-inner">
													<div class="carousel-item active">
														<div class="form-group">
															<label for="username" data-smarty="{7}"></label>
															<div class="input-group">
																<div class="input-group-prepend">
																	<div class="input-group-text">
																		<i class="fas fa-user fa-fw"></i>
																	</div>
																</div>
																<input type="text" class="form-control" id="input-username" name="username" required />
															</div>
														</div>
														<a class="forget" onclick="window.location.href='forgot?tag=username'">
															<span data-smarty="{8}"></span><span>?</span>
														</a>
														<div class="d-flex justify-content-between">
															<button type="button" class="btn btn-link" id="account-create" data-smarty="{9}">
																<span data-smarty="{10}"></span>
															</button>
															<button type="button" class="btn btn-info" id="account-next" data-smarty="{11}">
																<span data-smarty="{12}"></span>
																<i class="fas fa-caret-right fa-fw"></i>
															</button>
														</div>
													</div>
													<div class="carousel-item">
														<div class="form-group">
															<label for="password" data-smarty="{13}"></label>
															<div class="input-group">
																<div class="input-group-prepend">
																	<div class="input-group-text">
																		<i class="fas fa-key fa-fw"></i>
																	</div>
																</div>
																<input type="password" class="form-control" id="input-password" name="password" required />
															</div>
														</div>
														<a class="forget" onclick="window.location.href='forgot?tag=password'">
															<span data-smarty="{14}"></span><span>?</span>
														</a>
														<div class="d-flex justify-content-between">
															<button type="button" class="btn btn-secondary" id="account-back" data-smarty="{15}">
																<i class="fas fa-caret-left fa-fw"></i>
																<span data-smarty="{16}"></span>
															</button>
															<button type="submit" class="btn btn-info" id="account-submit" data-smarty="{17}">
																<span data-smarty="{5}"></span>
																<i class="fas fa-sign-in-alt fa-fw"></i>
															</button>
														</div>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<div class="d-flex justify-content-center my-3">
							<span class="copyright">Copyright &copy; <?php echo date ('Y'); ?> Jodamo Exchange</span>
						</div>
					</div>
				</div>
				<div></div>
			</div>
		</div>
	</div>
<?php foreach ($assets->getScripts () as $script): ?>
	<script src="<?php echo $script->print (); ?>"></script>
<?php endforeach; ?>
</body>
</html>