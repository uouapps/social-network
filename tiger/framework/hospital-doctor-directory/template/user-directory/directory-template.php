<meta name="viewport" content="width=device-width, initial-scale=1">
<title> <?php wp_title('|', true, 'right'); ?> </title>
<!-- Bootstrap -->

<?php
wp_enqueue_style('user-dir-style', tiger_CSS.'user-directory.css', array(), $ver = false, $media = 'all');

global $wpdb;
?>

<script>
	jQuery(function() {
    jQuery('#package_sel').change(function() {
        this.form.submit();
    });
});
</script>
		<?php
		$package ='';
		if(isset($_REQUEST['package_sel'])){
			$package = $_REQUEST['package_sel'];
		}
		if($package==''){
			if(isset($_REQUEST['package'])){
				$package=$_REQUEST['package'];
			}
		}
		$search_user='';
		if(isset($_POST['search_user'])){
			$search_user = $_POST['search_user'];
			//$package = $_POST['package_hidden'];
		}

		?>
				<div id="header">
					<div class="header-search-bar">
						<div class="container">
							<form>
								<div class="basic-form clearfix">
									<a href="#" class="toggle"></a>

									<div class="hsb-input-1">
										<input type="text" class="form-control" placeholder="Keyword">
									</div>

									<div class="hsb-container">
										<div class="hsb-input-2">
											<input type="text" class="form-control" placeholder="Location">
										</div>

										<div class="hsb-select">
											<input type="text" class="form-control" placeholder="Profession">

										</div>
									</div>

									<div class="hsb-submit">
										<input type="submit" class="btn btn-default btn-block" value="Search Professionals">
									</div>
								</div>


							</form>
						</div>
						<div class="advanced-form">

							<div class="container">
								<div class="row">
									<label class="col-md-3 filter-result">Filter Results</label>

									<div class="col-md-9">
									</div>
								</div>
								<div class="row">
									<label class="col-md-3">Distance (in kilometers):</label>

									<div class="col-md-9">
										<div class="range-slider">
											<div class="slider" data-min="1" data-max="200" data-current="100"></div>
											<div class="last-value"><span>100</span> km</div>
										</div>
									</div>
								</div>

								<div class="row">
									<label class="col-md-3">Rating:</label>

									<div class="col-md-9">
										<div class="range-slider">
											<div class="slider" data-min="1" data-max="100" data-current="20"></div>
											<div class="last-value">&gt; <span>20</span> %</div>
										</div>
									</div>
								</div>

								<div class="row">
									<label class="col-md-3">Location:</label>

									<div class="col-md-9">
										<input type="text" class="form-control" placeholder="Switzerland">
									</div>
								</div>

								<div class="row">
									<label class="col-md-3">Industry:</label>

									<div class="col-md-9">
										<select class="form-control">
											<option value="">Select Industry</option>
											<option value="">Option 1</option>
											<option value="">Option 2</option>
											<option value="">Option 3</option>
											<option value="">Option 4</option>
											<option value="">Option 5</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div> <!-- end .header-search-bar -->
				</div>

				<div class="container">
	        <div id="directory-temp" class="bootstrap-wrapper">
	        	<div class="main clearfix directory-option">
	        		<div class="row">
								<div class="col-md-6 col-sm-6">
									<h3>Professionals</h3>
								</div>
								<form class="col-md-6 col-sm-6"   action="<?php echo the_permalink(); ?>" method="post"  >
									<div class="sort-by-select">
									   <select id="package_sel" name="package_sel" class="" >
								     <?php
										   $sql="SELECT * FROM $wpdb->posts WHERE post_type = 'iv_directories_pack'  and post_status='draft' ";
										$membership_pack = $wpdb->get_results($sql);
											echo'<option value="">Sort by</option>';
										foreach ( $membership_pack as $row ){
											echo'<option value="'.$row->ID.'"  '.($package==$row->ID ? " selected" : " ") .' >'.$row->post_title.'</option>';

										}

										  ?>
										  </select >

								  </div>
								</form>

	        		</div>

	        	</div>
					<section class="main">
								<ul class="ch-grid row">
				        <?php

				        if(isset($atts['per_page'])){
							 $no=$atts['per_page'];
						}else{
							$no=12;
						}

						$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						if($paged==1){
						  $offset=0;
						}else {
						   $offset= ($paged-1)*$no;
						}
				        $args = array();
				        $args['number']=$no;
				        $args['offset']=$offset;
				        $args['orderby']='registered';
				        $args['order']='DESC';
				        //$args['search']='12';
				        //$args['search_columns']=array( 'user_login', 'user_email' );
				        if($package!=''){
							$role_package= get_post_meta( $package,'iv_directories_package_user_role',true);
							$args['role']=$role_package;
						}
						  if($search_user!=''){
							$args['search']='*'.$search_user.'*';
						}



						$reg_page_user='';

						if(isset($atts['role'])){
							 $args['role']=$atts['role'];
						}
				        $user_query = new WP_User_Query( $args );

				        // User Loop
				        if ( ! empty( $user_query->results ) ) {
				        	foreach ( $user_query->results as $user ) {

								if (isset($user->wp_capabilities['administrator'])!=1 ){

								$iv_profile_pic_url=get_user_meta($user->ID, 'iv_profile_pic_thum',true);
								$reg_page_u=$reg_page_user.'?&id='.$user->user_login; //$reg_page ;
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
									<li class="col-md-3 col-sm-4">

										<div class="ch-item">
										<a href="<?php echo $reg_page_user.'?&id='.$user->user_login; ?>">
						                    <?php
						                    if($iv_profile_pic_url!=''){ ?>
								        	 <img src="<?php echo $iv_profile_pic_url; ?>" class="home-img wide tall">
								        	<?php
								        	}else{
								        	 echo'	 <img src="'. wp_iv_directories_URLPATH.'assets/images/Blank-Profile.jpg" class="home-img wide tall">';
								   		} ?>
											<div class="ch-info">
											</div>
											</a>
										</div>
										<div class="user-details">
																	<p class="para text-center">
																			  <?php
																			  if(get_user_meta($user->ID,'twitter',true)!=''){
																			  ?>
																			  <a href="http://www.twitter.com/<?php  echo get_user_meta($user->ID,'twitter',true);  ?>/">
																	          <i class="fa fa-twitter"></i>
																	          </a>
																			  <?php
																			  }
																			  if(get_user_meta($user->ID,'linkedin',true)!=''){
																			  ?>
																	          <a href="http://www.linkedin.com/<?php  echo get_user_meta($user->ID,'linkedin',true);  ?>/">
																	          <i class="fa fa-linkedin"></i>
																	          </a>
																			  <?php
																			  }
																			  if(get_user_meta($user->ID,'facebook',true)!=''){
																			  ?>
																	          <a href="http://www.facebook.com/<?php  echo get_user_meta($user->ID,'facebook',true);  ?>/">
																	          <i class="fa fa-facebook"></i>
																	          </a>
																			  <?php
																			  }
																			   if(get_user_meta($user->ID,'gplus',true)!=''){
																			  ?>
																	          <a href="http://www.plus.google.com/<?php  echo get_user_meta($user->ID,'gplus',true);  ?>/">
																	          <i class="fa fa-google-plus"></i>
																	          </a>
																			  <?php
																			  }
																			  ?>
																	</p>
																	<a href="<?php echo $reg_page_user.'?&id='.$user->user_login; ?>">
																	<h5 class="text-center"><?php echo $user->display_name; ?></h5>
																	</a>
																	<p class="para1 text-center">
																	<?php  	if(get_user_meta($user->ID,'occupation',true)==!""){
																				echo get_user_meta($user->ID,'occupation',true);
																			}
																	}
												  }
											} else {
													     echo 'No users found.';
											 }

											?>

										</div>
										</li>

						</ul>
				</section>
				<div class="text-center">
				<?php
					$total_user = $user_query->total_users;
					$total_pages=ceil($total_user/$no);
					echo '<div id="iv-pagination" class="iv-pagination">';

						echo paginate_links( array(
							'base' =>  '%_%'.'?&package='.$package, // the base URL, including query arg
							'format' => '?&paged=%#%', // this defines the query parameter that will be used, in this case "p"
							'prev_text' => __('&laquo; Previous','tiger'), // text for previous page
							'next_text' => __('Next &raquo;','tiger'), // text for next page
							'total' => $total_pages, // the total number of pages we have
							'current' => $paged, // the current page
							'end_size' => 1,
							'mid_size' => 5,
						));
					echo '</div></div>';
					?>
					</div>


</div>



