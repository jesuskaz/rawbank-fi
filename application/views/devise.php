<!DOCTYPE html>
<html lang="en">


<!-- forms-advanced-form.html  21 Nov 2019 03:54:41 GMT -->

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title>Otika - Admin Dashboard Template</title>
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
										<h4>Ajouter Devise</h4>
									</div>
									<div class="card-body">
										<form>
											<div class="row">
												<div class="form-group col-md-6">
													<label>Symbole</label>
													<div class="input-group">
														<div class="input-group-prepend">
															<div class="input-group-text">
																$/Fc
															</div>
														</div>
														<input type="text" class="form-control currency" name="devise">
													</div>
													<p><em class="text-danger small" name="devise"></em></p>
												</div>
											</div>
											<p><em class="text-danger small" msg></em></p>
											<div class="row">
												<div class="card-footer pt-0">
													<button type="submit" class="btn btn-warning mt-4">Ajouter Devise</button>
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
									<div class="card-header">
										<h4>Liste Devise</h4>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-striped table-hover" id="tableExport" style="width:100%;">
												<thead>
													<tr>
														<th>N°</th>
														<th>Intitulé Devise</th>
													</tr>
												</thead>
												<tbody>
													<?php
														$i = 0;
														if(isset($devises))
														{
															foreach($devises as $devise)
															{
																$i += 1;
																?>
																	<tr>
																		<td><?= $i ?> </td>
																		<td><?= $devise["intitule"]?></td>
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
		$(function(){
			$('form').submit(function(e)
			{
					e.preventDefault();

					var form = $(this);
					var btn = $(':submit', form);
					var txt = btn.html();

					var m = $('#message');
					m.html('');

					btn.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Ajouter Devise');
					$(`em[name]`).html('');
					$(`em[msg]`).html('');

					$.post('<?= site_url('ajax/add_devise') ?>', form.serialize(), function(log)
					{
							log = JSON.parse(log);

							if(log.status)
							{
								btn.attr('disabled', true).html('<i class="fa fa-check-circle"></i> Ajouter Devise');
								form.get(0).reset();
								setTimeout(() => {
									location.reload();
								}, 5000);
								m.removeClass().addClass('text-success').html(log.message);
							}
							else if(log.status == "existe")
							{
								btn.attr('disabled', true).html('<i class="fa fa-check-circle"></i> Ajouter Devise');
								form.get(0).reset();
								setTimeout(() => {
									location.reload();
								}, 5000);
								m.removeClass().addClass('text-danger').html(log.message);
							}
							else
							{
							
								btn.attr('disabled', false).html(txt);
								$('em[msg]').html(log.error).fadeIn('slow');
								var err = log.error;
								for (i in err)
								{
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
