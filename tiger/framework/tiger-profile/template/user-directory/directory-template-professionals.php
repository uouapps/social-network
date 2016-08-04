<meta name="viewport" content="width=device-width, initial-scale=1">
<title> <?php wp_title('|', true, 'right'); ?> </title>
<!-- Bootstrap -->

<?php
wp_enqueue_style('user-dir-style', tiger_CSS.'user-directory.css', array(), $ver = false, $media = 'all');
$address=(isset($_REQUEST['address'])?$_REQUEST['address'] :'');
$keyword=(isset($_REQUEST['keyword'])?$_REQUEST['keyword'] :'');
$profession=(isset($_REQUEST['profession'])?$_REQUEST['profession'] :'');

global $wpdb;

		?>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery-ui.css" type="text/css" />  
		
	<div >
		<div id="header">
					<div class="header-search-bar">
						<div class="">
							<form  action="<?php echo the_permalink(); ?>" method="post" onkeypress="return event.keyCode != 13;">
								<div class="basic-form clearfix">
									<!--
									<a href="#" class="toggle"></a>
									-->
									<div class="hsb-input-1">
										<input type="text" id="keyword" name="keyword" class="form-control" value="<?php echo $keyword;?>" placeholder="<?php esc_html_e('Keyword','tiger'); ?>">
									</div>

									<div class="hsb-container">
										<div class="hsb-input-2">
											<input type="text" id="address" name="address" value="<?php echo $address;?>"  class="form-control" placeholder="<?php esc_html_e('City','tiger'); ?>">
											<input type="hidden" id="latitude" name="latitude"  value="" >
											<input type="hidden" id="longitude" name="longitude"  value="" >
											<input type="hidden" id="city" name="city" >
										</div>

										<div class="hsb-select">
											<input type="text" id="profession" name="profession" class="form-control" value="<?php echo $profession;?>"  placeholder="<?php esc_html_e('Profession','tiger'); ?>">


										</div>
									</div>

									<div class="hsb-submit">
										<input type="submit" class="btn btn-default btn-block" value="<?php esc_html_e('Search Professionals','tiger'); ?>">
									</div>
								</div>


							</form>
							<?php $pos = $this->get_unique_post_meta_values('designation');?>
							<script>
							  jQuery(function() {
								var availableTags = [ "<?php echo  implode('","',$pos); ?>" ];
								jQuery( "#profession" ).autocomplete({source: availableTags});
							  });
							</script>
							<script type="text/javascript">
								var google;
								jQuery(document).ready(function($) {
									
									google.maps.event.addDomListener(window, 'load', initialize_address);
									function initialize_address() {
										var input = document.getElementById('address');
										var autocomplete = new google.maps.places.Autocomplete(input);
											google.maps.event.addListener(autocomplete, 'place_changed', function () {
											var place = autocomplete.getPlace();
											document.getElementById('city').value = place.name;
											document.getElementById('latitude').value = place.geometry.location.lat();
											document.getElementById('longitude').value = place.geometry.location.lng();

										});
									}
									

								});
								
						    </script>
							
						</div>
						<div class="advanced-form">

							<div class="">
								<div class="row">
									<label class="col-md-3 filter-result"><?php esc_html_e('Filter Results','tiger'); ?></label>

									<div class="col-md-9">
									</div>
								</div>
								<div class="row">
									<label class="col-md-3"><?php esc_html_e('Distance (in kilometers)','tiger'); ?>:</label>

									<div class="col-md-9">
										<div class="range-slider">
											<div class="slider" data-min="1" data-max="200" data-current="100"></div>
											<div class="last-value"><span><?php esc_html_e('100','tiger'); ?></span><?php esc_html_e('km','tiger'); ?> </div>
										</div>
									</div>
								</div>

								<div class="row">
									<label class="col-md-3"><?php esc_html_e('Rating','tiger'); ?>:</label>

									<div class="col-md-9">
										<div class="range-slider">
											<div class="slider" data-min="1" data-max="100" data-current="20"></div>
											<div class="last-value">&gt; <span>20</span> %</div>
										</div>
									</div>
								</div>

								
							</div>
						</div>
					</div> <!-- end .header-search-bar -->
				</div>

		  <!-- Members -->
    <section class="pro-mem">
      <div class=" pb30">

        <div class="row">
			 <?php
						$search_user='';
						if(isset($_REQUEST['keyword'])){
							 $search_user = $_REQUEST['keyword'];
						}

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
				        $profession_type_mq=array();
				        $city_mq=array();
				        $user_status_t=array();
				        
				        $args['number']=$no;
				        $args['offset']=$offset;
				        $args['orderby']='registered';
				        $args['order']='DESC';

				        
						
						$user_status_t = array(								
								array(
									'key' => 'uou_tigerp_user_status',
									'value' => 'active',
									'compare' => '=',
									
								)
						);
					
						if(isset($_REQUEST['city']) AND $_REQUEST['city']!=''){							
								$city_mq = array(
								'relation' => 'AND',
									array(
										'key'     => 'city',
										'value'   => $_REQUEST['city'],
										'compare' => 'LIKE'
									),
								);
						}
						if($profession!='' ){
							$profession_type_mq = array(
								'relation' => 'AND',
									array(
										'key'     => 'designation',
										'value'   => $profession,
										'compare' => 'LIKE'
									),
								);
						}
						
						$args['meta_query'] = array(							
							array(
								'key'     => 'iv_member_type',
								'value'   => 'professional',
								'compare' => 'LIKE'
							),
							$user_status_t,$city_mq, $profession_type_mq,
							
							
						);
						
						
				        //$args['search']='12';
				        //$args['search_columns']=array( 'user_login', 'user_email' );

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

								 $iv_profile_pic_url=tiger_IMAGE.'Blank-Profile.jpg';
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
								   <div class="uou-block-6a uer-directory-single">
									   <a href="<?php echo $reg_page_user.'?&id='.$user->user_login; ?>">
								   		<div class="uer-image" style="background: url('<?php echo $iv_profile_pic_url; ?>') center center no-repeat; background-size: cover;">
								   			<!-- <img src="<?php echo $iv_profile_pic_url; ?>" alt=""> -->
								   		</div>
								   		</a>

								   	<div class="user-details">
								   		<a href="<?php echo $reg_page_user.'?&id='.$user->user_login; ?>"><h6><?php echo substr(get_user_meta($user->ID,'profile_name',true), 0, 25 ); ?> &nbsp;<span><?php echo substr(get_user_meta($user->ID,'designation',true), 0, 25 );  ?>&nbsp;</span></h6></a>
								   		<p><i class="fa fa-map-marker"></i> <?php echo substr(get_user_meta($user->ID,'address',true), 0, 32 ); ?>&nbsp;</p>
								   	</div>

									</div>
									<!-- end .uou-block-6a -->
								</div>


							<?php

							}
						}
					}

			?>
			<?php
			 
				if ($user_query->total_users<1 ){
				esc_html_e( 'Sorry, no data matched your criteria.','tiger' );
				}
			?>
        </div>
      </div>
    </section>
    		<div class="text-center">
				<?php
					$total_user = $user_query->total_users;
					$total_pages=ceil($total_user/$no);
					echo '<div id="pagination" class="pagination">';

						echo paginate_links( array(
							'base' =>  '%_%'.'?&keyword='.$search_user, // the base URL, including query arg
							'format' => '?&paged=%#%', // this defines the query parameter that will be used, in this case "p"
							'prev_text' => __('&laquo; Previous','chilepro'), // text for previous page
							'next_text' => __('Next &raquo;','chilepro'), // text for next page
							'total' => $total_pages, // the total number of pages we have
							'current' => $paged, // the current page
							'end_size' => 1,
							'mid_size' => 5,
						));
					echo '</div></div>';
					?>
					</div>



	</div>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

