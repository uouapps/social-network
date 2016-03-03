<?php
//wp_enqueue_style('iv_directories-style-1109', wp_iv_directories_URLPATH . 'admin/files/css/iv-bootstrap.css');
//wp_enqueue_script('iv_directories-ar-script-21', wp_iv_directories_URLPATH . 'admin/files/js/bootstrap.min.js');
wp_enqueue_style('iv_directories-style-11010', wp_iv_directories_URLPATH . 'admin/files/css/image_gallery.css');

$feature_post_ids =array();
if(!isset($atts['post_ids']) || $atts['post_ids']==''){
	$args = array(
		'post_type' => 'hospital', // enter your custom post type		
		'post_status' => 'publish',
		'showposts'=>'3',
		'orderby' => 'rand',
		
	);
	$the_feature = new WP_Query( $args );  
		 if ( $the_feature->have_posts() ) : 	
			while ( $the_feature->have_posts() ) : $the_feature->the_post();
						$id = get_the_ID();
						$feature_post_ids[]=$id;						
			endwhile; 
	 endif;
}else{
		$feature_post_ids = explode(",", $atts['post_ids']);
}

?>
	<div class="pb30">
			<div class="row">		
				<div class="col-md-12 ">	
				<div class="row">
					<div class="categories-imgs text-center">
			
						<?php
						foreach($feature_post_ids as $fpost){
							
							 $id =$fpost;
							 $post = get_post($id);
							 if($post!=''){
								$feature_img='';
								if(has_post_thumbnail($id)){ 
									$feature_image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'large' );
									if($feature_image[0]!=""){ 							
										$feature_img =$feature_image[0];
									}					
								}else{
									$feature_img= wp_iv_directories_URLPATH."/assets/images/default-directory.jpg";					
								
								}
								
								$currentCategory=wp_get_object_terms( $id, 'hospital-category');
								$cat_link='';$cat_name='';$cat_slug='';
								if(isset($currentCategory[0]->slug)){										
									$cat_slug = $currentCategory[0]->slug;
									$cat_name = $currentCategory[0]->name;
									
									$cat_link= get_term_link($currentCategory[0], 'hospital-category');
									
								}
							?>

							<div class="col-md-4">
							
							<a href="<?php echo get_post_permalink($id); ?>" style="color:#000000;">
								<div class="image-wrapper-content">
									<img src="<?php echo $feature_img; ?>" class="home-category-img" alt="home category">
									<div class="categories-wrap-shadow"></div>
									<div class="inner-meta ">
										<!-- <div><?php echo $post->post_title;  ?></div>
										<small><?php echo $cat_name; ?></small> -->
										<i class="fa fa-link"></i>
									</div>
								</div>
												
																									
								<span style="font-size:15px;"><?php echo $post->post_title;  ?></span>
								
							</a>
							</div>
							
						<?php
							}
						
						}
				
			?>
			</div>
		</div>
	</div>
	</div>
</div>
