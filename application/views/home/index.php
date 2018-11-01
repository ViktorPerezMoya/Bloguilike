
    
    <!-- Main Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
           <?php 
           
           foreach ($posts as $p){
               ?>
                <div class="post-preview">
                <a href="<?=base_url('posts/post/'.$p['id'])?>">
                  <h2 class="post-title">
                    <?= $p['titulo']?>
                  </h2>
                  <h3 class="post-subtitle">
                    <?=$p['subtitulo']?>
                  </h3>
                </a>
                <p class="post-meta">Publicado por
                  <a href="#"><?=$p['autor']?></a>
                  el <?= strftime('%d de %B de %Y',strtotime($p['created_at'])); ?>
                  <img src="<?= base_url('public/img/perfil.jpg')?>" class="img-thumbnail img-posts"></p>
                <p class="liked_p">
                    <span><i class="far fa-thumbs-up"></i> Liked (<?= $p['liked']?>)</span>
                    <span><i class="far fa-thumbs-down"></i> Disliked (<?=$p['disliked']?>)</span>
                </p>
              </div>
              <hr>
               <?php
           }
           ?>
          
          <!-- Pager -->
          <div class="clearfix">
            <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
          </div>
        </div>
      </div>
    </div>

