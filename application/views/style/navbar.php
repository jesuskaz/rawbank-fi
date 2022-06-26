<nav class="navbar navbar-expand-lg main-navbar sticky">
	<div class="form-inline mr-auto">
		<ul class="navbar-nav mr-3">
			<li>
				<a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn">
					<i data-feather="align-justify"></i>
				</a>
			</li>
			<li>
				<a href="#" class="nav-link nav-link-lg fullscreen-btn">
					<i data-feather="maximize"></i>
				</a>
			</li>
		</ul>
	</div>
	<ul class="navbar-nav navbar-right">
		<li class="dropdown dropdown-list-toggle">
			<a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle">
				<i data-feather="mail"></i>
				<span class="badge headerBadge1"> 6 </span>
			</a>
			<div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
				<div class="dropdown-header">
					Messages
					<div class="float-right">
						<a href="#">Mark All As Read</a>
					</div>
				</div>
				<div class="dropdown-list-content dropdown-list-message">
					<a href="#" class="dropdown-item">
						<span class="dropdown-item-avatar text-white">
							<img alt="image" src="<?= base_url('assets/img/users/user-1.png'); ?>" class="rounded-circle">
						</span>
						<span class="dropdown-item-desc">
							<span class="message-user">John Deo</span>
							<span class="time messege-text">Please check your mail !!</span>
							<span class="time">2 Min Ago</span>
						</span>
						<a href="#" class="dropdown-item">
							<span class="dropdown-item-avatar text-white">
								<img alt="image" src="<?= base_url('assets/img/users/user-3.png'); ?>" class="rounded-circle">
							</span>
							<span class="dropdown-item-desc">
								<span class="message-user">Jalpa Joshi</span>
								<span class="time messege-text">Please do as specify.
									Let me
									know if you have any query.
								</span>
								<span class="time"> 1 Days Ago </span>
							</span>
						</a>
				</div>
				<div class="dropdown-footer text-center">
					<a href="#">Voir Plus <i class="fas fa-chevron-right"></i></a>
				</div>
			</div>
		</li>
		<li class="dropdown"><a href="<?= base_url('index/deconnexion'); ?>" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="<?= base_url('assets/img/user.png'); ?>" class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
			<div class="dropdown-menu dropdown-menu-right pullDown">
				<div class="dropdown-divider"></div>
				<a href="<?= base_url('index/deconnexion'); ?>" class="dropdown-item has-icon text-danger">
					<i class="fas fa-sign-out-alt"></i>
					Deconnexion
				</a>
			</div>
		</li>
	</ul>
</nav>
