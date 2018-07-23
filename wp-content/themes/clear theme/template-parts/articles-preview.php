            <!--Новый вывод данных-->

            <?php if(in_category('premium')) { ?>
              <div class="row novosti-wrapper" style="box-shadow: 0 0 36px 0 rgba(40, 137, 101, 0.6); position: relative;">
                <a class="ajax_article_link" data-id="<?php echo get_the_ID() ?>" href="<?php the_permalink(); ?>" style="position: absolute; top:0; left: 0; width: 100%; height: 100%; z-index: 1;"></a>
                <span class="premium-title">Премиум</span>
            <?php } else { ?>
              <div class="row novosti-wrapper" style="position: relative">
                <a class="ajax_article_link" data-id="<?php echo get_the_ID() ?>" href="<?php the_permalink(); ?>" style="position: absolute; top:0; left: 0; width: 100%; height: 100%; z-index: 1;"></a>
            <?php } ?>

            <?php if (get_the_post_thumbnail(get_the_ID()) != "") { ?>

              <div class="col-md-3 col-sm-3 col-xs-12 text-center">
                <div class="about imgprev">
                  <?php the_post_thumbnail('full',array('class' => 'img-responsive')); ?>
                </div>
              </div>

              <div class="col-md-9 col-sm-9 col-xs-12">

                <div class="blogi-zagolovok">
                  <a class="ajax_article_link" data-id="<?php echo get_the_ID() ?>" href="<?php the_permalink(); ?>"><?= $post->post_title; ?></a>
                </div>

                <div class="blogi-date">
                  <?php
                    $date = new DateTime($post->post_date);
                    echo $date->Format('d.m.Y');
                  ?>
                </div>

                <div class="blogi-introtext">
                  <?php 
                    $text=$post->post_content;				    
                    $string = strip_tags($text);
                    $string = substr($string, 0, 300);
                    $string = rtrim($string, "!,.-");
                    $string = substr($string, 0, strrpos($string, ' '));
                    echo $string."… ";
                  ?>
                </div>

                <div class="post-footer to-left" style="position: relative; z-index: 2;">
                  <div class="button-love to-left top">
                    <p class="love-text">Нравится ли вам это?<?php if(function_exists('wp_ulike')) wp_ulike('get'); ?></p>
                  </div>
                  <div class="post-links to-right"> 
                    <span class="comments"></span>
                    <span class="more"> <a href="<?php the_permalink(); ?>" class="link hover-link">Подробнее</a></span>
                  </div>
                </div>

              </div>

            <?php } else { ?>

              <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="blogi-zagolovok">
                  <a class="ajax_article_link" data-id="<?php echo get_the_ID() ?>" href="<?php the_permalink(); ?>"><?= $post->post_title; ?></a>
                </div>

                <div class="blogi-date">
                  <?php
                    $date = new DateTime($post->post_date);
                    echo $date->Format('d.m.Y');
                  ?>
                </div>

                <div class="blogi-introtext">
                  <?php  
                    $text = $post->post_content;				    
                    $string = strip_tags($text);
                    $string = substr($string, 0, 300);
                    $string = rtrim($string, "!,.-");
                    $string = substr($string, 0, strrpos($string, ' '));
                    echo $string."… ";
                  ?>
                </div>

                <div class="post-footer to-left"  style="position: relative; z-index: 2;">
                  <div class="button-love to-left top">
                    <p class="love-text">Нравится ли вам это?<?php if(function_exists('wp_ulike')) wp_ulike('get'); ?></p>
                  </div>
                  <div class="post-links to-right"> 
                    <span class="comments">
                    </span>
                    <span class="more"> <a href="<?php the_permalink(); ?>" class="link hover-link">Подробнее</a></span>
                  </div>
                </div>

              </div>

            <?php } ?>

            </div>
            <!--Новый вывод данных-->