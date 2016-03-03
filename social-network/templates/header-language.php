<?php global $chameleon_option_data; ?>



<?php 

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

    if ( is_plugin_active('sitepress-multilingual-cms/sitepress.php') && $chameleon_option_data['chameleon-top-language'] == 1){
    	
    	chameleon_wpml_languages();

    } else {  ?>


		<?php if(isset($chameleon_option_data['chameleon-top-language']) && $chameleon_option_data['chameleon-top-language'] == 1) : ?>
		<div class="language">
			<?php if(isset($chameleon_option_data['chameleon-language']) && is_array($chameleon_option_data['chameleon-language']) && !empty($chameleon_option_data['chameleon-language'])) : ?>
			<a class = "toggle" href = "" >
				EN
			</a>

				<ul>
					<?php foreach($chameleon_option_data['chameleon-language'] as $key => $value){ ?>

					<li><a href="#"><?php echo esc_attr($value); ?></a></li>
					
					<?php } ?>
				</ul>

			<?php endif; ?>
		</div>
		<?php endif; ?>

<?php } ?>
<!-- End Header-Language -->