<?php include 'html-header.php'; ?>
	
	<div class="wrapper">
		<div class="sidebar" data-color="orange">
			<div class="logo">
			</div>
			
			<div class="sidebar-wrapper" id="sidebar-wrapper">
				<ul class="nav">
					<li class="nav-item">
						<a class="nav-link" onclick="window.location.href='index'">
							<i class="fas fa-tachometer-alt fa-fw"></i> <span>Dashboard</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link collapsed" data-toggle="collapse" data-target="#mlocsub" aria-expanded="false" aria-controls="mlocsub">
							<i class="fas fa-database fa-fw"></i> <span>Master</span>
						</a>
						<div id="mlocsub" class="collapse" data-parent="#sidebar-wrapper" aria-labelledby="headingMloc">
							<div class="bg-white py-2 collapse-inner rounded">
								<h6 class="collapse-header">Master Menu</h6>
								<a class="collapse-item" onclick="window.location.href='master-categories'">Kategori Aset</a>
								<a class="collapse-item" onclick="window.location.href='master-loanee'">Penerima</a>
								<hr class="collapse-separator" />
								<a class="collapse-item" onclick="window.location.href='master-imports'">Import Data</a>
							</div>
						</div>
					</li>
					<li class="nav-item">
						<a class="nav-link" onclick="window.location.href='location'">
							<i class="fas fa-landmark fa-fw"></i> <span>Location</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link collapsed" data-toggle="collapse" data-target="#asset" aria-expanded="false" aria-controls="asset">
							<i class="fas fa-barcode fa-fw"></i> <span>Aset</span>
						</a>
						<div  id="asset" class="collapse" data-parent="#sidebar-wrapper" aria-labelledby="headingAsset">
							<div class="bg-white py-2 collapse-inner rounded">
								<h6 class="collapse-header">Master Data Aset</h6>
								<a class="collapse-item" onclick="window.location.href='master-assets'">Daftar Aset</a>
								<a class="collapse-item" onclick="window.location.href='new-asset'">Register Aset Baru</a>
								<a class="collapse-item" onclick="window.location.href='doc-assetreq'">Permintaan Aset</a>
								<hr class="collapse-separator" />
								<h6 class="collapse-header">Mutasi Aset</h6>
								<a class="collapse-item" onclick="window.location.href='doc-assetin'">Penerimaan Aset</a>
								<a class="collapse-item" onclick="window.location.href='doc-assetout'">Perpindahan Aset</a>
								<hr class="collapse-separator" />
								<a class="collapse-item" onclick="window.location.href='doc-removal'">Pemusnahan</a>
							</div>
						</div>
					</li>
					<li class="nav-item">
						<a class="nav-link collapsed" data-toggle="collapse" data-target="#manuser" aria-expanded="false" aria-controls="manuser">
							<i class="fas fa-users fa-fw"></i> <span>Pengguna</span>
						</a>
						<div id="manuser" class="collapse" data-parent="#sidebar-wrapper" aria-labelledby="headingManuser">
							<div class="bg-white py-2 collapse-inner rounded">
								<h6 class="collapse-header">Pengguna</h6>
								<a class="collapse-item" onclick="window.location.href='users'">
									<i class="fas fa-id-card fa-fw"></i> <span>Pengguna</span>
								</a>
								<a class="collapse-item" onclick="window.location.href='groups'">
									<i class="fas fa-users fa-fw"></i> <span>Grup</span>
								</a>
							</div>
						</div>
					</li>
					<li class="nav-item">
						<a class="nav-link collapsed" data-toggle="collapse" data-target="#usersub" aria-expanded="false" aria-controls="usersub">
							<i class="fas fa-cogs fa-fw"></i> <span>User Settings</span>
						</a>
						<div id="usersub" class="collapse" data-parent="#sidebar-wrapper" aria-labelledby="headingUser">
							<div class="bg-white py-2 collapse-inner rounded">
								<h6 class="collapse-header">Your Settings</h6>
								<a class="collapse-item" onclick="window.location.href='user-profile'">
									<i class="fas fa-user fa-fw"></i> <span>Profile</span>
								</a>
								<a class="collapse-item" onclick="window.location.href='user-settings'">
									<i class="fas fa-cog fa-fw"></i> <span>Settings</span>
								</a>
							</div>
						</div>
					</li>
					<li class="nav-item">
						<a class="nav-link" onclick="window.location.href='file-manager'">
							<i class="fas fa-file-image fa-fw"></i> <span>Pengelola File</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" onclick="window.location.href='logout'">
							<i class="fas fa-sign-out-alt fa-fw"></i> <span>Logout</span>
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
									<h4 class="dropdown-header">Messages Center</h4>
									<a class="dropdown-item d-flex align-items-center"></a>
									<a class="dropdown-item d-flex align-items-center"></a>
									<a class="dropdown-item d-flex align-items-center"></a>
									<a class="dropdown-item d-flex align-items-center">
										<i class="fas fa-eye fa-fw"></i> See all messages
									</a>
								</div>
							</li>
							<li class="nav-item dropdown">
								<a id="notification" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fas fa-bell fa-fw"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right bg-primary" aria-labelledby="notification">
									<h4 class="dropdown-header">Notifications Center</h4>
									<a class="dropdown-item d-flex align-items-center"></a>
									<a class="dropdown-item d-flex align-items-center"></a>
									<a class="dropdown-item d-flex align-items-center"></a>
									<a class="dropdown-item d-flex align-items-center">
										<i class="fas fa-bell fa-fw"></i> See all notification
									</a>
								</div>
							</li>
							<li class="nav-item dropdown">
								<a id="user-dropdown" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fa fa-user fa-fw"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right bg-primary" aria-labelledby="user-dropdown">
									<a class="dropdown-item d-flex align-items-center"></a>
									<a class="dropdown-item d-flex align-items-center"></a>
									<a class="dropdown-item d-flex align-items-center"></a>
									<a class="dropdown-item d-flex align-items-center">
										<i class="fas fa-sign-out-alt fa-fw"></i> <span></span>
									</a>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</nav>
			<div class="panel-header panel-header-sm"></div>
			<div class="content">
