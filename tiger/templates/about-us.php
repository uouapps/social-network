<?php 
/**
 * Template Name: About Us Page
 *
 */
 ?>
<?php get_header(); ?>

	<?php
		$top_breadcrumb_image= tiger_IMAGE."banner-breadcrumb.jpg";
        if(isset($tiger_option_data['tiger-banner-breadcrumb']['url']) AND $tiger_option_data['tiger-banner-breadcrumb']['url']!=""):
			$top_breadcrumb_image=esc_url($tiger_option_data['tiger-banner-breadcrumb']['url']);
         endif;
         
         $tiger_breadcrumb_value='1';
         if(isset($tiger_option_data['tiger-breadcrumb']) AND $tiger_option_data['tiger-breadcrumb']!=""):
			$tiger_breadcrumb_value=$tiger_option_data['tiger-breadcrumb'];
         endif;
         
         
         if($tiger_breadcrumb_value=='1'){ 
		?>
		 <div class="breadcrumb-content">
			<img   src="<?php echo $top_breadcrumb_image;?>" alt="<?php esc_html_e( 'banner', 'tiger' ); ?>">
			<div class="container">
				<h3> <?php the_title(); ?> </h3>
			</div>
		</div>	
		<?php
			}
		?>
  <div class="blog-content pt60"> 
    <div class="container">		
       <?php echo apply_filters('the_content',$post->post_content); ?>
    </div>
            
  </div> <!--  end blog-single -->


<?php get_footer();
