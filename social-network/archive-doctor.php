<?php get_header(); ?>
	<?php
wp_enqueue_style('iv_directories-style-64', wp_iv_directories_URLPATH . 'assets/cube/css/cubeportfolio.css');
wp_enqueue_style('iv_directories-style-110', SB_CSS . 'listing_style_1.css');
wp_enqueue_script('iv_directories-script-12', wp_iv_directories_URLPATH . 'admin/files/js/markerclusterer.js');


$ins_lat='37.4419';
$ins_lng='-122.1419';

$search_button_show=get_option('_search_button_show');
if($search_button_show==""){$search_button_show='yes';}

$dir_searchbar_show=get_option('_dir_searchbar_show');
if($dir_searchbar_show==""){$dir_searchbar_show='no';}


$dir_map_show=get_option('_dir_map_show');
if($dir_map_show==""){$dir_map_show='no';}

	$dirs_data =array();
	$tag_arr= array();
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args = array(
		'post_type' => 'doctor', // enter your custom post type
		'paged' => $paged,
		'post_status' => 'publish',
		//'fields' => 'all',
		//'orderby' => 'ASC',
		//'posts_per_page'=> '2',  // overrides posts per page in theme settings
	);

	$lat='';$long='';$keyword_post='';$address='';$postcats ='';$selected='';

	if(get_query_var('doctor-category')!=''){
			$postcats = get_query_var('doctor-category');
			$args['doctor-category']=$postcats;
			$selected=$postcats;
	}

	if( isset($_POST['doctor-category'])){
		if($_POST['doctor-category']!=''){
			$postcats = $_POST['doctor-category'];
			$args['doctor-category']=$postcats;
			$selected=$postcats;
			$args['posts_per_page']='999999';
		}
	}


	$radius=get_option('_iv_radius');
	if( isset($_POST['range_value'])){
		$radius = $_POST['range_value'];
	}
	if($radius==''){$radius='50';}

	if( isset($_POST['address'])){
		if($_POST['address']!=""){
			$lat =  $_POST['latitude'];
			$long = $_POST['longitude'];
			$address=trim($_POST['address']);
			$args['lat']=$lat;
			$args['lng']=$long;
			$args['distance']=$radius;
			$args['posts_per_page']='999999';
		}
	}
	if( isset($_POST['keyword'])){
		if($_POST['keyword']!=""){
			$args['s']= $_POST['keyword'];
			$keyword_post=$_POST['keyword'];
			$args['posts_per_page']='999999';
		}
	}
	if( isset($tag)){
		if($tag!=""){
			if(!isset($_POST['keyword'])){
				$args['tag']= $tag;

			}
		}
	}
	if( isset($_POST['tag_arr'])){
		if($_POST['tag_arr']!=""){
			$tag_arr= $_POST['tag_arr'];
			//$tag_arr= get_query_var('tag_arr');
			$tags_string= implode("+", $tag_arr);
			$args['tag']= $tags_string;
		}
	}

	   $the_query = new WP_GeoQuery( $args );


 $paid_ids= array();

?>
<div class="breadcrumb-content">
		<img   src="<?php echo SB_IMAGE."banner-breadcrumb.jpg";?>" >

		<div class="container">
			<h3>	<?php
				esc_html_e( 'Doctors Directory', 'chilepro' );
			?></h3>
		</div>
</div>

<div>

		<div id="top-map" class="<?php echo ($dir_map_show=='yes'? '': 'div-hide') ?>">
			<div id="map"> </div>
		</div>


	 <div id="top-search" class=" navbar-default navbar <?php echo ($dir_searchbar_show=='yes'? '': 'div-hide') ?>" >
		<div class=" navbar-collapse text-left" >
				<form class="form-inline advanced-serach" method="POST"  onkeypress="return event.keyCode != 13;">
					<div class="container">


					<div class="input-field ">
					<div class="">

					 <div class="form-group" class="top-8">
							<input type="text" class="form-control " id="keyword" name="keyword"  placeholder="<?php esc_html_e( 'Keyword', 'chilepro' ); ?>" value="<?php echo $keyword_post; ?>">
					  </div>
				  </div>
				  <div class="">

					  <div class="form-group" class="top-8">
					  <i class="fa fa-chevron-down arrow"></i>
									<?php
								echo '<select name="doctor-category" class="form-control">';
								echo'	<option selected="'.$selected.'" value="">'.__('Any Category','chilepro').'</option>';


										if( isset($_POST['submit'])){
											$selected = $_POST['doctor-category'];
										}
											//directories
											$taxonomy = 'doctor-category';
											$args = array(
												'orderby'           => 'name',
												'order'             => 'ASC',
												'hide_empty'        => true,
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
													'type'                     => 'doctor',
													'parent'                   => $term_parent->term_id,
													'orderby'                  => 'name',
													'order'                    => 'ASC',
													'hide_empty'               => 1,
													'hierarchical'             => 1,
													'exclude'                  => '',
													'include'                  => '',
													'number'                   => '',
													'taxonomy'                 => 'doctor-category',
													'pad_counts'               => false

												);
												$categories = get_categories( $args2 );
												if ( $categories && !is_wp_error( $categories ) ) :


													foreach ( $categories as $term ) {
														echo '<option  value="'.$term->slug.'" '.($selected==$term->slug?'selected':'' ).'>-'.$term->name.'</option>';
													}

												endif;

												?>


									<?php
										$i++;
									}
								endif;
									echo '</select>';
								?>
						</div>
					</div>
					<div class="">
						<div class="form-group" class="top-8">
								<input type="text" class="form-control location-input" id="address" name="address"  placeholder="<?php esc_html_e( 'Location', 'chilepro' ); ?>"
								value="<?php echo trim($address); ?>">
								<i class="fa fa-map-marker marker"></i>
								<input type="hidden" id="latitude" name="latitude"  value="<?php echo $lat; ?>" >
								<input type="hidden" id="longitude" name="longitude"  value="<?php echo $long; ?>">
					  </div>
				  </div>
				  <div class="">
					  <div class="form-group search" class="top-8">
									<button type="submit" id="submit" name="submit"  class="btn-new btn-custom-search "><i class="fa fa-search"></i><span>Search</span></button>
						</div>
					</div>
				  </div>
				  <!-- <div class="range-slider-content row">
				  	<div class="">
						<?php
							$dir_search_redius=get_option('_dir_search_redius');
							if($dir_search_redius==""){$dir_search_redius='Km';}
							?>
						<div class="form-group" class="top-8">
							<?php _e( 'Radius', 'chilepro' ); ?>: <span id="rvalue"><?php echo $radius;?></span><?php echo ' '.$dir_search_redius; ?>
						</div>

					 	<div class="form-group" class="top-8">
								<div class="range range-success">
									<input type="range" name="range" id="range" min="1" max="1000" value="<?php echo $radius;?>" onchange="range.value=value">
									<input type="hidden" name="range_value" id="range_value" value="<?php echo $radius; ?>" >
								</div>
						</div>



						</div> -->



					</div>
				</form>

	 </div>
	</div>


</div>

  <div class="blog-content pt30">

    <div class="container">

      <div class="row">
        <div class="col-md-12">


			<!-- Map**************-->




 <div class="clearfix" class="top-20">
		<?php
		if($search_button_show=='yes'){
		?>
		 <div id="" class="cbp-l-filters-button cbp-l-filters-right">
			<div id="search_toggle_div" class="cbp-filter-item" onclick="toggle_top_search('top-search');" ><?php esc_html_e('Search', 'chilepro' ); ?></div>
			<div  id="map_toggle_div"  class="cbp-filter-item" onclick="toggle_top_map('top-map');"><?php esc_html_e('Map', 'chilepro' ); ?></div>
		</div>
		<?php
		}
		?>
        <div id="js-filters-lightbox-gallery2" class="cbp-l-filters-button cbp-l-filters-left">
           <?php
				if($postcats==''){	?>

            <div data-filter="*" class="cbp-filter-item-active cbp-filter-item"><?php esc_html_e('Show All', 'chilepro' ); ?></div>
            <?php
				$args2 = array(
					'type'                     => 'doctor',
					'orderby'                  => 'name',
					'order'                    => 'ASC',
					'hide_empty'               => true,
					'hierarchical'             => 1,
					'exclude'                  => '',
					'include'                  => '',
					'number'                   => '',
					'taxonomy'                 => 'doctor-category',
					'pad_counts'               => false

				);
				$categories = get_categories( $args2 );
				if ( $categories && !is_wp_error( $categories ) ) :

					foreach ( $categories as $term ) {
						//echo '<div data-filter=".'.$term->slug.'" class="cbp-filter-item"> '.$term->name.'<div class="cbp-filter-counter"></div></div>';
						?>
							<div data-filter="" class="cbp-filter-item"><a style="text-decoration:none;" href="<?php echo get_post_type_archive_link( 'doctor' ).'?&doctor-category='.$term->slug ; ?>">
								<?php echo $term->name; ?>
								</a>
							</div>
					<?php
					}

				endif;
			}if($postcats!=''){ ?>
					<div data-filter="" class="cbp-filter-item"><a href="<?php echo get_post_type_archive_link( 'doctor' ) ; ?>">
						<?php esc_html_e('Show All', 'chilepro' ); ?>
						</a>
					</div>
				<?php
				$custom_cat_obj =  get_term_by('slug',$postcats,'doctor-category');

			    echo '<div data-filter=".'.$postcats.'"  class="cbp-filter-item-active cbp-filter-item"> '.$custom_cat_obj->name.' <div class="cbp-filter-counter"></div></div>';


			}

				?>
        </div>
    </div>

    <div id="js-grid-lightbox-gallery" class="cbp">
       <?php
	$i=1;
	 if ( $the_query->have_posts() ) :

	while ( $the_query->have_posts() ) : $the_query->the_post();
				$id = get_the_ID();

				$gallery_ids=get_post_meta($id ,'image_gallery_ids',true);
				$gallery_ids_array = array_filter(explode(",", $gallery_ids));

				$dir_data['link']=get_post_permalink();
				$dir_data['title']=$post->post_title;
				$dir_data['lat']=get_post_meta($id,'latitude',true);
				$dir_data['lng']=get_post_meta($id,'longitude',true);
				$ins_lat=get_post_meta($id,'latitude',true);
				$ins_lng=get_post_meta($id,'longitude',true);
				$dir_data['address']=get_post_meta($id,'address',true);
				$dir_data['image']= '';
				$feature_image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'thumbnail' );
				if($feature_image[0]!=""){
					//$dir_data['image']= '<img class=" img-responsive" src="'. $feature_image[0].'">';
					$dir_data['image']=  $feature_image[0];
				}
				$dir_data['marker_icon']=wp_iv_directories_URLPATH."/assets/images/map-marker/map-marker.png";
				$currentCategoryId='';
				$terms =get_the_terms($id, "doctor-category");
				if($terms!=""){
					foreach ($terms as $termid) {
						if(isset($termid->term_id)){
							 $currentCategoryId= $termid->term_id;
						}
					}
				}
				$marker = get_option('_cat_map_marker_'.$currentCategoryId,true);
				if($marker!=''){
					$image_attributes = wp_get_attachment_image_src( $marker ); // returns an array
					if( $image_attributes ) {
						$dir_data['marker_icon']= $image_attributes[0];
					}
				}
				array_push( $dirs_data, $dir_data );
					$feature_img='';
					if(has_post_thumbnail()){
						$feature_image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'medium' );
						if($feature_image[0]!=""){
							$feature_img =$feature_image[0];
						}
					}else{
						$feature_img= wp_iv_directories_URLPATH."/assets/images/default-doctor.jpg";

					}

					$currentCategory=wp_get_object_terms( $id, 'doctor-category');
					$cat_link='';$cat_name='';$cat_slug='';
					if(isset($currentCategory[0]->slug)){
						$cat_slug = $currentCategory[0]->slug;
						$cat_name = $currentCategory[0]->name;
						$cat_link= get_term_link($currentCategory[0], 'doctor-category');
					}
					?>
					 <div class="cbp-item <?php echo $cat_slug;?>">
						<a href="<?php echo admin_url('admin-ajax.php'); ?>?action=iv_doctor_ajax_single&id=<?php echo $id; ?>" class="cbp-caption cbp-singlePageInline" data-title="<?php echo $post->post_title; ?><br><?php echo $cat_name ; ?>" rel="nofollow">
							<div class="cbp-caption-defaultWrap">
								<img src="<?php echo $feature_img;?>" alt="">
							</div>
							<div class="cbp-caption-activeWrap">
								<div class="cbp-l-caption-alignLeft">
									<div class="cbp-l-caption-body">
										<div class="cbp-l-caption-title"><?php echo $post->post_title; ?></div>
										<div class="cbp-l-caption-desc"><?php echo $cat_name.'&nbsp;'; ?></div>
									</div>
								</div>
							</div>
						</a>
					</div>

		<?php
		$i++;

	endwhile;
				$dirs_json ='';
				if(!empty($dirs_data)){
					//$dirs_json =json_encode($dirs_data);
					$dirs_json =$dirs_data;
				}

				?>


		<?php else :
			$dirs_json='';

		 ?>

			

		<?php endif; ?>
   </div>
<?php 
	if ( !$the_query->have_posts() ){
	esc_html_e( 'Sorry, no doctor matched your criteria.','chilepro' ); 
	}
?>
					<!--
					ppaging plugin
					https://wordpress.org/plugins/wp-pagenavi/screenshots/
					-->
					  <?php
					  if ( $the_query->have_posts() ){
							   if (function_exists("wp_pagination")) :
									wp_pagination();
								else: ?>


									<div class="cbp-l-filters-left nav-next"><span class="cbp-l-grid-team-name;"><?php previous_posts_link( ''.__( ' Newer Entries', 'chilepro' ).'' ); ?></span></div>
									<div class="cbp-l-filters-right nav-previous" ><span class="cbp-l-grid-team-name"><?php next_posts_link( ''.__( ' Older Entries ', 'chilepro' ).'' ); ?></span></div>



							  <?php endif; 
					}		  
					?>

					<!--END .navigation-links-->




<?php
wp_enqueue_script('iv_directories-ar-script-23', wp_iv_directories_URLPATH . 'assets/cube/js/jquery.cubeportfolio.min.js');
wp_enqueue_script('iv_directories-ar-script-102', wp_iv_directories_URLPATH . 'assets/cube/js/lightbox-main.js');
wp_enqueue_script('archive-hospital-js', SB_JS.'archive-hospital.js', array('jquery'), $ver = true, true );
wp_localize_script('archive-hospital-js', 'chilepro_data', array( 			'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
'loading_image'		=> wp_iv_directories_URLPATH.'admin/files/images/loader.gif',
'current_user_id'	=>get_current_user_id(),
'login_message'		=> __('Please login to remove favorite','chilepro'),
'Add_to_Favorites'	=> __('Add to Favorites','chilepro'),
'Login_claim'		=> __('Please login to Claim The Listing','chilepro'),
'login_favorite'	=> __("Please login to add favorite",'chilepro'),
'ins_lat'=>$ins_lat,
'ins_lng'=>$ins_lng,
'dirs'=> $dirs_json,
) );
?>


            </div> <!-- end .blog-list -->
      </div>
    </div>
  </div> <!-- end .page-content -->



<?php get_footer(); ?>
