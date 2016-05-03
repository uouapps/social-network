<?php 
/**
 * Template Name: About Us Page
 *
 */
 ?>
<?php get_header(); ?>

   <div class="breadcrumb-content">
		<img   src="<?php echo tiger_IMAGE."banner-breadcrumb.jpg";?>" alt="<?php esc_html_e( 'banner', 'tiger' ); ?>">
		<div class="container">
		  <h3><?php  echo esc_attr($post->post_title) ;?></h3>
		</div>
  </div>  
  <div class="blog-content pt60"> 
    <div class="container">		
       <?php echo apply_filters('the_content',$post->post_content); ?>
    </div>
            
  </div> <!--  end blog-single -->


<?php get_footer();