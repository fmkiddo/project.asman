<?php include 'html-header.php'; 
$buildMenu = isset ($menus);
?>
	
	<div class="wrapper">
		<div class="sidebar" data-color="orange">
			<div class="logo">
			</div>
			
			<div class="sidebar-wrapper" id="sidebar-wrapper">
				<ul class="nav">
					<li class="nav-item">
						<a class="nav-link" onclick="window.location.href='index'">
							<i class="fas fa-tachometer-alt fa-fw"></i> <span data-headsmarty="{0}"></span>
						</a>
					</li>
<?php if ($buildMenu): 
echo $menus;
else:
?>
					<li class="nav-item">
						<a class="nav-link collapsed" data-toggle="collapse" data-target="#mdataasset" aria-expanded="false" aria-controls="mdataasset">
							<i class="fas fa-database fa-fw"></i> <span class="collapse-parentmenu" data-headsmarty="{1}"></span>
						</a>
						<div id="mdataasset" class="collapse" data-parent="#sidebar-wrapper" aria-labelledby="heading-masset">
							<div class="bg-white py-2 collapse-inner rounded">
								<h6 class="collapse-header" data-headsmarty="{2}"></h6>
								<a class="collapse-item" onclick="window.location.href='master-assets'" data-headsmarty="{3}"></a>
								<a class="collapse-item" onclick="window.location.href='new-asset'" data-headsmarty="{4}"></a>
								<a class="collapse-item" onclick="window.location.href='master-categories'" data-headsmarty="{5}"></a>
								<hr class="collapse-separator" />
								<h6 class="collapse-header" data-headsmarty="{6}"></h6>
								<a class="collapse-item" onclick="window.location.href='doc-assetreq'" data-headsmarty="{7}"></a>
								<hr class="collapse-separator" />
								<h6 class="collapse-header" data-headsmarty="{8}"></h6>
								<a class="collapse-item" onclick="window.location.href='doc-assetout'" data-headsmarty="{9}"></a>
								<a class="collapse-item" onclick="window.location.href='doc-assetin'" data-headsmarty="{10}"></a>
								<a class="collapse-item" onclick="window.location.href='doc-removal'" data-headsmarty="{11}"></a>
							</div>
						</div>
					</li>
					<li class="nav-item">
						<a class="nav-link" onclick="window.location.href='location'">
							<i class="fas fa-landmark fa-fw"></i> <span data-headsmarty="{14}"></span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link collapsed" data-toggle="collapse" data-target="#mdatauser" aria-expanded="false" aria-controls="mdatauser">
							<i class="fas fa-users fa-fw"></i> <span data-headsmarty="{15}"></span>
						</a>
						<div id="mdatauser" class="collapse" data-parent="#sidebar-wrapper" aria-labelledby="heading-muser">
							<div class="bg-white py-2 collapse-inner rounded">
								<h6 class="collapse-header" data-headsmarty="{16}"></h6>
								<a class="collapse-item" onclick="window.location.href='users'" data-headsmarty="{17}"></a>
								<a class="collapse-item" onclick="window.location.href='masteruser-newform'" data-headsmarty="{18}"></a>
								<hr class="collapse-separator" />
								<h6 class="collapse-header" data-headsmarty="{19}"></h6>
								<a class="collapse-item" onclick="window.location.href='groups'" data-headsmarty="{20}"></a>
								<a class="collapse-item" onclick="window.location.href='usergroups-formnew'" data-headsmarty="{21}"></a>
 							</div>
						</div>
					</li>
					<li class="nav-item">
						<a class="nav-link" onclick="window.location.href='file-manager'">
							<i class="fas fa-archive fa-fw"></i> <span data-headsmarty="{22}"></span>
						</a>
					</li>
<?php endif; ?>
					<li class="nav-item">
						<a class="nav-link collapsed" data-toggle="collapse" data-target="#user-settings" aria-expanded="false" aria-controls="user-settings">
							<i class="fas fa-cogs fa-fw"></i> <span data-headsmarty="{24}"></span>
						</a>
						<div id="user-settings" class="collapse" data-parent="#sidebar-wrapper" aria-labelledby="heading-usersetting">
							<div class="bg-white py-2 collapse-inner rounded">
								<h6 class="collapse-header" data-headsmarty="{25}"></h6>
								<a class="collapse-item" onclick="window.location.href='user-profile'">
									<i class="fas fa-user fa-fw"></i> <span data-headsmarty="{26}"></span>
								</a>
								<a class="collapse-item" onclick="window.location.href='user-settings'">
									<i class="fas fa-cog fa-fw"></i> <span data-headsmarty="{27}"></span>
								</a>
							</div>
						</div>
					</li>
					<li class="nav-item">
						<a class="nav-link" onclick="window.location.href='logout'">
							<i class="fas fa-sign-out-alt fa-fw"></i> <span data-headsmarty="{28}"></span>
						</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="main-panel">
			<nav class="navbar navbar-expand-lg navbar-transparent bg-primary navbar-absolute">
				<div class="container-fluid">
					<div class="navbar-wrapper">
						<div class="navbar-toggle">
							<button type="button" class="navbar-toggler">
								<span class="navbar-toggler-bar bar1"></span>
								<span class="navbar-toggler-bar bar2"></span>
								<span class="navbar-toggler-bar bar3"></span>
							</button>
						</div>
						<a class="navbar-brand" href="#fmkiddo"></a>	
					</div>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-bar navbar-kebab"></span>
						<span class="navbar-toggler-bar navbar-kebab"></span>
						<span class="navbar-toggler-bar navbar-kebab"></span>
					</button>
					<div id="navigation" class="navbar-collapse justify-content-end collapse">
						<ul class="navbar-nav">
							<li class="nav-item dropdown">
								<a id="messages" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fas fa-envelope fa-fw"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right bg-primary" aria-labelledby="messages">
									<h4 class="dropdown-header" data-headsmarty="{29}"></h4>
<?php if (count ($messages) == 0): ?>
									<div class="dropdown-item d-flex align-items-center py-4">
										<i class="fas fa-comment-slash fa-fw"></i> <span class="ml-2" data-headsmarty="{33}"></span>
									</div>
<?php else: ?>
<?php endif; ?>
									<a class="dropdown-item d-flex align-items-center">
										<i class="fas fa-comments fa-fw"></i> <span class="ml-2" data-headsmarty="{30}"></span>
									</a>
								</div>
							</li>
							<li class="nav-item dropdown">
								<a id="notification" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fas fa-bell fa-fw"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right bg-primary" aria-labelledby="notification">
									<h4 class="dropdown-header" data-headsmarty="{31}"></h4>
<?php if (count ($notifs) == 0): ?>
									<div class="dropdown-item d-flex align-items-center py-4">
										<i class="fas fa-bell-slash fa-fw"></i> <span class="ml-2" data-headsmarty="{34}"></span>
									</div>
<?php else: ?>
<?php endif; ?>
									<a class="dropdown-item d-flex align-items-center">
										<i class="fas fa-bell fa-fw"></i> <span class="ml-2" data-headsmarty="{32}"></span>
									</a>
								</div>
							</li>
							<li class="nav-item dropdown">
								<a id="user-dropdown" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fa fa-user fa-fw"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right bg-primary" aria-labelledby="user-dropdown">
									<a class="dropdown-item d-flex align-items-center" onclick="window.location.href='user-profile'">
										<i class="fas fa-id-card fa-fw"></i> <span class="ml-2" data-headsmarty="{26}"></span>
									</a>
									<a class="dropdown-item d-flex align-items-center" onclick="window.location.href='user-settings'">
										<i class="fas fa-cog fa-fw"></i> <span class="ml-2" data-headsmarty="{25}"></span>
									</a>
									<a class="dropdown-item d-flex align-items-center" onclick="window.location.href='about'">
										<i class="fas fa-info-circle fa-fw"></i> <span class="ml-2" data-headsmarty="{37}"></span>
									</a>
									<a class="dropdown-item d-flex align-items-center" onclick="window.location.href='logout'">
										<i class="fas fa-sign-out-alt fa-fw"></i> <span class="ml-2" data-headsmarty="{28}"></span>
									</a>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</nav>
			<div class="panel-header panel-header-sm"></div>
			<div class="content">
