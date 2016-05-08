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
	<div id="main-wrapper">	
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
		
		  <!-- Members -->
    <section class="pro-mem">
      <div class="container pb30">
        <h3><?php esc_html_e('Professionals','tiger'); ?>  </h3>
        <div class="row">
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
									
								$iv_profile_pic_url=get_user_meta($user->ID, 'iv_profile_pic_url',true);
								$reg_page_u=$reg_page_user.'?&id='.$user->user_login; //$reg_page ;
								$reg_page_user='';
								$user_type= get_user_meta($user->ID,'iv_member_type',true);
								if($iv_profile_pic_url==''){
								 $iv_profile_pic_url=wp_iv_directories_URLPATH.'assets/images/Blank-Profile.jpg';
								}	 
								if($user_type=='corporate'){
									$iv_redirect_user = get_option( '_iv_corporate_profile_public_page');
								    $reg_page_user= get_permalink( $iv_redirect_user) ;
								}else{
									
									$iv_redirect_user = get_option( '_iv_personal_profile_public_page');
								    $reg_page_user= get_permalink( $iv_redirect_user) ;
								}
								?>
								<div class="col-sm-3">
								   <div class="uou-block-6a "> <img src="<?php echo $iv_profile_pic_url; ?>" alt="">
									  <a href="<?php echo $reg_page_user.'?&id='.$user->user_login; ?>"><h6><?php echo get_user_meta($user->ID,'profile_name',true); ?> <span><?php echo get_user_meta($user->ID,'designation',true);   ?></span></h6></a>
									  <p><i class="fa fa-map-marker"></i> <?php echo get_user_meta($user->ID,'address',true); ?></p>
									</div>
									<!-- end .uou-block-6a --> 
								</div>
								
							
							<?php	
								
							}
						}
					}
			
			?>
        </div>
      </div>
    </section>
  
	
	</div>	
