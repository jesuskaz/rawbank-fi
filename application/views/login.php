<!DOCTYPE html>
<html lang="en">

<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Rawbank-Fi | Connexion </title>
  <!-- General CSS Files -->
	<?= $header ?>
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
              <div class="col d-flex justify-content-center" id="sample-login">
                <form>
                  <div class="card-header">
                    <h4>Connexion</h4>
                  </div>
                  <div class="card-body pb-0">
                    <p class="text-muted">
                      <center>Veuillez renseigner vos coordonnées pour vous connectez à</center>
                    </p>
                    <p>
                      <center><b>
                          <font color="orange">Rawbank-Fi</font>
                        </b></center>
                    </p>
                    <div class="form-group">
                      <label>Login</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fas fa-envelope"></i>
                          </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Votre Login" name="login">
                      </div>
											<p><em class="text-danger small" name="login"></em></p>
                    </div>
                    <div class="form-group">
                      <label>Mot de Passe</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text" >
                            <i class="fas fa-lock"></i>
                          </div>
                        </div>
                        <input type="password" class="form-control" placeholder="Password" name="password">
                      </div>
											<p><em class="text-danger small" name="password"></em></p>
                    </div>
                    <div class="form-group mb-0">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="remember" class="custom-control-input" id="remember-me">
                        <label class="custom-control-label" for="remember-me">Remember Me</label>
                      </div>
                    </div>
                  </div>
									<p><em class="text-danger small" msg></em></p>
                  <div class="card-footer pt-">
                    <button type="submit" class="btn btn-warning mt-4"><i class="fas fa-unlock"></i> Se Connecter</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="mt-5 text-muted text-center">
             Tout droit réservé à la Rawbank
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
	<?= $js ?>
	<script>
		$(function()
    {
			$('form').submit(function(e)
			{
					e.preventDefault();

					var form = $(this);
					var btn = $(':submit', form);
					var txt = btn.html();

					btn.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Se Connecter');
					$(`em[name]`).html('');
					$(`em[msg]`).html('');

					$.post('<?= site_url('ajax/login') ?>', form.serialize(), function(log){
							log = JSON.parse(log);

							if(log.status)
							{
								btn.attr('disabled', true).html('<i class="fa fa-check-circle"></i> Se Connecter');
								form.get(0).reset();

								setTimeout(() => {
									location.assign(log.url);
								}, 500);
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
</html>
