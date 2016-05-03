<?php $tiger_option_data =get_option('tiger_option_data');  ?>

<!-- Start Social -->
<?php if(isset($tiger_option_data['tiger-share-button']) && $tiger_option_data['tiger-share-button'] == 1) : ?>
<ul class="buttons">
	<?php if(isset($tiger_option_data['tiger-share-button-facebook']) && $tiger_option_data['tiger-share-button-facebook'] == 1) : ?>
	<li><a class="fa fa-facebook" href="http://www.facebook.com/sharer.php?u=<?php home_url('/');?> "></a></li>
	<?php endif; ?>
	<?php if(isset($tiger_option_data['tiger-share-button-twitter']) && $tiger_option_data['tiger-share-button-twitter'] == 1) : ?>
	<li><a class="fa fa-twitter" href="http://twitthis.com/twit?url=<?php home_url('/'); ?>"></a></li>
	<?php endif; ?>
	<?php if(isset($tiger_option_data['tiger-share-button-linkedin']) && $tiger_option_data['tiger-share-button-linkedin'] == 1) : ?>
	<li><a class="fa fa-google-plus" href="http://plus.google.com/share?url=<?php home_url('/');?>"></a></li>
	<?php endif; ?>
</ul> 
<?php endif; ?>
<!-- End Social -->