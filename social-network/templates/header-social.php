<?php global $chameleon_option_data; ?>

<!-- Start Social -->
<?php if(isset($chameleon_option_data['chameleon-share-button']) && $chameleon_option_data['chameleon-share-button'] == 1) : ?>
	<ul class="social">
	<?php if(isset($chameleon_option_data['chameleon-share-button-facebook']) && $chameleon_option_data['chameleon-share-button-facebook'] == 1) : ?>
	<li><a class="fa fa-facebook" href="http://www.facebook.com/sharer.php?u=<?php home_url('/');?> "></a></li>
	<?php endif; ?>
	<?php if(isset($chameleon_option_data['chameleon-share-button-twitter']) && $chameleon_option_data['chameleon-share-button-twitter'] == 1) : ?>
	<li><a class="fa fa-twitter" href="http://twitthis.com/twit?url=<?php home_url('/'); ?>"></a></li>
	<?php endif; ?>
	<?php if(isset($chameleon_option_data['chameleon-share-button-linkedin']) && $chameleon_option_data['chameleon-share-button-linkedin'] == 1) : ?>
	<li><a class="fa fa-google-plus" href="http://plus.google.com/share?url=<?php home_url('/');?>"></a></li>
	<?php endif; ?>
	</ul> 
<?php endif; ?>
<!-- End Social -->