        <?php
        /*
        Template Name: Блог
        Template Post Type: post, page
        */
        ?>
        <?php
        get_header();

        ?>
              <div class="container-fluid">
                  <div class="row">
           <div class="font_treatment"<?php $img = wp_get_attachment_image_src(get_post_meta(get_the_ID(), "previmg", true), 'full'); if ($img[0] != "") { ?> style="background-image:url('<?php echo $img[0]; ?>')"<?php } ?>>
                <div class="container box-container">
                 <div class="patch-man"><?php if (get_post_meta(get_the_ID(), "prevtitle", true) != "") { echo get_post_meta(get_the_ID(), "prevtitle", true); } else { echo "Лечение народными средствами"; } ?></div><br>
                     <div class="shop-title"><?php if (get_post_meta(get_the_ID(), "prevtext", true) != "") { echo str_replace("\n","<br/>",get_post_meta(get_the_ID(), "prevtext", true)); } else { echo 'Гипертония - лечение народными<br>средствами'; } ?></div>
                </div>
              </div>
                </div>
                     </div>
    <div class="container">
          <div class="show_more"> 
            <div class=".col-md-3 .col-md-offset-3">
          </div>
        </div>
       <div class="block">
          <div class="container">
            <div class="row">
       <?php $price = query_posts('post_type=post&cat=1');
      $count =1;
      foreach ($price as $post):
        the_post();?>
                <div class="post col-lg-12">
                  <div class="post-header">
                    <h6><a href="<?php the_permalink(); ?>"><?= $post->post_title; ?></a></h6>
                  </div>
                  <div class="about col-lg-2 col-md-2 imgprev">
                    <?php the_post_thumbnail('full',array('class' => 'img-responsive')); ?>
                  </div>
                  <div class="info col-lg-10 col-md-10">
                    <p class="font"><?php the_content("<br/>Читать далее..."); ?></p>
                    <div class="post-footer to-left">
                      <div class="button-love to-left top">
                      <p class="love-text">Нравится ли вам это?<?php if(function_exists('wp_ulike')) wp_ulike('get'); ?></p>
                    </div>
                      <div class="post-links to-right"> 
                        <span class="comments">
                       <!--   <i class="fa fa-comment-o" aria-hidden="true"></i><a href="#" class="hover-link number-comment">0</a>  -->
                       </span>
                     <!--   <span class="more"> <a href="#more" class="link hover-link">Подробнее</a></span> -->
                     </div>
                   </div>
                 </div>
               </div>
               <?php if ($count % 2 === 0 ) {
        echo '<div class="clearfix visible-sm"></div>';
      }
      $count++;
      ?>
      <?php
      endforeach;
      wp_reset_query();?>
           </div>
         </div>
      </div>
      <div class="block" style="display: none;text-decoration: ">
          <div class="container">
            <div class="row">
       <?php $price = query_posts('post_type=post&cat=49');
      $count =1;
      foreach ($price as $post):
        the_post();?>
                <div class="post col-lg-12">
                  <div class="post-header">
                    <h6><?= $post->post_title; ?></h6>
                  </div>
                  <div class="about col-lg-2 col-md-2">
                    <?php the_post_thumbnail('full',array('class' => 'img-responsive')); ?>
                  </div>
                  <div class="info col-lg-10 col-md-10">
                    <p class="font"><?php the_content(); ?></p>
                    <div class="post-footer to-left">
                      <div class="button-love to-left top">
                      <p class="love-text">Нравится ли вам это?<?php if(function_exists('wp_ulike')) wp_ulike('get'); ?></p>
                    </div>
                      <div class="post-links to-right"> 
                        <span class="comments">
                       <!--   <i class="fa fa-comment-o" aria-hidden="true"></i><a href="#" class="hover-link number-comment">0</a>  -->
                       </span>
                       <!-- <span class="more"> <a href="http://demo.pinofran.com/demo/booksbog/lechenie/" class="link hover-link">Подробнее</a></span> -->
                     </div>
                   </div>
                 </div>
               </div>
               <?php if ($count % 10 === 0 ) {
        echo '<div class="clearfix visible-sm"></div>';
      }
      $count++;
      ?>
      <?php
      endforeach;
      wp_reset_query();?>
           </div>
         </div>
      </div>
    </div>
    <div class="container">
          <div class="show_more"> 
            <div class=".col-md-3 .col-md-offset-3">
           <!--   <a class="more-project-btn open-more" href="javascript:void(0);">Еще проекты</a> -->
           <!--  <button class="button button-hover text-color" type="submit">Показать еще</button></div> -->
          </div>
        </div>
    </div>
      <div class="container">
          <div class="show_more"> 
            <div class=".col-md-3 .col-md-offset-3">
            <button class="button button-hover text-color" type="submit">Показать еще</button></div>
          </div>
      </div>

  <script>
      $('.show_more button').on('click', function() {
          $('.block').show();
      });
  </script>
        <?php

        get_footer();