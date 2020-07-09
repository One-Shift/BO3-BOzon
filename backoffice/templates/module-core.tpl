<!DOCTYPE html>
<html>
	<head>
		{{ head }}
		<style media="screen">
			{{ custom-css }}
		</style>
	</head>
	<body class="animsition">
		<div class="page-wrapper">

			<!-- MENU SIDEBAR-->
			<aside class="menu-sidebar d-none d-lg-block">
				<div class="logo">
					<a href="{{ bo-path }}">
						<img src="{{ images }}/logo-dark.svg" alt="BO{{ bo3-version }} {{ bo3-sub-version }}" title="BO{{ bo3-version }} {{ bo3-sub-version }}" />
					</a>
				</div>
				<div class="menu-sidebar__content js-scrollbar1">
					<nav class="navbar-sidebar">
						<ul class="list-unstyled navbar__list">
							{{ menu }}
						</ul>
					</nav>
				</div>
			</aside>
			<!-- END MENU SIDEBAR-->

			<!-- PAGE CONTAINER-->
			<div class="page-container">
				<!-- HEADER DESKTOP-->
				<header class="header-desktop">
					<div class="section__content section__content--p30">
						<div class="container-fluid">
							<div class="header-wrap" style="justify-content: flex-end;">
								<!-- 
								<form class="form-header" action="" method="POST">
									<input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
									<button class="au-btn--submit" type="submit">
										<i class="zmdi zmdi-search"></i>
									</button>
								</form>
								-->
								<div class="header-button">
									<div class="account-wrap">
										<div class="account-item clearfix js-item-menu">
											<div class="image">
												<img src="https://www.gravatar.com/avatar/{{ user-avatar}?s=240&r=g&d=mm" alt="{{ user-name }}" />
											</div>
											<div class="content">
												<a class="js-acc-btn" href="#">{{ user-name }}</a>
											</div>
											<div class="account-dropdown js-dropdown">
												<div class="info clearfix">
													<div class="image">
														<a href="#">
															<img src="https://www.gravatar.com/avatar/{{ user-avatar}?s=240&r=g&d=mm" alt="{{ user-name }}" />
														</a>
													</div>
													<div class="content">
														<h5 class="name">
															<a href="#">{{ user-name }}</a>
														</h5>
														<span class="email">{{ user-email }}</span>
													</div>
												</div>
												<div class="account-dropdown__body">
													{{ dropdown-menu }}
												</div>
												<div class="account-dropdown__footer">
													<a href="{{ bo-path }}/{{ lg }}/logout/">
														<i class="zmdi zmdi-power"></i>Logout</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</header>
				<!-- HEADER DESKTOP-->

				<!-- MAIN CONTENT-->
				<div class="main-content">
					<div class="section__content section__content--p30">
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-12">
									<div class="overview-wrap">
										<h2 class="title-1">{{ mdl-name }}</h2>
										{{ module-action-list }}
									</div>
								</div>
							</div>
							<div class="spacer sm-30"></div>
							{{ module }}
							<div class="spacer sm-30"></div>
							{{ uninstall }}

							<div class="row">
								<div class="col-md-12">
									<div class="authors-bar text-center">
										<small class="grey-text">
											<a class="grey-text" href="https://one-shift.com/en/bo3-module/{{ mdl-official-url }}#t" target="_blank">{{ mdl-name }}</a> - version <a href="{{ bo-path }}/{{ lg }}/{{ module-folder }}/changelog/">{{ mdl-version }}</a> - developer <a class="grey-text" href="mailto:{{ mdl-developer-contact }}?subject={{ mdl-name }}-v{{ mdl-version }}">{{ mdl-developer }}</a>
										</small>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="copyright">
										<p>Copyright © 2012 - {{ year }}, Code by <a href="https://colorlib.com" title="One:Shift">One:Shift</a> and Template by <a href="https://colorlib.com" title="Copyright © 2018 Colorlib. Template by Colorlib">Colorlib</a>.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- END MAIN CONTENT-->
				<!-- END PAGE CONTAINER-->
			</div>

		</div>

		<!-- Vendor JS  -->
		<script src="{{ libs }}/_slick/slick.min.js"></script>
		<script src="{{ libs }}/_wow/wow.min.js"></script>
		<script src="{{ libs }}/_animsition/animsition.min.js"></script>
		<script src="{{ libs }}/_bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
		<script src="{{ libs }}/_counter-up/jquery.waypoints.min.js"></script>
		<script src="{{ libs }}/_counter-up/jquery.counterup.min.js"></script>
		<script src="{{ libs }}/_circle-progress/circle-progress.min.js"></script>
		<script src="{{ libs }}/_perfect-scrollbar/perfect-scrollbar.js"></script>
		<script src="{{ libs }}/_chartjs/Chart.bundle.min.js"></script>
		<script src="{{ libs }}/_select2/select2.min.js"></script>

		<!-- Main JS-->
		<script src="{{ js }}/_main.js"></script>
	</body>
</html>
