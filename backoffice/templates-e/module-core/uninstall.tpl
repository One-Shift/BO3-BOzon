<div class="row">
	<div class="col-md-12">
		<button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#myModal">Uninstall</button>
	</div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">{c2r-lg-title}</h4>
			</div>
			<div class="modal-body">
				<p>{c2r-lg-question}</p>
			</div>
			<div class="modal-footer">
				<form method="post" action="{c2r-path-bo}/0/{c2r-lg}/{c2r-module-folder}/uninstall">
					<button type="submit" class="btn btn-danger" name="submitUninstall">{c2r-lg-uninstall}</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">{c2r-lg-close}</button>
				</form>
			</div>
		</div>

	</div>
</div>
