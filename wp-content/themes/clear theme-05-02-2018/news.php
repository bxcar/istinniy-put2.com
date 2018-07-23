 <?php
      /*
      Template Name: Новости
      Template Post Type: post, page
      */
      ?>
       <?php
      get_header();
      ?>
      <div class="container-fluid">
      <div class="row">
      	<div class="font_news">
      		<div class="container box-container">
      			<div class="patch-man">Блог «Истинный путь человека»</div>
      				<div class="shop-title">Гипертония - лечение народными <br>средствами</div>
      		
      		</div>
      	</div>
      </div>
      </div>

       <div class="block">

            <div class="container">
              <div class="row">
            
   <!--  <div class="row" style="padding-top: 30px;">
      <div class="sidebar_shop col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <?php  dynamic_sidebar( 'sidebar_shop' ); ?>
      </div>
   
</div> -->
  
              <div class="col-md-12">
         <?php $price = query_posts('post_type=post&cat=53');
        $count =1;
        foreach ($price as $post):
          the_post();?>
                  <div class="post">
                    <div class="post-header">
                      <h6><a href="<?php the_permalink(); ?>"><?= $post->post_title; ?></a></h6>
                    </div>
                    <?php if (get_the_post_thumbnail(get_the_ID()) != "") { ?><div class="about col-md-3 imgprev">                      <?php the_post_thumbnail('full',array('class' => 'img-responsive')); ?>                    </div><?php } ?>
                    <div class="info-content">
                    
                      <p class="font col-md-9"><?php the_content("<br/>Читать далее..."); ?></p>
                     
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
         <div class="block" style="display: none"> 
            <div class="container">
              <div class="row">
              <div class="sidebar col-md-3">
              </div>
              <div class="col-md-9">
         <?php $price = query_posts('post_type=post&cat=27');
        $count =1;
        foreach ($price as $post):
          the_post();?>
                  <div class="post">
                    <div class="post-header">
                      <h6><?= $post->post_title; ?></h6>
                    </div>
                    <div class="about col-md-3 ">
                      <?php the_post_thumbnail('full',array('class' => 'img-responsive')); ?>
                    </div>
                    <div class="info-content">
                    
                      <p class="font col-md-9"><?php the_content(); ?></p>
                     
                      <div class="post-footer to-left">
                         <div class="button-love to-left top">
                    <p class="love-text">Нравится ли вам это?<?php if(function_exists('wp_ulike')) wp_ulike('get'); ?><!-- <span class="love-icon"> 8 </span> --></p>

                  </div>
                        <div class="post-links to-right"> 
                          <span class="comments">
                           <i class="fa fa-comment-o" aria-hidden="true"></i><a href="#" class="hover-link number-comment">0</a> 
                         </span>
                         <span class="more"> <a href="http://demo.pinofran.com/demo/booksbog/lechenie/" class="link hover-link">Подробнее</a></span>
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
        </div>
          <div class="container">
            <div class="show_more"> 
              <div class=".col-md-3 .col-md-offset-3"><button class="button button-hover text-color" type="submit">Показать еще</button></div>
            </div>
          </div>


	 <script>
      $('.show_more button').on('click', function() {
          $('.block').show();
      });
  </script>
  <?php
          get_footer();