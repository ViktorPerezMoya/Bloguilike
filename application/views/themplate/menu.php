<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand" href="index.php">Bloguilike</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url()?>">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('acerca_de')?>">Acerca de</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('contacto')?>">Contacto</a>
            </li>
            <?php if(!empty($this->session->userdata('nombre'))): ?>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('nuevo_post')?>">Nuevo Post</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('mis_posts')?>">Mis Posts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="javascript:void(0)"><?= $this->session->userdata('nombre');?></a>
            </li>
            <?php endif; ?>
            <li class="nav-item">
                <?php
                if(!empty($this->session->userdata('nombre'))){
                    ?><a tabindex="0" id="logout_mn" class="nav-link" href="<?= base_url('auth/logout')?>"><i class="fas fa-sign-out-alt"></i></a><?php
                }else{
                    ?><a tabindex="0" id="login_mn" class="nav-link" href="javascript:void(0);" data-toggle="modal" data-target="#modal_login">Iniciar Sesion</a><?php
                }
                ?>
            </li>
          </ul>
        </div>
      </div>
    </nav>

<div class="modal" tabindex="-1" role="dialog" id="modal_login">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">INICIAR SESIÓN</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <?= form_open('auth/login',array('id' => 'login_form'))?>
        <div class="control-group">
            <div id="error_login"></div>
            <div class="form-group floating-label-form-group-sm controls">
              <label>Email</label>
              <input type="email" class="form-control" placeholder="tumail@example.com" name="email_login" id="email_login">
              
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group-sm controls">
              <label>Clave</label>
              <input type="password" class="form-control floating-label-form-group-sm" placeholder="*****" name="clave_login" id="clave_login">
              
            </div>
          </div>
          <br>
          
        <div class="form-group">
          <button type="submit" class="btn btn-primary" id="btn_loguear">Login</button>
          <button type="button" class="btn" id="registrarse_btn" data-toggle="modal" data-target="#modal_register">Registrarse</button>
        </div>
          <?= form_close()?>
      </div>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="modal_register">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">REGISTRARSE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div id="error_register"></div>
          <div id="success_register"></div>
          <?= form_open('',array('id'=>'register_form'))?>
        <div class="control-group">
            <div class="form-group floating-label-form-group-sm controls">
              <label>Nombre</label>
              <input type="text" class="form-control" placeholder="Tu nombre" name="name_register" id="name_register" required data-validation-required-message="Por favor ingrese Nombre">
              
            </div>
          </div>
        <div class="control-group">
            <div class="form-group floating-label-form-group-sm controls">
              <label>Email</label>
              <input type="email" class="form-control" placeholder="tumail@example.com" name="email_register" id="email_register" required data-validation-required-message="Por favor ingrese mail.">
              
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group-sm controls">
              <label>Clave</label>
              <input type="password" class="form-control floating-label-form-group-sm" placeholder="*****" name="clave_register" id="clave_register">
              
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group-sm controls">
              <label>Repita la Clave</label>
              <input type="password" class="form-control floating-label-form-group-sm" placeholder="*****" name="clave_register_repeat" id="clave_register_repeat">
              
            </div>
          </div>
          <br>
          
        <div class="form-group">
          <button type="submit" class="btn btn-primary" id="btn_registrar">Guardar</button>
        </div>
          <?= form_close()?>
      </div>
    </div>
  </div>
</div>