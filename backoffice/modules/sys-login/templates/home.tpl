<!DOCTYPE html>
<html>
	<head>
		{c2r-head}
		<link rel="stylesheet" href="{c2r-mod-path}/site-assets/css/style.css" media="screen" title="no title" charset="utf-8">
		<script type="text/javascript" src="{c2r-mod-path}/site-assets/js/script.js"></script>
	</head>
	<body class="login">
		<div class="spacer sm-30"></div>
		<div class="container form_login">
			<div class="row">
				<div class="col-sm-4 offset-sm-4 sm-tacenter">
					<div class="row">
						<div class="col-sm-10 offset-sm-1">
							<form method="post" action="{c2r-bo-path}/{c2r-lg}/login/">
								{c2r-message}
								<div class="img">
									<img class="avatar img-circle sm-block120" alt="avatar" src="https://www.gravatar.com/avatar/d41d8cd98f00b204e9800998ecf8427e?s=120&amp;r=g&amp;d=mm">
								</div>
								<div class="spacer sm-60"></div>
								<div class="form-group">
									<label for="login-input-email">Email address</label>
									<input type="email" name="input-email" class="form-control sm-tacenter" id="login-input-email" placeholder="" autofocus>
								</div>
								<div class="spacer sm-30"></div>
								<div class="form-group">
									<label for="login-input-password">Password</label>
									<input type="password" name="input-password" class="form-control sm-tacenter" id="login-input-password" placeholder="">
								</div>
								<div class="spacer sm-60"></div>
								<button name="input-submit" type="submit" class="btn btn-default btn-block">
									<span>Login</span>
								</button>
							</form>
							<div class="spacer sm-90"></div>
							<p>Don't have an account? <a class="a_signup" href="{c2r-bo-path}/{c2r-lg}/login/register/">Sign up</a></p>
							<div class="spacer sm-30"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="spacer sm-15"></div>
	</body>
</html>
