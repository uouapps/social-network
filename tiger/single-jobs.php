<?php get_header(); ?>
<?php
$tiger_option_data =get_option('tiger_option_data'); 
?>

<!-- SIngle page code **************************************************************************** -->
  <div class="breadcrumb-content">
		<img   src="<?php echo tiger_IMAGE."banner-breadcrumb.jpg";?>" alt="<?php esc_html_e( 'banner', 'tiger' ); ?>">
		<div class="container">
		  <h3><?php  echo esc_attr($post->post_title) ;?></h3>
		</div>
  </div> 
<div class="compny-profile">
<div class="profile-company-content has-bg-image user-profile">
    <div class="container">
      <div class="row">
        <div class="col-md-8">

					
					<?php if (have_posts()) :while ( have_posts() ) : the_post(); 
						$curr_post_id=get_the_ID();
					  ?>
					 <div class="listing listing-1">
						<div class="listing-section">
                		<div class="listing-ver-3">
							
						  <div class="listing-inner">
							<div class="listing-content">
							  <h6 class="title-company"><?php echo get_post_meta($curr_post_id,'company_name',true); ?> </h6>
							  <span class="location"> <i class="fa fa-map-marker"></i> <?php echo get_post_meta($curr_post_id,'company_address',true); ?>  </span> <span class="type-work full-time">  </span>
								<p>
								 <?php the_content(); ?>
								
							  
							  
							  <h6 class="title-tags"><?php esc_html_e('Skills required','tiger'); ?> :</h6>
							  <ul class="tags list-inline">
								  <?php
								  $var_arr=explode(',',get_post_meta($curr_post_id,'job_skills',true));
								   foreach($var_arr as $skill)
									{?>
										
										<li><a href="#"><?php echo $skill; ?></a></li>
									<?php	
									}
								  ?>
								
								
							  </ul>
							</div>
						  </div>
						  <div class="listing-tabs">
							<ul>
							  <li><a href="#"><i class="fa fa-envelope"></i> <?php echo get_post_meta($curr_post_id,'company_email',true); ?> </a></li>
							  <li><a href="#"><i class="fa fa-phone"></i> <?php echo get_post_meta($curr_post_id,'company_phone',true); ?> </a></li>
							  <li><a href="<?php echo get_post_meta($curr_post_id,'company_web',true); ?>"><i class="fa fa-globe"></i> <?php echo get_post_meta($curr_post_id,'company_web',true); ?></a></li>
							  <li class="share-button"> <a href="#"><i class="fa fa-share"></i> <?php esc_html_e('Share','tiger'); ?></a>
								<div class="contact-share">
								  <ul>
									<li><a href="#"><i class="fa fa-facebook-square"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter-square"></i></a></li>
									<li><a href="#"><i class="fa fa-google-plus-square"></i></a></li>
									<li><a href="#"><i class="fa fa-linkedin-square"></i></a></li>
								  </ul>
								</div>
							  </li>
							</ul>
						  
						  </div>
						</div>
						<div> <p> </p></div>
								
						
						</div>
						</div>
						
									
                      <?php endwhile; else : ?>
                        <?php esc_html_e('No post have found!', 'tiger'); ?>
                      <?php endif; ?>

						
					
                      
                
				



          </div> <!--  end blog-single -->

<!-- ************************** Start Sidebar **************************** -->


            <div class="col-md-4">
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


<!-- ************************** End Sidebar **************************** -->
        </div>
      </div> <!--  end blog-single -->
    </div> <!-- end container -->
</div>
</div>


<?php get_footer(); ?>
