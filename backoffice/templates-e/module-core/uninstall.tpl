<div class="row">
	<div class="col-md-12">
		<!-- UNINSTALL BUTTON START -->
		<button type="button" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#modal-uninstall">
			<i class="fa fa-chain-broken" aria-hidden="true"></i>
			<span class="block xs-15 sm-15"></span>
			{c2r-lg-uninstall}
		</button>
		<!-- UNINSTALL BUTTON END -->
		<!-- Modal Uninstall START -->
		<div class="modal fade" id="modal-uninstall" tabindex="-1" role="dialog" aria-labelledby="modal-uninstall-label" style="display: none;" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modal-uninstall-label">{c2r-lg-title}</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">
						<p>{c2r-lg-question}</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">{c2r-lg-close}</button>
						<form method="post" action="{c2r-bo-path}/{c2r-lg}/{c2r-module-folder}/uninstall">
							<button type="button" class="btn btn-primary">
								<i class="fa fa-chain-broken" aria-hidden="true"></i>
								<span class="block xs-15 sm-15"></span>
								{c2r-lg-uninstall}
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal Uninstall END -->
	</div>
</div>
<div class="spacer sm-30"></div>
