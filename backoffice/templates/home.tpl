<!DOCTYPE html>
<html>
	<head>
		{c2r-head}
	</head>
	<body class="grey lighten-5">
		<nav id="bo-topbar" class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle button-help" data-toggle="collapse" data-target="#myNavbar">
						<i class="fa fa-info" aria-hidden="true"></i>
					</button>
					<a id="bo-menu-button" class="navbar-brand" href="#"><i class="fa fa-bars"></i><div class="xs-block15 sm-block15 md-block15 lg-block15"></div>BO3</a>
				</div>
				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav navbar-right">
						<li class="version">
							<a>
								Version: <span>{c2r-bo3-version}</span> <span>{c2r-bo3-sub-version}</span>
							</a>
						</li>
						<li>
							<a href="http://www.one-shift.com/" title="One:Shift" target="_blank">
								<i class="fa fa-globe"></i> <span class="hidden-sm hidden-md hidden-lg">One:Shift</span>
							</a>
						</li>
						<li>
							<a href="https://github.com/One-Shift/BO3-BOzon/issues" title="Support" target="_blank">
								<i class="fa fa-question"></i> <span class="hidden-sm hidden-md hidden-lg">Support</span>
							</a>
						</li>
						<li>
							<a href="https://github.com/One-Shift/" title="Github" target="_blank">
								<i class="fa fa-code-fork"></i> <span class="hidden-sm hidden-md hidden-lg">Github</span>
							</a>
						</li>
						<li>
							<a id="logout" href="#" title="logout">
								<i class="fa fa-power-off" aria-hidden="true"></i> <span class="hidden-sm hidden-md hidden-lg">Logout</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<div id="bo-menu" class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 bo-block-list">
					<div class="container-menu">
						<div class="list-group">
							{c2r-menu}
						</div>
						<div id="bo-profile">
							<div class="row">
								<div class="col-xs-12 col-sm-12 xs-spacer15 sm-spacer15"></div>
								<div class="col-xs-3 col-sm-3 xs-tacenter sm-tacenter">
									<img src="https://www.gravatar.com/avatar/{c2r-avatar}?s=240&r=g&d=mm" alt="avatar" class="img-circle"/>
								</div>
								<div class="col-xs-9 col-sm-9">
									{c2r-username}<br>
									<small>{c2r-email}</small>
								</div>
								<div class="col-xs-12 col-sm-12 xs-spacer15 sm-spacer15"></div>
								<div id="bo-rights" class="col-xs-12 col-sm-12 text-center">
									<small>
										&copy; <a href="http://www.one-shift.com/" target="_blank">One:Shift</a>
									</small>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="bo-wrapper">
			<div class="xs-spacer60 sm-spacer60"></div>
			<div class="xs-spacer15 sm-spacer15"></div>
		</div>
		<div id="bo-container" class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<ol class="breadcrumb">
						<li><a href="{c2r-path-bo}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
						<li class="active">
							<a href="{c2r-path-bo}/{c2r-lg}/{c2r-module-folder}/">
								{c2r-mdl-name}
							</a>
						</li>
						{c2r-breadcrump}
					</ol>
				</div>
			</div>
			{c2r-module}
			{c2r-uninstall}
			<div class="xs-spacer15 sm-spacer15"></div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 sm-taright">
					<small class="grey-text">
						<a class="grey-text" href="https://one-shift.com/en/bo3-module/{c2r-mdl-official-url}#t" target="_blank">{c2r-mdl-name}</a> / version {c2r-mdl-version} / developer <a class="grey-text" href="mailto:{c2r-mdl-developer-contact}?subject={c2r-mdl-name}-v{c2r-mdl-version}">{c2r-mdl-developer}</a>
					</small>
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<div class="row">
				<iframe class="ads hidden-xs" src="https://www.nexus-pt.eu/ads.php"></iframe>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 xs-spacer15 sm-spacer15 md-spacer15 lg-spacer15"></div>
			</div>
		</div>
	</body>
</html>
