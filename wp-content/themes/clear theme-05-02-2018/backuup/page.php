<?php
/**
 * Description: Page pattern  
 * Template name: SomePage
 * Theme Name: SomeTheme
 * CMS: WordPress
 */
?> 

<?php get_header(); ?>

<?php
  // Start the loop.
  while ( have_posts() ) : the_post();
  ?>
  
  <!-- HTML -->
     
  <?php
  // End of the loop.
  endwhile;
?>


<?php get_sidebar(); ?>
<?php get_footer(); ?>