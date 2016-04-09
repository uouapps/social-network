<?php
		$iv_directories_payment_terms=get_option('iv_directories_payment_terms'); 
		$term_text='I have read & accept the <a href="#"> Terms & Conditions</a>';
		if( get_option( 'iv_directories_payment_terms_text' ) ) {
			$term_text= get_option('iv_directories_payment_terms_text'); 
		}
		if($iv_directories_payment_terms=='yes'){
		?>

	<div class="row">
		<div class="col-md-3 "> 
		</div>
		<div class="col-md-9 term-condition"> 
			<label>
			  <input type="checkbox" data-validation="required" 
data-validation-error-msg="You have to agree to our terms "  name="check_terms" id="check_terms"> <?php echo $term_text; ?>
			</label>
		  </div>									
	</div>
													
	<?php
	}	 
					 
			?>	

											
	<div class="form-group row">
		<div class="col-md-3 "> 
		</div>
		<div class="col-md-9 "> 
		
		<div id="paypal-button">
			<?php 
			 $p_amount=$package_amount;
			 $recurring=get_post_meta($package_id, 'iv_directories_package_recurring',true);
			 
			 if($package_amount=="0" or trim($package_amount)=="" ){
				 if($recurring=='on'){
						$p_amount=get_post_meta($package_id, 'iv_directories_package_recurring_cost_initial',true); 
					}
				 
			  }else{
				 $p_amount=$package_amount;
				}			
			 if($package_name!="" AND $p_amount=='0' ){ ?>
				<div id="loading-3" style="display: none;"><img src='<?php echo wp_iv_directories_URLPATH. 'admin/files/images/loader.gif'; ?>' /></div>
				<button  id="submit_iv_directories_payment" name="submit_iv_directories_payment"  type="submit" class="btn-new btn-custom ctrl-btn"  > <?php  esc_html_e('Submit','chilepro');?></button>
				
			<?php
			}else{	
				?>
				<div id="loading-3" style="display: none;"><img src='<?php echo wp_iv_directories_URLPATH. 'admin/files/images/loader.gif'; ?>' /></div>
			<button  id="submit_iv_directories_payment" name="submit_iv_directories_payment" type="submit" class="btn-new btn-custom ctrl-btn"  ><?php  esc_html_e('Submit','chilepro');?>  </button>
			
			<?php 
				}
			?>
			
		</div>	
		
		</div>										
	</div>		
