<aside id="sidebar-wrapper">
	<div class="sidebar-brand">
		<a href="<?= base_url('index/accueil'); ?>"> <img alt="image" src="<?= base_url('assets/img/logo.png'); ?>" class="header-logo" /> <span class="logo-name">Rawbank-Fi</span>
		</a>
	</div>
	<ul class="sidebar-menu">
		<li class="menu-header">Principale</li>
		<li class="dropdown active">
			<a href="<?= base_url('index/accueil'); ?>" class="nav-link"><i data-feather="monitor"></i><span>Tableau de Bord</span></a>
		</li>
		<li class="dropdown">
			<a href="<?= base_url('index/compte') ?>" class="nav-link"><i data-feather="user-check"></i><span>Créer un compte</span></a>
		</li>

		<li class="menu-header">Opérations</li>
		<li class="dropdown">
			<a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="copy"></i><span>Echange
				</span></a>
			<ul class="dropdown-menu">
				<li><a class="nav-link" href="<?= base_url('index/achat'); ?>">Achat USD</a></li>
				<li><a class="nav-link" href="<?= base_url('index/vente'); ?>">Vente USD</a></li>
			</ul>
		</li>
		<li class="dropdown">
			<a href="<?= base_url('index/credit'); ?>" class="nav-link"><i data-feather="user-check"></i><span>Créditer un compte</span></a>
		</li>
		<li class="menu-header">Configuration</li>
		<li class="dropdown">
			<a href="<?= base_url('index/devise'); ?>" class="nav-link"><i data-feather="user-check"></i><span>Ajouter la devise</span></a>
		</li>
		<li class="dropdown">
			<a href="<?= base_url('index/taux'); ?>" class="nav-link"><i data-feather="user-check"></i><span>Définissez le taux bonus</span></a>
		</li>
		<li class="dropdown">
			<a href="<?= base_url('message'); ?>" class="nav-link"><i data-feather="user-check"></i><span>Notifiez Client</span></a>
		</li>
	</ul>
</aside>
