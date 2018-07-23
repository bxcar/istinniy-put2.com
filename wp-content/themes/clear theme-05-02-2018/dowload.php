  <?php
        /*
        Template Name: Скачать
        Template Post Type: post, page
        */
        ?>
        <?php
        get_header();

        ?>
    <div class="container">
      <span class="contentsp title"> </span>
        <ul class="products-menu">
    <li class="active"><a data-toggle="tab" href="#panel-shanks">Фото</a></li>
    <li><a data-toggle="tab" href="#panel-dressing">Аудио</a></li>
    <li class="dropdown">
     <li><a data-toggle="tab" href="#panel-big">Скачать книгу</a></li>
        <li><a data-toggle="tab" href="#panel-sets">Видео</a></li>
   
    </li>
  </ul>
    <div class="tab-content">
    <div id="panel-shanks" class="tab-pane fade in active">
   <div class="container">   
        <div class="row">

 <?php $price = query_posts('post_type=post&cat=44');
$count =1;
foreach ($price as $post):
	the_post();?>
<div class="col-md-3 col-sm-6 centered">
<div class="product-box">
	<?php the_post_thumbnail('full',array('class' => 'img-responsive')); ?>
	<span class="name"><?= $post->post_title; ?></span>
	<span class="price"><?php the_content(); ?></span>
	 
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
    <div id="panel-dressing" class="tab-pane fade">  
   <div class="container">
          <div class="row">
           <?php $price = query_posts('post_type=post&cat=44');
$count =1;
foreach ($price as $post):
	the_post();?>
<div class="col-md-3 col-sm-6 centered">
<div class="product-box">
	<?php the_post_thumbnail('full',array('class' => 'img-responsive')); ?>
	<span class="name"><?= $post->post_title; ?></span>
	<span class="price"><?php the_content(); ?></span>
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
    <div id="panel-sets" class="tab-pane fade">   
   <div class="container">
          <div class="row">
           <?php $price1 = query_posts('post_type=post&cat=44');
$count =1;
foreach ($price1 as $post):
	the_post();?>
<div class="col-md-3 col-sm-6 centered">
<div class="product-box">
	<?php the_post_thumbnail('full',array('class' => 'img-responsive')); ?>
	<span class="name"><?= $post->post_title; ?></span>
	<span class="price"><?php the_content(); ?></span>
	 <!-- <a href="#" class="btn btn-default navbar-btn">Заказать</a> -->
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
    <div id="panel-big" class="tab-pane fade">
   <div class="container">
          <div class="row">
            <?php $price2 = query_posts('post_type=post&cat=43');
$count =1;
foreach ($price2 as $post):
	the_post();?>
<div class="col-md-3 col-sm-6 centered">
<div class="product-box">
	<?php the_post_thumbnail('full',array('class' => 'img-responsive')); ?>
	<span class="name"><?= $post->post_title; ?></span>
	<span class="price"><?php the_content(); ?></span>
	<!--  <a href="#" class="btn btn-default navbar-btn">Заказать</a> -->
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
  

  </div>
        




          <?php

        get_footer();