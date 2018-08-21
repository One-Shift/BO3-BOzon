<!DOCTYPE html>
<html>
	<head>
		{c2r-head}
		<link rel="stylesheet" href="{c2r-mod-path}/site-assets/css/style.css" media="screen" title="no title" charset="utf-8">
		<script type="text/javascript" src="{c2r-mod-path}/site-assets/js/script.js"></script>
	</head>
	<body class="login">
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="row">
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<p class="navbar-text xs-tacenter sm-tacenter">
							{c2r-lg-cookies-alert}
						</p>
					</div>
				</div>
			</div>
		</nav>
		<div class="wrapper"></div>
		<div class="container">
			<div class="row">
				<div class="col-12 col-sm-5 col-md-4 col-lg-4 col-xl-4 offset-sm-1 offset-md-2 offset-lg-2 offset-xl-2 form">
					{c2r-form}
				</div>
				<div class="col-12 col-sm-5 col-md-4 col-lg-4 col-xl-4 message">
					<div class="spacer all-60"></div>
					<p align="center"><img src="{c2r-path-bo}/site-assets/images/logo-bo3.png" alt="logotipo" width="77%" /></p>
					<div class="spacer all-60"></div>
					{c2r-lg-message}
					<div class="spacer all-60"></div>
				</div>
			</div>
		</div>
		<div class="spacer all-120"></div>
		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel">{c2r-lg-cookies-title}</h4>
					</div>
					<div class="modal-body">
						{c2r-lg-cookies-modal}
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
