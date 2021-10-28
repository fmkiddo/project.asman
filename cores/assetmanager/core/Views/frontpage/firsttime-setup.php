<?php
$assets = isset ($pageAssets) ? $pageAssets : '';
?>
<!DOCTYPE html>
<html lang = "<?php echo $locale ? $locale : 'id'; ?>">
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
<body class="bg-info">
	<div class="container h-100">
		<div class="row h-100 justify-content-center align-items-center">
			<div class="col">
				<div class="card">
					<div class="card-header">
						<div class="d-flex justify-content-center">
							<div class="logo">
								<img src="<?php echo base_url('assets/web/css/images/logo-primary.png'); ?>" alt="Logo Jodamo" />
								<span></span>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="d-flex justify-content-center">
							<h3 data-smarty="{0}"></h3>
						</div>
						<div class="d-flex justify-content-center">
							<span data-smarty="{1}"></span>
						</div>
						<div class="d-flex justify-content-center">
							<span data-smarty="{2}"></span>
						</div>
						<hr />
						<div class="form-content">
							<div id="card-slider" class="carousel slide" data-interval="false" data-wrap="false">
								<div class="carousel-inner">
									<div class="carousel-item active">
										<div class="d-flex justify-content-center">
											<button type="button" class="btn btn-primary" id="to-firstform" data-smarty="{3}">
												<span data-smarty="{4}"></span>
											</button>
										</div>
									</div>
									<form role="form" action="javascript:void(0)">
										<div class="carousel-item">
											<div class="d-flex justify-content-center">
												<div class="w-50" id="first-form">
													<div class="text-center">
														<span data-smarty="{5}"></span>
													</div>
													<div class="form-group">
														<label for="username" data-smarty="{6}"></label>
														<div class="input-group">
															<div class="input-group-prepend">
																<span class="input-group-text">
																	<i class="fas fa-user fa-fw"></i>
																</span>
															</div>
															<input type="text" name="username" class="form-control" data-smarty="{7}" required />
														</div>
													</div>
													<div class="form-group">
														<label for="email" data-smarty="{8}"></label>
														<div class="input-group">
															<div class="input-group-prepend">
																<span class="input-group-text">
																	<i class="fas fa-envelope fa-fw"></i>
																</span>
															</div>
															<input type="email" name="email" class="form-control" data-smarty="{9}" required />
														</div>
													</div>
													<div class="d-flex justify-content-between">
														<button type="button" class="btn btn-secondary" id="reset-firstform" data-smarty="{10}">
															<span data-smarty="{11}"></span>
														</button>
														<button type="button" class="btn btn-primary" id="to-secondform" data-smarty="{12}">
															<span data-smarty="{13}"></span>
														</button>
													</div>
												</div>
											</div>
										</div>
										<div class="carousel-item">
											<div class="d-flex justify-content-center">
												<div class="w-50" id="second-form">
													<div class="text-center">
														<span data-smarty="{14}"></span>,&nbsp;<span id="entry-username"></span>.&nbsp;<span data-smarty="{15}"></span>
													</div>
													<div class="form-group">
														<label for="entry-password" data-smarty="{16}"></label>
														<div class="input-group">
															<div class="input-group-prepend">
																<span class="input-group-text">
																	<i class="fas fa-key fa-fw"></i>
																</span>
															</div>
															<input type="password" name="entry-password" class="form-control" required />
														</div>
													</div>
													<div class="form-group">
														<label for="confirm-password" data-smarty="{17}"></label>
														<div class="input-group">
															<div class="input-group-prepend">
																<span class="input-group-text">
																	<i class="fas fa-key fa-fw"></i>
																</span>
															</div>
															<input type="password" name="confirm-password" class="form-control" required />
														</div>
													</div>
													<div class="d-flex justify-content-between">
														<button type="button" class="btn btn-secondary" id="backto-firstform" data-smarty="{18}">
															<span data-smarty="{19}"></span>
														</button>
														<button type="button" class="btn btn-secondary" id="reset-secondform" data-smarty="{10}">
															<span data-smarty="{11}"></span>
														</button>
														<button type="button" class="btn btn-primary" id="to-profileform" data-smarty="{12}">
															<span data-smarty="{13}"></span>
														</button>
													</div>
												</div>
											</div>
										</div>
										<div class="carousel-item">
											<div class="d-flex justify-content-center">
												<div class="w-50" id="profile-form">
													<div class="text-center">
														<span id="entry-username"></span>, <span data-smarty="{20}"></span>
													</div>
													<div class="form-group">
														<label for="first-name" data-smarty="{21}"></label>
														<div class="input-group">
															<input type="text" name="first-name" class="form-control" data-smarty="{22}">
														</div>
													</div>
													<div class="form-group">
														<label for="middle-name" data-smarty="{23}"></label>
														<div class="input-group">
															<input type="text" name="middle-name" class="form-control" data-smarty="{24}">
														</div>
													</div>
													<div class="form-group">
														<label for="last-name" data-smarty="{25}"></label>
														<div class="input-group">
															<input type="text" name="last-name" class="form-control" data-smarty="{26}">
														</div>
													</div>
													<div class="form-group">
														<label for="address-primary" data-smarty="{27}"></label>
														<div class="input-group">
															<textarea name="address-primary" class="form-control" rows="1" data-smarty="{28}"></textarea>
														</div>
													</div>
													<div class="form-group">
														<label for="address-secondary" data-smarty="{29}"></label>
														<div class="input-group">
															<textarea name="address-secondary" class="form-control" rows="1" data-smarty="{30}"></textarea>
														</div>
													</div>
													<div class="form-group">
														<label for="phone-num" data-smarty="{31}"></label>
														<div class="input-group">
															<input type="text" name="phone-num" class="form-control" data-smarty="{32}">
														</div>
													</div>
													<div class="d-flex justify-content-between">
														<button type="button" class="btn btn-secondary" id="backto-secondform" data-smarty="{18}">
															<span data-smarty="{19}"></span>
														</button>
														<button type="button" class="btn btn-secondary" id="reset-profileform" data-smarty="{10}">
															<span data-smarty="{11}"></span>
														</button>
														<button type="button" class="btn btn-primary" id="to-summarypage" data-smarty="{33}">
															<span data-smarty="{13}"></span>
														</button>
													</div>
												</div>
											</div>
										</div>
										<div class="carousel-item">
											<div class="d-flex justify-content-center">
												<div class="w-50" id="summary-page">
													<div class="summary-content">
														<div class="carousel slide" id="summary-slider" data-interval="false" data-wrap="false">
															<ol class="carousel-indicators">
																<li data-target="#summary-slider" data-slide-to="0" class="active" style="background-color: red;"></li>
																<li data-target="#summary-slider" data-slide-to="1" style="background-color: red;"></li>
															</ol>
															<div class="carousel-inner">
																<div class="carousel-item active">
																	<div class="text-center">
																		<h4 data-smarty="{34}"></h4>
																	</div>
																	<table class="table table-hover" width="100%">
																		<tbody>
																			<tr>
																				<td data-smarty="{6}"></td><td>:</td><td id="username"></td>
																			<tr>
																			<tr>
																				<td data-smarty="{8}"></td><td>:</td><td id="email"></td>
																			<tr>
																			<tr>
																				<td data-smarty="{16}"></td><td>:</td><td id="password"></td>
																			<tr>
																		</tbody>
																	</table>
																</div>
																
																<div class="carousel-item">
																	<div class="text-center">
																		<h4 data-smarty="{35}"></h4>
																	</div>
																	<table class="table table-hover" width="100%">
																		<tbody>
																			<tr>
																				<td data-smarty="{21}"></td><td>:</td><td id="first-name"></td>
																			</tr>
																			<tr>
																				<td data-smarty="{23}"></td><td>:</td><td id="middle-name"></td>
																			</tr>
																			<tr>
																				<td data-smarty="{25}"></td><td>:</td><td id="last-name"></td>
																			</tr>
																			<tr>
																				<td data-smarty="{27}"></td><td>:</td><td id="address-primary"></td>
																			</tr>
																			<tr>
																				<td data-smarty="{29}"></td><td>:</td><td id="address-secondary"></td>
																			</tr>
																			<tr>
																				<td data-smarty="{31}"></td><td>:</td><td id="phone-num"></td>
																			</tr>
																		</tbody>
																	</table>
																</div>
															</div>
														</div>
													</div>
													<div class="d-flex justify-content-between">
														<button type="button" class="btn btn-secondary" id="backto-profileform" data-smarty="{18}">
															<span data-smarty="{19}"></span>
														</button>
														<button type="reset" class="btn btn-warning" id="resetand-tofirstform" data-smarty="{36}">
															<i class="fas fa-undo fa-fw"></i> <span data-smarty="{37}"></span>
														</button>
														<button type="submit" class="btn btn-primary" id="submit-form" data-smarty="{38}">
															<i class="fas fa-paper-plane fa-fw"></i> <span data-smarty="{39}"></span>
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
					<div class="card-footer">
						<div class="d-flex justify-content-center">
							Copyright &copy; - Rizcky Nuzul Ardhy - <?php echo date ('Y'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php foreach ($assets->getScripts () as $script): ?>
	<script src="<?php echo $script->print (); ?>"></script>
<?php endforeach; ?>
</body>
</html>