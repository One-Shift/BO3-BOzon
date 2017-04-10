<!DOCTYPE html>
<html>
	<head>
		{c2r-head}
        <link rel="stylesheet" href="{c2r-mod-path}/site-assets/css/style.css" media="screen" title="no title" charset="utf-8">
	</head>
	<body class="login" style="background-image: url({c2r-background});">
        <nav class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<p class="navbar-text mb-tacenter tacenter">
							{c2r-lg-cookies-alert}
						</p>
					</div>
				</div>
			</div>
		</nav>
		<div class="wrapper hidden-xs"></div>
		<div class="mb-spacer120"></div>
		<div class="container-fluid">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-5 col-md-3 col-sm-offset-1 col-md-offset-2 form">
                        {c2r-form}
					</div>
					<div class="col-xs-12 hidden-sm hidden-md hidden-lg mb-spacer15">

					</div>
					<div class="col-xs-12 col-sm-4 col-md-3 col-sm-offset-1 col-md-offset-2 message">
						<div class="spacer30"></div>
						<div class="mb-spacer30"></div>
						<p align="center"><img src="{c2r-path-bo}/site-assets/images/logo-bo3.png" alt="logotipo" width="80%" /></p>
						<div class="spacer30"></div>
						{c2r-lg-message}
						<div class="spacer30"></div>
						<div class="mb-spacer30"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="mb-spacer120"></div>
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
