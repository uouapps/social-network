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
	

		<h3  class=""><?php _e('Setting','tiger');  ?><small></small>	
		</h3>
	
		<br/>
		<div id="update_message"> </div>		 
					
			<form class="form-horizontal" role="form"  name='directory_settings' id='directory_settings'>											
					<?php
				
					$new_badge_day=get_option('_iv_new_badge_day');
					//$bid_start_amount=get_option('_bid_start_amount');
					 $dir_approve_publish =get_option('_dir_approve_publish');
					if($dir_approve_publish==""){$dir_approve_publish='no';}
					
					$blog_approve_publish =get_option('_blog_approve_publish');
					if($blog_approve_publish==""){$blog_approve_publish='no';}
					
					$job_approve_publish =get_option('_job_approve_publish');
					if($job_approve_publish==""){$job_approve_publish='no';}
					
					
					
				
						
					?>
					
					
					
					
					
					
					<div class="form-group">
						<label  class="col-md-3 control-label"> <?php _e('Company & Professional','tiger');  ?></label>
					
					<div class="col-md-4">
							<label>												
							<input type="radio" name="dir_approve_publish" id="dir_approve_publish" value='yes' <?php echo ($dir_approve_publish=='yes' ? 'checked':'' ); ?> >
							<?php _e(" Don't publish without admin approval",'tiger');  ?>
							</label>	
						</div>
						<div class="col-md-3">	
							<label>											
							<input type="radio"  name="dir_approve_publish" id="dir_approve_publish" value='no' <?php echo ($dir_approve_publish=='no' ? 'checked ':'' );  ?> >
							<?php _e('User Can Publish','tiger');  ?> 
							 
							</label>
						</div>	
					</div>
					
					<div class="form-group">
						<label  class="col-md-3 control-label"> <?php _e('Blog','tiger');  ?></label>
					
					<div class="col-md-4">
							<label>												
							<input type="radio" name="blog_approve_publish" id="blog_approve_publish" value='yes' <?php echo ($blog_approve_publish=='yes' ? 'checked':'' ); ?> >
							<?php _e(" Don't publish without admin approval",'tiger');  ?>
							</label>	
						</div>
						<div class="col-md-3">	
							<label>											
							<input type="radio"  name="blog_approve_publish" id="blog_approve_publish" value='no' <?php echo ($blog_approve_publish=='no' ? 'checked':'' );  ?> >
							<?php _e('User Can Publish','tiger');  ?> 
							 
							</label>
						</div>	
					</div>
					
					<div class="form-group">
						<label  class="col-md-3 control-label"> <?php _e('Job','tiger');  ?></label>
					
						<div class="col-md-4">
							<label>												
							<input type="radio" name="job_approve_publish" id="job_approve_publish" value='yes' <?php echo ($job_approve_publish=='yes' ? 'checked':'' ); ?> >
							<?php _e(" Don't publish without admin approval",'tiger');  ?>
							</label>	
						</div>
						<div class="col-md-3">	
							<label>											
							<input type="radio"  name="job_approve_publish" id="job_approve_publish" value='no' <?php echo ($job_approve_publish=='no' ? 'checked':'' );  ?> >
							<?php _e('User Can Publish','tiger');  ?> 
							 
							</label>
						</div>	
					</div>
					
					
					
				<div class="form-group">
					<label  class="col-md-3 control-label"> <?php _e('Cron Job URL','tiger');  ?>						 
					
					</label>
					
						<div class="col-md-6">
							<label>												
							 <b> <a href="<?php echo admin_url('admin-ajax.php'); ?>?action=uou_tigerp_cron_job"><?php echo admin_url('admin-ajax.php'); ?>?action=uou_tigerp_cron_job </a></b>
							
							</label>	
						</div>
						<div class="col-md-3">
							Cron JOB Detail : Hide jobs( Package setting),Subscription Remainder email.
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
