<?php $tiger_option_data =get_option('tiger_option_data');  ?>

<!-- Start Social -->
<?php if(isset($tiger_option_data['tiger-share-button']) && $tiger_option_data['tiger-share-button'] == 1) : ?>
	<ul class="social">
	<?php if(isset($tiger_option_data['tiger-share-button-facebook']) && $tiger_option_data['tiger-share-button-facebook'] == 1) : ?>
	<li><a class="fa fa-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( home_url( '/' ) );?> "></a></li>
	<?php endif; ?>
	<?php if(isset($tiger_option_data['tiger-share-button-twitter']) && $tiger_option_data['tiger-share-button-twitter'] == 1) : ?>
	<li><a class="fa fa-twitter" href="https://twitter.com/home?status=<?php echo esc_url( home_url( '/' ) ); ?>"></a></li>
	<?php endif; ?>	
	
	<?php if(isset($tiger_option_data['tiger-share-button-linkedin']) && $tiger_option_data['tiger-share-button-linkedin'] == 1) : ?>	
	<li><a class="fa fa-linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url( home_url( '/' ) );?>"></a></li>
	<?php endif; ?>
	
	<?php if(isset($tiger_option_data['tiger-share-button-google']) && $tiger_option_data['tiger-share-button-google'] == 1) : ?>	
	<li><a class="fa fa-google-plus" href="https://plus.google.com/share?url=<?php echo esc_url( home_url( '/' ) );?>"></a></li>
	<?php endif; ?>
	
	<?php if(isset($tiger_option_data['tiger-share-button-pinterest']) && $tiger_option_data['tiger-share-button-pinterest'] == 1) : ?>	
	<li><a class="fa fa-pinterest" href="https://pinterest.com/pin/create/button/?url=<?php echo esc_url( home_url( '/' ) );?>"></a></li>
	<?php endif; ?>
	
	</ul> 
<?php endif; ?>

<!-- End Social -->
