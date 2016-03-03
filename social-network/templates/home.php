<?php
/**
 * Template Name: Home Page
 *
 */
 ?>
 <?php get_header(); ?>
 <?php
 wp_enqueue_style( 'iv_directories-font', 'https://fonts.googleapis.com/css?family=Raleway');




	
?>
 <div class="blog-content pbzero">
 	
	<div class="container">
		<?php echo apply_filters('the_content',$post->post_content); ?>

	</div>

  </div> <!--  end blog-single -->

</div> <!-- end container -->

<div>
	
</div>






<?php get_footer();
