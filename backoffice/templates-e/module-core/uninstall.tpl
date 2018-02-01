<div class="row">
	<div class="col-md-12">
		<button type="button" class="btn btn-cancel pull-right" data-toggle="modal" data-target="#modal-uninstall">
			<i class="fa fa-chain-broken" aria-hidden="true"></i>
			<span class="xs-block15 sm-block15"></span>
			{c2r-lg-uninstall}
		</button>
	</div>
</div>

<!-- Modal Uninstall -->
<div id="modal-uninstall" class="modal fade" role="dialog">
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
				<form method="post" action="{c2r-path-bo}/{c2r-lg}/{c2r-module-folder}/uninstall">
					<div class="row">
						<div class="col-xs-6 col-sm-6 xs-taleft sm-taleft">
							<button type="submit" class="btn btn-cancel" name="submitUninstall">
								<i class="fa fa-chain-broken" aria-hidden="true"></i>
								<span class="xs-block15 sm-block15"></span>
								{c2r-lg-uninstall}
							</button>
						</div>
						<div class="col-xs-6 col-sm-6 xs-taright sm-taright">
							<button type="button" class="btn btn-default" data-dismiss="modal">{c2r-lg-close}</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
