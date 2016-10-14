<?php get_header();
 if(defined('wp_uou_tigerp_URLPATH')){
	wp_enqueue_style('uou_tigerp-style-71', wp_uou_tigerp_URLPATH . 'assets/cube/css/cubeportfolio.css');
 }
wp_enqueue_style('Company-Profile-style', tiger_CSS.'user-public-profile.css', array(), $ver = false, $media = 'all');
$display_name='';
$email='';
$user_id=1;
 global $current_user;




 if(isset($_REQUEST['id'])){
	   $author_name= $_REQUEST['id'];
		$user = get_user_by( 'slug', $author_name );
	if(isset($user->ID)){
		$user_id=$user->ID;
		$display_name=$user->display_name;
		$email=$user->user_email;
	}
  }else{

	  $user_id=$current_user->ID;
	  $display_name=$current_user->display_name;
	  $email=$current_user->user_email;
	  if($user_id==0){
		$user_id=1;
	  }
  }
	$tigerp_user_status = get_user_meta($user_id, 'uou_tigerp_user_status', true);
	if($tigerp_user_status!='active'){ 
		if($user_id!=$current_user->ID ){
			 include( get_query_template( '404' ) );
			 header('HTTP/1.0 404 Not Found');
            exit; 
		}

	}
  
   $iv_profile_pic_url=get_user_meta($user_id, 'iv_profile_pic_url',true);

	$lat=get_user_meta($user_id,'latitude',true);
	$lng=get_user_meta($user_id,'longitude',true);

	// Get latlng from address* START********
	$dir_lat=$lat;
	$dir_lng=$lng;
	$address = get_user_meta($user_id,'address',true);
	
?>
  <div class="breadcrumb-content">
		<img   src="<?php echo tiger_IMAGE."banner-breadcrumb.jpg";?>" alt="<?php esc_html_e( 'banner', 'tiger' ); ?>">
		<div class="container">
		  <h3><?php esc_html_e( 'Jobs', 'tiger' ); ?></h3>
		</div>
  </div> 
  
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
												
                      $args = array();	
                      //$args['number']=$no;
					  //$args['offset']=$offset;		     
				      $args['post_type']='jobs'; 
				      //$args['author']=$user_id;  
				      $args['post_status']='publish';  			       
					 
					  
                      $job_query = new WP_Query( $args );
                      
					  

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
									  <input name="keyword"  id="keyword"  type="text" placeholder="keyword">
									  
									  <input name="email_address" id="email_address"  type="text" placeholder="E-mail address">
									  <input name="email_address" id="email_address"  type="text" placeholder="E-mail address">
									  <?php
											$directory_url_1='jobs';								
											//$currentCategory=wp_get_object_terms( $post_edit->ID, $directory_url_1.'-category');
											$selected='';
											
											
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
										
									  <select>
										<option>ssss  </option>
										<option>ssss  </option>
									  </select>	  
									  
										
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
