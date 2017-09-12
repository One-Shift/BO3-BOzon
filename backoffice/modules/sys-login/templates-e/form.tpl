<form action="{c2r-path-bo}/{c2r-lg}/login/" method="post">
	<div class="xs-spacer30 sm-spacer30"></div>
	{c2r-return-message}
	<div class="img">
		<img id="avatar" alt="avatar" src="https://www.gravatar.com/avatar/?s=240&r=g&d=mm" />
	</div>
	<div class="xs-spacer30 sm-spacer30"></div>
	<div class="name">
		<input type="email" name="email" id="email" placeholder="{c2r-lg-email}" required="" autofocus />
	</div>
	<div class="password">
		<input type="password" name="password" id="password" placeholder="{c2r-lg-password}" required="" />
	</div>
	<div class="xs-spacer30 sm-spacer30 invisible">
		<input type="submit" name="submit" value="">
	</div>
</form>
