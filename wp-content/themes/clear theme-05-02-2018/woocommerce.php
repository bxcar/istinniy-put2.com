<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bible
 */

get_header(); ?>
	<?php if (is_singular("product")) { if (have_posts()) : while (have_posts()) : the_post(); ?><div class="container-fluid forem-description shop-bg"<?php $img = wp_get_attachment_image_src(get_post_meta(get_the_ID(), "previmg", true), 'full'); if ($img[0] != "") { ?> style="background-image:url('<?php echo $img[0]; ?>')"<?php } ?>>
		<div class="description-container">
			<?php $postdata = get_post($post_id = 195); ?>
			<h2><?php if (get_post_meta(get_the_ID(), "prevtitle", true) != "") { echo get_post_meta(get_the_ID(), "prevtitle", true); } else { echo $postdata->post_title; } ?></h2>
			<p><?php if (get_post_meta(get_the_ID(), "prevtext", true) != "") { echo str_replace("\n","<br/>",get_post_meta(get_the_ID(), "prevtext", true)); } else { echo $postdata->post_content; } ?></p>
		</div>
	</div><?php endwhile; endif; } else { ?><div class="container-fluid forem-description shop-bg">
		<div class="description-container">
			<?php $postdata = get_post($post_id = 195); ?>
			<h2><?php echo $postdata->post_title; ?></h2>
			<p><?php echo $postdata->post_content; ?></p>
		</div>
	</div><?php } ?>
	<div class="container">
		<div class="row" style="padding-top: 30px;">
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<?php if (isset($_GET['chapters'])) { if (have_posts()) : while (have_posts()) : the_post(); ?><h2>Содержание</h2><ul class="chapters">
					<?php $colvo=0; foreach(get_field("chapters") as $title) { $colvo++; ?><li><a href="tab<?php echo $colvo; ?>"<?php if($colvo == 1) { echo ' class="select"'; } ?>><?php echo $title['title']; ?></a></li><?php echo "\n					"; } ?>
				</ul><?php endwhile; endif; } else { dynamic_sidebar( 'sidebar_shop' ); } ?>
			</div>
			<div class="all_content shop col-lg-9 col-md-8 col-sm-8 col-xs-12">	
				<?php if (isset($_GET['chapters'])) { $colvo=0; if (have_posts()) : while (have_posts()) : the_post(); ?><h1 class="product_title entry-title"><?php the_title(); ?><br/><small><a href="<?php the_permalink(); ?>">← вернуться на страницу книги</a></small></h1>
				<?php $colvo=0; foreach(get_field("chapters") as $chapter) { $colvo++; ?><div class="chapterstabs" id="tab<?php echo $colvo; ?>"<?php if($colvo > 1) { echo ' style="display:none"'; } ?>><h2><?php echo $chapter['title']; ?></h2>
				<?php echo apply_filters( 'the_content', $chapter['text'] ); ?></div><?php } ?>
				<?php endwhile; endif; wp_reset_query(); } else { woocommerce_content(); } ?>		
			</div>
		</div>
	</div>

<?php
get_footer();
