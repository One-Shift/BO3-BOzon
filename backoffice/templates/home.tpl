<!DOCTYPE html>
<html>
	<head>
		{c2r-head}
	</head>
	<body>
		<nav id="bo-topbar" class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a id="bo-menu-button" class="navbar-brand" href="#"><i class="fa fa-bars"></i><div class="mb-block15 block15"></div>BO3</a>
				</div>
				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="http://www.one-shift.com/" title="One:Shift" target="_blank"><i class="fa fa-globe"></i> <span class="hidden-sm hidden-md hidden-lg">One:Shift</span></a></li>
						<li><a href="https://github.com/One-Shift/BO3-BOzon/issues" title="Support" target="_blank"><i class="fa fa-question"></i> <span class="hidden-sm hidden-md hidden-lg">Support</span></a></li>
						<li><a href="https://github.com/One-Shift/" title="Github" target="_blank"><i class="fa fa-code-fork"></i> <span class="hidden-sm hidden-md hidden-lg">Github</span></a></li>
						<li><a id="logout" href="#" title="logout"><i class="fa fa-power-off" aria-hidden="true"></i> <span class="hidden-sm hidden-md hidden-lg">Logout</span></a></li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<br/><br/><br/><br/>
				</div>
			</div>
		</div>
		<div id="bo-menu" class="container">
			<div class="row">
				<div id="profile" class="col-md-12" style="background-image: url('{c2r-background}');">
					<img src="http://www.gravatar.com/avatar/{c2r-avatar}?s=240&r=g&d=mm" alt="avatar" />
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 bo-block-list">
					<div class="list-group">
						{c2r-menu}
					</div>
				</div>
			</div>
		</div>
		<div id="bo-container" class="container">
			<div class="row">
				<div class="col-md-12">
					<ol class="breadcrumb">
						<li><a href="{c2r-path-bo}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
						<li class="active">
							<a href="{c2r-path-bo}/0/pt/{c2r-module-name}/">
								{c2r-module-name}
							</a>
						</li>
						{c2r-breadcrump}
					</ol>
				</div>
			</div>
			{c2r-module}
			{c2r-uninstall}
		</div>
		<div class="container-fluid">
			<div class="row">
				<iframe class="ads hidden-xs" src="http://www.nexus-pt.eu/ads.php"></iframe>
			</div>
			<div class="row">
				<div class="col-md-12"><br/></div>
			</div>
		</div>
	</body>
</html>
