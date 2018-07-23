  <?php
      /*
      Template Name: Статьи
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
               <div class="patch-man"><?php if (get_post_meta(get_the_ID(), "prevtitle", true) != "") { echo get_post_meta(get_the_ID(), "prevtitle", true); } else { echo "Статьи"; } ?></div><br>
               <?php if (get_post_meta(get_the_ID(), "prevtext", true) != "") { echo '<div class="shop-title">'.str_replace("\n","<br/>",get_post_meta(get_the_ID(), "prevtext", true)).'</div>'; } ?>
              </div>
            </div>
              </div>
  </div>
           
       <div class="block">

            <div class="container">
              <div class="row">
            <!--   <div class="sidebar col-md-3"> -->
          
   <div class="sidebar_shop block col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <?php  dynamic_sidebar( 'sidebar_shop' ); ?>
      </div>

             

              <div class="col-md-9 articles"">
              
         <?php $price = query_posts('post_type=post&cat=54');
        $count =1;
        foreach ($price as $post):
          the_post();?>
                  <div class="post">
                    <div class="post-header">
                      <h6><a href="<?php the_permalink(); ?>"><?= $post->post_title; ?></a></h6>
                    </div>
                    <?php if (get_the_post_thumbnail(get_the_ID()) != "") { ?><div class="about col-md-3 imgprev">
                      <?php the_post_thumbnail('full',array('class' => 'img-responsive')); ?>
                    </div><?php } ?>
                   
                    <div class="info-content">
                    
                      <p class="font col-md-9"><?php the_excerpt(); ?></p>
                     
                      <div class="post-footer to-left">
                         <div class="button-love to-left top">
                    <p class="love-text">Нравится ли вам это?<?php if(function_exists('wp_ulike')) wp_ulike('get'); ?></p>

                  </div>
                        <div class="post-links to-right"> 
                          <span class="comments">
                          <!--  <i class="fa fa-comment-o" aria-hidden="true"></i><a href="#" class="hover-link number-comment">0</a>  -->
                         </span>
                         <span class="more"> <a href="<?php the_permalink(); ?>" class="link hover-link">Подробнее</a></span>
                       </div>
                     </div>
                   </div>
                 </div>&nbsp;
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
             </div>  
           </div>
        </div>

        <?php

      get_footer();