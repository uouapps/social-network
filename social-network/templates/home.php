<?php
/**
 * Template Name: Home Page
 *
 */
 ?>
 <?php get_header(); ?>
 <?php
 wp_enqueue_style( 'iv_directories-font', 'https://fonts.googleapis.com/css?family=Raleway');


 if(isset($chameleon_option_data['chameleon-show-page-banner-image']) AND $chameleon_option_data['chameleon-show-page-banner-image']==1){
		$top_banner_image= SB_IMAGE."home-top.jpg";
		 if(isset($chameleon_option_data['chameleon-home-banner-image']['url']) AND $chameleon_option_data['chameleon-home-banner-image']['url'] !=""){
			$top_banner_image=  $chameleon_option_data['chameleon-home-banner-image']['url'];
		}
		$page_name_reg=get_option('_iv_directories_registration' );
		$register_link= get_page_link($page_name_reg);
		$hospital_link=get_post_type_archive_link( 'hospital' );
		$doctor_link=get_post_type_archive_link( 'doctor' );
 ?>
 <div class="chilepro-home-banner" style="background: url('<?php echo $top_banner_image;?>') top center no-repeat;">
		<div class="overlay"></div>
		<div class="banner-content">

			<div class="container">
				<div  class="home-banner-text">
					<div class="row">
						<div class="text-center">
							<strong>
								<?php
									echo $chameleon_option_data['chameleon-home-banner-text'];
								?>
							</strong>

						</div>
					</div>
					<div class="row">
						<div class="text-center">
							<p>
								<?php
									$banner_subtitle= (isset($chameleon_option_data['chameleon-home-banner-subtitle'])?$chameleon_option_data['chameleon-home-banner-subtitle']:"");
									echo $banner_subtitle;
								?>
							</p>

						</div>
					</div>

				</div>
				<div class="home-banner-button text-center">
					<?php
					$hospital_banner_button_text= (isset($chameleon_option_data['chameleon-home-banner-button1'])?$chameleon_option_data['chameleon-home-banner-button1']:"");
					echo '<button type="button" class="btn-new btn-custom" onclick="location.href=\''.$hospital_link.'\'" >'. $hospital_banner_button_text.'</button>';
					?>

					<?php
					$hospital_banner_button_text2= (isset($chameleon_option_data['chameleon-home-banner-button2'])?$chameleon_option_data['chameleon-home-banner-button2']:"");
					echo '<button type="button" class="btn-new btn-custom-white" onclick="location.href=\''.$doctor_link.'\'" >'. $hospital_banner_button_text2.'</button>';
					?>
				</div>
			</div>

		</div>


</div>
<?php
	}
?>

<?php
	echo do_shortcode("[search_box bgcolor='1d1d1d']");
?>
 <div class="blog-content pbzero">
 		<div class="container-fluid text-center">
 			<div class="row">
 				<div class="feature-content-body">
 				<div class="col-md-4">
 					<div class="feature-content-single">
 						<h5><i class="fa fa-hospital-o"></i> <?php  esc_html_e('Hospitals','chilepro');  ?> </h5>
 						<p><?php
 						$hospital_top_text= (isset($chameleon_option_data['chameleon-home-top-block1'])?$chameleon_option_data['chameleon-home-top-block1']:"");
 						echo $hospital_top_text;  ?></p>
 						<div class="button-content">
 							<?php
 								$button_link= get_post_type_archive_link( 'hospital' );
 								echo '<button type="button" class="btn btn-transparent" onclick="location.href=\''.$button_link.'\'" >'.  __('Search Now ','chilepro').'</button>';
 							?>
 						</div>
 					</div>
 				</div>
 				<div class="col-md-4">
 					<div class="feature-content-single middle">
 						<h5><i class="fa fa-user-md"></i><?php  esc_html_e('Doctors','chilepro');  ?> </h5>
 						<p><?php
 						$doctor_top_text= (isset($chameleon_option_data['chameleon-home-top-block2'])?$chameleon_option_data['chameleon-home-top-block2']:"");
 						echo $doctor_top_text;
 					  ?></p>
 						<div class="button-content">
 							<?php
 							$button_link= get_post_type_archive_link( 'doctor' );
 							echo '<button type="button" class="btn btn-transparent" onclick="location.href=\''.$button_link.'\'" >'.  __('Search Now ','chilepro').'</button>';
 							?>
 						</div>
 					</div>
 				</div>
 				<div class="col-md-4">
 					<div class="feature-content-single">
 						<h5><i class="fa fa-file-text-o"></i><?php  esc_html_e('Registration','chilepro');  ?> </h5>
 						<p><?php
 						$register_top_text= (isset($chameleon_option_data['chameleon-home-top-block3'])?$chameleon_option_data['chameleon-home-top-block3']:"");
 						echo $register_top_text;
 						 ?></p>
 						<div class="button-content">
 							<?php
 							$page_name_reg=get_option('_iv_directories_registration' );
 							$register_link= get_page_link($page_name_reg);
 							echo '<button type="button" class="btn btn-transparent" onclick="location.href=\''.$register_link.'\'" >'.  __('Register ','chilepro').'</button>';
 							?>
 						</div>
 					</div>
 				</div>
 				</div>
 			</div>
 		</div>



	<div class="container">
		<?php echo apply_filters('the_content',$post->post_content); ?>

	</div>

  </div> <!--  end blog-single -->
</div> <!-- end container -->

<div>
	<?php
		echo do_shortcode("[doctor_featured_home]");
	?>
</div>






<?php get_footer();
