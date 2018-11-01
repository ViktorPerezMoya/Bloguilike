
<script>
var v_postid = <?=$post['id']?>;
</script>

    <!-- Post Content -->
    <article>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
              <div class="liked_div">
                  <p><a href="javascript:void(0);" id="liked"><i class="far fa-thumbs-up"></i> Like (<span><?= $post['liked']?></span>)</a><a href="javascript:void(0);" id="disliked"><i class="far fa-thumbs-down"></i> Dislike (<span><?=$post['disliked']?></span>)</a></p>
              </div>
              <p><?= $post['contenido']?></p>
            <!-- formulario -->
            <hr>
            <p>Escribe tu comentario:</p>
             <form id="new_comment" method="post" action="<?= base_url('posts/coment')?>">
                <div class="control-group">
                  <div class="form-group floating-label-form-group controls">
                    <textarea rows="5" class="form-control" placeholder="Tu comentaro..." name="comentario"></textarea>
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <br>
                <div id="success"></div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary" id="sendMessageButton">Comentar</button>
                </div>
              </form>
          </div>
        </div>
      </div>
    </article>
