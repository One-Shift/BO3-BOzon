<form action="{c2r-bo-path}/{c2r-lg}/login/" method="post">
	<div class="spacer all-30"></div>
	{c2r-return-message}
	<div class="img">
		<img id="avatar" alt="avatar" src="https://www.gravatar.com/avatar/?s=240&r=g&d=mm" />
	</div>
	<div class="spacer all-30"></div>
	<div class="name">
		<input type="email" name="email" id="email" placeholder="{c2r-lg-email}" required="" autofocus />
	</div>
	<div class="input-group password">
		<input type="password" name="password" id="password" placeholder="{c2r-lg-password}" required="" />
		<div class="input-group-btn">
			<span onclick="seePassword()">
				<i class="fas fa-eye-slash" aria-hidden="true"></i>
			</span>
		</div>
	</div>
	<div class="spacer all-30"></div>
	<div class="xs-tacenter sm-tacenter">
		<input class="btn bo-btn-submit" type="submit" name="submit" value="Enter">
	</div>
	<div class="spacer all-30"></div>
</form>
