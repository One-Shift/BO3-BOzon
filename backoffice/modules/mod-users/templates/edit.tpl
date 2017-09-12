{c2r-return-message}
<div class="xs-spacer15 sm-spacer30"></div>
<div class="row">
	<div class="col-sm-4 col-md-4 sm-tacenter">
		<img src="https://www.gravatar.com/avatar/{c2r-md5-mail}?s=300&r=g&d=mm" class="img-circle">
		<div class="xs-spacer30 sm-spacer30"></div>
		<form method="post" name="form" id="form" action="{c2r-path-bo}/{c2r-lg}/{c2r-module-folder}/remove/{c2r-user-id}" enctype="multipart/form-data">
			<!-- CHECK IF DELETE FIELD-->
			<div>
				<div class="form-group">
					<div class="checkbox">
						<label>
							<input name="inputRemove" id="inputRemove" type="checkbox" value="1" required>{c2r-lg-check-remove}
						</label>
					</div>
				</div>
				<button type="submit" class="btn btn-save pull-center" name="remove_btn" id="remove_btn">
					<i class="fa fa-eraser" aria-hidden="true"></i><div class="xs-block15 sm-block15"></div>{c2r-lg-remove}
				</button>
			</div>
		</form>
	</div>
	<div class="col-sm-8 col-md-8">
		{c2r-form}
	</div>
</div>
