
    <!-- Main Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <p>Crea tu post a tu manera!</p>
          <!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work. -->
          <!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address! -->
          <!-- To use the contact form, your site must be on a live web host with PHP! The form will not work locally! -->
          <div style="color:red;"><?php echo validation_errors(); ?></div>
            <?= form_open('posts/create')?>
            <div class="control-group">
              <div class="form-group floating-label-form-group controls">
                <label>Titulo</label>
                <input type="text" class="form-control" placeholder="Titulo" id="titulo" name="titulo" >
              </div>
            </div>
            <div class="control-group">
              <div class="form-group floating-label-form-group controls">
                <label>Subtitulo</label>
                <input type="text" class="form-control" placeholder="Subtitulo" id="subtitulo" name="subtitulo" >
              </div>
            </div>
            <div class="control-group">
              <div class="form-group floating-label-form-group controls">
                <label>Contenido</label>
                <textarea rows="25" class="form-control" placeholder="Contenido del post" name="contenido" id="editor"></textarea>
              </div>
            </div>
            <br>
            <div id="success"></div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary" id="sendMessageButton">Guardar</button>
            </div>
          <?= form_close()?>
        </div>
      </div>
    </div>
    <script>
    ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );
    </script>
