<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bible
 */

?>
<div class="container-fluid forem-description">
	<div class="description-container">
		<?php	$post = get_post($post_id = 195);	?>
		<h2><?php echo $post ->post_title; ?></h2>
		<p><?php echo $post ->post_content; ?></p>
	</div>
</div>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="container">
		<div class="entry-content">
			<?php
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'bible' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );

			
			?>
		</div><!-- .entry-content -->

		
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
