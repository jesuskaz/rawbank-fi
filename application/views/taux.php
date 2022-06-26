<!DOCTYPE html>
<html lang="en">
<!-- forms-advanced-form.html  21 Nov 2019 03:54:41 GMT -->

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title>Rawbank | Bonus</title>
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
				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="formModal">Ajouter un Montant Seuil à rétirer</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form id="seuil">
									<div class="form-group">
										<label>Montant Seuil Rétirable</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<div class="input-group-text">
													<i class="fas fa-envelope"></i>
												</div>
											</div>
											<input type="text" class="form-control" placeholder="Montant" name="montant">
											<p><em class="text-danger small" name="montant"></em></p>
										</div>

										<div class="form-group">
											<label>Selectionnez Devise</label>
											<select class="form-control selectric" name="devise">
												<?php
												if (isset($devises)) {
													foreach ($devises as $devise) {
												?>

														<option value="<?= $devise["iddevise"] ?>"><?= $devise["intitule"]; ?></option>

												<?php
													}
												}
												?>
											</select>
										</div>
										<p><em class="text-danger small" name="devise"></em></p>
									</div>
									<p><em class="text-danger small" msg></em></p>
									<div class="row">
										<p id="message"></p>
										<button type="submit" class="btn btn-warning m-t-15 waves-effect">Ajouter</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<section class="section">
					<div class="section-body">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header justify-content-between">
										<h4>Definir Taux Bonus</h4>
										<button type="button" class="btn btn-warning" style="border-radius: 5px;" data-toggle="modal" data-target="#exampleModal">
											Ajouter Montant Seuil
											</button>
									</div>
									<div class="card-body">
										<form id="taux">
											<div class="row">
												<div class="form-group col-md-3">
													<label>Minimum</label>
													<div class="input-group">
														<div class="input-group-prepend">
															<div class="input-group-text">
																De
															</div>
														</div>
														<input type="text" class="form-control currency" name="min">
													</div>
													<p><em class="text-danger small" name="min"></em></p>
												</div>
												<div class="form-group col-md-3">
													<label>Maximum</label>
													<div class="input-group">
														<div class="input-group-prepend">
															<div class="input-group-text">
																A
															</div>
														</div>
														<input type="text" class="form-control currency" name="max">
													</div>
													<p><em class="text-danger small" name="max"></em></p>
												</div>
												<div class="form-group col-md-2">
													<label>Bonus</label>
													<div class="input-group">
														<div class="input-group-prepend">
															<div class="input-group-text">
																Bo
															</div>
														</div>
														<input type="text" class="form-control currency" name="bonus">
														<p><em class="text-danger small" name="bonus"></em></p>
													</div>
												</div>
												<div class="form-group col-md-2">
													<label>Selectionnez Devise</label>
													<select class="form-control selectric" name="devise">
														<?php
														if (isset($devises)) {
															foreach ($devises as $devise) {
														?>

																<option value="<?= $devise["iddevise"] ?>"><?= $devise["intitule"]; ?></option>

														<?php
															}
														}
														?>
													</select>
												</div>
											</div>
											<p><em class="text-danger small" msg></em></p>

											<div class="row">
												<div class="card-footer pt-0">
													<button type="submit" class="btn btn-warning mt-4">Ajouter Taux</button>
												</div>
												<div class="card-footer pt-0">
													<p id="message"></p>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
							<div class="col-12">
								<div class="card">
									
									<div class="card-header justify-content-between">
										<h4>Liste Taux Dollar</h4>
										<div>
											<?php
												if(count($seuil_1))
												{
													echo '<font color="green"><h5><b>SEUIL RETIRABLE : '.$seuil_1[0]['montant'].' '.$seuil_1[0]['intitule'].'</b></h5></font>';
												}
												else
												{
													echo '<font color="red"><h5><b> Définissez un seuil retirable s\'il vous plait </b></h5></font>';
												}
											?>
										</div>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-striped table-hover" id="tableExport" style="width:100%;">
												<thead>
													<tr>
														<th>N°</th>
														<th>Somme Minimum</th>
														<th>Somme Maximum</th>
														<th>Bonus</th>
														<th>Devise</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$i = 0;
													if (isset($taux_usd)) {
														foreach ($taux_usd as $taux) {
															$i += 1;
													?>
															<tr>
																<td><?= $i ?> </td>
																<td><?= $taux["min"] ?></td>
																<td><?= $taux["max"] ?></td>
																<td><?= $taux["bonus"] ?></td>
																<td><?= $taux["intitule"] ?></td>
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
							<div class="col-12">
								<div class="card">
									<div class="card-header justify-content-between">
										<h4>Liste Taux Franc</h4>
										<div>
											<?php
												if(count($seuil_1))
												{
													echo '<font color="green"><h5><b>SEUIL RETIRABLE : '.$seuil_2[0]['montant'].' '.$seuil_2[0]['intitule'].'</b></h5></font>';
												}
												else
												{
													echo '<font color="red"><h5><b> Définissez un seuil retirable s\'il vous plait </b></h5></font>';
												}
											?>
										</div>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-striped table-hover" id="tableExport" style="width:100%;">
												<thead>
													<tr>
														<th>N°</th>
														<th>Somme Minimum</th>
														<th>Somme Maximum</th>
														<th>Bonus</th>
														<th>Devise</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$i = 0;
													if (isset($taux_cdf)) {
														foreach ($taux_cdf as $taux) {
															$i += 1;
													?>
															<tr>
																<td><?= $i ?> </td>
																<td><?= $taux["min"] ?></td>
																<td><?= $taux["max"] ?></td>
																<td><?= $taux["bonus"] ?></td>
																<td><?= $taux["intitule"] ?></td>
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
		$(function() 
		{
			var taux = $('#taux');

			taux.submit(function(e) {
				e.preventDefault();

				var form = $(this);
				var btn = $(':submit', form);
				var txt = btn.html();

				var m = $('#message');
				m.html('');

				btn.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Ajouter Taux');
				$(`em[name]`).html('');
				$(`em[msg]`).html('');

				$.post('<?= site_url('ajax/add_taux') ?>', form.serialize(), function(log) {
					log = JSON.parse(log);

					if (log.status) {
						btn.attr('disabled', true).html('<i class="fa fa-check-circle"></i> Ajouter Taux');
						form.get(0).reset();

						setTimeout(() => {
							location.reload();
						}, 5000);
						m.removeClass().addClass('text-success').html(log.message);
					} else if (log.status == "existe") {
						form.get(0).reset();
						setTimeout(() => {
							location.reload();
						}, 5000);
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
				})
			});
		});

		$(function() 
		{
			var element = $('#seuil');
			element.submit(function(e) 
			{
				e.preventDefault();
				var form = $(this);
				var btn = $(':submit', form);
				var txt = btn.html();
				var m = $('#message');

				m.html('');

				btn.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Ajouter');
				$(`em[name]`).html('');
				$(`em[msg]`).html('');

				$.post('<?= site_url('ajax/seuil') ?>', form.serialize(), function(log) {
					log = JSON.parse(log);
					if (log.status == true) {
						btn.attr('disabled', true).html('<i class="fa fa-check-circle"></i> Ajouter');
						form.get(0).reset();

						setTimeout(() => {
							location.reload()
						}, 3000);

						m.removeClass().addClass('text-success').html(log.message);
					} else if (log.status == 'existe') {
						form.get(0).reset();
						setTimeout(() => {
							location.reload();
						}, 5000);

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
				})
			});
		});
	</script>
</body>
<!-- forms-advanced-form.html  21 Nov 2019 03:55:08 GMT -->

</html>
