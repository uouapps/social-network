<div class="bootstrap-wrapper">
	<div class="welcome-panel container-fluid">
		
		<div class="row">
			<div class="col-md-12">
				
				<h3 class="page-header" ><?php _e('My Account','tiger');?> <small>  </small> </h3>
				
				
				
			</div>
		</div>
		
		
		<div class="form-group col-md-12 row">
			
			<div class="row ">
				<label for="text" class="col-md-2 control-label"><?php _e('Short Code','tiger');?> </label>
				<div class="col-md-4" >
					[uou_tigerp_profile_template]
				</div>
				<div class="col-md-4" id="success_message">
				</div>
			</div>
			<div class="row ">
				<label for="text" class="col-md-2 control-label"><?php _e('Php Code','tiger');?> </label>
				<div class="col-md-10" >
							<p>
										&lt;?php
										echo do_shortcode('[uou_tigerp_profile_template]');
										?&gt;</p>	
				</div>
			</div>
			<div class="row ">
				<label for="text" class="col-md-2 control-label"> <?php _e('My Account Page','tiger');?> </label>
				<div class="col-md-10" >
					<!--
					 get_option('_uou_tigerp_registration','73');
					-->
					<?php 
					$form_wizard=get_option('_uou_tigerp_profile_page');
							//echo get_the_title( $form_wizard );  ?>
					<a class="btn btn-info btn-xs " href="<?php echo get_permalink( $form_wizard ); ?>" target="blank"><?php _e('View Page','tiger');?> </a>
				
					
				</div>
			</div>
			<div class="row ">
				<label for="text" class="col-md-2 control-label"> <?php _e('Profile Fields Setting','tiger');?> </label>
				<div class="col-md-10" >	
					<a class="btn btn-primary btn-xs" href="?page=wp-uou_tigerp-profile-fields"><?php _e('Add /Edit/ Remove Profile Fields','tiger');?>   </a>
											
				</div>
			</div>
			<div class="row ">
				<label for="text" class="col-md-2 control-label"> <?php _e('My Account Menu','tiger');?>  </label>
				<div class="col-md-10" >	
					<a class="btn btn-primary btn-xs" href="?page=wp-uou_tigerp-profile-fields"> <?php _e('Show/Hide/Add Menu','tiger');?> </a>
											
				</div>
			</div>
			<br/>
			
			<table class="table">
				<!--
				<?php
					$opt_style=	get_option('uou_tigerp_profile-template');
				?>
				<tr>
					<td >
							<label >
									<input type="radio" name="option-profile" id="option-profile" value="style-1"  <?php  echo ($opt_style=='style-1' ? 'checked': ''); ?> >
									Style 1 
								</label>
					</td>
					<td>
						<?php //include( wp_uou_tigerp_template. 'private-profile/profile-template-1.php');?>
					</td>	
				</tr>
				-->
					
				
			</table>	
				
				
			
		</div>
		
			
		
	</div>
</div>
<script type="text/javascript">
	 jQuery(document).ready(function () {

		   jQuery("input[type='radio']").click(function(){
				update_profile_template();
		   });

		});
function update_profile_template(){
	
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
		var search_params = {
			"action": 			"uou_tigerp_update_profile_template",
			"profile-st": jQuery("input[name=option-profile]:checked").val(),	
		};
		jQuery.ajax({
			url: ajaxurl,
			dataType: "json",
			type: "post",
			data: search_params,
			success: function(response) {              		
				jQuery("#success_message").html('<h4><span style="color: #04B404;"> ' + response.code + '</span></h4>');
			}
		});
}
</script>
