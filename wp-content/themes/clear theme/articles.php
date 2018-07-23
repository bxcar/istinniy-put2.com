  <?php
      /*
      Template Name: Статьи
      Template Post Type: post, page
      */
      ?>

  <?php
    get_header();









if (isset($_GET['sss']) && $_GET['sss']=='sss') {





  $query = new WP_Query(array(
    'posts_per_page' => '-1',
    'post_type' => 'post',
  ));

  if( $query->have_posts() ){ 
    while( $query->have_posts() ){ $query->the_post();

      echo get_the_ID().'<br>';
      update_post_meta(get_the_ID(), 'article_order', 0);
      flush();
      ob_flush();

    }
  }

  die();
}






    $catid = null;
      if (isset($_GET['catid'])) {
      $catid = $_GET['catid'];
    }
  ?>
      
  <div class="container-fluid">
    <div class="row">
      <div class="font_news">
        <div class="container box-container">
          <?php echo do_shortcode('[xyz-ihs snippet="Stati-text"]'); ?>
        </div>
      </div>
    </div>
  </div>
             
  <div class="block">

    <div class="container">
      <div class="row">

        <div class="col-xs-12 col-sm-3 articles-menu">
          <ul>
            <?php $args = array('parent' => 54); ?>
            <?php $categories = get_categories( $args ); ?>
  
            <?php $i = 0; ?>
            <?php foreach($categories as $category) { ?>
              <li>

                <a class="toggle_list <?php echo ($i===0)?'active':'' ?>" data-target="#parrent_<?php echo $category->term_id ?>"  data-id="<?php echo $category->term_id ?>" style="font-size: 20px;" href="<?php echo get_site_url() ?>/article?catid=<?= $category->term_id ?>"
                title="<?= sprintf( __( "Смотреть всё для: %s" ), $category->name ) ?>">
                  <?= $category->name ?>
                </a>

                <ul class="toggle_list_item <?php echo ($i===0)?'active':'' ?>" id="parrent_<?php echo $category->term_id ?>" style="padding-left: 15px; padding-bottom: 20px; padding-top: 10px;">
                  <?php $query = new WP_Query(array(
                    'cat' => $category->term_id,
                    'posts_per_page' => '-1',
                    'meta_key' => 'article_order',
                    'meta_type' => 'NUMERIC',
                    'orderby'  => 'meta_value_num',
                    'order' => 'DESC',

                  )); ?>
                  <?php if( $query->have_posts() ){ ?>
                  <?php $r = 0; ?>
                    <?php while( $query->have_posts() ){ $query->the_post(); ?>

                      <?php 
                        if ($r === 0 && $i===0){
                          $first_id = get_the_ID();
                        }
                      ?>
                      <li style="padding-top: 3px; padding-bottom: 3px;">
                        <a class="ajax_article_link" data-id="<?php echo get_the_ID() ?>" style="font-size: 16px;" href="<?php  the_permalink(get_the_ID()); ?>"><?= get_the_title() ?></a>
                      </li>
                      <?php $r++; ?>

                    <?php } ?>

                  <?php } ?>
                  <?php wp_reset_postdata(); ?>
                </ul>

              </li>
              <?php $i++; ?>
            <?php } ?>

          </ul>
        </div>
        <div class="col-xs-12 col-sm-9 articles" id="ajax_articles">

          <?php 
            $args = array(
              'post_type' => 'post',
              'cat'   => '54,58,59',
              'p'     => $first_id
            );
            if ($catid != null) {
              $args['p'] = $first_id;
              $args['post_type'] = 'post';
              $args['cat'] = $catid;
            }
            $price = query_posts($args);
            $count =1;

            foreach ($price as $post){ 
          ?>

          <?php the_post(); ?>
          <?php get_template_part('/template-parts/content-page') ?>
          <?php 
              if ($count % 2 === 0 ) {
              echo '<div class="clearfix visible-sm"></div>';
              }
              $count++;
            }
            if ( comments_open() || get_comments_number()  ) :
              comments_template();
            endif;
            wp_reset_query();
          ?>

          </div>

        </div>
      </div>
    </div>  
  </div>
</div>

<style>
  .articles-menu ul li:not(:first-of-type) .toggle_list_item{
    display: none;
  }
  .articles-menu ul li a.active{
    color: #288965;
  }
  div#ajax_articles.active::before {
      content: " ";
      display: block;
      position: absolute;
      width: 100%;
      height: 100%;
      left: 0;
      right: 0;
      top: 0;
      bottom: 0;
      z-index: 3;
      background: #ffffff7a;
  }
  #ajax_articles .entry-content p{
    margin: 0 auto;
  }
</style>
<script>
  jQuery(document).ready(function($) {


    $('.articles-menu').on('click', '.toggle_list', function(event) {
      event.preventDefault();
      
      var target = $(this).attr('data-target');

      $('.articles-menu .active').removeClass('active');

      $(target).addClass('active');
      $(this).addClass('active');
      $('.articles-menu .toggle_list_item:not(.active)').slideUp('300', function() {
        $('.articles-menu .toggle_list_item.active').slideDown('300');
      });


      var data = new Object();
      data.action = 'get_query_ip';
      data.query = '';
      data.category = $(this).attr('data-id');
      data.taxonomy = 'category';
      data.template = '/template-parts/content-page';
      data.posts_per_page = '1';
      data.sortbymeta = 'article_order';

      $.ajax({
        method: "POST",
        url: ajax.url,
        data: data,
        beforeSend: function() {
          $('#ajax_articles').addClass('active');
        },
      })
      .done(function(data) {
        $('#ajax_articles').html(data);
        $('#ajax_articles').removeClass('active');
      });

    });

    $('.toggle_list_item, #ajax_articles').on('click', '.ajax_article_link', function(event) {
      event.preventDefault();
      var id = $(this).attr('data-id');

      var data = new Object();
      data.action = 'get_query_ip';
      data.query = '';
      data.category = '';
      data.taxonomy = '';
      data.template = '/template-parts/content-page';
      data.postid = id;
      data.posttype = 'post';

      $.ajax({
        method: "POST",
        url: ajax.url,
        data: data,
        beforeSend: function() {
          $('#ajax_articles').addClass('active');
        },
      })
      .done(function(data) {
        $('#ajax_articles').html(data);
        $('#ajax_articles').removeClass('active');
      });

    });


  });
</script>


<?php

get_footer();