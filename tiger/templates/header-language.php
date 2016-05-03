<?php $tiger_option_data =get_option('tiger_option_data');  ?>



<?php 

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

    if ( is_plugin_active('sitepress-multilingual-cms/sitepress.php') && $tiger_option_data['tiger-top-language'] == 1){
    	
    	tiger_wpml_languages();

    } else {  ?>


		<?php if(isset($tiger_option_data['tiger-top-language']) && $tiger_option_data['tiger-top-language'] == 1) : ?>
		<div class="language">
			<?php if(isset($tiger_option_data['tiger-language']) && is_array($tiger_option_data['tiger-language']) && !empty($tiger_option_data['tiger-language'])) : ?>
			<a class = "toggle" href = "" >
				EN
			</a>

				<ul>
					<?php foreach($tiger_option_data['tiger-language'] as $key => $value){ ?>

					<li><a href="#"><?php echo esc_attr($value); ?></a></li>
					
					<?php } ?>
				</ul>

			<?php endif; ?>
		</div>
		<?php endif; ?>

<?php } ?>
<!-- End Header-Language -->