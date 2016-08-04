<style>
.bs-callout {
    margin: 20px 0;
    padding: 15px 30px 15px 15px;
    border-left: 5px solid #eee;
}
.bs-callout-info {
    background-color: #E4F1FE;
    border-color: #22A7F0;
}
.html-active .switch-html, .tmce-active .switch-tmce {
	height: 28px!important;
	}
	.wp-switch-editor {
		height: 28px!important;
	}
</style>	
	

		<h3  class=""><?php _e('Directory Setting','tiger');  ?><small></small>	
		</h3>
	
		<br/>
		<div id="update_message"> </div>		 
					
			<form class="form-horizontal" role="form"  name='directory_settings' id='directory_settings'>											
					<?php
				
					$new_badge_day=get_option('_iv_new_badge_day');
					//$bid_start_amount=get_option('_bid_start_amount');
					$dir_approve_publish =get_option('_dir_approve_publish');
					$dir_archive=get_option('_dir_archive_page');	
					if($dir_approve_publish==""){$dir_approve_publish='no';}
					
					$dir_claim_show=get_option('_dir_claim_show');	
					if($dir_claim_show==""){$dir_claim_show='yes';}
					
					$search_button_show=get_option('_search_button_show');	
					if($search_button_show==""){$search_button_show='yes';}
					
					$dir_searchbar_show=get_option('_dir_searchbar_show');	
					if($dir_searchbar_show==""){$dir_searchbar_show='no';}
					
					$dir_map_show=get_option('_dir_map_show');	
					if($dir_map_show==""){$dir_map_show='no';}
						
					?>
					<!--
					<div class="form-group">
					<label  class="col-md-3 control-label"> <?php _e('Days #','tiger');  ?></label>
						<div class="col-md-2">						
							<input type="text" class="form-control" name="iv_new_badge_day" id="iv_new_badge_day" value="<?php echo $new_badge_day;?>" placeholder="Enter Days">
							
						</div>
						<div class="col-md-7">
							<img  width="40px" src="<?php echo  wp_uou_tigerp_URLPATH."/assets/images/newicon-big.png";?>">	
							<?php _e('The new item badge will show for the days','tiger');  ?>
						</div>	
					</div>
					-->
					<div class="form-group">
						<label  class="col-md-3 control-label"> <?php _e('Listing Page toggle button[Search + Map] ','tiger');  ?></label>
					
					<div class="col-md-2">
							<label>												
							<input type="radio" name="search_button_show" id="search_button_show" value='yes' <?php echo ($dir_map_show=='yes' ? 'checked':'' ); ?> ><?php _e('Show','tiger');  ?>
							</label>	
						</div>
						<div class="col-md-3">	
							<label>											
							<input type="radio"  name="search_button_show" id="search_button_show" value='no' <?php echo ($dir_map_show=='no' ? 'checked':'' );  ?> > <?php _e('Hide','tiger');  ?>
							</label>
						</div>	
					</div>
					<div class="form-group">
						<label  class="col-md-3 control-label"> <?php _e('Listing Page Top Map','tiger');  ?></label>
					
					<div class="col-md-2">
							<label>												
							<input type="radio" name="dir_map_show" id="dir_map_show" value='yes' <?php echo ($dir_map_show=='yes' ? 'checked':'' ); ?> ><?php _e('Show  Top Map','tiger');  ?>
							</label>	
						</div>
						<div class="col-md-3">	
							<label>											
							<input type="radio"  name="dir_map_show" id="dir_map_show" value='no' <?php echo ($dir_map_show=='no' ? 'checked':'' );  ?> > <?php _e('Hide Top Map','tiger');  ?>
							</label>
						</div>	
					</div>
					
					
					<div class="form-group">
						<label  class="col-md-3 control-label"> <?php _e('Listing Page Search Bar','tiger');  ?></label>
					
					<div class="col-md-2">
							<label>												
							<input type="radio" name="dir_searchbar_show" id="dir_searchbar_show" value='yes' <?php echo ($dir_searchbar_show=='yes' ? 'checked':'' ); ?> ><?php _e('Show  Search Bar','tiger');  ?>
							</label>	
						</div>
						<div class="col-md-3">	
							<label>											
							<input type="radio"  name="dir_searchbar_show" id="dir_searchbar_show" value='no' <?php echo ($dir_searchbar_show=='no' ? 'checked':'' );  ?> > <?php _e('Hide Search Bar','tiger');  ?>
							</label>
						</div>	
					</div>
					
					
					<div class="form-group">
						<label  class="col-md-3 control-label"> <?php _e('Claim','tiger');  ?></label>
					
					<div class="col-md-2">
							<label>												
							<input type="radio" name="dir_claim_show" id="dir_claim_show" value='yes' <?php echo ($dir_claim_show=='yes' ? 'checked':'' ); ?> ><?php _e('Show Claim','tiger');  ?>
							</label>	
						</div>
						<div class="col-md-3">	
							<label>											
							<input type="radio"  name="dir_claim_show" id="dir_claim_show" value='no' <?php echo ($dir_claim_show=='no' ? 'checked':'' );  ?> > <?php _e('Hide Claim','tiger');  ?>
							</label>
						</div>	
					</div>
					
					
					<div class="form-group">
						<label  class="col-md-3 control-label"> <?php _e('Listing Publish By User','tiger');  ?></label>
					
					<div class="col-md-2">
							<label>												
							<input type="radio" name="dir_approve_publish" id="dir_approve_publish" value='yes' <?php echo ($dir_approve_publish=='yes' ? 'checked':'' ); ?> >
							<?php _e('Admin Will Approve ','tiger');  ?>   
							</label>	
						</div>
						<div class="col-md-3">	
							<label>											
							<input type="radio"  name="dir_approve_publish" id="dir_approve_publish" value='no' <?php echo ($dir_approve_publish=='no' ? 'checked':'' );  ?> >
							<?php _e('User Can Publish','tiger');  ?> 
							 
							</label>
						</div>	
					</div>
					
					<?php
					$dir_search_redius=get_option('_dir_search_redius');	
					if($dir_search_redius==""){$dir_search_redius='Km';}	
					?>
					<div class="form-group">
					<label  class="col-md-3 control-label"> <?php _e('Listing Radius','tiger');  ?></label>
					
					<div class="col-md-2">
							<label>												
							<input type="radio" name="dir_search_redius" id="dir_search_redius" value='Km' <?php echo ($dir_search_redius=='Km' ? 'checked':'' ); ?> > Km  
							</label>	
						</div>
						<div class="col-md-2">	
							<label>											
							<input type="radio"  name="dir_search_redius" id="dir_search_redius" value='Miles' <?php echo ($dir_search_redius=='Miles' ? 'checked':'' );  ?> > Miles
							</label>
						</div>	
					</div>
					
					<br/>
					
					
				<div class="form-group">
					<label  class="col-md-3 control-label"> <?php _e('Cron Job URL','tiger');  ?>						 
					
					</label>
					
						<div class="col-md-6">
							<label>												
							 <b> <a href="<?php echo admin_url('admin-ajax.php'); ?>?action=uou_tigerp_cron_job"><?php echo admin_url('admin-ajax.php'); ?>?action=uou_tigerp_cron_job </a></b>
							
							</label>	
						</div>
						<div class="col-md-3">
							Cron JOB Detail : Hide Listing( Package setting),Subscription Remainder email.
						</div>		
							
					</div>
					
					
				
					<div class="form-group">
					<label  class="col-md-3 control-label"> </label>
					<div class="col-md-8">
						
						<button type="button" onclick="return  iv_update_dir_setting();" class="btn btn-success">Update</button>
					</div>
				</div>
						
			</form>
								

	
<script>

function iv_update_dir_setting(){
var search_params={
		"action"  : 	"iv_update_dir_setting",	
		"form_data":	jQuery("#directory_settings").serialize(), 
	};
	jQuery.ajax({					
		url : ajaxurl,					 
		dataType : "json",
		type : "post",
		data : search_params,
		success : function(response){
			jQuery('#update_message').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
			
		}
	})

}

	

</script>
