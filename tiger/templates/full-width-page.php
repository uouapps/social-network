<?php 
/**
 * Template Name: Full Width Page
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
		
		<div class="row">
			<div class="col-md-12">
						
					<?php echo apply_filters('the_content',$post->post_content); ?>

						
			</div> <!--  end blog-single -->
		</div>
		<?php
		if(comments_open()) {
		?>
		<div class="row">
			<div class="col-md-12">			
				<div class="uou-post-comment"> 
					   <aside class="uou-block-14a">
						  <h5><?php esc_html_e('Comments','comments');?> 
						   <?php 
									if(comments_open() && !post_password_required()){
									  comments_popup_link( '(0)', '(1)', '(%)', 'article-post-meta' );
									}
							?> 
							   
						  </h5>          
						   <?php comments_template('', true); ?>
						</aside>
				</div> <!-- end of comment -->
			</div>
		 </div> 			
    
		<?php
			}
		?>
    
      </div> <!--  end blog-single -->
    </div> <!-- end container -->


<?php get_footer();
