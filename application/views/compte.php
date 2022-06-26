<!DOCTYPE html>
<html lang="en">

<!-- forms-advanced-form.html  21 Nov 2019 03:54:41 GMT -->

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title>Rawbank-Fi | Compte</title>
	<!-- General CSS Files -->
	<?= $header ?>
</head>

<body>
	<div class="loader"></div>
	<div id="app">
		<div class="main-wrapper main-wrapper-1">
			<div class="navbar-bg"></div>
			<?= $navbar ?>
			<div class="main-sidebar sidebar-style-2">
				<?= $sidebar ?>
			</div>
			<!-- Main Content -->
			<div class="main-content">
				<section class="section">
					<div class="section-body">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<h4>Enregistrement Client</h4>
									</div>
									<form id="add-client">
										<div class="card-body">
											<div class="row">
												<div class="form-group col-md-4">
													<label>Nom</label>
													<input type="text" class="form-control" name="nom">
													<p><em class="text-danger small" name="nom"></em></p>
												</div>
												<div class="form-group col-md-4">
													<label>Post-nom</label>
													<input type="text" class="form-control" name="postnom">
													<p><em class="text-danger small" name="postnom"></em></p>
												</div>
												<div class="form-group col-md-4">
													<label>Prenom</label>
													<input type="text" class="form-control" name="prenom">
													<p><em class="text-danger small" name="prenom"></em></p>
												</div>
											</div>
											<div class="row">
												<div class="form-group col-md-6">
													<label>Adresse</label>
													<input type="text" class="form-control" name="adresse">
													<p><em class="text-danger small" name="adresse"></em></p>
												</div>
												<div class="form-group col-md-6">
													<label>Téléphone</label>
													<div class="input-group">
														<div class="input-group-prepend">
															<div class="input-group-text">
																<i class="fas fa-phone"></i>
															</div>
														</div>
														<input type="text" class="form-control phone-number" name="phone">
													</div>
													<p><em class="text-danger small" name="phone"></em></p>
												</div>
											</div>
											<div class="row">
												<div class="form-group col-md-6">
													<label>Password Strength</label>
													<div class="input-group">
														<div class="input-group-prepend">
															<div class="input-group-text">
																<i class="fas fa-lock"></i>
															</div>
														</div>
														<input type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password">
													</div>
													<p><em class="text-danger small" name="password"></em></p>
													<div id="pwindicator" class="pwindicator">
														<div class="bar"></div>
														<div class="label"></div>
													</div>
												</div>
												<div class="form-group col-md-6">
													<label>Login</label>
													<div class="input-group">
														<div class="input-group-prepend">
															<div class="input-group-text">
																<i class="fas fa-user"></i>
															</div>
														</div>
														<input type="text" class="form-control" name="login">
													</div>
													<p><em class="text-danger small" name="login"></em></p>
												</div>
											</div>
											<p><em class="text-danger small" msg></em></p>
											<div class="row">
												<div class="card-footer pt-0">
													<button type="submit" class="btn btn-warning mt-4">Ajouter Client</button>
												</div>
												<p id="message"></p>
											</div>
										</div>
									</form>
								</div>
							</div>
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<h4>Ajouter un Compte</h4>
									</div>
									<form id="add-compte">
										<div class="card-body">
											<div class="row">
												<div class="form-group col-md-4">
													<label>Numéro compte</label>
													<input type="text" class="form-control" name="numero_compte">
													<p><em class="text-danger small" name="numero_compte"></em></p>
												</div>
												<div class="form-group col-md-4">
													<label>Type Compte</label>
													<select class="form-control selectric" name="type_compte">
														<option value="courant">Courant</option>
														<option value="epargne">Epargne</option>
													</select>
													<p><em class="text-danger small" name="type_compte"></em></p>
												</div>
												<div class="form-group col-md-4">
													<label>Devise</label>
													<select class="form-control selectric" name="devise">
														<?php
														if (isset($devises)) {
															foreach ($devises as $devise) {
														?>
																<option value="<?= $devise["iddevise"] ?>"><?= $devise["intitule"] ?></option>
														<?php
															}
														}
														?>
													</select>
													<p><em class="text-danger small" name="devise"></em></p>
												</div>
											</div>
											<div class="row">
												<div class="form-group col-md-6">
													<label>Type Client</label>
													<select class="form-control selectric" name="type_client">
														<option value="echangeur">Echangeur</option>
														<option value="simple">Simple</option>
													</select>
												</div>
												<p><em class="text-danger small" name="type_client"></em></p>
												<div class="form-group col-md-6">
													<label>Selectionnz le client</label>
													<select class="form-control selectric" name="client">
														<?php
														if (isset($clients)) {
															foreach ($clients as $client) {
														?>
																<option value="<?= $client["idclient"] ?>"><?= $client["prenom"] . " " . $client["nom"] ?></option>
														<?php
															}
														}

														?>
													</select>
													<p><em class="text-danger small" name="client"></em></p>
												</div>
											</div>
											<p><em class="text-danger small" msg></em></p>
											<div class="row">
												<div class="card-footer pt-0">
													<button type="submit" class="btn btn-warning mt-4">Ajouter Compte</button>
												</div>
												<p id="message1"></p>
											</div>
										</div>
									</form>
								</div>
							</div>
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<h4>Comptes Récemments crées</h4>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-striped table-hover" id="tableExport" style="width:100%;">
												<thead>
													<tr>
														<th>Nom</th>
														<th>Postnom</th>
														<th>Prénom</th>
														<th>Adresse</th>
														<th>Téléphone</th>
														<th>Compte</th>
														<th>Devise</th>
													</tr>
												</thead>
												<tbody>
													<?php
													if (isset($client_compte)) {
														foreach ($client_compte as $cl) {
													?>
															<tr>
																<td><?= $cl["nom"] ?></td>
																<td><?= $cl["postnom"] ?></td>
																<td><?= $cl["prenom"] ?></td>
																<td><?= $cl["adresse"] ?></td>
																<td><?= $cl["telephone"] ?></td>
																<td>
																	<?php
																	if ($cl["numero_compte"]) {
																		echo $cl["numero_compte"];
																	} else {
																		echo "<font color='red'><b>"."Pas de compte"."</b></font>";
																	}
																	?>
																</td>
																<td>
																	<?php
																	if ($cl["intitule"]) {
																		echo $cl["intitule"];
																	} else {
																		echo "<font color='red'><b>"."Pas de compte"."</b></font>";
																	}
																	?>
																</td>
															</tr>
													<?php
														}
													}
													?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				<div class="settingSidebar">
					<a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
					</a>
					<div class="settingSidebar-body ps-container ps-theme-default">
						<div class=" fade show active">
							<div class="setting-panel-header">Setting Panel
							</div>
							<div class="p-15 border-bottom">
								<h6 class="font-medium m-b-10">Select Layout</h6>
								<div class="selectgroup layout-color w-50">
									<label class="selectgroup-item">
										<input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
										<span class="selectgroup-button">Light</span>
									</label>
									<label class="selectgroup-item">
										<input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
										<span class="selectgroup-button">Dark</span>
									</label>
								</div>
							</div>
							<div class="p-15 border-bottom">
								<h6 class="font-medium m-b-10">Sidebar Color</h6>
								<div class="selectgroup selectgroup-pills sidebar-color">
									<label class="selectgroup-item">
										<input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
										<span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip" data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
									</label>
									<label class="selectgroup-item">
										<input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
										<span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip" data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
									</label>
								</div>
							</div>
							<div class="p-15 border-bottom">
								<h6 class="font-medium m-b-10">Color Theme</h6>
								<div class="theme-setting-options">
									<ul class="choose-theme list-unstyled mb-0">
										<li title="white" class="active">
											<div class="white"></div>
										</li>
										<li title="cyan">
											<div class="cyan"></div>
										</li>
										<li title="black">
											<div class="black"></div>
										</li>
										<li title="purple">
											<div class="purple"></div>
										</li>
										<li title="orange">
											<div class="orange"></div>
										</li>
										<li title="green">
											<div class="green"></div>
										</li>
										<li title="red">
											<div class="red"></div>
										</li>
									</ul>
								</div>
							</div>
							<div class="p-15 border-bottom">
								<div class="theme-setting-options">
									<label class="m-b-0">
										<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="mini_sidebar_setting">
										<span class="custom-switch-indicator"></span>
										<span class="control-label p-l-10">Mini Sidebar</span>
									</label>
								</div>
							</div>
							<div class="p-15 border-bottom">
								<div class="theme-setting-options">
									<label class="m-b-0">
										<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="sticky_header_setting">
										<span class="custom-switch-indicator"></span>
										<span class="control-label p-l-10">Sticky Header</span>
									</label>
								</div>
							</div>
							<div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
								<a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
									<i class="fas fa-undo"></i> Restore Default
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?= $footer ?>
		</div>
	</div>
	<?= $js ?>
	<script>
		$(function() {
			addclient = $('#add-client');

			addclient.submit(function(e) {
				e.preventDefault();

				var form = $(this);
				var btn = $(':submit', form);
				var txt = btn.html();
				var m = $('#message');

				btn.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Ajouter Client');
				$(`em[name]`).html();
				$(`em[msg]`).html();

				$.post('<?= base_url('ajax/add_client') ?>', form.serialize(), function(log) {
					log = JSON.parse(log);

					if (log.status) {
						btn.attr('disabled', true).html('<i class="fa fa-check-circle"></i> Ajouter Client');
						form.get(0).reset();

						setTimeout(() => {
							location.reload();
						}, 500);
						m.removeClass().addClass('text-success').html(log.message);
					} else if (log.status == "existe") {
						btn.attr('disabled', true).html('<i class="fa fa-check-circle"></i> Ajouter Devise');
						form.get(0).reset();
						setTimeout(() => {
							location.reload();
						}, 6000);
						m.removeClass().addClass('text-danger').html(log.message);
					} else {
						btn.attr('disabled', false).html(txt);
						$('em[msg]').html(log.error).fadeIn('slow');
						var err = log.error;
						for (i in err) {
							$(`em[name=${i}]`).html(err[i]);
							console.log(i);
						}
					}
				});
			})
		});


		addcompte = $('#add-compte');
		$(function() {
			addcompte.submit(function(e) {
				e.preventDefault();

				var form = $(this);
				var btn = $(':submit', form);
				var txt = btn.html();
				var m = $('#message1');

				btn.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Ajouter Client');
				$(`em[name]`).html();
				$(`em[msg]`).html();

				$.post('<?= base_url('ajax/add_compte') ?>', form.serialize(), function(log) {
					log = JSON.parse(log);

					if (log.status) {
						btn.attr('disabled', true).html('<i class="fa fa-check-circle"></i> Ajouter Compte');
						form.get(0).reset();

						setTimeout(() => {
							location.reload();
						}, 500);
						m.removeClass().addClass('text-success').html(log.message);
					} else if (log.status == "existe") {
						btn.attr('disabled', true).html('<i class="fa fa-check-circle"></i> Ajouter Compte');
						form.get(0).reset();
						setTimeout(() => {
							location.reload();
						}, 6000);
						m.removeClass().addClass('text-danger').html(log.message);
					} else {
						btn.attr('disabled', false).html(txt);
						$('em[msg]').html(log.error).fadeIn('slow');
						var err = log.error;
						for (i in err) {
							$(`em[name=${i}]`).html(err[i]);
							console.log(i);
						}
					}
				});
			})
		})
	</script>
</body>
<!-- forms-advanced-form.html  21 Nov 2019 03:55:08 GMT -->

</html>
