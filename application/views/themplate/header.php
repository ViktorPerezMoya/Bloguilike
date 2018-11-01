
    <!-- Page Header -->
    <header class="masthead" style="background-image: url('<?= base_url('public/img/').(empty($img_hr) ? 'post-bg.jpg' : $img_hr)?>')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="post-heading">
              <?php echo empty($titulo_hr) ? '' : '<h1>'.$titulo_hr.'</h1>'; ?>
              <?php echo empty($subtitulo_hr) ? '' : '<h2>'.$subtitulo_hr.'</h2>'; ?>
              <?php echo empty($detalle_hr) ? '' : '<span class="meta"><img src="'. base_url('public/img/perfil.jpg').'" class="img-thumbnail img-post">'.$detalle_hr.'</span>'; ?>
            </div>
          </div>
        </div>
      </div>
    </header>