<?php 
/**
 * Template Name: About Us Page
 *
 */
 ?>
<?php get_header(); ?>

   <div class="breadcrumb-content">
		<img   src="<?php echo SB_IMAGE."banner-breadcrumb.jpg";?>" >
		<div class="container">
		  <h3><?php  echo $post->post_title ;?></h3>
		</div>
  </div>  
  <div class="blog-content pt60"> 
    <div class="container">		
       <?php echo apply_filters('the_content',$post->post_content); ?>
    </div>
            
  </div> <!--  end blog-single -->


<?php get_footer();
