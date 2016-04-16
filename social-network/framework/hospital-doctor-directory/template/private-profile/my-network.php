<?php
$network_tab= (isset($_REQUEST['network'])?$_REQUEST['network']:'connection' );

?>
 <div class="network">
            <h4><?php esc_html_e('Network','medico'); ?> </h4>
            
            <!-- Nav Tabs -->
            <ul class="nav nav-tabs">
              <li <?php echo ($network_tab =='connection'?'class="active"':'' ); ?> ><a data-toggle="tab" href="#connection"><?php esc_html_e('Connections','medico'); 
                $socialnetwork_value='';
				$socialnetwork_value = get_user_meta($current_user->ID,'_my_connect',true);				
				$socialnetwork_value_arr = array_filter( explode(',', $socialnetwork_value), 'strlen' );
				$socialnetwork_value_arr= array_filter(array_map('trim', $socialnetwork_value_arr));
				echo ' ('.sizeof($socialnetwork_value_arr).')';
              	?> </a></li>
              <li <?php echo ($network_tab=='follower'?'class="active"':'' ); ?> ><a data-toggle="tab" href="#follower"><?php esc_html_e('Followers','medico'); ?> 
              <?php
               $socialnetwork_value='';
				$socialnetwork_value = get_user_meta($current_user->ID,'_follower',true);				
				$socialnetwork_value_arr = array_filter( explode(',', $socialnetwork_value), 'strlen' );
				$socialnetwork_value_arr= array_filter(array_map('trim', $socialnetwork_value_arr));
				echo ' ('.sizeof($socialnetwork_value_arr).')';
              	?>
              </a></li>
              <li  <?php echo ($network_tab=='following'?'class="active"':'' ); ?> ><a data-toggle="tab" href="#following"><?php esc_html_e('Following','medico'); ?> 
              <?php
               $socialnetwork_value='';
				$socialnetwork_value = get_user_meta($current_user->ID,'_following',true);				
				$socialnetwork_value_arr = array_filter( explode(',', $socialnetwork_value), 'strlen' );
				$socialnetwork_value_arr= array_filter(array_map('trim', $socialnetwork_value_arr));
				echo ' ('.sizeof($socialnetwork_value_arr).')';
              	?>
              </a></li>
            </ul>
            
            <!-- Tab Content -->
            <div class="tab-content"> 
              
              <!-- Connections -->
              <div id="connection" class="tab-pane fade <?php echo ($network_tab =='connection'?'in active':'' ); ?> ">
                <div class="net-work-in"> 
				<?php
					$connection_type=(isset($_REQUEST['type'])? $_REQUEST['type']:'All' );
					$search_connection=(isset($_POST['connnection_search'])? $_POST['connnection_search']:'' );
					?>
                  <!-- Filter -->
                  <div class="filter-flower">
                    <div class="row">
                      <div class="col-sm-7">
                        <ul>
                          <li><a href="<?php echo the_permalink();?>?&profile=network&network=connection&type=All" <?php echo($connection_type=='All' ?'class="active"':'' ); ?> ><?php esc_html_e('Show All','medico'); ?></a></li>
                          <li><a href="<?php echo the_permalink();?>?&profile=network&network=connection&type=Professionals" <?php echo($connection_type=='Professionals' ?'class="active"':'' ); ?> ><i class="fa fa-user"></i> <?php esc_html_e('Professionals','medico'); ?></a></li>
                          <li><a href="<?php echo the_permalink();?>?&profile=network&network=connection&type=Companies" <?php echo($connection_type=='Companies' ?'class="active"':'' ); ?> ><i class="fa fa-building-o"></i> <?php esc_html_e('Companies','medico'); ?></a></li>
                        </ul>
                      </div>
                      
                      <!-- Short -->
                      <div class="col-sm-5">
                        <!--
                        <select>
                          <option>Sort</option>
                          <option>Sort</option>
                          <option>Sort</option>
                          <option>Sort</option>
                        </select>
                      -->
                      </div>
                      
                    </div>
                  </div>
                  
                  <!-- Members -->
                  <div class="main-mem"> 
                    
                    <!-- Head -->
                    <div class="head">
                      <div class="row">
                        <div class="col-sm-8">
                          <button onclick="connection_make_follow();" ><i class="fa fa-user-plus"></i><?php esc_html_e('Follow','medico'); ?></button>
                          <button onclick="connection_make_delete_conection();"  ><i class="fa fa-trash"></i><?php esc_html_e('Delete','medico'); ?></button>
                        </div>
                        <div class="col-sm-4">
                           <form action="<?php echo the_permalink().'?&profile=network&network=connection'; ?>" method="post" id="connection_form" name="connection_form" >
								<input type="text" id="connnection_search" name="connnection_search"  placeholder="<?php esc_html_e('Search','medico'); ?>" value="<?php echo $search_connection; ?>">
								<button    ><i class="fa fa-search"></i></button>
                          </form>
                        </div>
                      </div>
                    </div>
                    
                    <!-- Tittle -->
                    <div class="tittle">
                      <ul class="row">
                        <li class="col-xs-4"> <span><?php esc_html_e('Title','medico'); ?></span> </li>
                        <li class="col-xs-3"> <span><?php esc_html_e('Location','medico'); ?></span> </li>
                        <li class="col-xs-3"> <span><?php esc_html_e('Network','medico'); ?></span> </li>
                        <li class="col-xs-2 n-p-r n-p-l"> <span><?php esc_html_e('Connections','medico'); ?></span> </li>
                      </ul>
                    </div>
                    
                    <!-- Tittle -->
                    <form id="connection_form_list" name="connection_form_list" style="padding: 0px">
						<div class="folow-persons">
						  <ul>
							<?php
							$socialnetwork_value='';
							$socialnetwork_value = get_user_meta($current_user->ID,'_my_connect',true);	                       
							$socialnetwork_value = array_filter(explode(",", $socialnetwork_value));
							
							$args = array();				
							$no=1;						
							$paged = 1;						
							$offset=0;  
							
							if(isset($_POST['connnection_search'])){								
								
								$args['meta_query']=array(
										'relation' => 'AND',
											array(
												'key'     => 'profile_name',
												'value'   => $search_connection,
												'compare' => 'LIKE'
											)
											
									);
								
							
							}
							
							if($connection_type!='All'){
								if($connection_type=='Professionals'){								
									
									$args['meta_query']=array(
										'relation' => 'AND',
											array(
												'key'     => 'iv_member_type',
												'value'   => 'professional',
												'compare' => '='
											)
											
									);
								}
								if($connection_type=='Companies'){
									
									$args['meta_query']=array(
										'relation' => 'AND',
											array(
												'key'     => 'iv_member_type',
												'value'   => 'corporate',
												'compare' => '='
											)
											
									);
								}	
							}
							//$offset= ($paged-1)*$no;
							
							
							$args['number']=$no;
							$args['offset']=$offset;							
							$args['include']=$socialnetwork_value;
							
						if(sizeof($socialnetwork_value)>0){
							$user_query = new WP_User_Query( $args );	
						  	
							if ( ! empty( $user_query->results ) ) {
								foreach ( $user_query->results as $user ) {		
									$iv_profile_pic_url=get_user_meta($user->ID, 'iv_profile_pic_thum',true);
									if($iv_profile_pic_url==''){ 
										$iv_profile_pic_url= wp_iv_directories_URLPATH.'assets/images/Blank-Profile.jpg';
									}
									$reg_page_user='';
									$user_type= get_user_meta($user->ID,'iv_member_type',true);
									if($user_type=='corporate'){
										$iv_redirect_user = get_option( '_iv_corporate_profile_public_page');
										$reg_page_user= get_permalink( $iv_redirect_user) ;
									}else{
										
										$iv_redirect_user = get_option( '_iv_personal_profile_public_page');
										$reg_page_user= get_permalink( $iv_redirect_user) ;
									}							
									?>
									 <!-- MEMBER -->
									 
										<li >
										  <div class="row">
											<div class="col-xs-4"> 
											  <!-- Check Box -->
											  <div class="checkbox">
												<input id="connection_id[]" name="connection_id[]" value="<?php echo $user->ID; ?>" class="styled" type="checkbox">
												<label for="checkbox1"></label>
											  </div>
											  <!-- Name -->
											  <div class="fol-name">
												<div class="avatar">
													<a href="<?php echo $reg_page_user.'?&id='.$user->user_login; ?>">	
													 <img src="<?php echo $iv_profile_pic_url; ?>" alt="image"> 
													 </a>
												</div>
												<a href="<?php echo $reg_page_user.'?&id='.$user->user_login; ?>">		
												<h6><?php echo (get_user_meta($user->ID,'profile_name',true)!=''? get_user_meta($user->ID,'profile_name',true): $user->display_name )  ;?></h6>
												</a>
												<span><?php echo ( get_user_meta($user->ID,'iv_member_type',true)=='corporate' ? get_user_meta($user->ID,'company_type',true):get_user_meta($user->ID,'designation',true) ) ;   ?></span> </div>
											</div>
											<!-- Location -->
											<div class="col-xs-3 n-p-r n-p-l"> <span><?php echo get_user_meta($user->ID,'address',true); ?> </span> </div>
											<!-- Network -->
											<div class="col-xs-3 n-p-r"> <span>
													<?php 
													$socialnetwork_value='';
													$socialnetwork_value = get_user_meta($user->ID,'_follower',true);				
													$socialnetwork_value_arr = array_filter( explode(',', $socialnetwork_value), 'strlen' );
													$socialnetwork_value_arr= array_filter(array_map('trim', $socialnetwork_value_arr));
													echo sizeof($socialnetwork_value_arr).' ';	
													?><?php esc_html_e('Followers','medico'); ?></span> <span>
														<?php 
														$socialnetwork_value='';
														$socialnetwork_value = get_user_meta($user->ID,'_following',true);				
														$socialnetwork_value_arr = array_filter( explode(',', $socialnetwork_value), 'strlen' );
														$socialnetwork_value_arr= array_filter(array_map('trim', $socialnetwork_value_arr));
														echo sizeof($socialnetwork_value_arr).' ';	
														?>												
													<?php esc_html_e('Following','medico'); ?></span> </div>
											<!-- Connections -->
											<div class="col-xs-2 n-p-r n-p-l"> <span>
												<?php 
													$socialnetwork_value='';
													$socialnetwork_value = get_user_meta($user->ID,'_connecter',true);				
													$socialnetwork_value_arr = array_filter( explode(',', $socialnetwork_value), 'strlen' );
													$socialnetwork_value_arr= array_filter(array_map('trim', $socialnetwork_value_arr));
													echo sizeof($socialnetwork_value_arr).' ';	
													?>											
												 <?php esc_html_e('Connections','medico'); ?></span> </div>
										  </div>
										</li>
										
									<?php
								}
								$total_user = $user_query->total_users;  
								$total_pages_connection=ceil($total_user/$no);
								if($total_pages_connection>1){
								
									echo'<div id="add_more_connection"></div>';
									echo'<div class="text-center" id="add_more_connection_loading"></div>';
									
									echo'<div class="text-center" id="add_more_connection_more_button"><button type="button" onclick="add_more_connection_ajax(2);"><i class="fa fa-plus"></i> '.esc_html__(' More','medico').'</button> </div>';
								}
							} else {?>
								<li>
								 <?php esc_html_e('No result found.','medico'); ?>
								</li>
							<?php	 
							}
						}else{
							?>
								<li>
								 <?php esc_html_e('No result found.','medico'); ?>
								</li>
							<?php
						
						
						}	
							
							?>
							
							
						  </ul>
						</div>
                 
					</form>
                  </div>
                 				
                </div>
           
              </div>
              
              <!-- Followers -->
              <div id="follower" class="tab-pane fade  <?php echo ($network_tab =='follower'?'in active':'' ); ?> ">
				  <?php
				  include(  wp_iv_directories_template. 'private-profile/my-follower.php');
				  ?>
           
              </div>
              
              <!-- Following -->
              <div id="following" class="tab-pane fade  <?php echo ($network_tab =='following'?'in active':'' ); ?> ">
				<?php
				  include(  wp_iv_directories_template. 'private-profile/following.php');
				  ?>
              
              
               </div>
            </div>
          </div>
 
<script>
function connection_make_follow(){
	var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';

	var search_params={
			"action"  : 	"iv_directories_bulk_connection_make_follow",	
			"form_data":	jQuery("#connection_form_list").serialize(), 
		};
		jQuery.ajax({					
			url : ajaxurl,					 
			dataType : "json",
			type : "post",
			data : search_params,
			success : function(response){						
				alert('success');
			}
		});
	
	//alert(all_connection);
}
function connection_make_delete_conection(){
	var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
	

	var search_params={
			"action"  : 	"iv_directories_bulk_connection_make_deleteconnection",	
			"form_data":	jQuery("#connection_form_list").serialize(), 
		};
		jQuery.ajax({					
			url : ajaxurl,					 
			dataType : "json",
			type : "post",
			data : search_params,
			success : function(response){						
				alert('success');
			}
		});
	
	//alert(all_connection);
}	
function add_more_connection_ajax(page){
var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
var total_page=<?php echo $total_pages_connection; ?>;	
	var loader_image = '<img src="<?php echo wp_iv_directories_URLPATH. "admin/files/images/loader.gif"; ?>" />';
		jQuery('#add_more_connection_loading').html(loader_image);
		
		var search_params={
			"action"  : 	"iv_directories_load_more_connection",	
			"data": "page=" + page +"&type=<?php echo $connection_type; ?>" , 
		};
		jQuery.ajax({					
			url : ajaxurl,					 
			//dataType : "json",
			type : "post",
			data : search_params,
			success : function(response){						
				page=page+1;
				jQuery('#add_more_connection_loading').html('');
				jQuery('#add_more_connection').append(response);
				//jQuery('#add_more_connection_more_button').html('')
				
				if(page<=total_page){ 
				jQuery('#add_more_connection_more_button').html('<div class="text-center" id="add_more_connection_more_button"><button type="button" onclick="add_more_connection_ajax('+ page +');"><i class="fa fa-plus"></i> More</button> </div>');
				}else{
					jQuery('#add_more_connection_more_button').html('');
				}
			}
		});

}	
</script>	     
