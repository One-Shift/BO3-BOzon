<!DOCTYPE html>
<html>
	<head>
		{c2r-head}
		<style media="screen">
			{c2r-custom-css}
		</style>
	</head>
	<body>
		<nav class="top-bar navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="{c2r-bo-path}/{c2r-lg}/5-home/">
				<img src="{c2r-bo-path}/site-assets/images/logo-dark.svg" class="spacer all-30" alt="bo3 bozon3">
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link" href="#">
							<i class="fas fa-bell"></i>
						</a>
					</li>
					<div class="block all-15"></div>
					<li class="nav-item">
						<a class="nav-link" href="#">
							<i class="fas fa-envelope"></i>
						</a>
					</li>
					<div class="block all-15"></div>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="menu-user" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<img src="https://www.gravatar.com/avatar/{c2r-avatar}?s=240&r=g&d=mm" class="rounded-circle" alt="">
						</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
							{c2r-dropdown-menu}
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" id="logout" href="{c2r-bo-path}/{c2r-lg}/logout/" title="logout">
								<i class="fa fa-power-off" aria-hidden="true"></i>
								<span class="block all-15"></span>
								<span>Logout</span>
							</a>
						</div>
					</li>
				</ul>
			</div>
		</nav>
		<div class="top-bar-animation"></div>
		<div class="sidebar {c2r-collapsed}">
			<div class="list-group">
				<div class="spacer all-30"></div>
				{c2r-menu}
			</div>
			<div class="spacer all-15"></div>
		</div>
		<div class="core-container {c2r-unleashed}">
			<div class="core-header">
				<div class="container-fluid">
					<div class="row">
						<div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
							<h3>{c2r-mdl-name}</h3>
						</div>
						<div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{c2r-bo-path}/{c2r-lg}/"><i class="fas fa-home"></i></a></li>
									<li class="breadcrumb-item"><a href="{c2r-bo-path}/{c2r-lg}/{c2r-module-folder}/">{c2r-mdl-name}</a></li>
									<!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
									{c2r-breadcrumb}
								</ol>
							</nav>
						</div>
					</div>
				</div>
			</div>
			<div class="core-body">
				<div class="container-fluid">
					{c2r-module}
				</div>
			</div>
			<div class="core-footer">
				<div class="container-fluid {c2r-ads-active}">
					<div class="spacer all-30"></div>
					<div class="row">
						<iframe class="ads" src="https://www.nexus-pt.eu/ads.php"></iframe>
					</div>
					<div class="spacer all-30"></div>
				</div>
				<div class="authors-bar">
					<small class="grey-text">
						<a class="grey-text" href="https://one-shift.com/en/bo3-module/{c2r-mdl-official-url}#t" target="_blank">{c2r-mdl-name}</a> / version <a href="{c2r-bo-path}/{c2r-lg}/{c2r-module-folder}/changelog/">{c2r-mdl-version}</a> / developer <a class="grey-text" href="mailto:{c2r-mdl-developer-contact}?subject={c2r-mdl-name}-v{c2r-mdl-version}">{c2r-mdl-developer}</a>
					</small>
				</div>
			</div>
		</div>
	</body>
</html>
