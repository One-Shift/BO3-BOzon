<!DOCTYPE html>
<html>
	<head>
		{c2r-head}
		<style media="screen">
			{c2r-custom-css}
		</style>
	</head>
	<body class="animsition">
		<div class="page-wrapper">
			<!-- HEADER MOBILE-->
			<header class="header-mobile d-block d-lg-none">
				<div class="header-mobile__bar">
					<div class="container-fluid">
						<div class="header-mobile-inner">
							<a class="logo" href="index.html">
								<img src="{c2r-images}/_icon/logo.png" alt="CoolAdmin" />
							</a>
							<button class="hamburger hamburger--slider" type="button">
								<span class="hamburger-box">
									<span class="hamburger-inner"></span>
								</span>
							</button>
						</div>
					</div>
				</div>
				<nav class="navbar-mobile">
					<div class="container-fluid">
						<ul class="navbar-mobile__list list-unstyled">
							<li class="has-sub">
								<a class="js-arrow" href="#">
									<i class="fas fa-tachometer-alt"></i>Dashboard</a>
								<ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
									<li>
										<a href="index.html">Dashboard 1</a>
									</li>
									<li>
										<a href="index2.html">Dashboard 2</a>
									</li>
									<li>
										<a href="index3.html">Dashboard 3</a>
									</li>
									<li>
										<a href="index4.html">Dashboard 4</a>
									</li>
								</ul>
							</li>
							<li>
								<a href="chart.html">
									<i class="fas fa-chart-bar"></i>Charts</a>
							</li>
							<li>
								<a href="table.html">
									<i class="fas fa-table"></i>Tables</a>
							</li>
							<li>
								<a href="form.html">
									<i class="far fa-check-square"></i>Forms</a>
							</li>
							<li>
								<a href="#">
									<i class="fas fa-calendar-alt"></i>Calendar</a>
							</li>
							<li>
								<a href="map.html">
									<i class="fas fa-map-marker-alt"></i>Maps</a>
							</li>
							<li class="has-sub">
								<a class="js-arrow" href="#">
									<i class="fas fa-copy"></i>Pages</a>
								<ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
									<li>
										<a href="login.html">Login</a>
									</li>
									<li>
										<a href="register.html">Register</a>
									</li>
									<li>
										<a href="forget-pass.html">Forget Password</a>
									</li>
								</ul>
							</li>
							<li class="has-sub">
								<a class="js-arrow" href="#">
									<i class="fas fa-desktop"></i>UI Elements</a>
								<ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
									<li>
										<a href="button.html">Button</a>
									</li>
									<li>
										<a href="badge.html">Badges</a>
									</li>
									<li>
										<a href="tab.html">Tabs</a>
									</li>
									<li>
										<a href="card.html">Cards</a>
									</li>
									<li>
										<a href="alert.html">Alerts</a>
									</li>
									<li>
										<a href="progress-bar.html">Progress Bars</a>
									</li>
									<li>
										<a href="modal.html">Modals</a>
									</li>
									<li>
										<a href="switch.html">Switchs</a>
									</li>
									<li>
										<a href="grid.html">Grids</a>
									</li>
									<li>
										<a href="fontawesome.html">Fontawesome Icon</a>
									</li>
									<li>
										<a href="typo.html">Typography</a>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</nav>
			</header>
			<!-- END HEADER MOBILE-->

			<!-- MENU SIDEBAR-->
			<aside class="menu-sidebar d-none d-lg-block">
				<div class="logo">
					<a href="{c2r-bo-path}">
						<img src="{c2r-images}/logo-dark.svg" alt="BO{c2r-bo3-version} {c2r-bo3-sub-version}" title="BO{c2r-bo3-version} {c2r-bo3-sub-version}" />
					</a>
				</div>
				<div class="menu-sidebar__content js-scrollbar1">
					<nav class="navbar-sidebar">
						<ul class="list-unstyled navbar__list">
							{c2r-menu}
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
							<div class="header-wrap">
								<form class="form-header" action="" method="POST">
									<input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
									<button class="au-btn--submit" type="submit">
										<i class="zmdi zmdi-search"></i>
									</button>
								</form>
								<div class="header-button">
									<!--
									<div class="noti-wrap">
										<div class="noti__item js-item-menu">
											<i class="zmdi zmdi-comment-more"></i>
											<span class="quantity">1</span>
											<div class="mess-dropdown js-dropdown">
												<div class="mess__title">
													<p>You have 2 news message</p>
												</div>
												<div class="mess__item">
													<div class="image img-cir img-40">
														<img src="{c2r-images}/_icon/avatar-06.jpg" alt="Michelle Moreno" />
													</div>
													<div class="content">
														<h6>Michelle Moreno</h6>
														<p>Have sent a photo</p>
														<span class="time">3 min ago</span>
													</div>
												</div>
												<div class="mess__item">
													<div class="image img-cir img-40">
														<img src="{c2r-images}/_icon/avatar-04.jpg" alt="Diane Myers" />
													</div>
													<div class="content">
														<h6>Diane Myers</h6>
														<p>You are now connected on message</p>
														<span class="time">Yesterday</span>
													</div>
												</div>
												<div class="mess__footer">
													<a href="#">View all messages</a>
												</div>
											</div>
										</div>
										<div class="noti__item js-item-menu">
											<i class="zmdi zmdi-email"></i>
											<span class="quantity">1</span>
											<div class="email-dropdown js-dropdown">
												<div class="email__title">
													<p>You have 3 New Emails</p>
												</div>
												<div class="email__item">
													<div class="image img-cir img-40">
														<img src="{c2r-images}/_icon/avatar-06.jpg" alt="Cynthia Harvey" />
													</div>
													<div class="content">
														<p>Meeting about new dashboard...</p>
														<span>Cynthia Harvey, 3 min ago</span>
													</div>
												</div>
												<div class="email__item">
													<div class="image img-cir img-40">
														<img src="{c2r-images}/_icon/avatar-05.jpg" alt="Cynthia Harvey" />
													</div>
													<div class="content">
														<p>Meeting about new dashboard...</p>
														<span>Cynthia Harvey, Yesterday</span>
													</div>
												</div>
												<div class="email__item">
													<div class="image img-cir img-40">
														<img src="{c2r-images}/_icon/avatar-04.jpg" alt="Cynthia Harvey" />
													</div>
													<div class="content">
														<p>Meeting about new dashboard...</p>
														<span>Cynthia Harvey, April 12,,2018</span>
													</div>
												</div>
												<div class="email__footer">
													<a href="#">See all emails</a>
												</div>
											</div>
										</div>
										<div class="noti__item js-item-menu">
											<i class="zmdi zmdi-notifications"></i>
											<span class="quantity">3</span>
											<div class="notifi-dropdown js-dropdown">
												<div class="notifi__title">
													<p>You have 3 Notifications</p>
												</div>
												<div class="notifi__item">
													<div class="bg-c1 img-cir img-40">
														<i class="zmdi zmdi-email-open"></i>
													</div>
													<div class="content">
														<p>You got a email notification</p>
														<span class="date">April 12, 2018 06:50</span>
													</div>
												</div>
												<div class="notifi__item">
													<div class="bg-c2 img-cir img-40">
														<i class="zmdi zmdi-account-box"></i>
													</div>
													<div class="content">
														<p>Your account has been blocked</p>
														<span class="date">April 12, 2018 06:50</span>
													</div>
												</div>
												<div class="notifi__item">
													<div class="bg-c3 img-cir img-40">
														<i class="zmdi zmdi-file-text"></i>
													</div>
													<div class="content">
														<p>You got a new file</p>
														<span class="date">April 12, 2018 06:50</span>
													</div>
												</div>
												<div class="notifi__footer">
													<a href="#">All notifications</a>
												</div>
											</div>
										</div>
									</div>
									-->
									<div class="account-wrap">
										<div class="account-item clearfix js-item-menu">
											<div class="image">
												<img src="https://www.gravatar.com/avatar/{c2r-user-avatar}?s=240&r=g&d=mm" alt="{c2r-user-name}" />
											</div>
											<div class="content">
												<a class="js-acc-btn" href="#">{c2r-user-name}</a>
											</div>
											<div class="account-dropdown js-dropdown">
												<div class="info clearfix">
													<div class="image">
														<a href="#">
															<img src="https://www.gravatar.com/avatar/{c2r-user-avatar}?s=240&r=g&d=mm" alt="{c2r-user-name}" />
														</a>
													</div>
													<div class="content">
														<h5 class="name">
															<a href="#">{c2r-user-name}</a>
														</h5>
														<span class="email">{c2r-user-email}</span>
													</div>
												</div>
												<div class="account-dropdown__body">
													{c2r-dropdown-menu}
												</div>
												<div class="account-dropdown__footer">
													<a href="{c2r-bo-path}/{c2r-lg}/logout/">
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
										<h2 class="title-1">{c2r-mdl-name}</h2>
										{c2r-module-action-list}
									</div>
								</div>
							</div>
							<div class="spacer sm-30"></div>
							{c2r-module}
							<div class="spacer sm-30"></div>
							{c2r-uninstall}

							<div class="row">
								<div class="col-md-12">
									<div class="authors-bar text-center">
										<small class="grey-text">
											<a class="grey-text" href="https://one-shift.com/en/bo3-module/{c2r-mdl-official-url}#t" target="_blank">{c2r-mdl-name}</a> - version <a href="{c2r-bo-path}/{c2r-lg}/{c2r-module-folder}/changelog/">{c2r-mdl-version}</a> - developer <a class="grey-text" href="mailto:{c2r-mdl-developer-contact}?subject={c2r-mdl-name}-v{c2r-mdl-version}">{c2r-mdl-developer}</a>
										</small>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="copyright">
										<p>Copyright © 2012 - {c2r-year}, Code by <a href="https://colorlib.com" title="One:Shift">One:Shift</a> and Template by <a href="https://colorlib.com" title="Copyright © 2018 Colorlib. Template by Colorlib">Colorlib</a>.</p>
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
		<script src="{c2r-libs}/_slick/slick.min.js"></script>
		<script src="{c2r-libs}/_wow/wow.min.js"></script>
		<script src="{c2r-libs}/_animsition/animsition.min.js"></script>
		<script src="{c2r-libs}/_bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
		<script src="{c2r-libs}/_counter-up/jquery.waypoints.min.js"></script>
		<script src="{c2r-libs}/_counter-up/jquery.counterup.min.js"></script>
		<script src="{c2r-libs}/_circle-progress/circle-progress.min.js"></script>
		<script src="{c2r-libs}/_perfect-scrollbar/perfect-scrollbar.js"></script>
		<script src="{c2r-libs}/_chartjs/Chart.bundle.min.js"></script>
		<script src="{c2r-libs}/_select2/select2.min.js"></script>

		<!-- Main JS-->
		<script src="{c2r-js}/_main.js"></script>
	</body>
</html>
