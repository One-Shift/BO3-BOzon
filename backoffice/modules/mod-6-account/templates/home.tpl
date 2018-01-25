{c2r-return-message}

<!-- User Info  -->
<div class="spacer30 mb-xs-spacer15 sm-spacer15"></div>
<div id="info" class="row">
	<div class="hidden-xs col-sm-3 col-md-3 col-lg-3 xs-tacenter sm-tacenter">
		<img src="http://www.gravatar.com/avatar/{c2r-md5-email}?s=150&r=g&d=mm" class="img-circle" alt="gravatar" title="gravatar">
	</div>
	<div class="col-xs-4 col-sm-3 col-md-3 col-lg-3">
		<h4>{c2r-lg-username}</h4>
		<p>{c2r-username}</p>
		<div class="xs-spacer15 sm-spacer15"></div>
		<h4>{c2r-lg-email}</h4>
		<p>{c2r-email}</p>
	</div>
	<div class="col-xs-4 col-sm-3 col-md-3 col-lg-3">
		<h4>{c2r-lg-rank}</h4>
		<p>{c2r-rank}</p>
		<div class="xs-spacer15 sm-spacer15"></div>
		<h4>{c2r-lg-date}</h4>
		<p>{c2r-date}</p>
	</div>
	<div class="col-xs-4 col-sm-3 col-md-3 col-lg-3"></div>
</div>
<div class="xs-spacer30 sm-spacer30"></div>

<!-- Form -->

<form method="post" action="{c2r-path-bo}/{c2r-lg}/6-account/">
<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<div class="form-group">
			<label for="formGroupExampleInput">{c2r-lg-password}</label>
			<input type="password" class="form-control" id="oldpassword" placeholder="Type your old password" name="oldPassword">
		</div>
		<div class="form-group">
			<input type="password" class="form-control" id="newpassword" placeholder="Type your new password" name="newPassword">
		</div>
		<div class="form-group">
			<input type="password" class="form-control" id="check" placeholder="Confirm your password" name="checkPassword">
		</div>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<div class="form-group">
			<label for="formGroupExampleInput2">{c2r-lg-email-change}</label>
			<input type="text" class="form-control" id="email" placeholder="Input your new email" name="email">
		</div>
		<div class="form-group">
			<input type="text" class="form-control" id="checkemail" placeholder="Confirm your new email" name="checkemail">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<div>
			<a href="{c2r-path-bo}/{c2r-lg}/home/" role="button" class="btn btn-cancel pull-right"><i class="fa fa-times" aria-hidden="true"></i><div class="xs-block15 sm-block15"></div> {c2r-lg-cancel}</a>
		</div>
		<div class="xs-spacer15 sm-spacer15 xs-block15 sm-block15 pull-right"></div>
		<div>
			<button type="submit" class="btn btn-save pull-right" name="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i><div class="xs-block15 sm-block15"></div> {c2r-lg-save}</button>
		</div>

		<div class="xs-spacer30 sm-spacer60"></div>
	</div>
</div>
</form>
