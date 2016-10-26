<?php get_header();
 if(defined('wp_uou_tigerp_URLPATH')){
	wp_enqueue_style('uou_tigerp-style-71', wp_uou_tigerp_URLPATH . 'assets/cube/css/cubeportfolio.css');
 }
wp_enqueue_style('Company-Profile-style', tiger_CSS.'user-public-profile.css', array(), $ver = false, $media = 'all');
$display_name='';

	
?>
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
				<h3> <?php esc_html_e( 'Jobs', 'tiger' ); ?> </h3>
			</div>
		</div>	
		<?php
			}
		?>
  
<div id="">
  <div class="compny-profile">
    <!-- SUB Banner -->
   

    <!-- Profile Company Content -->
    <div class="profile-company-content has-bg-image user-profile">
      <div class="container">
        <div class="row">
			
          <div class="col-md-12">
            <div class="tab-content">
          

			   <div id="jobs" class=" ">
				  <div class="row">
                  
                  <div class="col-md-8">                   

                    <!-- Professional Details -->
                    <div class="sidebar">
                      
                      <div class="similar">
                      <?php                 
					  $keyword_post='';	
					  $selected='';	
					
					   $page =  get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
					   
																	
                      $args = array();	
                      $args['paged']=$page;
					  //$args['offset']=$offset;		     
				      $args['post_type']='jobs'; 
				      //$args['author']=$user_id;  
				      if( isset($_REQUEST['keyword'])){
							if($_REQUEST['keyword']!=""){ 
								$args['s']= $_REQUEST['keyword'];
								$keyword_post=$_REQUEST['keyword'];
								
							}
						}
						if( isset($_REQUEST['postcats'])){
							if($_REQUEST['postcats']!=''){
								$postcats = $_REQUEST['postcats'];
								$args['jobs-category']=$postcats;
								$selected=$postcats;
								
							}
						}
				      $args['post_status']='publish';  			       
					 
					  
                      $job_query = new WP_Query( $args );
                      $GLOBALS['wp_the_query'] = new WP_Query( $args );
					  $GLOBALS['wp_query'] = $GLOBALS['wp_the_query'];
					  

				        // User Loop
				        if ( $job_query->have_posts() ) {
				        	while ( $job_query->have_posts() ) {
								$job_query->the_post();
								$post_id= $job_query->post->ID;
								$curr_post_id=$job_query->post->ID;
							
										$currentCategory=wp_get_object_terms( $id,'jobs-category');
										$cat_link='';$cat_name='';$cat_slug='';
										if(isset($currentCategory[0]->slug)){
											$cat_slug = $currentCategory[0]->slug;
											$cat_name = $currentCategory[0]->name;
											$cat_link= get_term_link($currentCategory[0], 'jobs-category');
										}
										?>
										 
										 <p> </p>
									<div class="row">  	 
										<div class="col-md-2">    
										 <?php
											  if ( has_post_thumbnail() ) {
												$image_id =  get_post_thumbnail_id( get_the_ID() );
												$large_image = wp_get_attachment_url( $image_id ,'full');
												$resize = tiger_aq_resize( $large_image, true );
											   ?>
											  <img src="<?php echo esc_url($resize); ?>" alt="<?php esc_html_e( 'image', 'tiger' ); ?>" class="thumb">
											  <?php } ?>								
										</div>
										<div class="col-md-10">  
											<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h5>
										   <div class="meta"> <span class="subtitle">
											   <?php esc_html_e('Category: ','tiger'); echo $cat_name   ?>  | <?php esc_html_e(' Date : ','tiger'); echo $job_query->post->post_date;   ?> </span>
											 </div>
												  <p>
													<?php $content = $job_query->post->post_content;
															$content = str_replace( ']]>', ']]&gt;', $content );
															echo substr($content ,0,200);
										
														?>
												  <a href="<?php echo get_permalink( $post_id );?>"> <?php esc_html_e( 'Read More','toger' );?></a>
												  </p>
								  
									</div>
									
								  </div>
								  <hr>
								  
							<?php
								}
								
							
							}
							
						
							if ( !$job_query->have_posts() ){
							esc_html_e( 'Sorry, no data matched your criteria.','toger' );
							}
							
						?>
						<!--  start pagination * -->
						  <?php if (function_exists("wp_pagination")) {
								wp_pagination();
						} ?>
						<!--  End of pagination * -->
						
			</div>
							 
					
                      
                    </div>
                
                  </div>

                  <!-- Col -->
                  <div class="col-md-4">

                    <!-- Search Details -->
                    <div class="sidebar">
                      <h5 class="main-title"><?php  esc_html_e('Search','tiger');?> </h5>
                      <div class="sidebar-information">

						   <form id="contact_form_2" name="contact_form_2" action="#" >
									  <input name="keyword"  id="keyword"  type="text" value="<?php echo $keyword_post; ?>" placeholder="keyword">
									  
									
									  <?php
											$directory_url_1='jobs';								
											//$currentCategory=wp_get_object_terms( $post_edit->ID, $directory_url_1.'-category');
											
											
											
											echo '<select name="postcats" class=" ">';
											echo'	<option selected="'.$selected.'" value="">'.__('Choose a category','medico').'</option>';
																		
												//directories
												$taxonomy = $directory_url_1.'-category';
												$args = array(
													'orderby'           => 'name', 
													'order'             => 'ASC',
													'hide_empty'        => false, 
													'exclude'           => array(), 
													'exclude_tree'      => array(), 
													'include'           => array(),
													'number'            => '', 
													'fields'            => 'all', 
													'slug'              => '',
													'parent'            => '0',
													'hierarchical'      => true, 
													'child_of'          => 0,
													'childless'         => false,
													'get'               => '', 
													
												);
									$terms = get_terms($taxonomy,$args); // Get all terms of a taxonomy
									if ( $terms && !is_wp_error( $terms ) ) :
										$i=0;
										foreach ( $terms as $term_parent ) {  ?>												
											
											
												<?php 
												
												echo '<option  value="'.$term_parent->slug.'" '.($selected==$term_parent->slug?'selected':'' ).'><strong>'.$term_parent->name.'<strong></option>';
												?>	
													<?php
													
													$args2 = array(
														'type'                     => $directory_url_1,						
														'parent'                   => $term_parent->term_id,
														'orderby'                  => 'name',
														'order'                    => 'ASC',
														'hide_empty'               => 0,
														'hierarchical'             => 1,
														'exclude'                  => '',
														'include'                  => '',
														'number'                   => '',
														'taxonomy'                 => $directory_url_1.'-category',
														'pad_counts'               => false 

													); 											
													$categories = get_categories( $args2 );	
													if ( $categories && !is_wp_error( $categories ) ) :
															
															
														foreach ( $categories as $term ) { 
															echo '<option  value="'.$term->slug.'" '.($selected==$term->slug?'selected':'' ).'>--'.$term->name.'</option>';
														} 	
																					
													endif;		
													
													?>
																				
		  
										<?php
											$i++;
										} 								
									endif;	
										echo '</select>';	
									?>
										
									  
									  
										
									  <button class="btn btn-primary"><?php  esc_html_e('Search','tiger');?></button>
									 
								</form>	


                      </div>
                    </div>
              
                 
                  </div>
             
                </div>
            
             
             
              </div>
			
		

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



	
<?php get_footer();
