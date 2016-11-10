<?php
/**
 * Template Name: Home Page New
 *
 */
 ?>

 <?php get_header(); ?>

<?php
wp_enqueue_style('uou_tigerp-owlcarousel', tiger_CSS . 'owl.carousel.css');

wp_enqueue_style('uou_tigerp-profile', tiger_CSS . 'user-public-profile.css');


$iv_gateway=esc_html__('paypal-express','tiger') ;
$stripe_publishable='';
$package_amount=esc_html__('0','tiger');
$api_currency=esc_html__('USD','tiger');
$package_id=esc_html__('0','tiger');
?>


  <div class="medicaldirectory-home-banner">
  	<div class="overlay"></div>
 		<div class="banner-content">
 			<div class="container">
 				<div  class="home-banner-text">
 					<div class="row">
 						<div class="text-center">
 							<div class="banner-icon">
 								<i class="fa fa-user-md"></i>
 							</div>
 							<h2>
 								<?php
 									//echo esc_attr($medicaldirectory_option_data['medicaldirectory-home-banner-text']);
 								?>
 								Welcome to Tiger Medical
 							</h2>
 						</div>
 					</div>
 					<div class="row">
 						<div class="text-center">
 							<p>
 								<?php
 									//$banner_subtitle= (isset($medicaldirectory_option_data['medicaldirectory-home-banner-subtitle'])?$medicaldirectory_option_data['medicaldirectory-home-banner-subtitle']:"");
 									//echo esc_attr($banner_subtitle);
 								?>
 								Search for hospitals and doctors on world wide basis
 							</p>

 						</div>
 					</div>

 				</div>
 				<div class="home-banner-button text-center">
 					<?php
 					//$hospital_banner_button_text= (isset($medicaldirectory_option_data['medicaldirectory-home-banner-button1'])?$medicaldirectory_option_data['medicaldirectory-home-banner-button1']:"");
 					//echo '<button type="button" class="btn-new btn-custom" onclick="location.href=\''.$hospital_link.'\'" >'. $hospital_banner_button_text.'</button>';
 					?>

 					<button type="button" class="btn-new btn-custom" >Find a hospital</button>

 					<?php
 					//$hospital_banner_button_text2= (isset($medicaldirectory_option_data['medicaldirectory-home-banner-button2'])?$medicaldirectory_option_data['medicaldirectory-home-banner-button2']:"");
 					//echo '<button type="button" class="btn-new btn-custom-white" onclick="location.href=\''.$doctor_link.'\'" >'. $hospital_banner_button_text2.'</button>';
 					?>
 					<button type="button" class="btn-new btn-transparent">Find a doctor</button>
 				</div>
 			</div>
 			<div class="home-search-content">
 				<div class="container">
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
											<button type="submit" class="btn-new btn-custom btn-block">
												<i class="fa fa-search"></i>
												<?php esc_html_e('Search','tiger'); ?>
											</button>
										</div>
									</div>


								</form>
								<?php// $pos = $this->get_unique_post_meta_values('designation');?>
								<!-- <script>
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

							  </script> -->

							</div>
						</div> <!-- end .header-search-bar -->
					</div>
				</div>
 			</div>
 		</div>
 </div>


	<div class="home-pro">
     <!-- SERVICES -->
     <?php
	     $row2=(isset($tiger_option_data['tiger-show-page-row2'])? $tiger_option_data['tiger-show-page-row2']: '1' );
	     if($row2==1){
	     ?>

	     <section class="services">

	       <!-- SERVICES ROW -->
	       <ul class="row">

	         <!-- SECTION -->
	         <li class="col-md-4 matchHeight" style="background: <?php echo (isset($tiger_option_data['tiger-home-row2-block1-color']['color'])? $tiger_option_data['tiger-home-row2-block1-color']['color']:'#43b9f6');?>;">
	           <div class="ser-inn" >
	             <h4>
	               <?php
	               echo (isset($tiger_option_data['tiger-home-row2-block1'])? $tiger_option_data['tiger-home-row2-block1']: esc_html__('Stay in touch with your colleagues','tiger'));
	               ?>
	               </h4>
	             <i class="fa fa-globe"></i>
	             <p>
	 				<?php
	               echo (isset($tiger_option_data['tiger-home-row2-block1-sub'])? $tiger_option_data['tiger-home-row2-block1-sub']: esc_html__('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue conseqaut nibbhi ellit ipsum consectetur.','tiger') );
	               ?>
	 				</p>
	             <button class="btn btn-transparent white round">Search Now</button>

	           </div>
	         </li>

	         <!-- SECTION -->
	         <li class="col-md-4 matchHeight"  style="background: <?php echo (isset($tiger_option_data['tiger-home-row2-block2-color']['color'])? $tiger_option_data['tiger-home-row2-block2-color']['color']:'#6686ff');?>;">
	           <div class="ser-inn">
	             <h4>
	               <?php
	               echo (isset($tiger_option_data['tiger-home-row2-block2'])? $tiger_option_data['tiger-home-row2-block2']: esc_html__('Get the latest news in your industry','tiger'));
	               ?>
	               </h4>
	             <i class="fa fa-book"></i>
	             <p><?php
	               echo (isset($tiger_option_data['tiger-home-row2-block2-sub'])? $tiger_option_data['tiger-home-row2-block2-sub']: esc_html__('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue conseqaut nibbhi ellit ipsum consectetur.','tiger') );
	               ?>

	             </p>

	             <button class="btn btn-transparent white round">Search Now</button>
	           </div>
	         </li>

	         <!-- SECTION  -->
	         <li class="col-md-4 matchHeight"  style="background: <?php echo (isset($tiger_option_data['tiger-home-row2-block3-color']['color'])? $tiger_option_data['tiger-home-row2-block3-color']['color']:'#87D37C');?>;">
	           <div class="ser-inn" >
	             <h4>
	              <?php
	               echo (isset($tiger_option_data['tiger-home-row2-block3'])? $tiger_option_data['tiger-home-row2-block3']: esc_html__('Share what’s up  with you','tiger'));
	               ?>
	             </h4>
	             <i class="fa fa-picture-o"></i>
	             <p><?php
	               echo (isset($tiger_option_data['tiger-home-row2-block3-sub'])? $tiger_option_data['tiger-home-row2-block3-sub']: esc_html__('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue conseqaut nibbhi ellit ipsum consectetur.','tiger') );
	               ?></p>

	             <button class="btn btn-transparent white round">Search Now</button>

	           </div>
	         </li>
	       </ul>
	     </section>

	 	<?php
	 	}
	 	?>



 </div>



 <div class="home-page-professianls">
 		<div class="title-container">
	 		<h2 class="home-title" style="text-align: center;"><strong>Professionals Category</strong></h2>
			<div class="home-subtitle">With over 5000 doctors and experts in the healthcare field medical directory provides a listing of all doctors
			across a wide variety if medical fields</div>
 		</div>
 		<div class="container">
 			<?php
					echo do_shortcode("[uou_tigerp_professionals_directory]");
				?>
 		</div>
	</div>


	 <div class="home-page-professianls with-bg-one">
	 		<div class="title-container">
		 		<h2 class="home-title" style="text-align: center;"><strong>Company Category</strong></h2>
				<div class="home-subtitle">With over 5000 doctors and experts in the healthcare field medical directory provides a listing of all doctors
				across a wide variety if medical fields</div>
	 		</div>
	 		<div class="container">
	 			<?php
						echo do_shortcode("[uou_tigerp_company_directory]");
					?>
	 		</div>
		</div>


		<div class="home-page-professianls with-bottom-padding">
	 		<div class="title-container">
		 		<h2 class="home-title" style="text-align: center;"><strong>Join us as a Company</strong></h2>
				<div class="home-subtitle">With over 5000 doctors and experts in the healthcare field medical directory provides a listing of all doctors
				across a wide variety if medical fields</div>
	 		</div>
	 		<div class="container">
	 			<?php
						echo do_shortcode("[uou_tigerp_price_table_company]");
					?>
	 		</div>
		</div>


		<div class="home-page-professianls with-bg-one two">
	 		<div class="title-container">
		 		<h2 class="home-title" style="text-align: center;"><strong>Feature Company Category</strong></h2>
				<div class="home-subtitle">With over 5000 doctors and experts in the healthcare field medical directory provides a listing of all doctors
				across a wide variety if medical fields</div>
	 		</div>
	 		<div class="container">
	 			<?php
						echo do_shortcode("[uou_tigerp_company_directory]");
					?>
	 		</div>
		</div>


		<div class="home-page-professianls">
	 		<div class="title-container">
		 		<h2 class="home-title" style="text-align: center;"><strong>Feature Professionals Category</strong></h2>
				<div class="home-subtitle">With over 5000 doctors and experts in the healthcare field medical directory provides a listing of all doctors
				across a wide variety if medical fields</div>
	 		</div>
	 		<div class="container">
	 			<?php
						echo do_shortcode("[uou_tigerp_professionals_directory]");
					?>
	 		</div>
		</div>

		<div class="home-page-professianls no-padding">
				<!-- TESTIMONIALS -->
    <?php

         $row5=(isset($tiger_option_data['tiger-testimonial-switch'])? $tiger_option_data['tiger-testimonial-switch']: '1' );
		if($row5==1){
		$testimonials_data= (isset($tiger_option_data['tiger-our-testimonials'][0]['title'])? $tiger_option_data['tiger-our-testimonials'][0]['title']: '' );

		if($testimonials_data==''){


			$tiger_option_data['tiger-our-testimonials']=array(
					array( 'title'=>'John Kevin Mara',
							'description'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue.',
							'url'=>'smashingmagazine.com',
							'image'=> tiger_IMAGE.'avatar-1.jpg',
				),
				array( 'title'=>'John Kevin Mara',
							'description'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue.',
							'url'=>'smashingmagazine.com',
							'image'=> tiger_IMAGE.'member-2.png',
				),
				array( 'title'=>'John Kevin Mara',
							'description'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue.',
							'url'=>'smashingmagazine.com',
							'image'=> tiger_IMAGE.'clients-avatar-1.jpg',
				),
			);

		}

    ?>

    <section class="clients-says">
      <div class="container">
        <h3 class="section-title"><?php
              echo (isset($tiger_option_data['tiger-testimonial-head'])? $tiger_option_data['tiger-testimonial-head']: esc_html__('What our users say','tiger'));
              ?>  </h3>
        <div class="testi">
          <div class="texti-slide">
			  <?php

			   foreach($tiger_option_data['tiger-our-testimonials'] as $t_slider){?>

				      <!-- SLide -->
						<div class="clints-text">
						  <div class="text-in">
							<p>
							<?php echo (isset($t_slider['description'])?$t_slider['description'] :''); ?>
							</p>
						  </div>
						  <div class="avatar">
							<div class=""> <a href="#"> <img src="<?php echo (isset($t_slider['image'])?$t_slider['image'] :''); ?>" alt="<?php esc_html_e('Image.', 'tiger');?>"> </a> </div>
							<div class="media-body">
							  <h6><?php echo (isset($t_slider['title'])?$t_slider['title'] :''); ?></h6>
							  <span><?php echo (isset($t_slider['url'])?$t_slider['url'] :''); ?></span> </div>
						  </div>
						</div>

					<!-- SLide -->

			<?php
			  }
			  ?>

          </div>
        </div>
      </div>
    </section>

	<?php
	}
	?>


			</div>










<?php get_footer(); ?>